<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Modelfolio;
use App\Models\PeopleExperience;

class ModelfolioController extends Controller
{
    public function index()
    {
        $model = DB::table('people_experiences as pe')
                        ->join('people as p', 'p.id', 'pe.people_id')
                        ->where('p.deleted_at', null)
                        ->where('p.status', 1)
                        ->where('pe.deleted_at', null)
                        ->where('pe.rubro_id', 4)
                        ->select('pe.folio', 'pe.id', 'p.first_name', 'p.last_name')
                        ->get();
                        // return $model;

        $folio = DB::table('people_experiences as pe')
                        ->join('people as p', 'p.id', 'pe.people_id')
                        ->join('modelfolios as m', 'm.peopleExperiences_id', 'pe.id')
                        ->where('p.deleted_at', null)
                        ->where('p.status', 1)
                        ->where('pe.deleted_at', null)
                        ->where('pe.rubro_id', 4)
                        ->where('m.status', 1)
                        ->select('pe.folio', 'pe.typeModel_id', 'pe.id', 'm.id as folio_id', 'p.first_name', 'p.last_name')
                        ->get();

        // return $folio;
        return view('modelFolio.browse', compact('model', 'folio'));
    }


    public function folioProfesional()
    {
        $folio = DB::table('people_experiences as pe')
                        ->join('people as p', 'p.id', 'pe.people_id')
                        ->join('people_requirements as pr', 'pr.people_experience_id', 'pe.id')
                        ->join('modelfolios as m', 'm.peopleExperiences_id', 'pe.id')
                        ->where('p.deleted_at', null)
                        ->where('p.status', 1)
                        ->where('pe.deleted_at', null)
                        ->where('pe.rubro_id', 4)
                        ->where('m.status', 1)
                        ->where('pe.typeModel_id', 1)
                        ->select('pe.folio', 'pe.typeModel_id', 'pe.id', 'm.id as folio_id', 'p.first_name', 'p.last_name', 'pr.image_book', 'pr.peso', 'pr.estatura',
                        'pr.talla_inf', 'pr.talla_sup', 'pr.eye')
                        ->get();
        return view('modelFolio.folio', compact('folio'));
    }

    public function foliostandard()
    {
        $folio = DB::table('people_experiences as pe')
                        ->join('people as p', 'p.id', 'pe.people_id')
                        ->join('people_requirements as pr', 'pr.people_experience_id', 'pe.id')
                        ->join('modelfolios as m', 'm.peopleExperiences_id', 'pe.id')
                        ->where('p.deleted_at', null)
                        ->where('p.status', 1)
                        ->where('pe.deleted_at', null)
                        ->where('pe.rubro_id', 4)
                        ->where('m.status', 1)
                        ->where('pe.typeModel_id', 2)
                        ->select('pe.folio', 'pe.typeModel_id', 'pe.id', 'm.id as folio_id', 'p.first_name', 'p.last_name', 'pr.image_book', 'pr.peso', 'pr.estatura',
                        'pr.talla_inf', 'pr.talla_sup', 'pr.eye')
                        ->get();
        return view('modelFolio.folio2', compact('folio'));
    }

    public function folioImpulsadores()
    {
        $folio = DB::table('people_experiences as pe')
                        ->join('people as p', 'p.id', 'pe.people_id')
                        ->join('people_requirements as pr', 'pr.people_experience_id', 'pe.id')
                        ->join('modelfolios as m', 'm.peopleExperiences_id', 'pe.id')
                        ->where('p.deleted_at', null)
                        ->where('p.status', 1)
                        ->where('pe.deleted_at', null)
                        ->where('pe.rubro_id', 4)
                        ->where('m.status', 1)
                        ->where('pe.typeModel_id', 3)
                        ->select('pe.folio', 'pe.typeModel_id', 'pe.id', 'm.id as folio_id', 'p.first_name', 'p.last_name', 'pr.image_book', 'pr.peso', 'pr.estatura',
                        'pr.talla_inf', 'pr.talla_sup', 'pr.eye')
                        ->get();
                        // return $folio;
        return view('modelFolio.folio3', compact('folio'));
    }

    public function store(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            Modelfolio::create(['peopleExperiences_id'=>$request->id]);
            PeopleExperience::where('id', $request->id)->update(['folio'=>1]);
            DB::commit();
            return redirect()->route('modelfolio.index')->with(['message' => 'Agregado al Portafolio..', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('modelfolio.index')->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
        }
    }

    public function update(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            // Modelfolio::create(['peopleExperiences_id'=>$request->id]);
            PeopleExperience::where('id', $request->id)->update(['folio'=>0]);
            Modelfolio::where('id', $request->folio_id)->update(['status'=>0]);
            DB::commit();
            return redirect()->route('modelfolio.index')->with(['message' => 'Eliminado del portafolio..', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('modelfolio.index')->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
        }
    }


}
