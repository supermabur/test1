<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class Roles_menus
{

    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        
        if (!empty($user)){
            $pos = strpos($request->path(), '/');
            if (!empty($pos)){
                $pt = '/'.substr($request->path(), 0, $pos);
            }
            else{
                $pt = '/'.$request->path();
            }
            // echo $request->path() . ' pos ' . $pos . ' | subs : ' . substr($request->path(), 0, $pos);


            if($pos == 0){
                $route = $request->path();
            }
            else{
                $route = substr($request->path(), 0, $pos);
            }

            // echo 'route : ' . $route . ' | path : ' . $request->path() . ' | role id : ' . $user->role_id . ' | menuid : ' . substr($request->path(), $pos+1);

            if($route == 'grctrl'){
                $menuid = substr($request->path(), $pos+1);
                $qued = "SELECT count(*) as jml FROM vwstrolemenupra a   
                        where a.menu_id = $menuid and a.checked = 1 and a.id = $user->role_id";
            }
            else{
                $qued = "SELECT count(*) as jml FROM vwstrolemenupra a   
                        where a.links = '$route' and a.checked = 1 and a.id = $user->role_id";
            }

            // echo 'query : ' . $qued;

            $jml = DB::select(DB::raw($qued));
            // echo 'jml : ' . $jml[0]->jml;
            if ($jml[0]->jml == 0){
                return redirect('/');
            }


            // if(str_contains($pt, ['create','edit'])){
            //     return $next($request);
            // }
            // else 
            // { 
            //     $hasilFilter = \App\vw_roles_menu::select('master', 'roles_id')
            //     ->where([  
            //         ['roles_id', $user->role_id],
            //         ['routex', $pt]
            //     ])->get();

            //     // echo '  jmlrec=' . count($hasilFilter) . '  role_id='.$user->role_id.'  path='.$pt;
            //     if (count($hasilFilter) < 1 ) {
            //         return redirect('/');                
            //     }   
            // }
        }
        return $next($request);
    }
}
