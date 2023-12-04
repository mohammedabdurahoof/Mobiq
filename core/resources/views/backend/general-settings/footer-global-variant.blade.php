@extends('backend.admin-master')

@section('site-title')
    {{__('Footer Global Variant Settings')}}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <x-msg.success/>
                <x-msg.error/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">{{__("Footer Global Variant Settings")}}</h4>
                        <form action="{{route('admin.general.global.variant.footer')}}" method="POST"
                              enctype="multipart/form-data">@csrf
                            <div class="card mt-5">
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="global_footer_variant"
                                               value="{{ get_static_option('global_footer_variant') }}"
                                               name="global_footer_variant">
                                    </div>
                                    <div class="row">
                                        @for($i = 1; $i < 4; $i++)
                                            <div class="col-lg-12 col-md-12">
                                                <div class="img-select selected">
                                                    <div class="img-wrap">
                                                        <img src="{{asset('assets/frontend/footer-variant/'.$i.'.jpg')}}" data-home_id="0{{$i}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                let iconpicker_selector = '.icp-dd';
                $(iconpicker_selector).iconpicker();
                $(iconpicker_selector).on('iconpickerSelected', function (e) {
                    let selectedIcon = e.iconpickerValue;
                    $(this).parent().parent().children('input').val(selectedIcon);
                });

                $(document).on('click','#update',function () {
                    $(this).addClass("disabled")
                    $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i> {{__("Updating")}}');
                });

                //For Footer
                let imgSelect = $('.img-select');
                let id = $('#global_footer_variant').val();
                imgSelect.removeClass('selected');
                $('img[data-home_id="' + id + '"]').parent().parent().addClass('selected');
                $(document).on('click', '.img-select img', function (e) {
                    e.preventDefault();
                    imgSelect.removeClass('selected');
                    $(this).parent().parent().addClass('selected').siblings();
                    $('#global_footer_variant').val($(this).data('home_id'));
                })

            });
        }(jQuery));
    </script>
@endsection
