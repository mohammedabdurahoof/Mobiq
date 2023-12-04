<?php

namespace App\Http\Controllers;

use App\Action\CartAction;
use App\Action\CompareAction;
use App\Action\LanguageAction;
use App\Admin;
use App\ContactInfoItem;
use App\Faq;
use App\Helpers\HomePageStaticSettings;
use App\Language;
use App\Mail\AdminResetEmail;
use App\Mail\BasicMail;
use App\Newsletter;
use App\Page;
use App\Blog;
use App\BlogCategory;
use App\Campaign\Campaign;
use App\HeaderSlider;
use App\Shipping\ShippingAddress;
use App\StaticOption;
use App\User;
use App\Country\Country;
use App\Country\State;
use App\Helpers\CartHelper;
use App\Helpers\CompareHelper;
use App\Helpers\FlashMsg;
use App\Helpers\WishlistHelper;
use Illuminate\Support\Facades\Validator;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductAttribute;
use Modules\Product\Entities\ProductCategory;
use Modules\Product\Entities\ProductSubCategory;
use Modules\Product\Entities\ProductUnit;
use Modules\Product\Entities\Tag;
use App\Shipping\UserShippingAddress;
use App\Tax\CountryTax;
use App\Tax\StateTax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{
    public function index()
    {
        $home_page_id = get_static_option('home_page');
        $page_details = Page::findOrfail($home_page_id);

        $static_field_data = Cache::remember('home_page_cache_key', 600 ,function () {
            return StaticOption::whereIn('option_name', HomePageStaticSettings::get_home_field(get_static_option('home_page_variant')))
                ->get()
                ->mapWithKeys(function ($item) {
                    return [
                        $item->option_name => $item->option_value
                    ];
                })->toArray();;
        });


        return view('frontend.frontend-home')->with([
            'static_field_data' => $static_field_data,
            'page_details' => $page_details
        ]);
    }

    public function home_page_change($id)
    {
        $all_header_slider = HeaderSlider::all();
        $all_blog = Blog::where(['status' => 'publish'])->orderBy('id', 'desc')->take(get_static_option('home_page_01_latest_news_items'))->get(); //make a function to call all static option by home page
        $static_field_data = StaticOption::whereIn('option_name', HomePageStaticSettings::get_home_field($id))->get()->mapWithKeys(function ($item) {
            return [$item->option_name => $item->option_value];
        })->toArray();


        return view('frontend.frontend-home-demo')->with([
            'all_header_slider' => $all_header_slider,
            'all_blog' => $all_blog,
            'static_field_data' => $static_field_data,
            'home_page' => $id,
        ]);
    }


    public function flutterwave_pay_get()
    {
        return redirect_404_page();
    }

    /** ==================================================================
     *                  BLOG PAGES
     * ==================================================================*/
    public function blog_page()
    {
        $page_details = Page::findOrFail(get_static_option('blog_page'));
        return view('frontend.frontend-home', compact('page_details'));
    }

    public function category_wise_blog_page($id)
    {
        $all_blogs = Blog::where(['blog_categories_id' => $id])->orderBy('id', 'desc')->paginate(get_static_option('blog_page_item'));
        if (empty($all_blogs)) {
            abort(404);
        }
        $all_recent_blogs = Blog::orderBy('id', 'desc')->take(get_static_option('blog_page_recent_post_widget_item'))->get();
        $all_category = BlogCategory::where(['status' => 'publish'])->orderBy('id', 'desc')->get();
        $category_name = BlogCategory::where(['id' => $id, 'status' => 'publish'])->first()->name;
        return view('frontend.pages.blog.blog-category')->with([
            'all_blogs' => $all_blogs,
            'all_categories' => $all_category,
            'category_name' => $category_name,
            'all_recent_blogs' => $all_recent_blogs,
        ]);
    }

    public function tags_wise_blog_page($tag)
    {
        $all_blogs = Blog::Where('tags', 'LIKE', '%' . $tag . '%')
            ->orderBy('id', 'desc')->paginate(get_static_option('blog_page_item'));
        if (empty($all_blogs)) {
            abort(404);
        }
        $all_recent_blogs = Blog::orderBy('id', 'desc')->take(get_static_option('blog_page_recent_post_widget_item'))->get();
        $all_category = BlogCategory::where(['status' => 'publish'])->orderBy('id', 'desc')->get();
        return view('frontend.pages.blog.blog-tags')->with([
            'all_blogs' => $all_blogs,
            'all_categories' => $all_category,
            'tag_name' => $tag,
            'all_recent_blogs' => $all_recent_blogs,
        ]);
    }

    public function blog_search_page(Request $request)
    {
        $all_recent_blogs = Blog::orderBy('id', 'desc')->take(get_static_option('blog_page_recent_post_widget_item'))->get();
        $all_category = BlogCategory::where(['status' => 'publish'])->orderBy('id', 'desc')->get();
        $all_blogs = Blog::Where('title', 'LIKE', '%' . $request->search . '%')
            ->orderBy('id', 'desc')->paginate(get_static_option('blog_page_item'));

        return view('frontend.pages.blog.blog-search')->with([
            'all_blogs' => $all_blogs,
            'all_categories' => $all_category,
            'search_term' => $request->search,
            'all_recent_blogs' => $all_recent_blogs,
        ]);
    }

    public function blog_single_page($slug)
    {
        $blog_post = Blog::where('slug', $slug)->first();

        if (empty($blog_post)) abort('404');

        $all_recent_blogs = Blog::orderBy('id', 'desc')->paginate(get_static_option('blog_page_recent_post_widget_item'));
        $all_category = BlogCategory::where(['status' => 'publish'])->orderBy('id', 'desc')->get();

        $all_related_blog = Blog::Where('blog_categories_id', $blog_post->blog_categories_id)->orderBy('id', 'desc')->take(6)->get();

        // insert blog page visit count += 1
        $blog_post->increment('visit_count');

        return view('frontend.pages.blog.blog-single')->with([
            'blog_post' => $blog_post,
            'all_categories' => $all_category,
            'all_recent_blogs' => $all_recent_blogs,
            'all_related_blog' => $all_related_blog,
        ]);
    }

    public function dynamic_single_page($slug)
    {

        $page_post = Page::where('slug', $slug)->first();

        $preserved_pages = [
            'home_page',
            'product_page',
            'blog_page',
        ];
        $static_option = StaticOption::whereIn('option_name', $preserved_pages)->get()->mapWithKeys(function ($item) {
            return [$item->option_name => $item->option_value];
        })->toArray();

        $pages_id_slugs = Page::whereIn('id', array_values($static_option))->get()->mapWithKeys(function ($item) {
            return [$item->id => $item->slug];
        })->toArray();

        if (in_array($slug, $pages_id_slugs) && $slug === $pages_id_slugs[$static_option['home_page']]) {
            return redirect()->route('homepage');
        } elseif (in_array($slug, $pages_id_slugs) && $slug === $pages_id_slugs[$static_option['blog_page']]) {
            return $this->fallbackBlogPage($page_post);
        } elseif (in_array($slug, $pages_id_slugs) && $slug === $pages_id_slugs[$static_option['product_page']]) {
            return $this->fallbackProductPage($page_post);
        }

        if (!is_null($page_post)) {
            return view('frontend.pages.dynamic-single', compact('page_post'));
        }

        abort(404);
    }

    /** ===================================================================
     *                  ADMIN AUTH FUNCTIONS
     * ===================================================================*/
    public function showAdminForgetPasswordForm()
    {
        return view('auth.admin.forget-password');
    }

    public function sendAdminForgetPasswordMail(Request $request)
    {
        $this->validate($request, ['username' => 'required|string:max:191']);

        $user_info = Admin::where('username', $request->username)->orWhere('email', $request->username)->first();

        if (!empty($user_info)) {
            $token_id = Str::random(30);
            $existing_token = DB::table('password_resets')->where('email', $user_info->email)->delete();
            if (empty($existing_token)) {
                DB::table('password_resets')->insert(['email' => $user_info->email, 'token' => $token_id]);
            }
            $message = 'Here is you password reset link, If you did not request to reset your password just ignore this mail. <a class="btn" href="' . route('admin.reset.password', ['user' => $user_info->username, 'token' => $token_id]) . '">Click Reset Password</a>';
            $data = [
                'username' => $user_info->username,
                'message' => $message
            ];

            try {
                Mail::to($user_info->email)->send(new AdminResetEmail($data));
            } catch (\Exception $e) {
                return redirect()->back()->with([
                    'msg' => $e->getMessage(),
                    'type' => 'success'
                ]);
            }

            return redirect()->back()->with([
                'msg' => __('Check Your Mail For Reset Password Link'),
                'type' => 'success'
            ]);
        }
        return redirect()->back()->with([
            'msg' => __('Your Username or Email Is Wrong!!!'),
            'type' => 'danger'
        ]);
    }

    public function showAdminResetPasswordForm($username, $token)
    {
        return view('auth.admin.reset-password')->with([
            'username' => $username,
            'token' => $token
        ]);
    }

    public function AdminResetPassword(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'username' => 'required',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user_info = Admin::where('username', $request->username)->first();
        $user = Admin::findOrFail($user_info->id);
        $token_iinfo = DB::table('password_resets')->where(['email' => $user_info->email, 'token' => $request->token])->first();
        if (!empty($token_iinfo)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('admin.login')->with(['msg' => __('Password Changed Successfully'), 'type' => 'success']);
        }

        return redirect()->back()->with(['msg' => __('Somethings Going Wrong! Please Try Again or Check Your Old Password'), 'type' => 'danger']);
    }

    public function lang_change(Request $request)
    {
        session()->put('lang', $request->lang);
        return redirect()->route('homepage');
    }

    /** ======================================================================================
     *                  OTHER PAGE FUNCTIONS
     * ======================================================================================*/
    public function about_page()
    {
        return view('frontend.pages.about');
    }

    public function faq_page()
    {
        $all_faq = Faq::where(['status' => 'publish'])->get();
        return view('frontend.pages.faq-page')->with([
            'all_faqs' => $all_faq
        ]);
    }

    public function contact_page()
    {
        $all_contact_info = ContactInfoItem::get();
        return view('frontend.pages.contact-page')->with([
            'all_contact_info' => $all_contact_info
        ]);
    }

    public function products_subcategory($id, $any = "")
    {
        $default_item_count = get_static_option('default_item_count');
        $all_products = Product::where('status', 'publish')
            ->whereJsonContains('sub_category_id', "$id")
            ->orderBy('id', 'desc')
            ->paginate($default_item_count);

        $category_name = ProductSubCategory::find($id)->title;

        if (empty($category_name)) {
            abort(404);
        }

        return view('frontend.pages.product.subcategory')->with([
            'all_products' => $all_products,
            'category_name' => $category_name,
        ]);
    }

    public function subscribe_newsletter(Request $request)
    {
        $this->validate($request, ['email' => 'required|string|email|max:191|unique:newsletters']);

        $verify_token = Str::random(32);

        Newsletter::create([
            'email' => $request->email,
            'verified' => 0,
            'verify_token' => $verify_token
        ]);

        $message = __('Verify your email to get all news from ') . get_static_option('site_title') . '<div class="btn-wrap"> <a class="anchor-btn" href="' . route('subscriber.verify', ['token' => $verify_token]) . '">' . __('verify email') . '</a></div>';

        $data = [
            'message' => $message,
            'subject' => __('verify your email')
        ];
        try {
            //send verify mail to newsletter subscriber
            Mail::to($request->email)->send(new BasicMail($data));
        } catch (\Throwable $th) {
            //throw $th;
        }

        return response()->json(['type' => 'success' , 'msg' => __('Thanks for Subscribe Our Newsletter')]);
    }

    public function subscriber_verify(Request $request)
    {
        $newsletter = Newsletter::where('token', $request->token)->first();
        $title = __('Sorry');
        $description = __('your token is expired');
        if (!empty($newsletter)) {
            Newsletter::where('token', $request->token)->update([
                'verified' => 1
            ]);
            $title = __('Thanks');
            $description = __('we are really thankful to you for subscribe our newsletter');
        }
        return view('frontend.thankyou', compact('title', 'description'));
    }

    public function showUserForgetPasswordForm()
    {
        return view('frontend.user.forget-password');
    }

    public function sendUserForgetPasswordMail(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string:max:191'
        ]);
        $user_info = User::where('username', $request->username)->orWhere('email', $request->username)->first();
        if (!empty($user_info)) {
            $token_id = Str::random(30);
            $existing_token = DB::table('password_resets')->where('email', $user_info->email)->delete();
            if (empty($existing_token)) {
                DB::table('password_resets')->insert(['email' => $user_info->email, 'token' => $token_id]);
            }
            $message = __('Here is you password reset link, If you did not request to reset your password just ignore this mail.') . ' <a class="btn" href="' . route('user.reset.password', ['user' => $user_info->username, 'token' => $token_id]) . '">' . __('Click Reset Password') . '</a>';
            $data = [
                'username' => $user_info->username,
                'message' => $message
            ];
            try {
                Mail::to($user_info->email)->send(new AdminResetEmail($data));
            } catch (\Exception $e) {
                return redirect()->back()->with([
                    'type' => 'danger',
                    'msg' => $e->getMessage()
                ]);
            }

            return redirect()->back()->with([
                'msg' => __('Check Your Mail For Reset Password Link'),
                'type' => 'success'
            ]);
        }
        return redirect()->back()->with([
            'msg' => __('Your Username or Email Is Wrong!!!'),
            'type' => 'danger'
        ]);
    }

    public function showUserResetPasswordForm($username, $token)
    {
        return view('frontend.user.reset-password')->with([
            'username' => $username,
            'token' => $token
        ]);
    }

    public function UserResetPassword(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'username' => 'required',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user_info = User::where('username', $request->username)->first();
        $user = User::findOrFail($user_info->id);
        $token_iinfo = DB::table('password_resets')->where(['email' => $user_info->email, 'token' => $request->token])->first();
        if (!empty($token_iinfo)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('user.login')->with(['msg' => __('Password Changed Successfully'), 'type' => 'success']);
        }

        return redirect()->back()->with(['msg' => __('Somethings Going Wrong! Please Try Again or Check Your Old Password'), 'type' => 'danger']);
    }

    public function ajax_login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|min:6'
        ], [
            'username.required' => __('username required'),
            'password.required' => __('password required'),
            'password.min' => __('password length must be 6 characters')
        ]);

        $login_key = "username";
        // check username is contained valid email than user will log in by usign email and password
        if(filter_var($request->username,FILTER_VALIDATE_EMAIL)){
            $login_key = "email";
        }

        if (Auth::guard('web')->attempt([$login_key => $request->username, 'password' => $request->password], $request->get('remember'))) {
            return response()->json([
                'msg' => __('login Success Redirecting'),
                'type' => 'danger',
                'status' => 'valid'
            ]);
        }

        return response()->json([
            'msg' => ($login_key == 'email' ? "Email" : "Username") . __(' Or Password Doest Not Matched !!!'),
            'type' => 'danger',
            'status' => 'invalid'
        ]);
    }

    public function user_campaign()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('user.campaign.new');
        }
        return view('frontend.user.login')->with(['title' => __('Login To Create New Campaign')]);
    }

    /** ======================================================================
     *                  USER SHIPPING ADDRESS
     * ======================================================================*/
    public function addUserShippingAddress(Request $request)
    {
        if (!auth('web')->check()) {
            return back()->with(FlashMsg::explain('danger', __('Please login to add new address')));
        }

        $this->validate($request, [
            'name' => 'required|string|max:191',
            'address' => 'required|string|max:191',
        ]);

        $UserShippingAddress = UserShippingAddress::create([
            'user_id' => auth('web')->user()->id,
            'name' => $request->name,
            'address' => $request->address
        ]);

        $all_user_shipping = UserShippingAddress::where('user_id', auth('web')->user()->id)->get();

        return view('frontend.cart.checkout-user-shipping', compact('all_user_shipping'));
    }

    /** ======================================================================
     *                  FRONTEND PRODUCT FUNCTIONS
     * ======================================================================*/
    public function getProductAttributeHtml(Request $request)
    {
        $product = Product::where('slug', $request->slug)->first();
        if ($product) {
            return view('frontend.partials.product-attributes', compact('product'));
        }
    }

    /** ======================================================================
     *                  CART FUNCTIONS
     * ======================================================================*/
    public function cartPage(Request $request)
    {
        $default_shipping_cost = CartAction::getDefaultShippingCost();

        $all_cart_items = CartHelper::getItems();

        // validate stock count here ...
        CartAction::validateItemQuantity();

        $all_cart_items = CartHelper::getItems();

        $products = Product::whereIn('id', array_keys($all_cart_items))->get();

        $subtotal = CartAction::getCartTotalAmount($all_cart_items, $products);
        $subtotal_with_tax = $subtotal + $default_shipping_cost;
        $total = CartAction::calculateCoupon($request, $subtotal_with_tax, $products);

        return view('frontend.cart.all', compact('all_cart_items', 'products', 'subtotal', 'default_shipping_cost', 'total'));
    }

    public function checkoutPage(Request $request)
    {
        $default_shipping_cost = CartAction::getDefaultShippingCost();
        $default_shipping = CartAction::getDefaultShipping();
        $user = getUserByGuard('web');

        $all_user_shipping = [];
        if (auth('web')->check()) {
            $all_user_shipping = ShippingAddress::where('user_id', getUserByGuard('web')->id)->get();
        }

        $countries = Country::where('status', 'publish')->get();

        // if not campaign
        $all_cart_items = CartHelper::getItems();
        $products = Product::whereIn('id', array_keys($all_cart_items))->get();

        $subtotal = CartAction::getCartTotalAmount($all_cart_items, $products);
        $subtotal_with_tax = $subtotal + $default_shipping_cost;
        $total = CartAction::calculateCoupon($request, $subtotal_with_tax, $products);
        $coupon_amount = CartAction::calculateCoupon($request, $subtotal_with_tax, $products, 'DISCOUNT');

        $tax_data = CartAction::getDefaultTax($subtotal);
        $tax = $tax_data['tax'];
        $tax_percentage = $tax_data['tax_percentage'];

        $setting_text = StaticOption::select('option_name', 'option_value')->whereIn('option_name', [
            'checkout_page_no_product_text',
            'returning_customer_text',
            'toggle_login_text',
            'checkout_username',
            'checkout_password',
            'checkout_remember_text',
            'checkout_forgot_password',
            'checkout_login_btn_text',
            'have_coupon_text',
            'enter_coupon_text',
            'coupon_placeholder',
            'apply_coupon_btn_text',
            'checkout_billing_section_title',
            'checkout_billing_city',
            'checkout_billing_zipcode',
            'checkout_billing_address',
            'checkout_billing_email',
            'checkout_billing_phone',
            'checkout_order_note',
            'create_account_text',
            'create_account_username',
            'create_account_password',
            'create_account_confirmed_password',
            'ship_to_another_text',
            'shipping_state',
            'shipping_state',
            'shipping_state',
            'shipping_city',
            'shipping_zipcode',
            'shipping_address',
            'shipping_email',
            'shipping_phone',
            'order_summary_title',
            'subtotal_text',
            'discount_text',
            'vat_text',
            'shipping_text',
            'total_text',
            'checkout_place_order',
            'checkout_return_cart',
            'checkout_page_terms_text',
            'checkout_page_terms_link_url',
        ])->pluck('option_value', 'option_name')->toArray();

        return view('frontend.cart.checkout', compact(
            'all_cart_items',
            'all_user_shipping',
            'products',
            'subtotal',
            'countries',
            'default_shipping_cost',
            'default_shipping',
            'total',
            'user',
            'coupon_amount',
            'tax',
            'tax_percentage',
            'setting_text'
        ));
    }

    /** ======================================================================
     *                  WISHLIST FUNCTIONS
     * ======================================================================*/
    public function wishlistPage(Request $request)
    {
        $all_wishlist_items = WishlistHelper::getItems();
        $products = Product::whereIn('id', array_keys($all_wishlist_items))->get();
        return view('frontend.wishlist.all', compact('all_wishlist_items', 'products'));
    }

    /** ======================================================================
     *                  COMPARE FUNCTIONS
     * ======================================================================*/
    public function productsComparePage()
    {
        $all_compare_items = CompareHelper::getItems();
        $all_compare_items = [
            array_pop($all_compare_items),
            array_pop($all_compare_items)
        ];

        $products = Product::with('additionalInfo', 'category', 'inventory')
            ->whereIn('id', $all_compare_items)
            ->get();
        $product_ids = $products->pluck('id')->toArray();

        $categories = CompareAction::getCategories($products);
        $all_attributes = CompareAction::getAllProductsAttributes($products);

        return view('frontend.compare.all', compact(
            'all_compare_items',
            'products',
            'product_ids',
            'categories',
            'all_attributes'
        ));
    }

    /** ======================================================================
     *                  PRODUCTS FILTER FUNCTIONS
     * ======================================================================*/
    public function topRatedProducts()
    {
        $products = Product::where('status', 'publish')
            ->withAvg('rating', 'rating')
            ->with('rating')
            ->orderBy('rating_avg_rating', 'DESC')
            ->take(5)
            ->get();

        if(\request()->isMethod('post')){
            if(\request()->style == 'two'){
                return view("frontend.partials.product_filter_style_two",compact("products"))->render();
            }
        }

        return view('frontend.partials.filter-item', compact('products'));
    }

    public function topSellingProducts()
    {
        $products = Product::where('status', 'publish')
            ->withAvg('rating', 'rating')
            ->with('rating')
            ->orderBy('sold_count', 'DESC')
            ->take(5)
            ->get();

        if(\request()->isMethod('post')){
            if(\request()->style == 'two'){
                return view("frontend.partials.product_filter_style_two",compact("products"))->render();
            }
        }

        return view('frontend.partials.filter-item', compact('products'));
    }

    public function newProducts()
    {
        $products = Product::where('status', 'publish')
            ->withAvg('rating', 'rating')
            ->with('rating')
            ->orderBy('created_at', 'DESC')
            ->take(5)
            ->get();

        if(\request()->isMethod('post')){
            if(\request()->style == 'two'){
                return view("frontend.partials.product_filter_style_two",compact("products"))->render();
            }
        }

        return view('frontend.partials.filter-item', compact('products'));
    }


    public function campaignProduct(Request $req){
        $limit = $this->validated_item_count($req);
        $products = Product::where('status', 'publish')
            ->withAvg('rating', 'rating')
            ->join("campaign_products","campaign_products.product_id","=","products.id")
            ->orderBy('campaign_products.id', 'DESC')
            ->where("campaign_products.end_date",">",date("Y-m-d H:i:s"))
            ->take($limit)
            ->get();

        return view("frontend.partials.product_filter_style_two",compact("products"))->render();
    }

    public function discountedProduct(Request $req){
        $limit = $this->validated_item_count($req);

        $products = Product::where("status","publish")
            ->withAvg('rating', 'rating')
            ->with("inventory")
            ->where("price" ,">","0")
            ->orderBy("products.id","DESC")
            ->take($limit)
            ->get();

        return view("frontend.partials.product_filter_style_two",compact("products"))->render();
    }

    private function validated_item_count($req){
        if($req->limit ?? false){
            $data = Validator::make($req->all(),["limit" => "required"]);

            return $data->safe()->only("limit")["limit"];
        }

        return null;
    }

    function filterCategoryProducts(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:product_categories',
            'item_count' => 'required|numeric'
        ]);

        $products = Product::where('status', 'publish')
            ->where('category_id', $request->id)
            ->withAvg('rating', 'rating')
            ->with('rating')
            ->take($request->item_count)
            ->get();

        return view('frontend.partials.filter-item', compact('products'));
    }

    /** ======================================================================
     *                          CAMPAIGN PAGE
     * ======================================================================*/
    public function campaignPage($id, $any = "")
    {
        $campaign = Campaign::with(['products', 'products.product'])->findOrFail($id);
        $products = optional($campaign->products);
        return view('frontend.campaign.index', compact('campaign'));
    }

    /** ======================================================================
     *                          FRONTEND ACTION FUNCTIONS
     * ======================================================================*/
    public function changeSiteCurrency(Request $request)
    {
        $request->validate(['currency' => 'required|string|max:191']);
        if (array_key_exists($request->currency, getAllCurrency())) {
            update_static_option('site_global_currency', $request->currency);
        }
        return true;
    }

    public function changeSiteLanguage(Request $request)
    {
        $language = Language::where('slug', $request->language)->first();
        session()->put('lang', $request->language);

        return response()->json(FlashMsg::explain(
            'success',
            sprintf(__('Language changed to %s'),$language->name))
        );
    }

    /** =====================================================================
     *                          AJAX FUNCTIONS
     * ===================================================================== */
    public function getCountryInfo(Request $request)
    {
        $this->validate($request, ['id' => 'required|exists:countries']);

        $country_tax = CountryTax::where('country_id', $request->id)->first();
        $shipping_options = getCountryShippingCost('country', $request->id);
        $default_shipping = CartAction::getDefaultShipping();
        $default_shipping_cost = CartAction::getDefaultShippingCost();
        $states = State::select('id', 'name')->where('country_id', $request->id)->get();
        $tax = $country_tax ? $country_tax->tax_percentage : 0;
        return response()->json([
            'tax' => $tax,
            'states' => $states,
            'shipping_options' => $shipping_options,
            'default_shipping' => $default_shipping,
            'default_shipping_cost' => $default_shipping_cost,
        ], 200);
    }

    public function getCountryStateInfo(Request $request){
        $request->validate(["id" => "required"]);

        $states = State::select('id', 'name')->where('country_id', $request->id)->get();
        $html = "<option value=''>Select State</option>";
        foreach($states as $state){
            $html .= "<option value='". $state->id ."'>" . $state->name . "</option>";
        }

        return $html;
    }

    public function getStateInfo(Request $request)
    {
        $this->validate($request, ['id' => 'required|exists:states']);

        $state_tax = StateTax::where('state_id', $request->id)->first();
        $default_shipping = CartAction::getDefaultShipping();
        $default_shipping_cost = CartAction::getDefaultShippingCost();
        $shipping_options = getCountryShippingCost('state', $request->id);
        $tax = $state_tax ? $state_tax->tax_percentage : 0;
        return response()->json([
            'tax' => $tax,
            'shipping_options' => $shipping_options,
            'default_shipping' => $default_shipping,
            'default_shipping_cost' => $default_shipping_cost,
        ], 200);
    }

    private function fallbackProductPage($page_post = null)
    {
        $page_name = $page_post->name ?? 'Product';
        $display_item_count = request()->get('count') ?? 15;
        $all_category = ProductCategory::where('status', 'publish')->with('subcategory')->withCount('product')->get();
        $all_subcategory = ProductSubCategory::where('status', 'publish')->get()->groupBy('category_id');
        $all_attributes = ProductAttribute::all();
        $all_tags = Tag::inRandomOrder()->take(10)->get();
        $all_units = ProductUnit::all();

        $maximum_available_price = Product::query()->with('category')->max('price');
        $min_price = request()->get('pr_min') ?? Product::query()->min('price');
        $max_price = request()->get('pr_max') ?? $maximum_available_price;

        $item_style = request()->get('s') ?? 'grid';
        $sort_by = request()->get('sort');

        if (!(request()->get('q') || request()->get('cat') || request()->get('subcat') || request()->get('unt') || request()->get('attr') || request()->get('rt') || request()->get('t'))) {
            $all_products = getProductByParams([
                'product_items' => [],
                'items_order' => 'DESC',
                'items_count' => $display_item_count,
                'sort_by' => request()->get('sort') ?? 'id',
            ]);
        } else {
            $all_products = Product::query()
                ->with('inventory', 'campaign', 'category', 'rating')
                ->withAvg('rating', 'rating')
                ->where('status', 'publish');

            // search title
            if (request()->get('q')) {
                $query = request()->get('q');
                $all_products->where('title', 'LIKE', "%$query%");
            }

            // category search
            if (request()->get('cat')) {
                $all_products->where('category_id', request()->get('cat'));
            }

            // subcategory search
            if (request()->get('subcat')) {
                $all_products->whereJsonContains('sub_category_id', request()->get('subcat'));
            }

            // unit search
            if (request()->get('unt')) {
                $all_products->where('uom', request()->get('unt'));
            }

            if ($min_price && $min_price > 0) {
                $all_products->whereBetween('sale_price', [$min_price, $max_price]);
            }

            // filter by attribute
            if (request()->get('attr')) {
                $filter_attributes = json_decode(request()->get('attr'), true);
                if (is_array($filter_attributes)) {
                    foreach ($filter_attributes as $attr) {
                        if (isset($attr['id']) && isset($attr['attribute'])) {
                            $all_products->where('attributes', 'LIKE', "%{$attr['id']}%{$attr['attribute']}%");
                        }
                    }
                }
            }

            // filter by rating
            if (request()->get('rt')) {
                $rating = request()->get('rt');
                $all_products->whereHas('rating', function ($query) use ($rating) {
                    $query->where('rating', $rating);
                });
            }

            // filter by tag
            if (request()->get('t')) {
                $tag = request()->get('t');
                $all_products->whereHas('tags', function ($query) use ($tag) {
                    $query->where('tag', $tag);
                });
            }

            if (request()->get('sort')) {
                if ($sort_by == 'popularity') {
                    $all_products->orderBy('sold_count', 'DESC');
                } else if ($sort_by == 'latest') {
                    $all_products->orderBy('created_at', 'DESC');
                } else if ($sort_by == 'price_low') {
                    $all_products->orderBy('price', 'ASC');
                } else if ($sort_by == 'price_high') {
                    $all_products->orderBy('price', 'DESC');
                }
            }

            $all_products = productSort($all_products, $sort_by)->paginate($display_item_count);
        }

        if ($all_products->count() <= $display_item_count) {
            request()->page = 1;
        }

        return view('frontend.dynamic-redirect.product', compact(
            'all_category',
            'all_subcategory',
            'all_attributes',
            'all_tags',
            'all_units',
            'all_products',
            'min_price',
            'max_price',
            'display_item_count',
            'sort_by',
            'maximum_available_price',
            'item_style',
            'page_post',
            'page_name'
        ));
    }

    private function fallbackBlogPage($page_post = null)
    {
        $page_name = $page_post->name ?? 'Blog';
        $all_blogs = Blog::with('category')->where('status', 'publish')->paginate();
        return view('frontend.dynamic-redirect.blog', [
            'padding_top' => 100,
            'padding_bottom' => 100,
            'all_blogs' => $all_blogs,
            'readMoreBtnText' => __('Read More'),
            'page_post' => $page_post,
            'page_name' => $page_name
        ]);
    }
}