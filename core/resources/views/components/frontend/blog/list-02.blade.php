@php
    $category_url = route('frontend.blog.category',  ['id' => optional($blog->category)->id, 'name' => optional($blog->category)->title]) ?? '';
@endphp

<div class="single-blog-list-item-style-1">
    <div class="img-box">
        {!! render_image_markup_by_attachment_id($blog->image) !!}
    </div>
    <div class="content">
        <div class="post-meta">
            <ul class="post-meta-list">
                <li class="post-meta-item">
                    <a href="{{ route('frontend.blog.single', $blog->slug) }}">
                        <i class="lar la-calendar icon"></i>
                        <span class="text">{{ date_format($blog->created_at, 'Y F Y') }}</span>
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
        <h4 class="title">
            <a href="{{ route('frontend.blog.single', $blog->slug) }}">
                {!! Str::limit(purify_html_raw($blog->title), 70) !!}
            </a>
        </h4>
        <p class="info">{!! Str::limit(purify_html_raw($blog->blog_content), 378) !!}</p>
        <div class="btn-wrapper">
            <a href="{{ route('frontend.blog.single', $blog->slug) }}" class="btn-default rounded-btn">{{ $readMoreBtnText }}</a>
        </div>
    </div>
</div>
