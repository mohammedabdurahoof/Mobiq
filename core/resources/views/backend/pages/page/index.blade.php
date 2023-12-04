@extends('backend.admin-master')
@section('site-title')
    {{__('All Pages')}}
@endsection
@section('style')
    <x-datatable.css/>
    <x-bulk-action.css/>
@endsection
@section('content')
    @php
        $pages = [];
    @endphp
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.error/>
                <x-msg.flash/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All Pages')}}</h4>
                        <div class="text-right">
                            <a href="{{ route('admin.page.new') }}" class="btn btn-primary">{{ __('Add New Page') }}</a>
                        </div>
                        <x-bulk-action.dropdown/>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <x-bulk-action.th/>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Title')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($all_pages as $page)
                                    <tr>
                                        <x-bulk-action.td :id="$page->id"/>
                                        <td>{{$page->id}}</td>
                                        <td>
                                            {{$page->title}}
                                            @if(isset($dynamic_page_ids[$page->id]))
                                                @if($dynamic_page_ids[$page->id] == 'home_page')
                                                    <strong class="text-info"> - {{ __('Home Page') }}</strong>
                                                @elseif($dynamic_page_ids[$page->id] == 'blog_page')
                                                    <strong class="text-info"> - {{ __('Blog Page') }}</strong>
                                                @elseif($dynamic_page_ids[$page->id] == 'product_page')
                                                    <strong class="text-info"> - {{ __('Product Page') }}</strong>
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{$page->created_at->diffForHumans()}}</td>
                                        <td>
                                            @if($page->status === 'publish')
                                                <span class="alert alert-success">{{__('Publish')}}</span>
                                            @else
                                                <span class="alert alert-warning">{{__('Draft')}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(empty($dynamic_page_ids[$page->id]))
                                                <x-delete-popover :url="route('admin.page.delete',$page->id)"/>
                                                <a class="btn btn-xs btn-info btn-sm mb-3 mr-1" target="_blank"
                                                   href="{{route('frontend.dynamic.page', ['slug' => $page->slug, 'id' => $page->id])}}">
                                                    <i class="ti-eye"></i>
                                                </a>
                                            @endif
                                            <a class="btn btn-xs btn-primary btn-sm mb-3 mr-1"
                                               href="{{route('admin.page.edit',$page->id)}}">
                                                <i class="ti-pencil"></i>
                                            </a>
                                            @if(!empty($page->page_builder_status))
                                                <a href="{{route('admin.dynamic.page.builder',['type' =>'dynamic-page','id' => $page->id])}}"
                                                   target="_blank"
                                                   class="btn btn-xs btn-secondary mb-3 mr-1">{{__('Open Page Builder')}}</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <x-datatable.js/>
    <x-bulk-action.js :route="route('admin.page.bulk.action')"/>
@endsection
