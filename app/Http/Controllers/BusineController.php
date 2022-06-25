<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Busine;
use App\Models\BusineRequirement;
use Illuminate\Support\Str;
use App\Models\RubroBusine;

class BusineController extends Controller
{
    public function index()
    {
        $busines = Busine::with('rubrobusines')->where('deleted_at', null)->where('status', '!=', 0)->get();
        return view('busine.browse', compact('busines'));
    }
    
    public function create()
    {
        $rubros = RubroBusine::all();
        return view('busine.add-busine', compact('rubros'));
    }

    public function store(Request $request)
    {
      
        DB::beginTransaction();
        try {
            $password = $request->password;
            $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'role_id' => 3,
                        'password' =>bcrypt($request->password)
                    ]);

            $file = $request->file('image');
            if($file)
            {
                $nombre_origen = $file->getClientOriginalName();
                        
                $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                                
                $dir = "busine/perfil/".date('F').date('Y');
                                
                Storage::makeDirectory($dir);
                Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));
            }
            // return  $request;
            $busine = Busine::create([
                'nit' => $request->nit,
                'name' => $request->name,
                'responsible' => $request->responsible,
                'address' => $request->address,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
                'email' => $request->email,
                'image' => $file? $newFileName: null,
                'user_id' => $user->id,
                'rubro_id' => $request->rubro_id,
                'description' => $request->description,
                'city_id' => $request->city_id

            ]);
            // return $request;
            DB::commit();

        
            $request->merge(['email'=> $user->email, 'password'=> $password]);
         

            $ok = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
     
    
            if (Auth::attempt($ok)) {
   
                $request->session()->regenerate();
                return redirect('admin');
            }

            
            // return $request->all();
            // DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return 0;
        }
    }

    public function show($id)
    {
        // return $id;
        $busine = Busine::with('rubrobusines')->where('id',$id)->first();
        // return $busine;
        $businerequirements = BusineRequirement::where('busine_id',$id)->first();
        return view('busine.read-busine', compact('busine', 'businerequirements'));
    }

    public function aprobarBusine(Request $request)
    {
        DB::beginTransaction();
        try {
            $busine = Busine::find($request->id);
            $busine->update(['status' => 1]);
            DB::commit();
            return redirect()->route('busines.index')->with(['message' => 'Empresa Verificada Exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('busines.index')->with(['message' => 'Ocurrió un error al verificar la empresa.', 'alert-type' => 'error']);
        }
    }

    public function perfilView()
    {
        // return 1;
        $busine = Busine::with('rubrobusines')->where('user_id', Auth::user()->id)->first();
        // return $busine;
        $businerequirements = BusineRequirement::where('busine_id',$busine->id)->where('deleted_at', null)->first();
        // return $businerequirements;
        return view('busine.perfil', compact('busine', 'businerequirements'));
    }

    public function perfilUpdate(Request $request)
    {
        DB::beginTransaction();
        try {
            // return $request->all();
            $busine = Busine::find($request->id);
            $busine->update(['nit' => $request->nit, 'name' => $request->name, 'responsible' => $request->responsible, 'address' => $request->address,
                            'phone1' => $request->phone1, 'phone2' => $request->phone2, 'email' => $request->email, 'description' => $request->description,
                            'website' => $request->website
                        ]);
            DB::commit();
            return redirect()->route('busines.perfil-view')->with(['message' => 'Perfil Actualizado Exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('busines.perfil-view')->with(['message' => 'Ocurrió un error al actualizar el perfil.', 'alert-type' => 'error']);
        }
    }
    ////// PARA LOS REQUISITOS DE LA EMPRESA

    public function requirementJardineriaStore(Request $request)
    {
        // return $request->all();
        DB::beginTransaction();
        try {
            $ok = BusineRequirement::where('busine_id', $request->busine_id)->where('deleted_at', null)->first();
      

            if($ok)
            {
                $image_lf = null;
                $image_roe = null;                

                $file = $request->file('image_lf');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "empresa/jadineria/licencia_funcionamiento/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_lf = $dir.'/'.$newFileName;
                    $ok->update(['image_lf' => $image_lf]);
                }


                $file = $request->file('image_roe');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "empresa/jadineria/roe/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_roe = $dir.'/'.$newFileName;
                    $ok->update(['image_roe' => $image_roe]);
                }


            }
            else
            {
                $image_lf = null;
                $image_roe = null;

                $file = $request->file('image_lf');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "empresa/jadineria/licencia_funcionamiento/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_lf = $dir.'/'.$newFileName;
                }

                $file = $request->file('image_roe');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "empresa/jadineria/roe".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_roe = $dir.'/'.$newFileName;
                }

                BusineRequirement::create(['type' => 'jardineria', 'busine_id' => $request->busine_id, 'image_lf' => $image_lf, 'image_roe' => $image_roe]);
                                    
            }            
            DB::commit();
            return redirect()->route('busines.perfil-view')->with(['message' => 'Perfil Actualizado Exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('busines.perfil-view')->with(['message' => 'Ocurrió un error al actualizar el perfil.', 'alert-type' => 'error']);
        }
    }

    public function requirementGuardiaStore(Request $request)
    {
        // return $request->all();
        DB::beginTransaction();
        try {
            $ok = BusineRequirement::where('busine_id', $request->busine_id)->where('deleted_at', null)->first();
            $image_lf = null;
            $image_roe = null;         
            $image_pd = null;   

            if($ok)
            {              
                $file = $request->file('image_lf');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "empresa/guardia/licencia_funcionamiento/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_lf = $dir.'/'.$newFileName;
                    $ok->update(['image_lf' => $image_lf]);
                }


                $file = $request->file('image_roe');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "empresa/guardia/roe/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_roe = $dir.'/'.$newFileName;
                    $ok->update(['image_roe' => $image_roe]);
                }

                $file = $request->file('image_pd');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "empresa/guardia/permiso_denacev/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_roe = $dir.'/'.$newFileName;
                    $ok->update(['image_pd' => $image_pd]);
                }


            }
            else
            {
                $file = $request->file('image_lf');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "empresa/jadineria/licencia_funcionamiento/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_lf = $dir.'/'.$newFileName;
                }

                $file = $request->file('image_roe');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "empresa/jadineria/roe".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_roe = $dir.'/'.$newFileName;
                }

                $file = $request->file('image_pd');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "empresa/guardia/permiso_denacev".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_pd = $dir.'/'.$newFileName;
                }

                BusineRequirement::create(['type' => 'guardia', 'busine_id' => $request->busine_id, 'image_lf' => $image_lf, 'image_roe' => $image_roe, 'image_pd' => $image_pd]);
                                    
            }            
            DB::commit();
            return redirect()->route('busines.perfil-view')->with(['message' => 'Perfil Actualizado Exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('busines.perfil-view')->with(['message' => 'Ocurrió un error al actualizar el perfil.', 'alert-type' => 'error']);
        }
    }


    public function requirementPiscinaStore(Request $request)
    {
        // return $request->all();
        DB::beginTransaction();
        try {
            $ok = BusineRequirement::where('busine_id', $request->busine_id)->where('deleted_at', null)->first();
      

            if($ok)
            {
                $image_lf = null;
                $image_roe = null;                

                $file = $request->file('image_lf');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "empresa/piscina/licencia_funcionamiento/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_lf = $dir.'/'.$newFileName;
                    $ok->update(['image_lf' => $image_lf]);
                }


                $file = $request->file('image_roe');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "empresa/piscina/roe/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_roe = $dir.'/'.$newFileName;
                    $ok->update(['image_roe' => $image_roe]);
                }


            }
            else
            {
                $image_lf = null;
                $image_roe = null;

                $file = $request->file('image_lf');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "empresa/piscina/licencia_funcionamiento/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_lf = $dir.'/'.$newFileName;
                }

                $file = $request->file('image_roe');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "empresa/piscina/roe".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_roe = $dir.'/'.$newFileName;
                }

                BusineRequirement::create(['type' => 'piscina', 'busine_id' => $request->busine_id, 'image_lf' => $image_lf, 'image_roe' => $image_roe]);
                                    
            }            
            DB::commit();
            return redirect()->route('busines.perfil-view')->with(['message' => 'Perfil Actualizado Exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('busines.perfil-view')->with(['message' => 'Ocurrió un error al actualizar el perfil.', 'alert-type' => 'error']);
        }
    }

    public function requirementModeloStore(Request $request)
    {
        // return $request->all();
        DB::beginTransaction();
        try {
            $ok = BusineRequirement::where('busine_id', $request->busine_id)->where('deleted_at', null)->first();
      

            if($ok)
            {
                $image_lf = null;
                $image_roe = null;                

                $file = $request->file('image_lf');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "empresa/modelo/licencia_funcionamiento/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_lf = $dir.'/'.$newFileName;
                    $ok->update(['image_lf' => $image_lf]);
                }


                $file = $request->file('image_roe');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "empresa/modelo/roe/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_roe = $dir.'/'.$newFileName;
                    $ok->update(['image_roe' => $image_roe]);
                }


            }
            else
            {
                $image_lf = null;
                $image_roe = null;

                $file = $request->file('image_lf');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "empresa/modelo/licencia_funcionamiento/".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_lf = $dir.'/'.$newFileName;
                }

                $file = $request->file('image_roe');
                if($file)
                {                        
                    $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    $dir = "empresa/modelo/roe".date('F').date('Y');
                            
                    Storage::makeDirectory($dir);
                    Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    $image_roe = $dir.'/'.$newFileName;
                }

                BusineRequirement::create(['type' => 'modelo', 'busine_id' => $request->busine_id, 'image_lf' => $image_lf, 'image_roe' => $image_roe]);
                                    
            }            
            DB::commit();
            return redirect()->route('busines.perfil-view')->with(['message' => 'Perfil Actualizado Exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('busines.perfil-view')->with(['message' => 'Ocurrió un error al actualizar el perfil.', 'alert-type' => 'error']);
        }
    }




    
}
