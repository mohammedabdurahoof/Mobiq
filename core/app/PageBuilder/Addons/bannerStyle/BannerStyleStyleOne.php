<?php

namespace App\PageBuilder\Addons\bannerStyle;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\PageBuilderBase;

class BannerStyleStyleOne extends PageBuilderBase
{

    public function preview_image(): string
    {
        return 'banner-style/style-one.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Repeater::get([
            'multi_lang' => false,
            'settings' => $widget_saved_values,
            'id' => 'banner_style_one',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title',
                    'label' => __('Title'),
                    'value' => $widget_saved_values['title'] ?? null,
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'sub_title',
                    'label' => __('Sub Title'),
                    'value' => $widget_saved_values['sub_title'] ?? null,
                ],
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'image',
                    'label' => __('Image'),
                    'value' => $widget_saved_values['image'] ?? null,
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'url',
                    'label' => __('URL'),
                    'value' => $widget_saved_values['url'] ?? null,
                ],
                [
                    'type' => RepeaterField::COLOR_PICKER,
                    'name' => 'bg_color',
                    'label' => __('Background Color'),
                    'value' => $widget_saved_values['bg_color'] ?? null,
                ],
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
        $banners = $settings["banner_style_one"] ?? "";

        return $this->renderBlade("banner-style/style-01", compact("banners"));
    }

    public function addon_title()
    {
        return __('Banner Style: 01');
    }
}