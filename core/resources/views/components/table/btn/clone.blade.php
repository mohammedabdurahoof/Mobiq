{{-- <a class="btn btn-info btn-xs mb-3 mr-1" href="{{$route}}">
    <form action="{{ $route }}" method="POST">
        <input type="hidden" name="id" id="{{ $id }}">
        <input type="submit"><i class="ti-layers"></i>
    </form>
</a> --}}
<form action="{{$route}}" method="post" style="display: inline-block">
    @csrf
    <input type="hidden" name="item_id" value="{{$id}}">
    <button type="submit" title="{{__('clone this to new draft')}}"
            class="btn btn-xs btn-secondary btn-sm mb-3 mr-1">
        <i class="far fa-copy"></i>
    </button>
</form>