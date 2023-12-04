
<ul class="sub-menu mega-menu-inner style-two-category-wrapper">
    @foreach($mega_menu_items as $item)

        <li class="mega-menu-single-section custom">
            <ul class="mega-menu-main">
                <li class="round-menu-product">
                    <a href="{{ route("frontend.products.subcategory",["id" => $item->id,"title" => Str::slug($item->title)]) }}">
                        @if(!empty($item->image))
                            {!! render_image_markup_by_attachment_id($item->image) !!}
                        @else
                            <img src="{{ asset('assets/uploads/no-image.png') }}">
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route("frontend.products.subcategory",["id" => $item->id,"title" => Str::slug($item->title)]) }}">
                        <h5 class="menu-title-x style-two-category-heading">{{ $item->title }}</h5>
                    </a>
                </li>
            </ul>
        </li>
    @endforeach
</ul>

<style>
    .style-two-category-heading{
        -webkit-line-clamp: 2;
        width: 100px;
        line-height: 24px;
        text-overflow: ellipsis;
        overflow: hidden;
        height: 48px;
        text-align: center;
    }
    .style-two-category-wrapper{
        width: 669px;
        display: flex;
        flex-wrap: wrap;
        text-align: center;
    }
</style>