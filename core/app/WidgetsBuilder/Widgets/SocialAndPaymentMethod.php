<?php


namespace App\WidgetsBuilder\Widgets;

use App\Blog;
use App\Language;
use App\Menu;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Helpers\RepeaterField;
use App\WidgetsBuilder\WidgetBase;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;

class SocialAndPaymentMethod extends WidgetBase
{
    /**
     * @inheritDoc
     */
    public function widget_title(): array|string|Translator|Application|null
    {
        // TODO: Implement widget_title() method.
        return __('Social And Payment Gateway: 01');
    }

    /**
     * @inheritDoc
     */
    public function admin_render()
    {
        // TODO: Implement admin_render() method.
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Image::get([
            'name' => 'gateway_image',
            'label' => __('Gateway Image'),
            'value' => $widget_saved_values['gateway_image'] ?? null,
        ]);

        $output .= Repeater::get([
            'multi_lang' => false,
            'settings' => $widget_saved_values,
            'id' => 'social_links',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'link',
                    'label' => __('link')
                ],
                [
                    'type' => RepeaterField::ICON_PICKER,
                    'name' => 'icon',
                    'label' => __('Icon')
                ]
            ]
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    /**
     * @inheritDoc
     */
    public function frontend_render(): string
    {
        // TODO: Implement frontend_render() method.
        $widget_saved_values = $this->get_settings();

        $gateway_image = $widget_saved_values['gateway_image'] ?? '';
        $social_links = $widget_saved_values['social_links'] ?? '';

        $social_links_icons = "";
        for($i = 0; $i < count($social_links["link_"]); $i++){
            $link = $social_links["link_"][$i];
            $icon = $social_links["icon_"][$i];

            $social_links_icons .= '<a href="' . $link . '" class="wow fadeInUp" data-wow-delay="0.'. $i + 1 .'s"><i class="' . $icon . '"></i></a>';
        }

        $output = '
            <div class="col-lg-12">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="footer-social mt-30">
                        '. $social_links_icons .'
                    </div>
                    
                    <div class="footer-logo">
                        <a href="'. url('/') .'">'. render_image_markup_by_attachment_id(get_static_option('site_logo')) .'</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="payment-getway">'. render_image_markup_by_attachment_id($gateway_image) .'</div>
            </div>
        ';

        return $output;
    }
}