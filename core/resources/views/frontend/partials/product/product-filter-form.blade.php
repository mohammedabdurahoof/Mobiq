<form action="{{ route('frontend.products.all') }}" id="sort_form" style="display: none">
    <input type="hidden" id="count" name="count" value="{{ request()->count ?? '' }}">
    <input type="hidden" id="sort" name="sort" value="{{ request()->sort ?? '' }}">
    <input type="hidden" id="pr" name="pr" value="{{ request()->pr ?? '' }}">
    <input type="hidden" id="pr_min" name="pr_min" value="{{ request()->pr_min ?? '' }}">
    <input type="hidden" id="pr_max" name="pr_max" value="{{ request()->pr_max ?? '' }}">
    <input type="hidden" id="s" name="s" value="{{ request()->s ? request()->s : '' }}">
    <input type="hidden" id="q" name="q" value="{{ request()->q ? request()->q : '' }}">
    <input type="hidden" id="cat" name="cat" value="{{ request()->cat ? request()->cat : '' }}">
    <input type="hidden" id="subcat" name="subcat" value="{{ request()->subcat ? request()->subcat : '' }}">
    <input type="hidden" id="unt" name="unt" value="{{ request()->unt ? request()->unt : '' }}">
    <input type="hidden" id="attr" name="attr" value="{{ request()->attr ? request()->attr : '' }}">
    <input type="hidden" id="rt" name="rt" value="{{ request()->rt ? request()->rt : '' }}">
    <input type="hidden" id="t" name="t" value="{{ request()->t ? request()->t : '' }}">
</form>
