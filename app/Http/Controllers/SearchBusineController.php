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
        // $data = DB::table('busines as b')
        //     ->join('message_busines as mb', 'mb.busine_id', 'b.id')
        //     ->where('mb.rubro_busine_id', 1)
        //     ->where('b.rubro_id', 1)
        //     ->where('b.status', 0)// para ver si esta verificada la experiencia
        //     ->where('mb.star_date', '!=', null)
        //     ->select('b.id', 'b.name', 'b.responsible', DB::raw("(SUM(mb.star) / count(mb.star_date)) as star"))            
        //     // ->having('star', '<', $request->star+1)
        //     ->groupBy('b.id', 'b.name', 'b.responsible')
        //     ->orderBy('star', 'desc')
        //     ->get();
        
        // return $data;









        $rubro_busine = RubroBusine::where('status',1)->where('deleted_at', null)->get();

        return view('beneficiary.search-busine.search', compact('rubro_busine'));
    }

    public function search(Request $request)
    {
       
        // $data = DB::table('busines as b')
        //     ->join('message_busines as mb', 'mb.busine_id', 'b.id')
        //     ->where('mb.rubro_busine_id', $request->rubro_id)
        //     ->where('b.rubro_id', $request->rubro_id)
        //     ->where('b.status', $request->verified)// para ver si esta verificada la experiencia
        //     ->where('mb.star_date', '!=', null)
        //     ->select('b.id', 'b.name', 'b.responsible', DB::raw("(SUM(mb.star) / count(mb.star_date)) as star"))            
        //     ->having('star', '<', $request->star+1)
        //     ->groupBy('b.id', 'b.name', 'b.responsible')
        //     ->orderBy('star', 'desc')
        //     ->get();

        $data = DB::table('busines as b')
            ->leftJoin('message_busines as mb', 'mb.busine_id', 'b.id')
            ->where('mb.rubro_busine_id', $request->rubro_id)
            ->where('b.rubro_id', $request->rubro_id)
            ->where('b.status', $request->verified)// para ver si esta verificada la experiencia
            ->where('mb.star_date', '!=', null)
            ->select('b.id', 'b.name', 'b.responsible', DB::raw("(SUM(mb.star) / count(mb.star_date)) as star"))            
            ->having('star', '<', $request->star+1)
            ->groupBy('b.id', 'b.name', 'b.responsible')
            ->orderBy('star', 'desc')
            ->get();
        return view('beneficiary.search-busine.search-result', compact('data'));
    }

}
