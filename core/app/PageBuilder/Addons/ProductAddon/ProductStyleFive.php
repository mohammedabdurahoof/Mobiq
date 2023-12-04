<?php

namespace App\PageBuilder\Addons\ProductAddon;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\PageBuilderBase;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\Modules\Product\Entities\_IH_ProductCategory_QB;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductCategory;

class ProductStyleFive extends PageBuilderBase
{
    public function preview_image(): string
    {
        return 'product-style/style-three.png';
    }

    public function addon_title(): array|string|Translator|Application|null
    {
        return __('Product Style: 05');
    }

    public function admin_render(): string
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $categories = ProductCategory::select(["id", "title"])->pluck("title", "id")->toArray();
        $types = [
            'type_one' => "4 Product Layout",
            'type_two' => "10 Product Layout",
        ];

        $output .= Text::get([
            'name' => 'section_title',
            'label' => __('Section Title'),
            'placeholder' => __('Section Title'),
            'value' => $widget_saved_values['section_title'] ?? null,
        ]);

        $output .= Repeater::get([
            'multi_lang' => false,
            'settings' => $widget_saved_values,
            'id' => 'products_type',
            'fields' => [
                [
                    'type' => RepeaterField::SELECT,
                    'name' => 'category',
                    'options' => $categories,
                    'label' => __('Select Category'),
                ],
                [
                    'type' => RepeaterField::SELECT,
                    'name' => 'layout_type',
                    'options' => $types,
                    'label' => __('Select Layout Type'),
                ],
            ]
        ]);

        $output .= paddings();

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render(): string
    {
        $settings = $this->get_settings();

        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);
        $section_title = SanitizeInput::esc_html($settings['section_title']);
        $product_types = $settings['products_type'] ?? [];

        return $this->renderBlade("product-style.style-05", compact("product_types","section_title", "padding_bottom", "padding_top"));
    }
}