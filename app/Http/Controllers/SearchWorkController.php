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

        // dd($request);
        $rubro_people = $request->rubro_id;
        $rubro_busine = DB::table('busines as b')
            ->join('rubro_busines as rb', 'rb.id', '=', 'b.rubro_id')
            ->where('b.user_id', Auth::user()->id)
            ->select('rb.id as rubro_busine', 'rb.name as rubro', 'b.id as busine_id')
            ->first();

        
        $star = $request->star;
        $image_ap ='';
        $image_lsm = '';
        $t_dia = '';
        $t_noche = '';

        $i_peso = '';
        $f_peso = '';
        $i_estatura = '';
        $f_estatura = '';
        
        $exp_jardineria ='';
        $exp_paisajismo = '';

        $exp_mant_piscina='';
        $medir_ph='';
        $asp_piscina='';
        $bomba_agua ='';

        $image_book = '';



        $query_filtro = 1;

        //para  guardia filtro 
        if($request->rubro_id == 1)
        {
            $image_ap = $request->image_ap ? 'pr.image_ap != null': '1=1';
            $image_lsm = $request->image_lsm? 'pr.image_lsm != null' : '1=1';
            $t_dia = $request->t_dia? 'pr.t_dia = 1' : '1=1';
            $t_noche = $request->t_noche? 'pr.t_noche = 1' : '1=1';
            $i_peso = $request->inicio_peso? 'pr.peso >= '.$request->inicio_peso : '1=1';
            $f_peso = $request->fin_peso? 'pr.peso <= '.$request->fin_peso : '1=1';
            $i_estatura = $request->inicio_estatura? 'pr.estatura >= '.$request->inicio_estatura : '1=1';
            $f_estatura = $request->fin_estatura? 'pr.estatura <= '.$request->fin_estatura : '1=1';

            $query_filtro = $image_ap.' and '.$image_lsm.' and '.$t_dia.' and '.$t_noche.' and '.$i_peso.' and '.$f_peso.' and '.$i_estatura.' and '.$f_estatura;
        }

        //para jardinero
        if($request->rubro_id == 2)
        {
            $image_ap = $request->image_ap ? 'pr.image_ap != null':'1=1';
            $exp_jardineria = $request->exp_jardineria? 'pr.exp_jardineria = 1':'1=1';
            $exp_paisajismo = $request->exp_paisajismo? 'pr.exp_paisajismo = 1':'1=1';

            $query_filtro = $image_ap.' and '.$exp_jardineria.' and '.$exp_paisajismo;
        }

        //para piscinero
        if($request->rubro_id == 3)
        {
            $image_ap = $request->image_ap ? 'pr.image_ap != null': '1=1';
            $exp_mant_piscina = $request->exp_mant_piscina? 'pr.exp_mant_piscina = 1': '1=1';
            $medir_ph = $request->medir_ph? 'pr.medir_ph = 1': '1=1';
            $asp_piscina = $request->asp_piscina? 'pr.asp_piscina = 1': '1=1';
            $bomba_agua = $request->bomba_agua? 'pr.bomba_agua = 1': '1=1';

            $query_filtro = $image_ap.' and '.$exp_mant_piscina.' and '.$medir_ph.' and '.$asp_piscina.' and '.$bomba_agua;
        }

        //para modelos
        if($request->rubro_id == 4)
        {
            $image_book = $request->image_book ? 'pr.image_book != null': '1=1';
            $i_peso = $request->inicio_peso? 'pr.peso >= '.$request->inicio_peso : '1=1';
            $f_peso = $request->fin_peso? 'pr.peso <= '.$request->fin_peso : '1=1';
            $i_estatura = $request->inicio_estatura? 'pr.estatura >= '.$request->inicio_estatura : '1=1';
            $f_estatura = $request->fin_estatura? 'pr.estatura <= '.$request->fin_estatura : '1=1';

            $query_filtro = $image_book.' and '.$i_peso.' and '.$f_peso.' and '.$i_estatura.' and '.$f_estatura;
        }

        $data = DB::table('people as p')
                ->join('people_experiences as pe', 'pe.people_id', 'p.id')
                ->leftJoin('people_requirements as pr', 'pr.people_experience_id', 'pe.id')
                ->whereRaw($query_filtro)
                ->where('pe.rubro_id', $request->rubro_id)
                ->where('pe.status', $request->verified)
                ->select('p.id', 'p.first_name', 'p.last_name', DB::raw("(pe.star / pe.cant) as star"), 'pe.id as people_experience_id')
                // ->groupBy('p.id', 'p.first_name', 'p.last_name')
                ->orderBy('star', 'desc')
                ->get();
        // dd($data);
     

        return view('busine.search-workers.search-result', compact('data','rubro_people', 'rubro_busine', 'star'));
    }
}
