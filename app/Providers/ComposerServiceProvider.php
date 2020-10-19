<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

use App\model\strole;
use App\model\mstmerk;
use App\mstgudang;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {   
        // view()->share('current_user', $user = \Auth::user());

        View::composer(['layouts.sidebar'], 'App\Http\ViewComposers\globalreportComposer');

        View::composer('*', 
            function ($view) {
                $view->with('composer_cur_user', Auth::user() );
            });


        View::composer(['users', 'userseditprofile'], 
            function ($view) {
                $cur_user = \Auth::user();
                $dbrole = strole::select(['id', 'name as text'])->where('idcompany', Auth::user()->idcompany )->orderBy('name');

                if($cur_user->owner){
                    $dbrole = strole::select(['id', 'name as text'])->where('id', '3')->union($dbrole);
                }
                else{
                }
                $view->with('composer_strole', $dbrole->get());
            });


        View::composer(['master\mstcompany'], 
            function ($view) {
                $view->with('composer_kota', DB::select(DB::raw("SELECT id, name2 FROM vwmstkota order by `name`")));
            });


        View::composer(['rptpesanrekap'], 
            function ($view) {
                $view->with('composer_tahunbulan', db::table('vwtahunbulan')->get());
            });


        View::composer(['rptpersediaan'], 
            function ($view) {
                $view->with('composer_mstgudang', mstgudang::where('kode','<>',"''")->orderBy('nama')->get());
            });


        View::composer(['master\mstbarang'], 
            function ($view) {
                $cur_user = \Auth::user();
                $view->with('composer_mstmerk', mstmerk::where('id','<>',1)->where('idcompany', $cur_user->idcompany)->orderBy('nama')->get());
            });
        
            
            
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
