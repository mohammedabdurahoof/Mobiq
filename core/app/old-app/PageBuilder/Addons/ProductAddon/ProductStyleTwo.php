<?php

namespace App\PageBuilder\Addons\ProductAddon;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\PageBuilderBase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\Modules\Product\Entities\_IH_ProductCategory_QB;
use Modules\Product\Entities\ProductCategory;

class ProductStyleTwo extends PageBuilderBase
{
    public function preview_image(): string
    {
        return 'product-style/style-two.png';
    }

    public function addon_title()
    {
        return __('Product Style: 02');
    }

    public function admin_render(): string
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $categories = ProductCategory::select(["id", "title"])->pluck("title", "id")->toArray();

        $output .= "<table style='width: 100%'><tr><td style='padding-right: 6px;width: 50%'><h5 class='mb-2'>Style One</h5>" .

            Select::get([
                'name' => 'category_one',
                'multiple' => false,
                'label' => __('Category One'),
                'placeholder' => __('Select Category'),
                'options' => $categories,
                'value' => $widget_saved_values['category_one'] ?? null
            ])
            . "</td><td style='width: 50%'><h5 class='mb-2'>Style Two</h5>" .
            Select::get([
                'name' => 'category_two',
                'multiple' => false,
                'label' => __('Category Two'),
                'placeholder' => __('Select Category'),
                'options' => $categories,
                'value' => $widget_saved_values['category_two'] ?? null,
            ])
            . "</td></tr>
            <tr><td style='padding-right: 6px'><h5 class='mb-2'>Style One</h5>" .

            Select::get([
                'name' => 'category_three',
                'multiple' => false,
                'label' => __('Category Three'),
                'placeholder' => __('Select Category'),
                'options' => $categories,
                'value' => $widget_saved_values['category_three'] ?? null
            ])
            . "</td><td><h5 class='mb-2'>Style Two</h5>" .
            Select::get([
                'name' => 'category_for',
                'multiple' => false,
                'label' => __('Category For'),
                'placeholder' => __('Select Category'),
                'options' => $categories,
                'value' => $widget_saved_values['category_for'] ?? null,
            ])
            . "</td></tr></table>";


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
                    'type' => RepeaterField::COLOR_PICKER,
                    'name' => 'bg_color',
                    'label' => __('Background Color'),
                    'value' => $widget_saved_values['bg_color'] ?? null,
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'btn_text',
                    'label' => __('Button Text'),
                    'value' => $widget_saved_values['btn_text'] ?? null,
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'btn_url',
                    'label' => __('Button URL'),
                    'value' => $widget_saved_values['btn_url'] ?? null,
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

  $padding_top = SanitizeInput::esc_html($settings['padding_top'] ?? '');
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom'] ?? '');

        // left
        $category_one = SanitizeInput::esc_html($settings['category_one'] ?? '');
        $category_two = SanitizeInput::esc_html($settings['category_two'] ?? '');
        // Right
        $category_three = SanitizeInput::esc_html($settings['category_three'] ?? "");
        $category_for = SanitizeInput::esc_html($settings['category_for'] ?? "");
        $banners = $settings['banner_style_one'] ?? [];

        $category_one_prd = $this->productQuery(4,$category_one);
        $category_two_prd =  $this->productQuery(9,$category_two);
        $category_three_prd = $this->productQuery(4,$category_three);
        $category_for_prd = $this->productQuery(9,$category_for);

        return $this->renderBlade("product-style.style-02", compact("category_for_prd","category_three_prd","category_two_prd","category_one_prd", "padding_bottom", "padding_top", "banners"));
    }

    private function productQuery($limit,$cat_id): Builder|_IH_ProductCategory_QB|ProductCategory|null
    {
        return ProductCategory::with(["product" => function ($query) use ($limit) {
            $query->withOut("inventory","campaign","rating","campaignProduct","category");
            $query->limit($limit);
        }])->where("id",$cat_id)->first();
    }
}