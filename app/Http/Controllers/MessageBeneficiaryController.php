<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beneficiary;
use App\Models\MessageBusine;
use Illuminate\Support\Carbon;
use App\Models\Busine;
use App\Models\RubroBusine;
use App\Models\Department;
use App\Models\City;
use App\Models\BusineRequirement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MessageBeneficiaryController extends Controller
{
    public function message_beneficiary()
    {
        // return 1;
        $beneficiary = Beneficiary::where('user_id', Auth::user()->id)->first();
        // return $beneficiary;
        $message = MessageBusine::with(['busine','rubro_busine', 'beneficiary'])->where('beneficiary_id', $beneficiary->id)->where('deleted_at', null)->orderBy('id', 'desc')->get();
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
    public function busine_perfil_view($id, $busine_id)
    {
        $message = MessageBusine::find($id);

        if($message->date_date == null)
        {
            $message->update([
                'date_view' => Carbon::now()
            ]);
        }
        // return $busine_id;
        // return $id;
        // return $rubro_id;
        $busine = Busine::find($busine_id);
        $city = City::with('department')->where('id', $busine->city_id)->first();


        $rubro = RubroBusine::find($busine->rubro_id);
        $businerequirements = BusineRequirement::where('busine_id', $busine->id)->first();
        // return $requirement;

        return view('message.message-busine.busine-perfil.perfil', compact('busine','city', 'rubro', 'businerequirements'));
        // $experiences = PeopleExperience::with('rubro_people')->where('people_id',$people_id)->where('rubro_id', $rubro_id)->first();
        // // return $experiences;
        // $peoplerequirement = PeopleRequirement::where('people_experience_id', $experiences->id)->where('deleted_at', null)->first();
        // return $requirement;
        // return view('message.message-people.people-perfil.perfil', compact('people', 'experiences', 'peoplerequirement', 'rubro_id'));
    }
}
