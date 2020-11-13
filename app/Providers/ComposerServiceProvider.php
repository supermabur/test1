<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

use App\model\strole;
use App\model\mstmerk;
use App\model\mstjenis;
use App\model\mstsatuan;
use App\model\mstsupcus;
use App\mstgudang;

use App\model\vwmstoutlet;
use App\model\vwusersoutlet;

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


        View::composer(['master.mstcompany', 'master.mstsupcus', 'master.mstoutlet', 'master.popmstsupcus', 'trans.trbeli'], 
            function ($view) {
                $view->with('composer_kota', DB::select(DB::raw("SELECT id, name2 FROM vwmstkota order by `name`")));
            });

        View::composer(['users'], 
            function ($view) {
                $cur_user = \Auth::user();
                $view->with('composer_mstoutlet', vwmstoutlet::where('idcompany', $cur_user->idcompany)->where('id','>',1)->orderBy('nama')->get());
            });


        View::composer(['rptpesanrekap'], 
            function ($view) {
                $view->with('composer_tahunbulan', db::table('vwtahunbulan')->get());
            });


        View::composer(['rptpersediaan'], 
            function ($view) {
                $view->with('composer_mstgudang', mstgudang::where('kode','<>',"''")->orderBy('nama')->get());
            });


        View::composer(['master.mstbarang'], 
            function ($view) {
                $cur_user = \Auth::user();
                $view->with('composer_mstmerk', mstmerk::where('idcompany', $cur_user->idcompany)->orderBy('nama')->get());
                $view->with('composer_mstjenis', mstjenis::where('idcompany', $cur_user->idcompany)->orderBy('nama')->get());
                $view->with('composer_mstsatuan', mstsatuan::orderBy('nama')->get());
            });
        
            

        // TRANSAKSI
        View::composer(['trans.trbeli'], 
            function ($view) {
                $cur_user = \Auth::user();
                $view->with('composer_usersoutlet', vwusersoutlet::where('iduser', $cur_user->id)->where('aktif',1)->orderBy('nama')->get());
                $view->with('composer_supplier', mstsupcus::where('idcompany', $cur_user->idcompany)->where('aktif',1)->where('jenis', '<', 2)->where('id','>', 1)->orderBy('nama')->get());
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
