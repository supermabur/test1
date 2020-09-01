<?php

namespace App\Http\ViewComposers;

use App\Providers\Auth;
use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\mstgudang;
use App\stmemenu;


class UserComposer
{
    public function compose(View $view)
    {
        // $view->with('nama', 'nuge');
        $cur_user = \Auth::user();
        
    	// $view->with('submenu', stmemenu::select('master')->orderby('UrutM')->distinct()->get());
        // $view->with('submenu',vw_roles_menu::select('master', 'roles_id')->orderby('urutm')->distinct()->get() );
        // if (empty($cur_user)){
        //     $view->with('submenu',vw_roles_menu::select('master', 'roles_id')->orderby('urutm')->distinct()->get() );            
        //     $view->with('menu', vw_roles_menu::select('master','detail', 'routex', 'roles_id')->orderby('UrutM','UrutD')->get());
        // }
        // else {
        //     $view->with('submenu',vw_roles_menu::select('master', 'roles_id')
        //                 ->where('roles_id', $cur_user->role_id )->orderby('urutm')->distinct()->get());            
        //     $view->with('menu', vw_roles_menu::select('master','detail', 'routex', 'roles_id')
        //                 ->where('roles_id', $cur_user->role_id )->orderby('UrutM')->orderby('UrutD')->get());
        // };
            



        // $view->with('composer_mstkota', Mstjenis::select('id', 'name')->orderby('id')->get());
        // $view->with('composer_mstkota', cpMstKota::select('id','name')->orderBy('id')->get());



        $view->with('composer_stmemenu', stmemenu::orderBy('name')->get());
        $view->with('composer_stmemenu_h', stmemenu::where('parentid','0')->orderBy('urut')->get());
        $view->with('composer_stmemenu_d', stmemenu::where('parentid','<>','0')->orderBy('urut')->get());
        
        $view->with('composer_mstgudang', mstgudang::orderBy('nama')->where('kode','<>',"''")->get());
                                                
    }

}