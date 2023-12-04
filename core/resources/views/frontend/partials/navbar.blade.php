@php
    $page_details = $page_details ?? $page_post ?? '';
    $navbar_type = $page_details->navbar_variant ?? get_static_option('global_navbar_variant') ?? 1;
@endphp

@if($navbar_type == 1)
    @include('frontend.partials.supportbar')
    @include('frontend.partials.navbar-partial-01')
@elseif($navbar_type == 2)
    @include('frontend.partials.navbar-partial-02')
@endif
