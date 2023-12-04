@extends('frontend.frontend-page-master')
@section('page-title')
    {{ __('Blog')  }}
@endsection
@section('content')
<div class="blog-grid-area-wrapper" data-padding-top="{{ $padding_top }}" data-padding-bottom="{{ $padding_bottom }}">
    <div class="container custom-container-1318">
        <div class="row row-reverse justify-content-around">
            <div class="col-md-8 col-lg-9">
                <div class="row col-control">
                    @foreach ($all_blogs as $blog)
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <x-frontend.blog.grid :blog="$blog" :readMoreBtnText="$readMoreBtnText" />
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="pagination margin-top-30">
                            {!! $all_blogs->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
