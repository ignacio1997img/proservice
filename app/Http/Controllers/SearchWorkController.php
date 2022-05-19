<?php

namespace App\Http\Controllers;

use App\Models\RubroPeople;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchWorkController extends Controller
{
    // PARA BUSCAR A TRABAJADORES
    public function index()
    {
        $rubro_people = RubroPeople::where('status',1)->where('deleted_at', null)->get();

        return view('busine.search-workers.search', compact('rubro_people'));
    }


    public function search(Request $request)
    {    
        // $rubro_busine 
       $data = DB::table('people as p')
            ->join('people_experiences as pe', 'pe.people_id', '=', 'p.id')
            ->join('rubro_people as rp', 'rp.id', '=', 'pe.rubro_id')
            ->where('p.status',1)
            ->where('p.deleted_at', null)
            ->where('rp.id', $request->rubro_id)
            ->where('pe.status', '!=' ,0)
            // ->where('pe.status',1)
            ->select('p.id', 'p.first_name', 'p.last_name', 'p.email', 'p.phone1', 'rp.name as rubro')
            ->get();
            // return $data;
        $rubro_people = $request->rubro_id;
        $rubro_busine = DB::table('busines as b')
            ->join('rubro_busines as rb', 'rb.id', '=', 'b.rubro_id')
            ->where('b.user_id', Auth::user()->id)
            ->select('rb.id as rubro_busine', 'rb.name as rubro', 'b.id as busine_id')
            ->first();

        // dd($rubro_busine);

        return view('busine.search-workers.search-result', compact('data','rubro_people', 'rubro_busine'));
    }
}
