<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Course;
use App\Models\Pasantia;
use App\Models\People;
use Composer\Util\Http\RequestProxy;

class PasantiaController extends Controller
{

    //  para poder agregar los requisitos de la pasantia 
    public function edit($id)
    {
        $pasantia_id=$id;
        $pasantia = Pasantia::where('id', $id)->first();
        // return $id;
        $courses = Course::where('deleted_at', null)->where('pasantia_id', $id)->get();
        // return $courses;
        return view('people.pasantia.add-requirement', compact('pasantia_id', 'courses', 'pasantia'));
    }

    public function store(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            Pasantia::create(['people_id'=>$request->people_id, 'institution'=>$request->institution, 'profession_id'=>$request->profession_id]);

            DB::commit();
            return redirect()->route('people-perfil-experience.index')->with(['message' => 'Registrado Exitosamente..', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return 0;
            return redirect()->route('people-perfil-experience.index')->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
        }
    }

    public function print($id)
    {
        // return 1;
        $pasantia = Pasantia::where('id', $id)->first();
        $people = People::where('id', $pasantia->people_id)->first();
        $courses = Course::where('pasantia_id', $pasantia->id)->where('deleted_at', null)->get();
        return view('people.pasantia.print', compact('people', 'pasantia', 'courses'));
    }

    // para poder actualizar los datos de los pasantes
    public function pasanteUpdate(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {

            $pasantia = Pasantia::find($request->pasantia_id);
            if($request->type)
            {
                $pasantia->update(['type'=>$request->type]);
            }

            if($request->semester)
            {
                $pasantia->update(['semester'=>$request->semester]);
            }

            if($request->objetive)
            {
                $pasantia->update(['objetive'=>$request->objetive]);
            }
        



            DB::commit();
            // return 1;
            return redirect()->route('pasantes.edit', ['pasante'=>$request->pasantia_id])->with(['message' => 'Registrado Exitosamente..', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollBack();
            // return 0;
            return redirect()->route('pasantes.edit', ['pasante'=>$request->pasantia_id])->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
        }
    }

    // para registar los cursos realizados para las pasantia
    public function courseStore(Request $request)
    {
        // return $request;
        DB::beginTransaction();       
        try {
            Course::create(['start'=>$request->start, 'finish'=>$request->finish, 'name'=>$request->name, 'institution'=>$request->institution, 'pasantia_id'=>$request->pasantia_id]);
            DB::commit();
            return redirect()->route('pasantes.edit', ['pasante'=>$request->pasantia_id])->with(['message' => 'Registrado Exitosamente..', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            // return 0;
            return redirect()->route('pasantes.edit', ['pasante'=>$request->pasantia_id])->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
        }
    }

    //  para eliminar los curso realizados de cada pasantia
    public function courseDestroy(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            Course::where('id', $request->id)->update(['deleted_at'=>Carbon::now()]);
            DB::commit();
            return redirect()->route('pasantes.edit', ['pasante'=>$request->pasantia_id])->with(['message' => 'Eliminado exitosamente..', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('pasantes.edit', ['pasante'=>$request->pasantia_id])->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
        }
    }

}
