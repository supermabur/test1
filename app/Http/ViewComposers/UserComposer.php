<?php

namespace App\Http\ViewComposers;

use Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use App\mstgudang;
use App\stmemenu;
use App\model\users;
use App\model\strole;


class UserComposer
{
    public function compose(View $view)
    {
        // $view->with('nama', 'nuge');
        $cur_user = \Auth::user();
        
        if (Auth::check())
        {
            $user = users::find(Auth::user()->id);
            

            $view->with('composer_stmemenu', stmemenu::orderBy('name')->get());


            $queh = "SELECT a.* FROM vwstmemenu a
                    INNER JOIN vwstrolemenupra b on a.id = b.menu_id and b.checked = 1 and b.id = $user->role_id 
                    where a.parentid = '0'
                    ";

            $qued = "SELECT a.* FROM vwstmemenu a
                    INNER JOIN vwstrolemenupra b on a.id = b.menu_id and b.checked = 1 and b.id = $user->role_id 
                    where a.parentid > '0'
                    ";

            $view->with('composer_stmemenu_h', DB::Select($queh));
            $view->with('composer_stmemenu_d', DB::Select($qued));


            $view->with('composer_strole', strole::select(['id', 'name as text'])->orderBy('name')->get());

            $view->with('composer_mstgudang', mstgudang::orderBy('nama')->where('kode','<>',"''")->get());
        }
                                                        
    }

}