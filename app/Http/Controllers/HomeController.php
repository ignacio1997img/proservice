<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use App\Models\Busine;
use App\Models\Beneficiary;
use App\Models\PeopleExperience;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $peoplev = DB::table('people as p')
            ->join('people_experiences as pe', 'pe.people_id', 'p.id')
            ->where('p.deleted_at', null)
            ->where('pe.status', 1)
            ->where('pe.deleted_at', null)
            ->select('p.id', 'pe.status')
            ->groupBy('p.id', 'pe.status')
            ->count();


        //solicitudes en verificacion
        $people_exp = PeopleExperience::where('status',2)->where('deleted_at', null)->count();
        $busine_exp = Busine::where('status',2)->where('deleted_at',null)->count();

        $solicitud_pendiente = $people_exp + $busine_exp;





        $people = People::where('deleted_at')->count();
        $busine = Busine::where('deleted_at')->count();
        $beneficiary = Beneficiary::where('deleted_at')->count();
        $miembros = $people + $busine +$beneficiary;
        // return $mie
        return view('welcome', compact('peoplev','solicitud_pendiente', 'miembros', 'busine'));
    }

    // public function modelFolio()
    // {

    //     // $profesional = PeopleExperience::where()
    //     // $standar =
    //     // $normal = 
    //     return view('modelFolio.master');
    // }

    // funcion para registrar solo archivos de cualquier formato
    
}
