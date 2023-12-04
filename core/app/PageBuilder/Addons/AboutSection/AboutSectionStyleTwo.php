<?php


namespace App\PageBuilder\Addons\AboutSection;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Summernote;
use App\PageBuilder\Fields\Switcher;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;

class AboutSectionStyleTwo extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'about-section/02.png';
    }

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('About Area: 02');
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

        $output .= Text::get([
            'name' => 'title',
            'label' => __('Title'),
            'value' => $widget_saved_values['title'] ?? null,
        ]);
        $output .= Image::get([
            'name' => 'section_image',
            'label' => __('Section Image'),
            'value' => $widget_saved_values['section_image'] ?? null,
        ]);
        $output .= Select::get([
            'name' => 'image_position',
            'label' => __('Image Position'),
            'value' => $widget_saved_values['image_position'] ?? null,
            'options' => [
                'right' => __('Right'),
                'left' => __('Left'),
            ],
        ]);

        $output .= Repeater::get([
            'multi_lang' => false,
            'settings' => $widget_saved_values,
            'id' => 'about_features',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title',
                    'label' => __('Title')
                ],
                [
                    'type' => RepeaterField::TEXTAREA,
                    'name' => 'description',
                    'label' => __('Details'),
                ],
                [
                    'type' => RepeaterField::ICON_PICKER,
                    'name' => 'icon',
                    'label' => __('Icon')
                ]
            ]
        ]);

        $output .= Text::get([
            'name' => 'button_text',
            'label' => __('Button Text'),
            'value' => $widget_saved_values['button_text'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'button_url',
            'label' => __('Button URL'),
            'value' => $widget_saved_values['button_url'] ?? null,
            'info' => 'If you want to use root path like <br><b><span style="color: #00B106">domain-name.com/Your URL</span></b> use this tag <b>[url/]</b>'
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 60,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 60,
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

        $section_data = [
            'title' => SanitizeInput::esc_html($settings['title']),
            'all_features' => $settings['about_features'],
            'button_text' => SanitizeInput::esc_html($settings['button_text']),
            'button_url' => SanitizeInput::esc_url($settings['button_url']),
            'section_image' => SanitizeInput::esc_html($settings['section_image']),
            'image_position' => SanitizeInput::esc_html($settings['image_position']),
            'padding_top' => SanitizeInput::esc_html($settings['padding_top']),
            'padding_bottom' => SanitizeInput::esc_html($settings['padding_bottom']),
        ];

        return $this->renderBlade('about.about_style_two', $section_data);
    }
}
