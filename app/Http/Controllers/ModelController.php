<?php

namespace App\Http\Controllers;
// namespace App\Http\FileControllers;

use App\Models\People;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PeopleExperience;
use Illuminate\Support\Facades\DB;
use App\Models\TypeModel;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\PeopleRequirement;
use App\Http\Controllers\PeopleWorkExperienceController;
use App\Models\City;
use App\Http\Controllers\FileController;

class ModelController extends Controller
{

    // static public $obj = new FileController(null);
    
    public function index()
    {
        // return 1;
        // $people = People::where('status',1)->where('deleted_at', null)->get();
        $people = PeopleExperience::where('deleted_at', null)->where('rubro_id', 4)->get();
        // return $people;

        $department = Department::where('status',1)->get();
        $type = TypeModel::where('status', 1)->where('deleted_at', null)->get();

        return view('people.registerModel.browse', compact('people', 'department', 'type'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|unique:users',
                'ci' => 'required|unique:people',
                'password' => 'required|min:8|max:25'
            ]);
        DB::beginTransaction();
        try {
            $ok = People::where('ci', $request->ci)->first();
            if($ok)
            {
                return redirect()->route('registerModel.index')->with(['message' => 'El CI ya existe.', 'alert-type' => 'error']);
            }
    
            $ok = User::where('email', $request->email)->first();
            if($ok)
            {
                    return redirect()->back()->with(['message' => 'El email ya existe.', 'alert-type' => 'error']);
            }
    
            $user = User::create([
                            'name' => $request->first_name,
                            'email' => $request->emails,
                            'role_id' => 4,
                            'password' =>bcrypt($request->password)
            ]);
            
            $people = People::create([
                    'user_id' => $user->id,
                    'ci' => $request->ci,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'birth_date' => $request->birth_date,
                    'email' => $request->email,
                    'phone1' => $request->phone1,
                    'phone2' => $request->phone2,
                    'address' => $request->address,
                    'city_id' => $request->city_id,
                    'sex' => $request->sex,
                    'type' => $request->type,
                    'facebook' => $request->facebook,
                    'instagram' => $request->instagram,
                    'tiktok' => $request->tiktok
            ]);

            $ok = PeopleExperience::create(['rubro_id' => 4, 'people_id' => $people->id, 'typeModel_id'=>$request->typeModel_id, 'status' => 2]);
            PeopleRequirement::create(['people_experience_id' => $ok->id]);
                
            DB::commit();
            
            return redirect()->route('registerModel.index')->with(['message' => 'Modelo Registrado Exitosamente..', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollback();
            // return 0;
            return redirect()->back()->with(['message' => 'Contactese Con Los Administradores.', 'alert-type' => 'error']);
        }
    }

    //   para ver el perfil del modelo registrado
    public function show($id)
    {
        $people = People::find($id);
        $city = City::with('department')->where('id', $people->city_id)->first();
        $experiences = PeopleExperience::where('rubro_id', 4)->where('people_id',$id)->where('deleted_at', null)->where('status', '!=', 0)->first();
        // return $experiences;
        return view('people.registerModel.perfil', compact('people', 'city','experiences'));
    }

    // para ver la vista de los requisitos para los modelos
    public function viewRequirement($id)
    {
        // return $id;
        $experience = PeopleExperience::find($id);
        $peoplerequirement = PeopleRequirement::where('people_experience_id', $id)->where('deleted_at', null)->where('status', 1)->first();
        return view('people.registerModel.add-requirement', compact('experience', 'peoplerequirement'));
    }

    

    public function storeRequirement(Request $request)
    {
        DB::beginTransaction();
        // DD($request);
        // return $request;
        try {
            $objVideo = new FileController;

            $image_ci = null;
            $image_ci2 = null;
            $image_book = null;
            $video = null;

            $ok = PeopleRequirement::where('people_experience_id', $request->people_experience_id)->where('deleted_at', null)->first();
            $people = PeopleExperience::where('id', $ok->people_experience_id)->where('deleted_at', null)->first();
            
        
                // return 2;
                $file = $request->file('image_ci');
                if($file)
                {                        

                    $image_ci = $this->image_POST($file, $people->people_id, "trabajadores/modelos/ci");
                    $ok->update(['image_ci' => $image_ci]);
                }

                $file = $request->file('image_ci2');
                if($file)
                {                        
                    $image_ci2 = $this->image_POST($file, $people->people_id, "trabajadores/modelos/ci");

                    $ok->update(['image_ci2' => $image_ci2]);
                }

                $file = $request->file('image_book');
                if($file)
                {                        
                   

                    $image_book = $this->image_POST($file, $people->people_id, "trabajadores/modelos/book");

                    $ok->update(['image_book' => $image_book]);
                }

                $file = $request->file('video');
                if($file)
                {                               
                    $video = $objVideo->video($file, $people->people_id, "trabajadores/modelos/video");
                    $ok->update(['video' => $video]);
                }

                // if($request->curso_modelaje != null)
                // {
                //     $ok->update(['curso_modelaje' => $request->curso_modelaje]);
                // }
                // if($request->exp_modelaje != null)
                // {
                //     $ok->update(['exp_modelaje' => $request->exp_modelaje]);
                // }
                // if($request->estatura != null)
                // {
                //     $ok->update(['estatura' => $request->estatura]);
                // }
                // if($request->peso != null)
                // {
                //     $ok->update(['peso' => $request->peso]);
                // }
                // if($request->eye)
                // {
                //     $ok->update(['eye'=> $request->eye]);
                // }
                // if($request->spanish != null)
                // {
                //     $ok->update(['spanish' => $request->spanish]);
                // }
                // if($request->english != null)
                // {
                //     $ok->update(['english' => $request->english]);
                // }
                // if($request->frances != null)
                // {
                //     $ok->update(['frances' => $request->frances]);
                // }
                // if($request->italiano != null)
                // {
                //     $ok->update(['italiano' => $request->italiano]);
                // }
                // if($request->portugues != null)
                // {
                //     $ok->update(['portugues' => $request->portugues]);
                // }
                // if($request->aleman != null)
                // {
                //     $ok->update(['aleman' => $request->aleman]);
                // }
                // if($request->otro_idioma != null)
                // {
                //     $ok->update(['otro_idioma' => $request->otro_idioma]);
                // }
                // if($request->talla_sup)
                // {

                //     $ok->update(['talla_sup'=> $request->talla_sup]);
                // }
                // if($request->talla_inf)
                // {
                //     $ok->update(['talla_inf'=> $request->talla_inf]);
                // }
                // if($request->nro_calzado)
                // {
                //     $ok->update(['nro_calzado'=> $request->nro_calzado]);
                // }
                // if($request->exp_publicidad != NULL)
                // {
                //     $ok->update(['exp_publicidad'=> $request->exp_publicidad]);
                // }
                // if($request->exp_fotografia != NULL)
                // {
                //     $ok->update(['exp_fotografia'=> $request->exp_fotografia]);
                // }
                // if($request->exp_pasarela != NULL)
                // {
                //     $ok->update(['exp_pasarela'=> $request->exp_pasarela]);
                // }

                DB::commit();
                return 11;
                return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);
             

            
            
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return 0;
            // return $th;
            return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Ocurrió un error al guardar el registro.', 'alert-type' => 'error']);
        }
    }
}
