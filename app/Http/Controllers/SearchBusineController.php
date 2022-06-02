<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RubroBusine;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Busine;

class SearchBusineController extends Controller
{

    // para buscar empresas 
    public function index()
    {
        // $rubro_people = RubroPeople::where('status',1)->where('deleted_at', null)->get();
        $rubro_busine = RubroBusine::where('status',1)->where('deleted_at', null)->get();

        return view('beneficiary.search-busine.search', compact('rubro_busine'));
    }

    public function search(Request $request)
    {
        dd($request);
        // $data = Busine::with(['rubrobusines'=>function($query)use($request){
        //             $query->where('id', $request->rubro_id);
        //             // dd($query);
        //         }])
        // ->where('status',1)->where('deleted_at', null)->get();

        $data = Busine::where('rubro_id', $request->rubro_id)->where('status',1)->where('deleted_at', null)->get();
        // dd($data);

        // $rubro_busine = $request->rubro_id;
        return view('beneficiary.search-busine.search-result', compact('data'));
    }

}
