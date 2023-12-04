<div class="blog-list-area-wrapper" data-padding-top="{{ $padding_top }}" data-padding-bottom="{{ $padding_bottom }}">
    <div class="container custom-container-1318">
        <div class="row row-reverse justify-content-around">
            @if($sidebar_position == 'left')
            <div class="col-md-4 col-lg-3">
                <div class="widget-area-wrapper">
                    {!! render_frontend_sidebar('blog', ['column' => false]) !!}
                </div>
            </div>
            @endif

            <div class="col-md-8 col-lg-9">
                <div class="row">
                    @foreach($all_blogs as $blog)
                    <div class="col-lg-12">
                        <x-frontend.blog.list-02 :blog="$blog" :readMoreBtnText="$readMoreBtnText" />
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="pagination margin-top-10">
                            {!! $all_blogs->links() !!}
                        </div>
                    </div>
                </div>
            </div>

            @if($sidebar_position == 'right')
                <div class="col-md-4 col-lg-3">
                    <div class="widget-area-wrapper">
                        {!! render_frontend_sidebar('blog', ['column' => false]) !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
