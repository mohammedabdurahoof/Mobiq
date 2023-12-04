<?php

use App\PageBuilder\Fields\Slider;

function paddings(): string
{
    $output = Slider::get([
        'name' => 'padding_top',
        'label' => __('Padding Top'),
        'value' => $widget_saved_values['padding_top'] ?? 110,
        'max' => 200,
    ]);

    $output .= Slider::get([
        'name' => 'padding_bottom',
        'label' => __('Padding Bottom'),
        'value' => $widget_saved_values['padding_bottom'] ?? 110,
        'max' => 200,
    ]);

    return $output;
}