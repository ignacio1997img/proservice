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

        $data = DB::table('people as p')
            ->join('people_experiences as pe', 'pe.people_id', 'p.id')
            ->join('message_people as mp', 'mp.people_id', 'p.id')
            
            ->where('mp.rubro_people_id', 1)
            ->where('pe.rubro_id', 1)
            ->where('pe.status', 2)// para ver si esta verificada la experiencia
            ->where('mp.star_date', '!=', null)
            // ->select('p.id', 'p.first_name', 'p.last_name', DB::raw("SUM(mp.star) as start"), DB::raw("count(mp.star_date) as count"))
            ->select('p.id', 'p.first_name', 'p.last_name', DB::raw("SUM(mp.star) / count(mp.star_date) as total"))
            // ->select('*')
            ->groupBy('p.id', 'p.first_name', 'p.last_name')
            ->get();
        // return $data;








        $rubro_people = RubroPeople::where('status',1)->where('deleted_at', null)->get();

        return view('busine.search-workers.search', compact('rubro_people'));
    }
    public function data(Request $request)
    {
        $data = DB::table('people as p')
            ->join('people_experiences as pe', 'pe.people_id', 'p.id')
            ->join('message_people as mp', 'mp.people_id', 'p.id')
            
            ->where('mp.rubro_people_id', $request->rubro_id)
            ->where('pe.rubro_id', $request->rubro_id)
            ->select('*')
            ->get();
    }


    public function search(Request $request)
    {    
        $rubro_people = $request->rubro_id;
        $rubro_busine = DB::table('busines as b')
            ->join('rubro_busines as rb', 'rb.id', '=', 'b.rubro_id')
            ->where('b.user_id', Auth::user()->id)
            ->select('rb.id as rubro_busine', 'rb.name as rubro', 'b.id as busine_id')
            ->first();

        
        $star = $request->star;

        $data = DB::table('people as p')
                ->join('people_experiences as pe', 'pe.people_id', 'p.id')
                ->leftJoin('message_people as mp', 'mp.people_id', 'p.id')
                ->where('pe.rubro_id', $request->rubro_id)
                ->where('pe.status', $request->verified)// para ver si esta verificada la experiencia
                // ->Where('mp.star', '>', 0)
                ->orwhere('mp.rubro_people_id', $request->rubro_id)

                // ->orWhereRaw('mp.star > 0')
                // ->orWhere('mp.rubro_people_id', '!=', 0)
                // ->orWhere('mp.status', 1)
                ->select('p.id', 'p.first_name', 'p.last_name', 'mp.star')
                // ->groupBy('p.id', 'p.first_name', 'p.last_name')
                // ->orderBy('star', 'desc')
                ->get();
                dd($data);
// 
        // $data = DB::table('people as p')
        //         ->join('people_experiences as pe', 'pe.people_id', 'p.id')
        //         ->leftJoin('message_people as mp', 'mp.people_id', 'p.id')//ineer join
                
        //         // ->where('mp.rubro_people_id', $request->rubro_id)
        //         ->where('pe.rubro_id', $request->rubro_id)
        //         ->where('pe.status', $request->verified)// para ver si esta verificada la experiencia
        //         ->orWhere('mp.star_date', '!=', null)
        //         ->select('p.id', 'p.first_name', 'p.last_name', DB::raw("(SUM(mp.star) / count(mp.star_date)) as star"))
        //         // ->having('star', '<', $request->star+1)
        //         ->groupBy('p.id', 'p.first_name', 'p.last_name')
        //         ->orderBy('star', 'desc')
        //         ->get();
        //         dd($request);

        return view('busine.search-workers.search-result', compact('data','rubro_people', 'rubro_busine', 'star'));
    }
}
