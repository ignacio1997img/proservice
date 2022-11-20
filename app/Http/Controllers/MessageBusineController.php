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
use Illuminate\Support\Str;
use App\Models\MessageBusine;
use App\Models\City;
use App\Models\TypeModel;
use App\Models\Department;
use App\Models\Pasantia;
use App\Models\Profession;
use App\Models\RubroPeople;


class MessageBusineController extends Controller
{
    public function file($file, $id, $type)
    {
        // $nombre_origen = $file->getClientOriginalName();                        
        $newFileName = $id.'@'.Str::random(20).time().'.'.$file->getClientOriginalExtension();
                        
        $dir = $type.'/'.date('F').date('Y');
                        
        Storage::makeDirectory($dir);
        Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));
                // $image_ap = $dir.'/'.$newFileName;
        return $dir.'/'.$newFileName;                 
    }

    public function store(Request $request)
    {
        // dd($request);
        DB::beginTransaction();
        try {
            $busine = Busine::find($request->busine_id);
            $beneficiary = Beneficiary::where('user_id', Auth::user()->id)->first();
            $files = $request->file('pdf');
            $data='';
            // return 1;
            if($files)
            {
                return $files;
                // $data = $this->file($files, $beneficiary->id, 'beneficiario/message');
            }
            // return 1;
            MessageBusine::create([
                'busine_id' => $request->busine_id,
                'rubro_busine_id' => $busine->rubro_id,
                'beneficiary_id' => $beneficiary->id,
                'detail' => $request->detail,
                'file'=> $data?$data:null
            ]);
            // return $busine;
            

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Mensaje enviado correctamente.']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Error al enviar mensaje.']);
        }
    }

    public function storeAll(Request $request)
    {
        DB::beginTransaction();
        // return $request;
        try {
            $cant = count($request->busine_id);
            // return $cant;
            $i=0;
            while($i < $cant)
            {
                $busine = Busine::find($request->busine_id[$i]);
                $beneficiary = Beneficiary::where('user_id', Auth::user()->id)->first();
                MessageBusine::create([
                    'busine_id' => $request->busine_id[$i],
                    'rubro_busine_id' => $busine->rubro_id,
                    'beneficiary_id' => $beneficiary->id,
                    'detail' => $request->detail
                ]);
                $i++;
            }
            DB::commit();
            // return 2;
            return response()->json(['success' => true, 'message' => 'Mensaje enviado correctamente.']);
        } catch (\Exception $e) {
            // return "nada";
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Seleccione una o mas empresa.']);
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
        $unique_experience = $rubro_id;
        $people = People::find($people_id);
        $city = City::with('department')->where('id', $people->city_id)->first();
        $department= Department::where('status', 1)->get();
        $cities = City::with('department')->get();
        $model = TypeModel::all();

        $pasantia = Pasantia::where('people_id', $people->id)->where('deleted_at', null)->first();
        $profession = Profession::where('status', 1)->get();

        $rubro = RubroPeople::where('status',1)->where('deleted_at', null)->get();
        $experiences = PeopleExperience::with('rubro_people')->where('people_id',$people_id)->where('deleted_at', null)->where('status', '!=', 0)->get();

        $peoplerequirement = PeopleRequirement::where('people_experience_id', $experience)->where('deleted_at', null)->where('status', 1)->first();



        $message = MessagePeople::find($id);
        if($message->data_view == null){
            $message->update([
                'date_view' => Carbon::now()
            ]);
        }

        // return $rubro_id;
        // $people = People::find($people_id);
        // $peoplerequirement = PeopleRequirement::where('people_experience_id', $experience)->first();

        return view('people.perfil', compact('people','department', 'city', 'cities', 'model', 'experiences', 'rubro', 'pasantia', 'profession',   'unique_experience', 'peoplerequirement'));
        // return view('people.perfil', compact('people', 'city', 'department', 'cities', 'experiences', 'rubro', 'model', 'pasantia', 'profession'));

        // return $requirement;
        // return view('message.message-people.people-perfil.perfil', compact('people', 'peoplerequirement', 'rubro_id'));
        // return view('message.message-people.people-perfil.perfil', compact('people', 'peoplerequirement', 'rubro_id'));
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
