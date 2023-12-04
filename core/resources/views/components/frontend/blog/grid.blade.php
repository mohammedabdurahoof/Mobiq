@php
    $category_url = route('frontend.blog.category',  ['id' => optional($blog->category)->id, 'name' => optional($blog->category)->title]) ?? '';
    $read_more_btn_text = get_static_option('blog_page_read_more_btn_text');
@endphp
<div class="single-blog-grid-item-style-1">
    <div class="img-box">
        {!! render_image_markup_by_attachment_id($blog->image, '', 'full', true) !!}
    </div>
    <div class="content">
        <div class="post-meta">
            <ul class="post-meta-list">
                <li class="post-meta-item">
                    <a href="{{ route('frontend.blog.single', $blog->slug) }}">
                        <i class="lar la-calendar icon"></i>
                        <span class="text">{{ $blog->created_at->format('D M Y') }}</span>
                    </a>
                </li>
                <li class="post-meta-item">
                    <a href="{{ $category_url }}">
                        <i class="las la-tag icon"></i>
                        <span class="text">{{ optional($blog->category)->name }}</span>
                    </a>
                </li>
            </ul>
        </div>
        <h4 class="title"><a href="{{ route('frontend.blog.single', $blog->slug) }}">{!! Str::limit(purify_html_raw($blog->title), 55) !!}</a></h4>
        <p class="info">{!! Str::limit(purify_html_raw($blog->blog_content), 104) !!}</p>
        <div class="btn-wrapper">
            <a href="{{ route('frontend.blog.single', $blog->slug) }}" class="btn-default rounded-btn">{{ $readMoreBtnText }}</a>
        </div>
    </div>
</div>
