<?php

namespace App\Http\ViewComposers;

use Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;


class globalreportComposer
{
    public function compose(View $view)
    {
        $cur_user = \Auth::user();
        
        if (Auth::check())
        {
            $queh = "SELECT a.* FROM vwstmemenu a
                    INNER JOIN vwstrolemenupra b on a.id = b.menu_id and b.checked = 1 and b.id = $cur_user->role_id 
                    where a.parentid = '0'
                    ";

            $qued = "SELECT a.* FROM vwstmemenu a
                    INNER JOIN vwstrolemenupra b on a.id = b.menu_id and b.checked = 1 and b.id = $cur_user->role_id 
                    where a.parentid > '0'
                    ";

            $view->with('composer_stmemenu_h', DB::Select(DB::raw($queh)));
            $view->with('composer_stmemenu_d', DB::Select(DB::raw($qued)));

            
        }
                                                        
    }

}