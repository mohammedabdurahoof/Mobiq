<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FlashMsg;
use App\Http\Controllers\Controller;
use App\Menu;
use App\SocialIcons;
use Illuminate\Http\Request;

class TopBarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

        $this->middleware(
            'permission:top-bar-menu-list|top-bar-menu-update|top-bar-social-icon-list|top-bar-social-icon-create|top-bar-social-icon-edit|top-bar-social-icon-delete',
            ['only', ['topbar_settings']]
        );
        $this->middleware('permission:top-bar-menu-update', ['only', ['selectTopBarMenu']]);

        $this->middleware('permission:top-bar-social-icon-list', ['only', ['new_social_item']]);
        $this->middleware('permission:top-bar-social-icon-create', ['only', ['update_social_item']]);
        $this->middleware('permission:top-bar-social-icon-edit', ['only', ['update_social_item']]);
        $this->middleware('permission:top-bar-social-icon-delete', ['only', ['delete_social_item']]);
    }

    public function topbar_settings()
    {
        $all_social_icons = SocialIcons::all();
        $menus = Menu::all();
        return view('backend.pages.topbar-settings')->with([
            'all_social_icons' => $all_social_icons,
            'menus' => $menus
        ]);
    }

    public function selectTopBarMenu(Request $request)
    {
        $request->validate(['topbar_menu' => 'exists:menus,id']);
        update_static_option('topbar_menu', $request->topbar_menu);
        return back()->with(FlashMsg::explain('success', __('Top-bar menu updated')));
    }

    /** ===================================================================
     *                          SOCIAL ICONS
     * =================================================================== */
    public function new_social_item(Request $request)
    {
        $this->validate($request, [
            'icon' => 'required|string',
            'url' => 'required|string',
        ]);

        SocialIcons::create([
            'icon' => $request->sanitize_html('icon'),
            'url' => $request->sanitize_html('url'),
        ]);

        return redirect()->back()->with([
            'msg' => __('New Social Item Added...'),
            'type' => 'success'
        ]);
    }

    public function update_social_item(Request $request)
    {
        $this->validate($request, [
            'icon' => 'required|string',
            'url' => 'required|string',
        ]);

        SocialIcons::find($request->id)->update([
            'icon' => $request->sanitize_html('icon'),
            'url' => $request->sanitize_html('url'),
        ]);

        return redirect()->back()->with([
            'msg' => __('Social Item Updated...'),
            'type' => 'success'
        ]);
    }

    public function delete_social_item(Request $request, $id)
    {
        SocialIcons::find($id)->delete();
        return redirect()->back()->with([
            'msg' => __('Social Item Deleted...'),
            'type' => 'danger'
        ]);
    }
}
