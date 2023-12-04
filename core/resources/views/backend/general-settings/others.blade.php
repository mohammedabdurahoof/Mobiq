@extends('backend.admin-master')
@section('site-title')
    {{__('Others')}}
@endsection
@section('style')
    <x-media.css/>
@endsection
@section('content')
    @can('general-settings-reading-settings')
        <div class="col-lg-12 col-ml-12 padding-bottom-30">
            <div class="row">
                <div class="col-12 mt-5">
                    @include('backend.partials.message')
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-6">
                                <h4 class="header-title">{{__("Others Settings")}}</h4>
                                <form action="{{route('admin.general.others')}}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="blog_page">{{__('Blog Page')}}</label>
                                        <select name="others_page_terms_and_condition_page_id" id="blog_page"
                                                class="form-control">
                                            @foreach($all_pages as $page)
                                                <option value="{{$page->id}}"
                                                        @if($page->id == get_static_option('others_page_terms_and_condition_page_id')) selected @endif>{{$page->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" id="update"
                                            class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-media.markup/>
    @endcan
@endsection
@section('script')
    <x-media.js/>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                $(document).on('click', '#update', function () {
                    $(this).addClass("disabled")
                    $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i> {{__("Updating")}}');
                });

                let iconpicker_selector = '.icp-dd';
                $(iconpicker_selector).iconpicker();
                $(iconpicker_selector).on('iconpickerSelected', function (e) {
                    let selectedIcon = e.iconpickerValue;
                    $(this).parent().parent().children('input').val(selectedIcon);
                });
            });
        })(jQuery);
    </script>
@endsection
