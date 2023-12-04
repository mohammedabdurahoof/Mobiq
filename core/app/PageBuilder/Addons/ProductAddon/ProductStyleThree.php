<?php

namespace App\PageBuilder\Addons\ProductAddon;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\PageBuilderBase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\Modules\Product\Entities\_IH_ProductCategory_QB;
use Modules\Product\Entities\ProductCategory;

class ProductStyleThree extends PageBuilderBase
{
    public function preview_image(): string
    {
        return 'product-style/style-two.png';
    }

    public function addon_title()
    {
        return __('Product Style: 03');
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
        . "</td><td></td></tr></table>";

        $output .= "<h4>Banner</h4>";

        $output .= Text::get([
            'name' => 'title',
            'label' => __('Title'),
            'value' => $widget_saved_values['title'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'sub_title',
            'label' => __('Sub Title'),
            'value' => $widget_saved_values['sub_title'] ?? null,
        ]);

        $output .= Image::get([
            'name' => 'image',
            'label' => __('Image'),
            'value' => $widget_saved_values['image'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'btn_text',
            'label' => __('Button Text'),
            'value' => $widget_saved_values['btn_text'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'btn_url',
            'label' => __('Button URL'),
            'value' => $widget_saved_values['btn_url'] ?? null,
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
        $title = SanitizeInput::esc_html($settings['title']);
        $sub_title = SanitizeInput::esc_html($settings['sub_title']);
        $image = SanitizeInput::esc_html($settings['image']);
        $btn_text = SanitizeInput::esc_html($settings['btn_text']);
        $btn_url = SanitizeInput::esc_html($settings['btn_url']);

        // left
        $category_one = SanitizeInput::esc_html($settings['category_one']);
        $category_two = SanitizeInput::esc_html($settings['category_two']);
        // Right
        $category_three = SanitizeInput::esc_html($settings['category_three'] ?? "");

        $banner = [
            "title" => $title,
            "sub_title" => $sub_title,
            "image" => $image,
            "btn_text" => $btn_text,
            "btn_url" => $btn_url,
        ];

        $category_one_prd = $this->productQuery(9,$category_one);
        $category_two_prd =  $this->productQuery(9,$category_two);
        $category_three_prd = $this->productQuery(18,$category_three,false);

        return $this->renderBlade("product-style.style-03", compact("category_three_prd","category_two_prd","category_one_prd", "padding_bottom", "padding_top", "banner"));
    }

    private function productQuery($limit,$cat_id,$without = true): Builder|_IH_ProductCategory_QB|ProductCategory|null
    {
        return ProductCategory::with(["product" => function ($query) use ($limit,$without) {
            if(!$without){
                $query->withOut("inventory","campaign","rating","campaignProduct","category");
            }
            $query->where("status","publish");
            $query->limit($limit);
        }])->where("id",$cat_id)->first();
    }
}