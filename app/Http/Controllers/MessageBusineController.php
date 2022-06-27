<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Busine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\MessagePeople;
use App\Models\People;
use App\Models\PeopleExperience;
use App\Models\PeopleRequirement;
use App\Models\MessageBusine;

class MessageBusineController extends Controller
{
    

    public function store(Request $request)
    {
        dd(1);
        DB::beginTransaction();
        try {
            $busine = Busine::find($request->busine_id);
            $beneficiary = Beneficiary::where('user_id', Auth::user()->id)->first();
            MessageBusine::create([
                'busine_id' => $request->busine_id,
                'rubro_busine_id' => $busine->rubro_id,
                'beneficiary_id' => $beneficiary->id,
                'detail' => $request->detail
            ]);
            // return $busine;

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Mensaje enviado correctamente.']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Error al enviar mensaje.']);
        }
    }
    

    public function message_busine()
    {
// return 1;
        $busine = Busine::where('user_id', Auth::user()->id)->where('deleted_at', null)->first();

        //para las solicitudes de los beneficiarios que sean de la empresa
        $entrada = MessageBusine::with(['busine','rubro_busine', 'beneficiary'])->where('busine_id', $busine->id)->where('deleted_at', null)->orderBy('id', 'desc')->get();

        // return $entrada;




        //para la solicitudes enviadas a los trabajadores
        $message = MessagePeople::with(['busine','rubro_busine', 'rubro_people', 'people'])->where('busine_id', $busine->id)->where('deleted_at', null)->orderBy('id', 'desc')->get();

        // return $message;
        //para las solicitudes recibidas de los beneficiarios


        return view('message.message-busine.browse', compact('message', 'entrada'));
    }

    public function aceptar(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            $message = MessageBusine::find($request->id);
            // return $message;
            $message->update([
                'status' => 1,
                'view' => Carbon::now()
            ]);
            DB::commit();
            return redirect()->route('message-busine.bandeja')->with(['message' => 'Mensaje aceptado correctamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('message-busijne.bandeja')->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);

        }
    }

    public function rechazar(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            $message = MessageBusine::find($request->id);
            $message->update([
                'status' => 0,
                'view' => Carbon::now()
            ]);
            DB::commit();
            return redirect()->route('message-busine.bandeja')->with(['message' => 'Mensaje rechazado correctamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('message-busine.bandeja')->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
        }
    }

    public function cancelar(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            $message = MessagePeople::find($request->id);
            $message->update([
                'status' => 0,
                'deleted_at' => Carbon::now()                
            ]);
            DB::commit();
            return redirect()->route('message-busine.bandeja')->with(['message' => 'Mensaje rechazado correctamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('message-busine.bandeja')->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
        }
    }










    //PARA VER LOS PERFILES DE CADA PERSONA QUE SE HAYA ENVIADO UN MENSAJE
    public function people_perfil_view($id, $people_id, $rubro_id, $experience)
    {
        // return $people_id;

        $message = MessagePeople::find($id);
        if($message->data_view == null){
            $message->update([
                'date_view' => Carbon::now()
            ]);
        }

        // return $rubro_id;
        $people = People::find($people_id);
        // $experiences = PeopleExperience::with('rubro_people')->where('people_id',$people_id)->where('rubro_id', $rubro_id)->first();

        // $experiences = PeopleExperience::find($experience);
        // return $experiences;
        $peoplerequirement = PeopleRequirement::where('people_experience_id', $experience)->first();
        // return $requirement;
        return view('message.message-people.people-perfil.perfil', compact('people', 'peoplerequirement', 'rubro_id'));
    }



    public function calification(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            $message = MessageBusine::find($request->id);
            // return $message;
            if($message->date_date == null)
            {
                $message->update([
                    'date_view' => Carbon::now()
                ]);
            }
            $busine = Busine::find($message->busine_id);
            $busine->update(['star'=> $busine->star + $request->star, 'cant'=> $busine->cant + 1]);

            $message->update([
                'star' => $request->star,
                'comment' => $request->comment,
                'star_date' => Carbon::now()
            ]);
            DB::commit();
            return redirect()->route('message-beneficiary.bandeja')->with(['message' => 'Calificación enviada correctamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('message-beneficiary.bandeja')->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
        }
    }







}
