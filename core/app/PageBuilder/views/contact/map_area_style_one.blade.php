<div class="google-map-area" data-padding-top="{{ $settings['padding_top'] }}"  data-padding-bottom="{{ $settings['padding_bottom'] }}">
{{--    @php--}}
{{--        sprintf(--}}
{{--            '<div class="elementor-custom-embed"><iframe width="1080" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=%s&amp;t=m&amp;z=%d&amp;output=embed&amp;iwloc=near" aria-label="%s"></iframe></div>',--}}
{{--            rawurlencode($location),--}}
{{--            10,--}}
{{--            $location--}}
{{--        )--}}
{{--    @endphp--}}
    <div class="elementor-custom-embed">
        <iframe width="1080" height="500"
                frameborder="0" scrolling="no"
                marginheight="0" marginwidth="0"
                src="https://maps.google.com/maps?q={{ rawurlencode($location) }}&amp;t=m&amp;z=10&amp;output=embed&amp;iwloc=near" aria-label="{{ $location }}">
        </iframe>
    </div>
</div>
