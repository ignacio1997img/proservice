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
        $image_lf = '';
        $image_roe = '';
        $image_pd = '';
        $exp_modelo = '';

        $query_filter = 1;

        //empresas de seguridad
        if($request->rubro_id == 1)
        {
            $image_lf = $request->image_lf? 'br.image_lf != null':'1=1';
            $image_roe = $request->image_roe? 'br.image_roe != null': '1=1';
            $image_pd = $request->image_pd? 'br.image_pd != null': '1=1';
            $query_filter = $image_lf.' and '.$image_roe.' and '.$image_pd;
        }
        //empresa jardineria
        if($request->rubro_id == 2)
        {
            $image_lf = $request->image_lf? 'br.image_lf != null':'1=1';
            $image_roe = $request->image_roe? 'br.image_roe != null': '1=1';
            $query_filter = $image_lf.' and '.$image_roe;
        }
        //empresa piscina
        if($request->rubro_id == 3)
        {
            $image_lf = $request->image_lf? 'br.image_lf != null':'1=1';
            $image_roe = $request->image_roe? 'br.image_roe != null': '1=1';
            $query_filter = $image_lf.' and '.$image_roe;
        }
        //empresa modelos
        if($request->rubro_id == 4)
        {
            $image_lf = $request->image_lf? 'br.image_lf != null':'1=1';
            $image_roe = $request->image_roe? 'br.image_roe != null':'1=1';
            $exp_modelo = $request->exp_modelo? 'br.exp_modelo = 1':'1=1';
            $query_filter = $image_lf.' and '.$image_roe.' and '.$exp_modelo;
        }
    

        $star = $request->star;
        $data = DB::table('busines as b')
            ->leftJoin('message_busines as mb', 'mb.busine_id', 'b.id')
            ->leftJoin('busine_requirements as br', 'br.busine_id', 'b.id')
            ->whereRaw($query_filter)
            // ->where('mb.rubro_busine_id', $request->rubro_id)
            ->where('b.rubro_id', $request->rubro_id)
            ->where('b.status', $request->verified)// para ver si esta verificada la experiencia
            ->orWhere('mb.star_date', '!=', null)
            ->select('b.id', 'b.name', 'b.responsible', DB::raw("(SUM(mb.star) / count(mb.star_date)) as star"))            
            // ->having('star', '<', $request->star+1)
            ->groupBy('b.id', 'b.name', 'b.responsible')
            ->orderBy('star', 'desc')
            ->get();
        return view('beneficiary.search-busine.search-result', compact('data', 'star'));
    }

}
