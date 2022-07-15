<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class downloadController extends Controller
{

    
    public function downloadpdf_suratpesan($alias) {
        $d = DB::table('trpesanh')->where('alias', $alias)->first();
        if ($d) {
            $file_path = public_path('faktur/trpesan/' . $d->faktur. '.pdf');
            return response()->download($file_path);        
        }
        else{
            abort(403, 'Unauthorized action.');
        }
    }
}
