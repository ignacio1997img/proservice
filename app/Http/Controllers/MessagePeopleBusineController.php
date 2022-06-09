<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MessagePeople;
use Illuminate\Support\Facades\DB;
use App\Models\People;
use App\Models\PeopleExperience;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MessagePeopleBusineController extends Controller
{
    // para poder enivar mensajes a la persona
    public function store(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            MessagePeople::create([
                'people_id' => $request->people_id,
                'rubro_people_id' => $request->rubro_people_id,
                'busine_id' => $request->busine_id,
                'rubro_busine_id' => $request->rubro_busine_id,
                'imoney' => $request->imoney?$request->imoney:0,
                'fmoney' => $request->fmoney?$request->fmoney:0,
                'detail' => $request->detail
            ]);
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Mensaje enviado correctamente.']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Error al enviar mensaje.']);
        }
    }



    //para que puedan ver las solicitudes de mensajes las personas
    public function message_people()
    {
        // return 1;
        $user = Auth::user();
        $people = People::where('user_id', $user->id)->where('status', 1)->where('deleted_at', null)->first();
        // return $people;
        $message = MessagePeople::with(['busine','rubro_busine'])->where('people_id', $people->id)->where('deleted_at', null)->orderBy('id', 'desc')->get();
        // return $message;
        return view('message.message-people.browse', compact('message'));
    }

    public function aceptar(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            $message = MessagePeople::find($request->id);
            $message->update([
                'status' => 1,
                'view' => Carbon::now()
            ]);
            DB::commit();
            return redirect()->route('message-people.bandeja')->with(['message' => 'Mensaje aceptado correctamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('message-people.bandeja')->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);

        }
    }

    public function rechazar(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            $message = MessagePeople::find($request->id);
            $message->update([
                'status' => 0,
                'view' => Carbon::now()
            ]);
            DB::commit();
            return redirect()->route('message-people.bandeja')->with(['message' => 'Mensaje rechazado correctamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('message-people.bandeja')->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
        }
    }
    public function calification(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            $message = MessagePeople::find($request->id);

            if($message->date_view == null){
                $message->update([
                    'date_view' => Carbon::now()
                ]);
            }

            $message->update([
                'star' => $request->star,
                'comment' => $request->comment,
                'star_date' => Carbon::now()
            ]);

            // return $message;
            $people = PeopleExperience::where('people_id', $message->people_id)->where('rubro_id', $message->rubro_people_id)->first();
            $people->update(['star' => $request->star + $people->star, 'cant' => $people->cant + 1]);


            DB::commit();
            // return 1;
            
            return redirect()->route('message-busine.bandeja')->with(['message' => 'Calificación enviada correctamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollback();
            // return 1;
            return redirect()->route('message-busine.bandeja')->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
        }
    }
}
