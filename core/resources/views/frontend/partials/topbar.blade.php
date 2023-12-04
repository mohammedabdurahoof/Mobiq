@php

    $page_details = $page_details ?? $page_post ?? '';

    $navbar_type = $page_details->navbar_variant ?? get_static_option('global_navbar_variant') ?? 1;

    $page_container = $navbar_type == 1 ? 'custom-container-1318' : 'custom-container-1720';

@endphp

<div class="topbar-area">

    <div class="container {{$page_container}}">

        <div class="row">

            <div class="col-lg-12">

                <div class="topbar-inner">

                    <div class="left-content">

                        <div class="topbar-item">

                            <div class="social-icon">

                                <ul class="social-link-list">

                                    @if(!empty($all_social_item) && $all_social_item->count())

                                        @foreach ($all_social_item as $social_item)

                                            <li class="link-item"><a href="{{ $social_item->url }}">
                                                <i class="{{ $social_item->icon }} icon"></i></a>
                                            </li>

                                        @endforeach

                                    @endif

                                </ul>

                            </div>

                        </div>

                        <div class="topbar-item">

                            <div class="info">

                                <ul class="list">

                                    {!! render_frontend_menu(get_static_option('topbar_menu')) !!}

                                </ul>

                            </div>

                        </div>

                    </div>

                    <div class="right-content">

                        <div class="topbar-item">

                            <div class="track-order">

                                <a href="{{ route('frontend.products.track.order') }}" class="sign-in">

                                    <span class="login">{{ __('Track Order') }}</span>

                                </a>

                            </div>

                        </div>

                        <div class="topbar-item">

                            <div class="select-option">

                                <div class="single-select">

                                    <select class="lang" id="change_site_language">

                                        @if($all_language && $all_language->count())

                                            @foreach($all_language as $lang)

                                                @php

                                                    $lang_name = explode('(',$lang->name);

                                                    $data = array_shift($lang_name);

                                                @endphp

                                                <option @if(get_user_lang() == $lang->slug) selected @endif value="{{$lang->slug}}">{{$data}}</option>

                                            @endforeach

                                        @endif

                                    </select>

                                </div>

                            </div>

                        </div>

                        <div class="topbar-item">

                            <div class="account-control d-none">

                                <a href="{{ route('user.login') }}" class="sign-in"><i class="lar la-user icon"></i><span class="login">{{ __('log in') }}</span></a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

