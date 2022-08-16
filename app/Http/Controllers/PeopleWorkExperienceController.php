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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class PeopleWorkExperienceController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $people = People::where('user_id',$user->id)->first();
        $city = City::with('department')->where('id', $people->city_id)->first();

        $department= Department::where('status', 1)->get();
        $cities = City::where('department_id', $city->department->id)->get();

        $profession = Profession::where('status', 1)->get();
        // return $city;
        $pasantia = Pasantia::where('people_id', $people->id)->where('deleted_at', null)->first();
        // return $pasantia;


        $model = TypeModel::all();
        
        $rubro = RubroPeople::where('status',1)->where('deleted_at', null)->get();
        $experiences = PeopleExperience::with('rubro_people','type_model')->where('people_id',$people->id)->where('deleted_at', null)->where('status', '!=', 0)->get();
      
        // return $experiences;
        return view('people.perfil', compact('people', 'city', 'department', 'cities', 'experiences', 'rubro', 'model', 'pasantia', 'profession'));
    }

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
            $experience->update(['status' => 0, 'deleted_at' => Carbon::now()]);

            PeopleRequirement::where('people_experience_id', $experience->id)->update(['status' => 0, 'deleted_at' => Carbon::now()]);


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
        // return 1;
        $rubro = RubroPeople::find($rubro_id);
        $peoplerequirement = PeopleRequirement::where('people_experience_id', $id)->where('deleted_at', null)->where('status', 1)->first();
        // return $peoplerequirement;
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




    //FUNCIONES PARA REGISTRAR LOS REQUERIMIENTOS DE CADA RUBRO DE MANERA ESTATICA

    public function requirementGuardiaStore(Request $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            $ok = PeopleRequirement::where('people_experience_id', $request->people_experience_id)->where('deleted_at', null)->first();
            
            if($ok)
            {
                
                $image_ci = null;
                $image_ci2 = null;
                $image_ap = null;
                $image_lsm = null;
                $image_fcc = null;
                // $m=0;
                $d=0;
                $n=0;
                

                $file = $request->file('image_ci');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/guardia/ci/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ci = $dir.'/'.$newFileName;
                    $ok->update(['image_ci' => $image_ci]);
                }

                $file = $request->file('image_ci2');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/guardia/ci/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ci2 = $dir.'/'.$newFileName;
                    $ok->update(['image_ci2' => $image_ci2]);
                }

                // return 1;
                $file = $request->file('image_ap');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/guardia/antecedente_penales/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ap = $dir.'/'.$newFileName;
                    $ok->update(['image_ap' => $image_ap]);
                }

                $file = $request->file('image_lsm');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/guardia/libreta_servicio/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_lsm = $dir.'/'.$newFileName;
                    $ok->update(['image_lsm' => $image_lsm]);
                }

                $file = $request->file('image_fcc');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/guardia/foto_tamaño_completo/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_fcc = $dir.'/'.$newFileName;
                    $ok->update(['image_fcc' => $image_fcc]);
                }
               
                if($request->turno)
                {
                    $i=0;
                    while($i < count($request->turno))
                    {
                        // if($request->turno[$i] == '1')
                        // {
                        //     $m++;
                        // }
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
                // return $request;
                if($request->peso)
                {
                    $ok->update(['peso' => $request->peso]);
                }
                if($request->estatura)
                {
                    $ok->update(['estatura' => $request->estatura]);
                }


            }
            else
            {
                $image_ci = null;
                $image_ci2 = null;
                $image_ap = null;
                $image_lsm = null;
                $image_fcc = null;
                // $m=0;
                $d=0;
                $n=0;
               

                $file = $request->file('image_ci');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/guardia/ci/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ci = $dir.'/'.$newFileName;
                }

                $file = $request->file('image_ci2');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/guardia/ci/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ci2 = $dir.'/'.$newFileName;
                }

                $file = $request->file('image_ap');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/guardia/antecedente_penales/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ap = $dir.'/'.$newFileName;
                }

                $file = $request->file('image_lsm');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/guardia/libreta_servicio/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_lsm = $dir.'/'.$newFileName;
                }

                $file = $request->file('image_fcc');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/guardia/foto_tamaño_completo/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_fcc = $dir.'/'.$newFileName;
                }
               
                if($request->turno)
                {
                    $i=0;
                    while($i < count($request->turno))
                    {
                        // if($request->turno[$i] == '1')
                        // {
                        //     $m++;
                        // }
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
                }
               
                // return $request->all();
                PeopleRequirement::create(['people_experience_id' => $request->people_experience_id, 'type'=>'guardia', 'image_ci' => $image_ci, 'image_ci2' => $image_ci2, 'image_ap' => $image_ap,
                                        'image_lsm' => $image_lsm, 'image_fcc' => $image_fcc, 't_dia' => $d, 't_noche' => $n, 'estatura' => $request->estatura, 'peso'=>$request->peso]);
        
            }

            // return 1;
            DB::commit();
            return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return 0;
            return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Ocurrió un error al guardar el registro.', 'alert-type' => 'error']);
        }
    }


    public function requirementJardineriaStore(Request $request)
    {
        DB::beginTransaction();
        // return $request->all();
        try {
            $ok = PeopleRequirement::where('people_experience_id', $request->people_experience_id)->where('deleted_at', null)->first();
            // return $ok;
            if($ok)
            {
                $image_ci = null;
                $image_ci2 = null;
                $image_ap = null;
                

                $file = $request->file('image_ci');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/jardinero/ci/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ci = $dir.'/'.$newFileName;
                    $ok->update(['image_ci' => $image_ci]);
                }

                $file = $request->file('image_ci2');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/jardinero/ci/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ci2 = $dir.'/'.$newFileName;
                    $ok->update(['image_ci2' => $image_ci2]);
                }

                $file = $request->file('image_ap');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/jardinero/antecedente_penales/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ap = $dir.'/'.$newFileName;
                    $ok->update(['image_ap' => $image_ap]);
                }

                if($request->exp_jardineria != NULL)
                {
                    $ok->update(['exp_jardineria' => $request->exp_jardineria]);
                }
                if($request->exp_paisajismo != NULL)
                {
                    $ok->update(['exp_paisajismo' => $request->exp_paisajismo]);
                }
                if($request->exp_maquinas)
                {
                    $ok->update(['exp_maquinas' => $request->exp_maquinas]);
                }


            }
            else
            {
                $image_ci = null;
                $image_ci2 = null;
                $image_ap = null;

                $file = $request->file('image_ci');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/jardinero/ci/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ci = $dir.'/'.$newFileName;
                }

                $file = $request->file('image_ci2');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/jardinero/ci/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ci2 = $dir.'/'.$newFileName;
                }

                $file = $request->file('image_ap');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/jardinero/antecedente_penales/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ap = $dir.'/'.$newFileName;
                }


                $ok = PeopleRequirement::create(['people_experience_id' => $request->people_experience_id, 'type'=>'jardinero', 'image_ci' => $image_ci, 'image_ci2' => $image_ci2, 'image_ap' => $image_ap]);
                if($request->exp_jardineria)
                {
                    $ok->update(['exp_jardineria' => $request->exp_jardineria]);
                }
                if($request->exp_paisajismo)
                {
                    $ok->update(['exp_paisajismo' => $request->exp_paisajismo]);
                }
                if($request->exp_maquinas)
                {
                    $ok->update(['exp_maquinas' => $request->exp_maquinas]);
                }
        
            }

            
            DB::commit();
            return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);
            
        } catch (\Throwable $th) {
            DB::rollBack();
            // return $th;
            return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Ocurrió un error al guardar el registro.', 'alert-type' => 'error']);
        }
    }

    public function requirementPiscineroStore(Request $request)
    {
        DB::beginTransaction();
        // return $request->all();
        try {

            $image_ci = null;
            $image_ci2 = null;
            $image_ap = null;

            $ok = PeopleRequirement::where('people_experience_id', $request->people_experience_id)->where('deleted_at', null)->first();
           
            if($ok)
            {
                $file = $request->file('image_ci');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/piscinero/ci/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ci = $dir.'/'.$newFileName;
                    $ok->update(['image_ci' => $image_ci]);
                }

                $file = $request->file('image_ci2');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/piscinero/ci/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ci2 = $dir.'/'.$newFileName;
                    $ok->update(['image_ci2' => $image_ci2]);
                }

                $file = $request->file('image_ap');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/piscinero/antecedente_penales/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ap = $dir.'/'.$newFileName;
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

                // return $ok;
                

            }
            else
            {

                $file = $request->file('image_ci');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/piscinero/ci/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ci = $dir.'/'.$newFileName;
                }

                $file = $request->file('image_ci2');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/piscinero/ci/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ci2 = $dir.'/'.$newFileName;
                }

                $file = $request->file('image_ap');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/piscinero/antecedente_penales/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ap = $dir.'/'.$newFileName;
                }


                PeopleRequirement::create(['people_experience_id' => $request->people_experience_id, 'type'=>'piscinero', 'image_ci' => $image_ci, 'image_ci2' => $image_ci2, 'image_ap' => $image_ap, 'exp_mant_piscina' => $request->exp_mant_piscina,
                                                'medir_ph' => $request->medir_ph, 'asp_piscina'=> $request->asp_piscina, 'cant_quimico' => $request->cant_quimico, 'bomba_agua' => $request->bomba_agua, 'trabajado_ante_donde'=> $request->trabajado_ante_donde ]);
        
            }

            
            DB::commit();
            return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);
            
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Ocurrió un error al guardar el registro.', 'alert-type' => 'error']);
        }
    }

    //para modelos
    public function requirementModelosStore(Request $request)
    {
        $this->validate($request, [
                // 'title' => 'required|string|max:255',
                // 'video' => 'required|file|mimetypes:video/mp4',
        ]);
        DB::beginTransaction();
        // return $request->all();
        try {

            $image_ci = null;
            $image_ci2 = null;
            $image_book = null;
            $video = null;

            $ok = PeopleRequirement::where('people_experience_id', $request->people_experience_id)->where('deleted_at', null)->first();
           
            if($ok)
            {
                // return 2;
                $file = $request->file('image_ci');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/modelos/ci/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ci = $dir.'/'.$newFileName;
                    $ok->update(['image_ci' => $image_ci]);
                }

                $file = $request->file('image_ci2');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/modelos/ci/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ci2 = $dir.'/'.$newFileName;
                    $ok->update(['image_ci2' => $image_ci2]);
                }

                $file = $request->file('image_book');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/modelos/book/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_book = $dir.'/'.$newFileName;
                    $ok->update(['image_book' => $image_book]);
                }


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



                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
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
            return $th;
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
