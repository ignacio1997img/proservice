<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Validated;
class PeopleController extends Controller
{
    public function index()
    {
        $people = People::where('status',1)->where('deleted_at', null)->get();
        return view('people.browse', compact('people'));
    }
    
    public function create()
    {
        return view('people.add-people');
    }

    public function add_people()
    {
        $data = User::where('id',1)->select('email')->first();
        $data->password = 'password';
        return $data;
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $password = $request->password;
            $user = User::create([
                        'name' => $request->first_name,
                        'email' => $request->email,
                        'role_id' => 4,
                        'password' =>bcrypt($request->password)
                    ]);

            // $user->update(['role_id' => 1]);

            $file = $request->file('image');
 
            $nombre_origen = $file->getClientOriginalName();
                    
            $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                    
            $dir = "people/perfil/".date('F').date('Y');
                    
            Storage::makeDirectory($dir);
            Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));
                    

        
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
                'city' => $request->city,
                'sex' => $request->sex,
                'image' => $dir.'/'.$newFileName,
            ]);


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


        } catch (\Throwable $th) {
            DB::rollback();
       
        }
    }

    public function perfilUpdate(Request $request)
    {
        DB::beginTransaction();
        try {
            // return $request->all();
            $people = People::find($request->id);

            $ok = People::where('ci', $request->ci)->where('id', '!=', $request->id)->first();
            if(!$ok)
            {
                $people->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'birth_date' => $request->birth_date,
                    'email' => $request->email,
                    'phone1' => $request->phone1,
                    'phone2' => $request->phone2,
                    'address' => $request->address,
                    'ci' => $request->ci,
                    'sex' => $request->sex
                ]);
                DB::commit();
                return redirect()->route('people-perfil-experience.index')->with(['message' => 'Perfil Actualizado exitosamente.', 'alert-type' => 'success']);
            }
            else
            {
                return redirect()->route('people-perfil-experience.index')->with(['message' => 'El CI ya existe.', 'alert-type' => 'error']);
            }            

            
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('people-perfil-experience.index')->with(['message' => 'Error al actualizar el perfil.', 'alert-type' => 'error']);
        }
    }
}
