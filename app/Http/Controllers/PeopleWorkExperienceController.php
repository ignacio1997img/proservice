<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\City;
use App\Models\People;
use App\Models\Pasantia;
use App\Models\TypeModel;
use App\Models\Department;
use App\Models\Profession;
use App\Models\RubroPeople;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PeopleExperience;
use App\Models\PeopleRequirement;
    use Symfony\Component\HttpFoundation\File\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FileController;

use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class PeopleWorkExperienceController extends Controller
{
    public function index()
    {
        // return 1;
        $user = Auth::user();

        $people = People::where('user_id',$user->id)->first();
        $city = City::with('department')->where('id', $people->city_id)->first();

        $department= Department::where('status', 1)->get();
        $cities = City::where('department_id', $city->department->id)->get();

        $profession = Profession::where('status', 1)->get();

        $pasantia = Pasantia::where('people_id', $people->id)->where('deleted_at', null)->first();


        $model = TypeModel::all();
        
        $rubro = RubroPeople::where('status',1)->where('deleted_at', null)->get();
        $experiences = PeopleExperience::with('rubro_people','type_model')->where('people_id',$people->id)->where('deleted_at', null)->where('status', '!=', 0)->get();

        $unique_experience=NULL;
        // return Carbon::now();
      
        // return $experiences;
        return view('people.perfil', compact('people', 'city', 'department', 'cities', 'experiences', 'rubro', 'model', 'pasantia', 'profession', 'unique_experience'));
    }

    // para registrar las experiencia de cada persona
    public function store(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            $people = People::where('user_id',Auth::user()->id)->first();

            $ok = PeopleExperience::where('people_id',$people->id)->where('rubro_id',$request->rubro_id)->where('deleted_at', null)->where('status', '!=', 0)->first();
            if(!$ok)
            {
                $ok = PeopleExperience::create(['rubro_id' => $request->rubro_id, 'people_id' => $people->id, 'typeModel_id'=>$request->typeModel_id, 'status' => 2]);
                PeopleRequirement::create(['people_experience_id' => $ok->id]);
                DB::commit();
                return redirect()->route('people-perfil-experience.index')->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);
            }
            else
            {
                return redirect()->route('people-perfil-experience.index')->with(['message' => 'Ya existe un registro con ese rubro.', 'alert-type' => 'error']);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('people-perfil-experience.index')->with(['message' => 'Ocurrió un error al guardar el registro.', 'alert-type' => 'error']);
        }
    }



    //metodo para que los trabajadores elimine "BAJA" la experiebncia laboral
    public function destroy(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            // return Carbon::now();
            $experience = PeopleExperience::find($request->id);
            $experience->update(['deleted_at' => Carbon::now()]);

            PeopleRequirement::where('people_experience_id', $experience->id)->update(['deleted_at' => Carbon::now()]);


            DB::commit();
            return redirect()->route('people-perfil-experience.index')->with(['message' => 'Registro eliminado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('people-perfil-experience.index')->with(['message' => 'Ocurrió un error al eliminar el registro.', 'alert-type' => 'error']);
        }
    }


    //metodo para ver la vista de los requisitos
    public function requirementCreate($id, $rubro_id)
    {        
        $rubro = RubroPeople::find($rubro_id);
        $peoplerequirement = PeopleRequirement::where('people_experience_id', $id)->where('deleted_at', null)->where('status', 1)->first();
        // $requirement = PeopleRequirement::where('people_experience_id', $id)->where('deleted_at', null)->where('status', 1)->first();
        return view('people.work-experience.add-requirement', compact('id', 'rubro_id', 'rubro', 'peoplerequirement'));
    }



    //FUNCION PARA APROBAR LOS RUBRO O EXPERIENCIA DE TRABAJOS
    public function aprobarRubro(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try
        {
            $experience = PeopleExperience::find($request->id);
            $experience->update(['status' => 1]);
            DB::commit();
            return redirect()->route('people.view', $experience->people_id)->with(['message' => 'Registro aprobado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th)
        {
            DB::rollBack();
            return redirect()->route('people.view', $experience->people_id)->with(['message' => 'Ocurrió un error al aprobar el registro.', 'alert-type' => 'error']);
        }
    }
    

    public function updateCategoriaModelaje(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try
        {
            $experience = PeopleExperience::find($request->id);
            $experience->update(['typeModel_id' => $request->typeModel_id]);
            DB::commit();
            return redirect()->route('people.view', $experience->people_id)->with(['message' => 'Categoria actualizada exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th)
        {
            DB::rollBack();
            return redirect()->route('people.view', $experience->people_id)->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
        }
    }


    public function image_POST($file, $id, $type){
        // return $file;
        Storage::makeDirectory($type.'/'.date('F').date('Y'));
        $base_name = $id.'@'.Str::random(40);

        // return $base_name;
        
        // imagen normal
        $filename = $base_name.'.'.$file->getClientOriginalExtension();
        $image_resize = Image::make($file->getRealPath())->orientate();
        $image_resize->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        
        $path =  $type.'/'.date('F').date('Y').'/'.$filename;
        $image_resize->save(public_path('../storage/app/public/'.$path));
        $imagen = $path;

        // imagen mediana
        $filename_medium = $base_name.'_medium.'.$file->getClientOriginalExtension();
        $image_resize = Image::make($file->getRealPath())->orientate();
        $image_resize->resize(650, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $path_medium = $type.'/'.date('F').date('Y').'/'.$filename_medium;
        $image_resize->save(public_path('../storage/app/public/'.$path_medium));
        // return 11;


        // imagen pequeña
        $filename_small = $base_name.'_small.'.$file->getClientOriginalExtension();
        $image_resize = Image::make($file->getRealPath())->orientate();
        $image_resize->resize(260, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $path_small = $type.'/'.date('F').date('Y').'/'.$filename_small;
        $image_resize->save(public_path('../storage/app/public/'.$path_small));



        // imagen Recortada
        $filename_cropped = $base_name.'_cropped.'.$file->getClientOriginalExtension();
        $image_resize = Image::make($file->getRealPath())->orientate();
        $image_resize->resize(300, 250, function ($constraint) {
            $constraint->aspectRatio();
        });
        $path_cropped = $type.'/'.date('F').date('Y').'/'.$filename_cropped;
        $image_resize->save(public_path('../storage/app/public/'.$path_cropped));

        return $imagen;
    }


    //FUNCIONES PARA REGISTRAR LOS REQUERIMIENTOS DE CADA RUBRO DE MANERA ESTAT


    

    

    //para modelos
    public function requirementModelosStore(Request $request)
    {
        $this->validate($request, [
                // 'title' => 'required|string|max:255',
                // 'video' => 'required|file|mimetypes:video/mp4',
        ]);
        // return $request;
        DB::beginTransaction();
        try {

            $image_ci = null;
            $image_ci2 = null;
            $image_book = null;
            $video = null;

            $ok = PeopleRequirement::where('people_experience_id', $request->people_experience_id)->where('deleted_at', null)->first();
            $people = PeopleExperience::where('id', $ok->people_experience_id)->where('deleted_at', null)->first();
            
            // return $people;
           
            if($ok)
            {
                // return 2;
                $file = $request->file('image_ci');
                if($file)
                {                        
                    // $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    // $dir = "trabajadores/modelos/ci/".date('F').date('Y');
                            
                    // Storage::makeDirectory($dir);
                    // Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    // $image_ci = $dir.'/'.$newFileName;

                    $image_ci = $this->image_POST($file, $people->people_id, "trabajadores/modelos/ci");
                    $ok->update(['image_ci' => $image_ci]);
                }

                $file = $request->file('image_ci2');
                if($file)
                {                        
                    // $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    // $dir = "trabajadores/modelos/ci/".date('F').date('Y');
                            
                    // Storage::makeDirectory($dir);
                    // Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    // $image_ci2 = $dir.'/'.$newFileName;

                    $image_ci2 = $this->image_POST($file, $people->people_id, "trabajadores/modelos/ci");

                    $ok->update(['image_ci2' => $image_ci2]);
                }

                $file = $request->file('image_book');
                if($file)
                {                        
                    // $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    // $dir = "trabajadores/modelos/book/".date('F').date('Y');
                            
                    // Storage::makeDirectory($dir);
                    // Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    // $image_book = $dir.'/'.$newFileName;

                    $image_book = $this->image_POST($file, $people->people_id, "trabajadores/modelos/book");

                    $ok->update(['image_book' => $image_book]);
                }
                // return 1;


                $file = $request->file('video');
                if($file)
                {             
                    // $file = $request->file('video');
                    // $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                    // $filename = $file->getClientOriginalName();
                    //  $dir = "trabajadores/modelos/video/".date('F').date('Y');
                    // Storage::makeDirectory($dir);
                    // // $path = public_path().'/uploads/';
                

                    // $file->move($dir, $newFileName);     



                    $newFileName = $people->people_id.'@'.Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/modelos/video/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    // return $dir;
                    // dd(file_get_contents($file));
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $video = $dir.'/'.$newFileName;
                    $ok->update(['video' => $video]);


                }

                if($request->curso_modelaje != null)
                {
                    $ok->update(['curso_modelaje' => $request->curso_modelaje]);
                }
                if($request->exp_modelaje != null)
                {
                    $ok->update(['exp_modelaje' => $request->exp_modelaje]);
                }
                if($request->estatura != null)
                {
                    $ok->update(['estatura' => $request->estatura]);
                }
                if($request->peso != null)
                {
                    $ok->update(['peso' => $request->peso]);
                }
                if($request->eye)
                {
                    $ok->update(['eye'=> $request->eye]);
                }
                if($request->spanish != null)
                {
                    $ok->update(['spanish' => $request->spanish]);
                }
                if($request->english != null)
                {
                    $ok->update(['english' => $request->english]);
                }
                if($request->frances != null)
                {
                    $ok->update(['frances' => $request->frances]);
                }
                if($request->italiano != null)
                {
                    $ok->update(['italiano' => $request->italiano]);
                }
                if($request->portugues != null)
                {
                    $ok->update(['portugues' => $request->portugues]);
                }
                if($request->aleman != null)
                {
                    $ok->update(['aleman' => $request->aleman]);
                }
                if($request->otro_idioma != null)
                {
                    $ok->update(['otro_idioma' => $request->otro_idioma]);
                }
                if($request->talla_sup)
                {

                    $ok->update(['talla_sup'=> $request->talla_sup]);
                }
                if($request->talla_inf)
                {
                    $ok->update(['talla_inf'=> $request->talla_inf]);
                }
                if($request->nro_calzado)
                {
                    $ok->update(['nro_calzado'=> $request->nro_calzado]);
                }
                if($request->exp_publicidad != NULL)
                {
                    $ok->update(['exp_publicidad'=> $request->exp_publicidad]);
                }
                if($request->exp_fotografia != NULL)
                {
                    $ok->update(['exp_fotografia'=> $request->exp_fotografia]);
                }
                if($request->exp_pasarela != NULL)
                {
                    $ok->update(['exp_pasarela'=> $request->exp_pasarela]);
                }
                // return $ok;

                DB::commit();
                return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);
                

            }
            else
            {

                return "Contactese con el administrador";
                
                $file = $request->file('image_ci');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/modelos/ci/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ci = $dir.'/'.$newFileName;
                }

                $file = $request->file('image_ci2');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/modelos/ci/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ci2 = $dir.'/'.$newFileName;
                }
                // return 3;
                $file = $request->file('image_book');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/modelos/book/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_book = $dir.'/'.$newFileName;
                }

                // return 1;
                PeopleRequirement::create(['people_experience_id' => $request->people_experience_id, 'type'=>'modelos', 'image_ci' => $image_ci, 'image_ci2' => $image_ci2, 'image_book' => $image_book, 'estatura' => $request->estatura, 'peso'=>$request->peso,
                    'spanish' => $request->spanish, 'english'=> $request->english, 'frances' => $request->frances, 'italiano' => $request->italiano, 'portugues'=> $request->portugues, 'aleman'=> $request->aleman, 'otro_idioma'=> $request->otro_idioma,
                    'curso_modelaje'=> $request->curso_modelaje, 'exp_modelaje'=> $request->exp_modelaje,
                    'talla_inf'=> $request->talla_inf,'talla_sup'=> $request->talla_sup, 'nro_calzado'=> $request->nro_calzado,
                    'exp_publicidad'=> $request->exp_publicidad, 'exp_fotografia'=> $request->exp_fotografia, 'exp_pasarela'=> $request->exp_pasarela
                ]);
                DB::commit();
                return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);
            }

            
            
            
        } catch (\Throwable $th) {
            DB::rollBack();
            // return 0;
            // return $th;
            return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Ocurrió un error al guardar el registro.', 'alert-type' => 'error']);
        }
    }

    // para seguridad de guardia
    public function requirementGuardiaStore(Request $request)
    {
        // dd($request);
        $imageObj = new FileController;
        DB::beginTransaction();
        try {
            $ok = PeopleRequirement::where('people_experience_id', $request->people_experience_id)->where('deleted_at', null)->first();
            $people = PeopleExperience::where('id', $ok->people_experience_id)->where('deleted_at', null)->first();
            $ok->update(['type'=>'guardia']);
        // return $ok;
            $file = $request->file('image_ci');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $ci = $imageObj->file($file, $people->people_id, "trabajadores/guardia/ci");
                }
                else
                {
                    $ci = $imageObj->image($file, $people->people_id, "trabajadores/guardia/ci");
                }  
                $ok->update(['image_ci' => $ci]);
            }

            $file = $request->file('image_ci2');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_ci2 = $imageObj->file($file, $people->people_id, "trabajadores/guardia/ci");
                }
                else
                {
                    $image_ci2 = $imageObj->image($file, $people->people_id, "trabajadores/guardia/ci");
                } 
                
                $ok->update(['image_ci2' => $image_ci2]);
            }

            $file = $request->file('image_ap');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_ap = $imageObj->file($file, $people->people_id, "trabajadores/guardia/antecedente_penales");
                }
                else
                {
                    $image_ap = $imageObj->image($file, $people->people_id, "trabajadores/guardia/antecedente_penales");
                } 
                $ok->update(['image_ap' => $image_ap]);
            }

            $file = $request->file('image_lsm');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_lsm = $imageObj->file($file, $people->people_id, "trabajadores/guardia/libreta_servicio");
                }
                else
                {
                    $image_lsm = $imageObj->image($file, $people->people_id, "trabajadores/guardia/libreta_servicio");
                } 
                $ok->update(['image_lsm' => $image_lsm]);
            }

            $file = $request->file('image_fcc');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_fcc = $imageObj->file($file, $people->people_id, "trabajadores/guardia/foto_tamaño_completo");
                }
                else
                {
                    $image_fcc = $imageObj->image($file, $people->people_id, "trabajadores/guardia/foto_tamaño_completo");
                } 
                $ok->update(['image_fcc' => $image_fcc]);
            }

            if($request->turno)
            {
                $i=0;
                $d=0;
                $n=0;
                while($i < count($request->turno))
                {
                    if($request->turno[$i] == '1')
                    {
                            $d++;
                    }
                    if($request->turno[$i] == '2')
                    {
                        $n++;
                    }
                    $i++;
                }
                $ok->update(['t_dia' => $d, 't_noche' => $n]);
            }
            if($request->peso)
            {
                $ok->update(['peso' => $request->peso]);
            }
            if($request->estatura)
            {
                $ok->update(['estatura' => $request->estatura]);
            }
            DB::commit();
            return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);           
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Ocurrió un error al guardar el registro.', 'alert-type' => 'error']);
        }
    }    

    // para los jardinero
    public function requirementJardineriaStore(Request $request)
    {
        $imageObj = new FileController;

        DB::beginTransaction();
        try {
            $ok = PeopleRequirement::where('people_experience_id', $request->people_experience_id)->where('deleted_at', null)->first();
            $people = PeopleExperience::where('id', $ok->people_experience_id)->where('deleted_at', null)->first();
            $ok->update(['type'=>'jardinero']);

            $file = $request->file('image_ci');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $ci = $imageObj->file($file, $people->people_id, "trabajadores/sistemaSeguridad/ci");
                }
                else
                {
                    $ci = $imageObj->image($file, $people->people_id, "trabajadores/sistemaSeguridad/ci");
                }  
                $ok->update(['image_ci' => $ci]);
            }

            $file = $request->file('image_ci2');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_ci2 = $imageObj->file($file, $people->people_id, "trabajadores/sistemaSeguridad/ci");
                }
                else
                {
                    $image_ci2 = $imageObj->image($file, $people->people_id, "trabajadores/sistemaSeguridad/ci");
                } 
                
                $ok->update(['image_ci2' => $image_ci2]);
            }
            $file = $request->file('image_ap');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_ap = $imageObj->file($file, $people->people_id, "trabajadores/sistemaSeguridad/antecedentePenales");
                }
                else
                {
                    $image_ap = $imageObj->image($file, $people->people_id, "trabajadores/sistemaSeguridad/antecedentePenales");
                } 
                $ok->update(['image_ap' => $image_ap]);
            }

            
            if($request->exp_jardineria != null)
            {
                $ok->update(['exp_jardineria' => $request->exp_jardineria]);
            }
            if($request->exp_paisajismo != null)
            {
                $ok->update(['exp_paisajismo' => $request->exp_paisajismo]);
            }
            if($request->exp_maquinas != null)
            {
                $ok->update(['exp_maquinas' => $request->exp_maquinas]);
            }
            
            DB::commit();
            return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Ocurrió un error al guardar el registro.', 'alert-type' => 'error']);
        }
    }

    // para sistema de seguridad   *requirementSeguritySystemStore*
    public function requirementSeguritySystemStore(Request $request)
    {
        // dd($request);
        $imageObj = new FileController;
        DB::beginTransaction();
        try {

            $ok = PeopleRequirement::where('people_experience_id', $request->people_experience_id)->where('deleted_at', null)->first();
            $people = PeopleExperience::where('id', $ok->people_experience_id)->where('deleted_at', null)->first();
            $ok->update(['type'=>'sistemaSeguridad']);

            $file = $request->file('image_ci');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $ci = $imageObj->file($file, $people->people_id, "trabajadores/sistemaSeguridad/ci");
                }
                else
                {
                    $ci = $imageObj->image($file, $people->people_id, "trabajadores/sistemaSeguridad/ci");
                }  
                $ok->update(['image_ci' => $ci]);
            }

            $file = $request->file('image_ci2');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_ci2 = $imageObj->file($file, $people->people_id, "trabajadores/sistemaSeguridad/ci");
                }
                else
                {
                    $image_ci2 = $imageObj->image($file, $people->people_id, "trabajadores/sistemaSeguridad/ci");
                } 
                
                $ok->update(['image_ci2' => $image_ci2]);
            }
            $file = $request->file('image_ap');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_ap = $imageObj->file($file, $people->people_id, "trabajadores/sistemaSeguridad/antecedentePenales");
                }
                else
                {
                    $image_ap = $imageObj->image($file, $people->people_id, "trabajadores/sistemaSeguridad/antecedentePenales");
                } 
                $ok->update(['image_ap' => $image_ap]);
            }


            if($request->exp_camaraSeguridad != null)
            {
                $ok->update(['exp_camaraSeguridad' => $request->exp_camaraSeguridad]);
            }

            if($request->exp_controlAcceso != null)
            {
                $ok->update(['exp_controlAcceso' => $request->exp_controlAcceso]);
            }

            if($request->exp_cercoElectrico != null)
            {
                $ok->update(['exp_cercoElectrico' => $request->exp_cercoElectrico]);
            }

            if($request->exp_sistemaAlarma != null)
            {
                $ok->update(['exp_sistemaAlarma' => $request->exp_sistemaAlarma]);
            }
            DB::commit();

            return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);

            
            
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return 0;
            return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Ocurrió un error al guardar el registro.', 'alert-type' => 'error']);
        }
    }

    // para los piscinero
    public function requirementPiscineroStore(Request $request)
    {
        $imageObj = new FileController;
        DB::beginTransaction();
        // return $request->all();
        try {
            $ok = PeopleRequirement::where('people_experience_id', $request->people_experience_id)->where('deleted_at', null)->first();
            $people = PeopleExperience::where('id', $ok->people_experience_id)->where('deleted_at', null)->first();
            $ok->update(['type'=>'piscinero']);

            $file = $request->file('image_ci');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $ci = $imageObj->file($file, $people->people_id, "trabajadores/sistemaSeguridad/ci");
                }
                else
                {
                    $ci = $imageObj->image($file, $people->people_id, "trabajadores/sistemaSeguridad/ci");
                }  
                $ok->update(['image_ci' => $ci]);
            }

            $file = $request->file('image_ci2');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_ci2 = $imageObj->file($file, $people->people_id, "trabajadores/sistemaSeguridad/ci");
                }
                else
                {
                    $image_ci2 = $imageObj->image($file, $people->people_id, "trabajadores/sistemaSeguridad/ci");
                } 
                
                $ok->update(['image_ci2' => $image_ci2]);
            }
            $file = $request->file('image_ap');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_ap = $imageObj->file($file, $people->people_id, "trabajadores/sistemaSeguridad/antecedentePenales");
                }
                else
                {
                    $image_ap = $imageObj->image($file, $people->people_id, "trabajadores/sistemaSeguridad/antecedentePenales");
                } 
                $ok->update(['image_ap' => $image_ap]);
            }

            if($request->exp_mant_piscina != null)
            {
                $ok->update(['exp_mant_piscina' => $request->exp_mant_piscina]);
            }

            if($request->medir_ph != null)
            {
                $ok->update(['medir_ph' => $request->medir_ph]);
            }

            if($request->asp_piscina != null)
            {
                $ok->update(['asp_piscina' => $request->asp_piscina]);
            }

            if($request->cant_quimico != null)
            {
                $ok->update(['cant_quimico' => $request->cant_quimico]);
            }

            if($request->bomba_agua != null)
            {
                $ok->update(['bomba_agua' => $request->bomba_agua]);
            }

            if($request->trabajado_ante_donde != null)
            {
                $ok->update(['trabajado_ante_donde' => $request->trabajado_ante_donde]);
            }
            
            DB::commit();
            return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Ocurrió un error al guardar el registro.', 'alert-type' => 'error']);
        }
    }





    public function fichaTecnica($id, $experience)
    {
        // return $id;
        $people = People::with(['experience'=>function($q) use ($experience){
                $q->where('id',$experience)->where('deleted_at',null)->first();
            }, 'experience.requirement'=>function($q){
                $q->where('deleted_at', null);
            }])
            ->where('id', $id)->first();

            // return $people;
        return view('people.fichaTecnica.print-ficha', compact('people'));
    }
}
