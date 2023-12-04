@if(request()->routeIs('homepage'))
    <meta property="og:title" content="{{filter_static_option_value('site_title',$global_static_field_data)}}"/>
    {!! render_og_meta_image_by_attachment_id(filter_static_option_value('og_meta_image_for_site',$global_static_field_data)) !!}
@endif

@php
    $prd_slug = \App\Page::where('id',get_static_option('product_page'))->select("slug")->first();
@endphp

@if(optional(request()->route())->getName() == 'homepage')
    <title>{{filter_static_option_value('site_title',$global_static_field_data)}}
        - {{filter_static_option_value('site_tag_line',$global_static_field_data)}}</title>
@elseif(request()->is([
        filter_static_option_value('blog_page_slug',$global_static_field_data).'/*',
        'p/*',
        filter_static_option_value('about_page_slug',$global_static_field_data),
        filter_static_option_value('faq_page_slug',$global_static_field_data),
        get_static_option('faq_page_name',$global_static_field_data),
        get_static_option('contact_page_slug',$global_static_field_data),
        filter_static_option_value('blog_page_slug',$global_static_field_data),
        filter_static_option_value('blog_page_slug',$global_static_field_data).'/*',
        $prd_slug?->slug,
        $prd_slug?->slug .'/*',
    ]))
    <title>@yield('site-title') - {{filter_static_option_value('site_title',$global_static_field_data)}} </title>
    @yield('og-meta')
@else
    <title>{{filter_static_option_value('site_title',$global_static_field_data)}}
        - {{filter_static_option_value('site_tag_line',$global_static_field_data)}}</title>
@endif