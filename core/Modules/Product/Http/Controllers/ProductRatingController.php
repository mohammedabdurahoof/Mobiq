<?php

namespace Modules\Product\Http\Controllers;

use App\Helpers\FlashMsg;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Product\Entities\ProductRating;
use function __;
use function auth;
use function back;
use function view;

class ProductRatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except("store");
        $this->middleware('permission:product-rating-list|product-rating-create|product-rating-edit|product-rating-delete', ['only', ['index']])->except("store");
        $this->middleware('permission:product-rating-create', ['only', ['store']])->except("store");
        $this->middleware('permission:product-rating-edit', ['only', ['update']])->except("store");
        $this->middleware('permission:product-rating-delete', ['only', ['destroy', 'bulk_action']])->except("store");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_ratings = ProductRating::with(['user', 'product'])->get();
        return view('backend.rating.all', compact('all_ratings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $user = auth('web')->user();
        if (!$user) {
            return redirect()->back()->with(FlashMsg::explain('danger', __('Login to submit rating')));
        }

        $this->validate($request, [
            'id' => 'required|exists:products',
            'rating' => 'required|integer',
            'comment' => 'required|string',
        ]);

        if ($request->rating > 5) {
            $rating = 5;
        }

        // ensure rating not inserted before
        $user_rated_already = !! ProductRating::where('product_id', $request->id)->where('user_id', $user->id)->count();
        if ($user_rated_already) {
            return redirect()->back()->with(FlashMsg::explain('danger', __('You have rated before')));
        }

        $rating = ProductRating::create([
            'product_id' => $request->id,
            'user_id' => $user->id,
            'status' => 0,
            'rating' => $request->rating,
            'review_msg' => $request->comment,
        ]);

        return $rating->id
            ? redirect()->back()->with(FlashMsg::create_succeed('rating'))
            : redirect()->back()->with(FlashMsg::create_failed('rating'));
    }

    public function approve(Request $request)
    {
        $request->validate(['id' => 'required|exists:product_ratings']);
        $product_rating = ProductRating::where('id', $request->id)->first();

        $updated = false;

        if (!is_null($product_rating)) {
            $updated = $product_rating->update(['status' => 1]);
        }

        return response()->json([
            'type' => $updated ? 'success' : 'error',
            'msg' => $updated ? __('Rating approved') : __('Something went wrong')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product\ProductRating  $productRating
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductRating $rating)
    {
        if ($rating->delete()) {
            return back()->with(FlashMsg::delete_succeed('Rating'));
        }
        return back()->with(FlashMsg::delete_failed('Rating'));
    }

    public function bulk_action(Request $request)
    {
        ProductRating::whereIn('id', $request->ids)->delete();
        return 'ok';
    }
}
