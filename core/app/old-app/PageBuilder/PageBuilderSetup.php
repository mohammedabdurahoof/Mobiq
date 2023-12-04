<?php


namespace App\PageBuilder;


use App\PageBuilder;
use App\PageBuilder\Addons\AboutSection\AboutSectionStyleOne;
use App\PageBuilder\Addons\AboutSection\AboutSectionStyleTwo;
use App\PageBuilder\Addons\AboutSection\TestimonialStyleOne;
use App\PageBuilder\Addons\bannerStyle\BannerStyleStyleOne;
use App\PageBuilder\Addons\Blog\GridStyleOne;
use App\PageBuilder\Addons\Blog\ListStyleOne;
use App\PageBuilder\Addons\Blog\ListStyleTwo;
use App\PageBuilder\Addons\Blog\NewsUpdatePageStyleOne;
use App\PageBuilder\Addons\Blog\NewsUpdateStyleOne;
use App\PageBuilder\Addons\Blog\NewsUpdateStyleTwo;
use App\PageBuilder\Addons\Brand\BrandLogoStyleOne;
use App\PageBuilder\Addons\Brand\BrandSliderStyleOne;
use App\PageBuilder\Addons\categories\CategorySliderThree;
use App\PageBuilder\Addons\Common\ImageSectionStyleOne;
use App\PageBuilder\Addons\Common\ImageUrlSectionStyleOne;
use App\PageBuilder\Addons\Common\QuoteStyleOne;
use App\PageBuilder\Addons\Common\TextSectionStyleOne;
use App\PageBuilder\Addons\ContactArea\ContactAreaStyleOne;
use App\PageBuilder\Addons\ContactArea\MapAreaStyleOne;
use App\PageBuilder\Addons\Feedback\CustomerFeedbackStyleOne;
use App\PageBuilder\Addons\Header\HeaderSliderOne;
use App\PageBuilder\Addons\Header\HeaderSliderTwo;
use App\PageBuilder\Addons\Header\HeaderSliderThree;
use App\PageBuilder\Addons\IconBox\IconBoxStyleOne;
use App\PageBuilder\Addons\IconBox\IconBoxStyleTwo;
use App\PageBuilder\Addons\Banner\BannerStyleOne;
use App\PageBuilder\Addons\Banner\BannerStyleTwo;
use App\PageBuilder\Addons\Banner\BannerStyleThree;
use App\PageBuilder\Addons\Banner\BannerStyleFour;
use App\PageBuilder\Addons\Banner\BannerStyleFive;
use App\PageBuilder\Addons\Banner\BannerStyleSix;
use App\PageBuilder\Addons\Page\ShopPageStyleTwo;
use App\PageBuilder\Addons\Product\ProductSliderOne;
use App\PageBuilder\Addons\Product\ProductCategorySliderOne;
use App\PageBuilder\Addons\Product\ProductCategoryMenu;
use App\PageBuilder\Addons\Product\ProductFilterOne;
use App\PageBuilder\Addons\Product\ProductSliderTwo;
use App\PageBuilder\Addons\Product\ProductSliderThree;
use App\PageBuilder\Addons\Product\ProductCategoryFilterOne;
use App\PageBuilder\Addons\Product\ProductGridOne;
use App\PageBuilder\Addons\Category\CategorySliderOne;
use App\PageBuilder\Addons\Page\ShopPage;
use App\PageBuilder\Addons\ProductAddon\ProductStyleFive;
use App\PageBuilder\Addons\ProductAddon\ProductStyleFor;
use App\PageBuilder\Addons\ProductAddon\ProductStyleOne;
use App\PageBuilder\Addons\ProductAddon\ProductStyleThree;
use App\PageBuilder\Addons\ProductAddon\ProductStyleTwo;
use Illuminate\Support\Facades\Cache;


class PageBuilderSetup
{
    private static function registerd_widgets(): array
    {
        //check module wise widget by set condition
        return [
            HeaderSliderOne::class,
            HeaderSliderTwo::class,
            HeaderSliderThree::class,
            BannerStyleOne::class,
            BannerStyleTwo::class,
            BannerStyleThree::class,
            BannerStyleFour::class,
            BannerStyleFive::class,
            BannerStyleSix::class,
            IconBoxStyleOne::class,
            IconBoxStyleTwo::class,
            BrandLogoStyleOne::class,
            ContactAreaStyleOne::class,
            MapAreaStyleOne::class,
            AboutSectionStyleOne::class,
            AboutSectionStyleTwo::class,
            TestimonialStyleOne::class,
            CustomerFeedbackStyleOne::class,
            NewsUpdateStyleOne::class,
            NewsUpdateStyleTwo::class,
            QuoteStyleOne::class,
            ImageSectionStyleOne::class,
            TextSectionStyleOne::class,
            ImageUrlSectionStyleOne::class,
            NewsUpdatePageStyleOne::class,
            GridStyleOne::class,
            ListStyleOne::class,
            ListStyleTwo::class,
            ProductSliderOne::class,
            ProductSliderTwo::class,
            ProductSliderThree::class,
            ProductGridOne::class,
            ProductFilterOne::class,
            ProductCategorySliderOne::class,
            ProductCategoryFilterOne::class,
            ProductCategoryMenu::class,
            CategorySliderOne::class,
            ShopPage::class,
            ShopPageStyleTwo::class,
            ProductStyleOne::class,
            ProductStyleTwo::class,
            ProductStyleThree::class,
            ProductStyleFor::class,
            ProductStyleFive::class,
            CategorySliderThree::class,
            BannerStyleStyleOne::class,
            BrandSliderStyleOne::class,
        ];
    }

    public static function get_admin_panel_widgets(): string
    {
        $widgets_markup = '';
        $widget_list = self::registerd_widgets();
        foreach ($widget_list as $widget) {
            try {
                $widget_instance = new  $widget();
            } catch (\Exception $e) {
                $msg = $e->getMessage();
                throw new \ErrorException($msg);
            }
            if ($widget_instance->enable()) {
                $widgets_markup .= self::render_admin_addon_item([
                    'addon_name' => $widget_instance->addon_name(),
                    'addon_namespace' => $widget_instance->addon_namespace(), // new added
                    'addon_title' => $widget_instance->addon_title(),
                    'preview_image' => $widget_instance->get_preview_image($widget_instance->preview_image())
                ]);
            }
        }
        return $widgets_markup;
    }

    private static function render_admin_addon_item($args): string
    {
        return '<li class="ui-state-default widget-handler" data-name="' . $args['addon_name'] . '" data-namespace="' . base64_encode($args['addon_namespace']) . '">
                    <h4 class="top-part"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>' . $args['addon_title'] . $args['preview_image'] . '</h4>
                </li>';
    }

    public static function render_widgets_by_name_for_admin($args)
    {
        $widget_class = $args['namespace'];
        $instance = new $widget_class($args);
        if ($instance->enable()) {
            return $instance->admin_render();
        }
    }

    public static function render_widgets_by_name_for_frontend($args)
    {
        $widget_class = $args['namespace'];
        $instance = new $widget_class($args);
        if ($instance->enable()) {
            return $instance->frontend_render();
        }
    }

    public static function render_frontend_pagebuilder_content_by_location($location): string
    {
        $output = '';
        $all_widgets = PageBuilder::where(['addon_location' => $location])->orderBy('addon_order', 'ASC')->get();
        foreach ($all_widgets as $widget) {
            $output .= self::render_widgets_by_name_for_frontend([
                'name' => $widget->addon_name,
                'namespace' => $widget->addon_namespace,
                'location' => $location,
                'id' => $widget->id,
                'column' => $args['column'] ?? false
            ]);
        }
        return $output;
    }

    public static function get_saved_addons_by_location($location): string
    {
        $output = '';
        $all_widgets = PageBuilder::where(['addon_location' => $location])->orderBy('addon_order', 'asc')->get();
        foreach ($all_widgets as $widget) {
            $output .= self::render_widgets_by_name_for_admin([
                'name' => $widget->addon_name,
                'namespace' => $widget->addon_namespace,
                'id' => $widget->id,
                'type' => 'update',
                'order' => $widget->addon_order,
                'page_type' => $widget->addon_page_type,
                'page_id' => $widget->addon_page_id,
                'location' => $widget->addon_location
            ]);
        }

        return $output;
    }

    public static function get_saved_addons_for_dynamic_page($page_type, $page_id): string
    {
        $output = '';
        $all_widgets = Cache::remember($page_type.'-'.$page_id, 600 ,function () use($page_type,$page_id) {
            return PageBuilder::where(['addon_page_type' => $page_type, 'addon_page_id' => $page_id])->orderBy('addon_order', 'asc')->get();
        });  
        // $all_widgets = PageBuilder::where(['addon_page_type' => $page_type, 'addon_page_id' => $page_id])->orderBy('addon_order', 'asc')->get();
        foreach ($all_widgets as $widget) {
            $output .= self::render_widgets_by_name_for_admin([
                'name' => $widget->addon_name,
                'namespace' => $widget->addon_namespace,
                'id' => $widget->id,
                'type' => 'update',
                'order' => $widget->addon_order,
                'page_type' => $widget->addon_page_type,
                'page_id' => $widget->addon_page_id,
                'location' => $widget->addon_location
            ]);
        }

        return $output;
    }

    public static function render_frontend_pagebuilder_content_for_dynamic_page($page_type, $page_id): string
    {
        $output = '';
         $all_widgets = Cache::remember($page_type.'-'.$page_id, 600 ,function () use($page_type,$page_id) {
            return PageBuilder::where(['addon_page_type' => $page_type, 'addon_page_id' => $page_id])->orderBy('addon_order', 'asc')->get();
        });
        // $all_widgets = PageBuilder::where(['addon_page_type' => $page_type, 'addon_page_id' => $page_id])->orderBy('addon_order', 'asc')->get();
        foreach ($all_widgets as $widget) {
            $output .= self::render_widgets_by_name_for_frontend([
                'name' => $widget->addon_name,
                'namespace' => $widget->addon_namespace,
                // 'location' => $location,
                'id' => $widget->id,
                'column' => $args['column'] ?? false
            ]);
        }
        return $output;
    }
}
