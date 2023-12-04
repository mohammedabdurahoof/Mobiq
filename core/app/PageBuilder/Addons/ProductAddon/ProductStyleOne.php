<?php

namespace App\PageBuilder\Addons\ProductAddon;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\PageBuilderBase;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductCategory;

class ProductStyleOne extends PageBuilderBase
{
    public function preview_image(): string
    {
        return 'product-style/style-one.png';
    }

    public function addon_title()
    {
        return __('Product Style: 01');
    }

    public function admin_render(): string
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $categories = ProductCategory::select(["id", "title"])->pluck("title", "id")->toArray();

        $output .= "<table>
            <tr>
                <td style='padding-right: 6px'>" .
                    // left
                    "<h5 class='mb-2'>Left side content</h5>" .
                    Select::get([
                        'name' => 'left_side_category',
                        'multiple' => false,
                        'label' => __('Category'),
                        'placeholder' => __('Select Category'),
                        'options' => $categories,
                        'value' => $widget_saved_values['left_side_category'] ?? null,
                        'info' => __('Please select multiple products or system will display 8 items randomly')
                    ]) .
                    Number::get([
                        'name' => 'left_items',
                        'label' => __('Left Items'),
                        'value' => $widget_saved_values['left_items'] ?? null,
                    ])
            . "</td>
                <td>
                    " .
                    "<h5 class='mb-2'>Right side content</h5>" .
                    Select::get([
                        'name' => 'right_side_category',
                        'multiple' => false,
                        'label' => __('Category'),
                        'placeholder' => __('Select Category'),
                        'options' => $categories,
                        'value' => $widget_saved_values['right_side_category'] ?? null,
                        'info' => __('Please select multiple products or system will display 8 items randomly')
                    ]) . Number::get([
                        'name' => 'right_items',
                        'label' => __('Right Items'),
                        'value' => $widget_saved_values['right_items'] ?? null,
                    ])
            . "</td>   
            </tr>
        </table>";

        $output .= paddings();

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();

        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);

        // left
        $left_category_id = SanitizeInput::esc_html($settings['left_side_category']);
        $left_limit = SanitizeInput::esc_html($settings['left_items']);
        // Right
        $right_category_id = SanitizeInput::esc_html($settings['right_side_category'] ?? "");
        $right_limit = SanitizeInput::esc_html($settings['right_items'] ?? "");

        $left_category = ProductCategory::with(["product" => function ($query) use ($left_limit){
            $query->where("status","publish");
            $query->limit($left_limit ?? 6);
        }])->where("id",$left_category_id)->first();

        $right_category = ProductCategory::with(["product" => function ($query) use ($right_limit){
            $query->where("status","publish");
            $query->limit($right_limit ?? 6);
        }])->where("id",$right_category_id)->first();

        return $this->renderBlade("product-style.style-01", compact("left_category","right_category", "padding_bottom", "padding_top"));
    }
}