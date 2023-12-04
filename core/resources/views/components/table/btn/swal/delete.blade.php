<a tabindex="0" class="btn btn-danger btn-xs mb-3 mr-1 swal-delete @if(isset($selector)) {{ $selector }} @endif" data-route="{{$route}}">
    <i class="@if(isset($class)) {{ $class }} @else ti-trash @endif"></i>
</a>
