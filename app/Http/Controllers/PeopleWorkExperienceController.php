<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PeopleExperience;
use App\Models\RubroPeople;
use Carbon\Carbon;
use App\Models\PeopleRequirement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PeopleWorkExperienceController extends Controller
{
    public function index()
    {
        $people = People::where('user_id',Auth::user()->id)->first();
        
        $rubro = RubroPeople::where('status',1)->where('deleted_at', null)->get();
        $experiences = PeopleExperience::with('rubro_people')->where('people_id',$people->id)->where('deleted_at', null)->where('status', '!=', 0)->get();
        // return $experiences;
        return view('people.perfil', compact('people', 'experiences', 'rubro'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $people = People::where('user_id',Auth::user()->id)->first();

            $ok = PeopleExperience::where('people_id',$people->id)->where('rubro_id',$request->rubro_id)->where('deleted_at', null)->where('status', '!=', 0)->first();
            if(!$ok)
            {
                PeopleExperience::create(['rubro_id' => $request->rubro_id, 'people_id' => $people->id, 'status' => 2]);
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


    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            // return Carbon::now();
            $experience = PeopleExperience::find($request->id);
            $experience->update(['status' => 0, 'deleted_at' => Carbon::now()]);
            DB::commit();
            return redirect()->route('people-perfil-experience.index')->with(['message' => 'Registro eliminado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('people-perfil-experience.index')->with(['message' => 'Ocurrió un error al eliminar el registro.', 'alert-type' => 'error']);
        }
    }

    public function requirementCreate($id, $rubro_id)
    {        
        // return 1;
        $rubro = RubroPeople::find($rubro_id);
        $peoplerequirement = PeopleRequirement::where('people_experience_id', $id)->where('deleted_at', null)->where('status', 1)->first();
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






    //FUNCIONES PARA REGISTRAR LOS REQUERIMIENTOS DE CADA RUBRO DE MANERA ESTATICA

    public function requirementGuardiaStore(Request $request)
    {
        DB::beginTransaction();
        try {
            $ok = PeopleRequirement::where('people_experience_id', $request->people_experience_id)->where('deleted_at', null)->first();
            
            if($ok)
            {
                
                $image_ci = null;
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
                PeopleRequirement::create(['people_experience_id' => $request->people_experience_id, 'type'=>'guardia', 'image_ci' => $image_ci, 'image_ap' => $image_ap,
                                        'image_lsm' => $image_lsm, 'image_fcc' => $image_fcc, 't_dia' => $d, 't_noche' => $n, 'estatura' => $request->estatura, 'peso'=>$request->peso]);
        
            }

            // return 1;
            DB::commit();
            return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);
            
        } catch (\Throwable $th) {
            DB::rollBack();
            // return 0;
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
            else
            {
                $image_ci = null;
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

                $file = $request->file('image_ap');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "trabajadores/jardinero/antecedente_penales/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_ap = $dir.'/'.$newFileName;
                }


                $ok = PeopleRequirement::create(['people_experience_id' => $request->people_experience_id, 'type'=>'jardinero', 'image_ci' => $image_ci, 'image_ap' => $image_ap]);
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
            // return 0;
            return redirect()->route('work-experience.requirement-create',['id'=>$request->people_experience_id, 'rubro_id'=>$request->rubro_id])->with(['message' => 'Ocurrió un error al guardar el registro.', 'alert-type' => 'error']);
        }
    }



}
