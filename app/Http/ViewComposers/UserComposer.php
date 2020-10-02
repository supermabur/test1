<?php

namespace App\Http\ViewComposers;

use Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use App\stmemenu;
use App\model\users;
use App\model\strole;


class UserComposer
{
    public function compose(View $view)
    {        
        if (Auth::check())
        {
            // $user = users::find(Auth::user()->id);
            

//             $view->with('composer_stmemenu', stmemenu::orderBy('name')->get());
            
        }
                                                        
    }

}