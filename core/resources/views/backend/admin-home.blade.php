@extends('backend.admin-master')

@section('site-title')

    {{__('Dashboard')}}

@endsection

@section('content')

@php
    if (auth('admin')->user()->role =='admin')
        $statistics = [
        ['title' => __('Total Admin'),'value' => $total_admin, 'icon' => 'lar la-user'],
        ['title' => __('Total Customer'),'value' => $total_user, 'icon' => 'lar la-user','link'=>'admin-home/frontend/all-user'],
        ['title' => __('Total Order'),'value' => $all_blogs_count, 'icon' => 'lar la-edit','link'=>'admin-home/products/product-order'],
        ['title' => __('Total Products'),'value' => $all_products_count, 'icon' => 'las la-box','link'=>'admin-home/products/all'],
        ['title' => __('Completed Sale'),'value' => $all_completed_sell_count, 'icon' => 'las la-boxes'],
        ['title' => __('Pending Sale'),'value' => $all_pending_sell_count, 'icon' => 'las la-history'],
        ['title' => __('Sold Amount'),'value' => $total_sold_amount, 'icon' => 'las la-coins'],
        ['title' => __('Ongoing Campaign'),'value' => $total_ongoing_campaign, 'icon' => 'las la-gifts','link'=>'admin-home/campaigns'],
    ];
    else
        
        $statistics = [
        ['title' => __('Total Admin'),'value' => $total_admin, 'icon' => 'lar la-user'],
        ['title' => __('Total Customer'),'value' => $total_user, 'icon' => 'lar la-user','link'=>'admin-home/frontend/all-user'],
        ['title' => __('Total Order'),'value' => $all_blogs_count, 'icon' => 'lar la-edit','link'=>'admin-home/products/product-order'],
        ['title' => __('Total Products'),'value' => $all_products_count, 'icon' => 'las la-box','link'=>'admin-home/products/all'],
        ['title' => __('Completed Sale'),'value' => $all_completed_sell_count, 'icon' => 'las la-boxes'],
        ['title' => __('Pending Sale'),'value' => $all_pending_sell_count, 'icon' => 'las la-history'],
        ['title' => __('Sold Amount'),'value' => $total_sold_amount, 'icon' => 'las la-coins'],
        ['title' => __('Ongoing Campaign'),'value' => $total_ongoing_campaign, 'icon' => 'las la-gifts','link'=>'admin-home/campaigns'],
    ];
        
 


@endphp

    <div class="main-content-inner">

        <div class="row">

            <!-- seo fact area start -->

            <div class="col-lg-12">

                <div class="row mt-3">

                    @foreach ($statistics as $data)

                    <div class="col-md-3 my-3">
                        <a href="{{$data['link'] ?? ''}}">
                        <div class="card card-hover">

                            <div class="dash-box text-white">

                                <span class="bgicon"> <i class="{{ $data['icon'] }}"></i></span>

                                <h1 class="dash-icon">

                                    <i class="{{ $data['icon'] }} mb-1 font-16"></i>

                                </h1>

                                <div class="dash-content">

                                    <h5 class="mb-0 mt-1">{{ $data['value'] }}</h5>

                                    <small class="font-light">{{ __($data['title']) }}</small>

                                </div>

                            </div>

                        </div>
                        </a>
                    </div>

                    @endforeach

                </div>

                <div class="row my-2">

                    <div class="col-lg-4 my-4">

                        <div class="chart-wrapper margin-top-40">

                            <h2 class="chart-title">{{__("Earned Per Month In")}} {{date('Y')}}</h2>

                            <canvas id="monthlyEarned"></canvas>

                        </div>

                    </div>

                    <div class="col-lg-4 my-4">

                        <div class="chart-wrapper margin-top-40">

                            <h2 class="chart-title">{{__("Earned Per Day In Last 30 Days")}}</h2>

                           <div>

                               <canvas id="monthlyEarnedPerDay"></canvas>

                           </div>

                        </div>

                    </div>

                    <div class="col-lg-4 my-4">

                        <div class="chart-wrapper margin-top-40">

                            <h2 class="chart-title">{{__("Product Order Per Day In Last 30 Days")}}</h2>

                           <div>

                               <canvas id="monthlyOrderCountPerDay"></canvas>

                           </div>

                        </div>

                    </div>

                    <div class="col-lg-4 my-4">

                        <div class="chart-wrapper margin-top-40">

                            <h2 class="chart-title">{{__("Product Sold Per Day In Last 30 Days")}}</h2>

                           <div>

                               <canvas id="monthlySoldCountPerDay"></canvas>

                           </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection



@section('script')

    <script src="{{asset('assets/backend/js/chart.js')}}"></script>

    <script>

        $.ajax({

            url: '{{route('admin.home.chart.data')}}',

            type: 'POST',

            async: false,

            data: {

                _token : "{{ csrf_token() }}"

            },

            success: function (data) {

                console.log(data);

                labels = data.labels;

                chartdata = data.data;

                new Chart(

                    document.getElementById('monthlyEarned'),

                    {

                        type: 'bar',

                        data: {

                            labels: data.labels,

                            datasets: [{

                                label: '{{__("Amount Earned")}}',

                                backgroundColor: 'linear-gradient(90deg, #ff8a73, #ffc097)',

                                backgroundColor: '#ff9e8b',

                                borderColor: '#ff9e8b',

                                data: data.data,

                            }]

                        },

                        options:{

                            scales: {

                                x: {

                                    grid: {

                                        display: false

                                    }

                                },

                                y: {

                                    grid: {

                                        display: false

                                    }

                                }

                            }

                        }

                    }

                );

            }

        });



        $.ajax({

            url: '{{route('admin.home.chart.data.by.day')}}',

            type: 'POST',

            async: false,

            data: {

                _token : "{{csrf_token()}}"

            },

            success: function (data) {

                labels = data.labels;

                chartdata = data.data;

                new Chart(

                    document.getElementById('monthlyEarnedPerDay'),

                    {

                        type: 'line',

                        data: {

                            labels: data.labels,

                            datasets: [{

                                label: '{{__("Amount Earned")}}',

                                backgroundColor: '#ff9e8b',

                                borderColor: '#ff9e8b',

                                data: data.data,

                            }]

                        },

                        options:{

                            scales: {

                                x: {

                                    grid: {

                                        display: false

                                    }

                                },

                                y: {

                                    grid: {

                                        display: false

                                    }

                                }

                            }

                        }

                    }

                );

            }

        });



        $.ajax({

            url: '{{route('admin.home.chart.sale.count.per.day')}}',

            type: 'POST',

            async: false,

            data: {

                _token : "{{csrf_token()}}"

            },

            success: function (data) {

                labels = data.labels;

                chartdata = data.data;

                new Chart(

                    document.getElementById('monthlySoldCountPerDay'),

                    {

                        type: 'bar',

                        data: {

                            labels: data.labels,

                            datasets: [{

                                label: '{{__("Product Sales")}}',

                                backgroundColor: '#ff9e8b',

                                borderColor: '#ff9e8b',

                                data: data.data,

                            }]

                        },

                        options:{

                            scales: {

                                x: {

                                    grid: {

                                        display: false

                                    }

                                },

                                y: {

                                    grid: {

                                        display: false

                                    }

                                }

                            }

                        }

                    }

                );

            }

        });



        $.ajax({

            url: '{{route("admin.home.chart.order.count.per.day")}}',

            type: 'POST',

            async: false,

            data: {

                _token : "{{csrf_token()}}"

            },

            success: function (data) {

                labels = data.labels;

                chartdata = data.data;

                new Chart(

                    document.getElementById('monthlyOrderCountPerDay'),

                    {

                        type: 'line',

                        data: {

                            labels: data.labels,

                            datasets: [{

                                fill: true,

                                borderWidth: 1,

                                label: '{{__("Product Order")}}',

                                backgroundColor: 'rgba(255, 82, 41,.03)',

                                borderColor: '#ff9e8b',

                                data: data.data,



                            }]

                        },



                        options:{

                            scales: {

                                x: {

                                    grid: {

                                        display: false                                    }

                                },

                                y: {

                                    grid: {

                                        display: false

                                    }

                                }

                            }

                        }

                        

                        

                    }

                );

            }

        });



    </script>

@endsection

