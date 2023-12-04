<?php


namespace App\PageBuilder\Addons\Product;


use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Fields\TimePicker;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductCategory;

class ProductCategorySliderOne extends PageBuilderBase
{
    use RepeaterHelper;

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Product Category Slider: 01');
    }

    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'product/category-slider-01.png';
    }

    /**
     * admin_render
     * this method must have to implement by all widget to render admin panel widget content
     * @since 1.0.0
     * */
    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $product_categories = ProductCategory::select('id', 'title')->where('status', 'publish')->pluck('title', 'id')->toArray();
        $output .= NiceSelect::get([
            'name' => 'product_category',
            'multiple' => true,
            'label' => __('Category'),
            'placeholder' =>  __('Select Category'),
            'options' => $product_categories,
            'value' => $widget_saved_values['product_category'] ?? null,
            'info' => __('Select particular item(s) to display, if you want to show all product leave it empty')
        ]);

        // padding
        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 90,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 200,
            'max' => 500,
        ]);
        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    /**
     * frontend_render
     * this method must have to implement by all widget to render frontend widget content
     * @since 1.0.0
     * */
    public function frontend_render(): string
    {
        $settings = $this->get_settings();
        $product_category = $this->setting_item('product_category') ?? [];
        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));

        if (isset($product_category) && is_array($product_category) && count($product_category)) {
            $product_categories =  ProductCategory::whereIn('id', $product_category)->where('status', 'publish')->get();
        } else {
            $product_categories = ProductCategory::where('status', 'publish')->get();
        }

        foreach ($product_categories as $cat) {
            $product_categories->push($cat);
        }
        foreach ($product_categories as $cat) {
            $product_categories->push($cat);
        }
        foreach ($product_categories as $cat) {
            $product_categories->push($cat);
        }
        foreach ($product_categories as $cat) {
            $product_categories->push($cat);
        }
        foreach ($product_categories as $cat) {
            $product_categories->push($cat);
        }

        $section_data = [
            'product_categories' => $product_categories,
            'padding_top' => $padding_top,
            'padding_bottom' => $padding_bottom,
        ];

        return $this->renderBlade('product.category.slider_one', $section_data);
    }
}
