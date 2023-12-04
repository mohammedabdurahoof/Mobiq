<?php

namespace App\PageBuilder\Addons\Brand;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\PageBuilderBase;
use Illuminate\Database\Eloquent\Builder;

class BrandSliderStyleOne extends PageBuilderBase
{
    public function preview_image(): string
    {
        return 'brand/brand-slider-style-one.png';
    }

    public function addon_title()
    {
        return __('Brand Slider Style: 01');
    }

    public function admin_render(): string
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Text::get([
            'name' => 'title',
            'label' => __("Section Title"),
            'value' => $widget_saved_values['title'] ?? null
        ]);

        $output .= Repeater::get([
            'multi_lang' => false,
            'settings' => $widget_saved_values,
            'id' => 'brand_image',
            'fields' => [
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'image',
                    'label' => __('Select Image'),
                    'value' => $widget_saved_values['image'] ?? null,
                ]
            ]
        ]);

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
        $title = SanitizeInput::esc_html($settings['title']);
        $brands = $settings['brand_image'];

        return $this->renderBlade("brand.brand-style-one", compact("title", "padding_bottom", "padding_top", "brands"));
    }
}