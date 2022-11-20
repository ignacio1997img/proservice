<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Department;
use App\Models\City;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Busine;
use App\Models\BusineRequirement;
use Illuminate\Support\Str;
use App\Models\RubroBusine;
use Illuminate\Support\Facades\Http;

use Intervention\Image\ImageManagerStatic as Image;
use Symfony\Component\HttpFoundation\File\File;

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
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'=>'6LcAThQjAAAAAJRt1vnUdRfRlTqN9N0hQxEal-AM',
            'response'=>$request->input('g-recaptcha-response')
        ])->object();

        if(!$response->success)
        {
            return "Error";
        }
        $message =$request->validate(
        [
                'email' => 'required|email|unique:users',
                'nit' => 'required|unique:busines',
                'name' => 'required|unique:busines',
                'password' => 'required|min:8|max:25'

        ]);

        // $title = $request->old('nit');


      
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
            // return $busine->id;
            BusineRequirement::create(['busine_id'=> $busine->id]);
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
            // return 0;
        }
    }

    public function show($id)
    {
        // return $id;
        $busine = Busine::with('rubrobusines')->where('id',$id)->first();
        $city = City::with('department')->where('id', $busine->city_id)->first();

        // return $busine;
        $businerequirements = BusineRequirement::where('busine_id',$id)->first();
        return view('busine.read-busine', compact('busine', 'city', 'businerequirements'));
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

        $city = City::with('department')->where('id', $busine->city_id)->first();

        $department= Department::where('status', 1)->get();
        $cities = City::where('department_id', $city->department->id)->get();


        // return $busine;
        $businerequirements = BusineRequirement::where('busine_id',$busine->id)->where('deleted_at', null)->first();
        // return $businerequirements;
        return view('busine.perfil', compact('busine', 'city', 'department', 'cities', 'businerequirements'));
    }

    public function perfilUpdate(Request $request)
    {
        DB::beginTransaction();
        try {
            // return $request->all();
            $busine = Busine::find($request->id);
            $busine->update(['nit' => $request->nit, 'name' => $request->name, 'responsible' => $request->responsible, 'address' => $request->address,
                            'phone1' => $request->phone1, 'phone2' => $request->phone2, 'email' => $request->email, 'description' => $request->description,
                            'website' => $request->website, 'city_id'=>$request->city_id
                        ]);
            DB::commit();
            return redirect()->route('busines.perfil-view')->with(['message' => 'Perfil Actualizado Exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('busines.perfil-view')->with(['message' => 'Ocurrió un error al actualizar el perfil.', 'alert-type' => 'error']);
        }
    }




    public function image_PostB($file, $id, $type){
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

    ////// PARA LOS REQUISITOS DE LA EMPRESA
    public function requirementGuardiaStore(Request $request)
    {
        $imageObj = new FileController;        
        DB::beginTransaction();
        try {
            $ok = BusineRequirement::where('busine_id', $request->busine_id)->where('deleted_at', null)->first();
            $ok->update(['type' => 'guardia']);
            
            $file = $request->file('image_nit');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_nit = $imageObj->file($file, $request->busine_id, "empresa/guardia/nit");
                }
                else
                {
                    $image_nit = $imageObj->image($file, $request->busine_id, "empresa/guardia/nit");
                } 
                $ok->update(['image_nit' => $image_nit]);
            }
            
            $file = $request->file('image_lf');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_lf = $imageObj->file($file, $request->busine_id, "empresa/guardia/licencia_funcionamiento");
                }
                else
                {
                    $image_lf = $imageObj->image($file, $request->busine_id, "empresa/guardia/licencia_funcionamiento");
                } 
                $ok->update(['image_lf' => $image_lf]);
            }

            $file = $request->file('image_roe');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_roe = $imageObj->file($file, $request->busine_id, "empresa/guardia/roe");
                }
                else
                {
                    $image_roe = $imageObj->image($file, $request->busine_id, "empresa/guardia/roe");
                } 
                $ok->update(['image_roe' => $image_roe]);
            }
            $file = $request->file('image_pd');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_pd = $imageObj->file($file, $request->busine_id, "empresa/guardia/permiso_denacev");
                }
                else
                {
                    $image_pd = $imageObj->image($file, $request->busine_id, "empresa/guardia/permiso_denacev");
                } 
                $ok->update(['image_pd' => $image_pd]);
            }       
            DB::commit();
            return redirect()->route('busines.perfil-view')->with(['message' => 'Perfil Actualizado Exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('busines.perfil-view')->with(['message' => 'Ocurrió un error al actualizar el perfil.', 'alert-type' => 'error']);
        }
    }

    public function requirementJardineriaStore(Request $request)
    {
        $imageObj = new FileController;        
        DB::beginTransaction();
        try {
            $ok = BusineRequirement::where('busine_id', $request->busine_id)->where('deleted_at', null)->first();
            $ok->update(['type' => 'jardineria']);
            
            $file = $request->file('image_nit');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_nit = $imageObj->file($file, $request->busine_id, "empresa/jadineria/nit");
                }
                else
                {
                    $image_nit = $imageObj->image($file, $request->busine_id, "empresa/jadineria/nit");
                } 
                $ok->update(['image_nit' => $image_nit]);
            }
            
            $file = $request->file('image_lf');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_lf = $imageObj->file($file, $request->busine_id, "empresa/jadineria/licencia_funcionamiento");
                }
                else
                {
                    $image_lf = $imageObj->image($file, $request->busine_id, "empresa/jadineria/licencia_funcionamiento");
                } 
                $ok->update(['image_lf' => $image_lf]);
            }

            $file = $request->file('image_roe');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_roe = $imageObj->file($file, $request->busine_id, "empresa/jadineria/roe");
                }
                else
                {
                    $image_roe = $imageObj->image($file, $request->busine_id, "empresa/jadineria/roe");
                } 
                $ok->update(['image_roe' => $image_roe]);
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
        $imageObj = new FileController;        
        DB::beginTransaction();
        try {
            $ok = BusineRequirement::where('busine_id', $request->busine_id)->where('deleted_at', null)->first();
            $ok->update(['type' => 'piscina']);
            
            $file = $request->file('image_nit');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_nit = $imageObj->file($file, $request->busine_id, "empresa/piscina/nit");
                }
                else
                {
                    $image_nit = $imageObj->image($file, $request->busine_id, "empresa/piscina/nit");
                } 
                $ok->update(['image_nit' => $image_nit]);
            }
            
            $file = $request->file('image_lf');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_lf = $imageObj->file($file, $request->busine_id, "empresa/piscina/licencia_funcionamiento");
                }
                else
                {
                    $image_lf = $imageObj->image($file, $request->busine_id, "empresa/piscina/licencia_funcionamiento");
                } 
                $ok->update(['image_lf' => $image_lf]);
            }

            $file = $request->file('image_roe');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_roe = $imageObj->file($file, $request->busine_id, "empresa/piscina/roe");
                }
                else
                {
                    $image_roe = $imageObj->image($file, $request->busine_id, "empresa/piscina/roe");
                } 
                $ok->update(['image_roe' => $image_roe]);
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
            $busine_id = $request->busine_id;

            if($ok)
            {
                $image_lf = null;
                $image_roe = null;                

                $file = $request->file('image_lf');
                if($file)
                {                        
                    // $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    // $dir = "empresa/modelo/licencia_funcionamiento/".date('F').date('Y');
                            
                    // Storage::makeDirectory($dir);
                    // Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    // $image_lf = $dir.'/'.$newFileName;

                    $image_lf = $this->image_PostB($file, $busine_id, "empresa/modelo/licencia_funcionamiento");
                    
                    $ok->update(['image_lf' => $image_lf]);
                }


                $file = $request->file('image_roe');
                if($file)
                {          
                    // return 11;              
                    // $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    // $dir = "empresa/modelo/roe/".date('F').date('Y');
                            
                    // Storage::makeDirectory($dir);
                    // Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    // $image_roe = $dir.'/'.$newFileName;

                    $image_roe = $this->image_PostB($file, $busine_id, "empresa/modelo/roe");
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
                    // $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    // $dir = "empresa/modelo/licencia_funcionamiento/".date('F').date('Y');
                            
                    // Storage::makeDirectory($dir);
                    // Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    // $image_lf = $dir.'/'.$newFileName;

                    $image_lf = $this->image_PostB($file, $busine_id, "empresa/modelo/licencia_funcionamiento");
                }

                $file = $request->file('image_roe');
                if($file)
                {                        
                    // $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                            
                    // $dir = "empresa/modelo/roe".date('F').date('Y');
                            
                    // Storage::makeDirectory($dir);
                    // Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));                    
                    // $image_roe = $dir.'/'.$newFileName;

                    $image_roe = $this->image_PostB($file, $busine_id, "empresa/modelo/roe");
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



    public function requirementSeguritySystemStore(Request $request)
    {
        $imageObj = new FileController;        
        DB::beginTransaction();
        try {
            $ok = BusineRequirement::where('busine_id', $request->busine_id)->where('deleted_at', null)->first();
            $ok->update(['type' => 'sistemaSeguridad']);
            $busine_id = $request->busine_id;
            // return $ok;
            // dd($request);
            
            $file = $request->file('image_nit');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_nit = $imageObj->file($file, $request->busine_id, "empresa/sistemaSeguridad/nit");
                }
                else
                {
                    $image_nit = $imageObj->image($file, $request->busine_id, "empresa/sistemaSeguridad/nit");
                } 
                $ok->update(['image_nit' => $image_nit]);
            }
            
            $file = $request->file('image_lf');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_lf = $imageObj->file($file, $request->busine_id, "empresa/sistemaSeguridad/licencia_funcionamiento");
                }
                else
                {
                    $image_lf = $imageObj->image($file, $request->busine_id, "empresa/sistemaSeguridad/licencia_funcionamiento");
                } 
                $ok->update(['image_lf' => $image_lf]);
            }

            $file = $request->file('image_roe');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_roe = $imageObj->file($file, $request->busine_id, "empresa/sistemaSeguridad/roe");
                }
                else
                {
                    $image_roe = $imageObj->image($file, $request->busine_id, "empresa/sistemaSeguridad/roe");
                } 
                $ok->update(['image_roe' => $image_roe]);
            }
            $file = $request->file('image_pd');
            if($file)
            {       
                if($file->getClientOriginalExtension()=='pdf')
                {
                    $image_pd = $imageObj->file($file, $request->busine_id, "empresa/sistemaSeguridad/permiso_denacev");
                }
                else
                {
                    $image_pd = $imageObj->image($file, $request->busine_id, "empresa/sistemaSeguridad/permiso_denacev");
                } 
                $ok->update(['image_pd' => $image_pd]);
            }       
            DB::commit();
            return redirect()->route('busines.perfil-view')->with(['message' => 'Perfil Actualizado Exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return 0;
            return redirect()->route('busines.perfil-view')->with(['message' => 'Ocurrió un error al actualizar el perfil.', 'alert-type' => 'error']);
        }
    }



    
}
