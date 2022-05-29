<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beneficiary;
use App\Models\MessageBusine;
use Illuminate\Support\Carbon;
use App\Models\Busine;
use App\Models\RubroBusine;
use App\Models\BusineRequirement;
use Illuminate\Support\Facades\DB;

class MessageBeneficiaryController extends Controller
{
    public function message_beneficiary()
    {
        // return 1;
        $message = MessageBusine::with(['busine','rubro_busine', 'beneficiary'])->where('deleted_at', null)->orderBy('id', 'desc')->get();
        // return $message;
        return view('message.message-beneficiary.browse', compact('message'));
    }



    public function cancelar(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            $message = MessageBusine::find($request->id);
            $message->update([
                'status' => 0,
                'deleted_at' => Carbon::now()
            ]);
            DB::commit();
            return redirect()->route('message-beneficiary.bandeja')->with(['message' => 'Mensaje cancelado correctamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('message-beneficiary.bandeja')->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
        }
    }


    //PARA VER LOS PERFILES DE CADA EMPRESA QUE SE HAYA ENVIADO UN MENSAJE
    public function busine_perfil_view($busine_id)
    {
        // return $busine_id;
        // return $id;
        // return $rubro_id;
        $busine = Busine::find($busine_id);
        return $busine;
        $rubro = RubroBusine::find($busine->rubro_id);
        $requirement = BusineRequirement::where('busine_id')->first();
        // $experiences = PeopleExperience::with('rubro_people')->where('people_id',$people_id)->where('rubro_id', $rubro_id)->first();
        // // return $experiences;
        // $peoplerequirement = PeopleRequirement::where('people_experience_id', $experiences->id)->where('deleted_at', null)->first();
        // return $requirement;
        // return view('message.message-people.people-perfil.perfil', compact('people', 'experiences', 'peoplerequirement', 'rubro_id'));
    }
}
