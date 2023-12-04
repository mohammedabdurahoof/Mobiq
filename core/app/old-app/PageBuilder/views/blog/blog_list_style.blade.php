<div class="blog-list-area-wrapper" data-padding-top="{{ $padding_top }}" data-padding-bottom="{{ $padding_bottom }}">
    <div class="container custom-container-1318">
        <div class="row row-reverse justify-content-around">
            <div class="col-md-8 col-lg-9">
                <div class="row">
                    @foreach($all_blogs as $blog)
                    <div class="col-lg-12">
                        <x-frontend.blog.list :blog="$blog" :readMoreBtnText="$readMoreBtnText" />
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
        </div>
    </div>
</div>
