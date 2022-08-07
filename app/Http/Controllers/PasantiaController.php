<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PasantiaController extends Controller
{
    public function store(Request $request)
    {
        // return  $request->all();
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
                // return redirect()->back()->with(['message' => 'El CI ya existe.', 'alert-type' => 'error']);
                // return redirect()->back()->with('error', 'El CI ya existe');
                // return redirect()->route('people.create')->with(['message' => 'El CI ya existe.', 'alert-type' => 'error']);
                return redirect()->route('people.create')->with(['message' => 'El CI ya existe.', 'alert-type' => 'error']);
            }

            $ok = User::where('email', $request->email)->first();
            if($ok)
            {
                return redirect()->back()->with(['message' => 'El email ya existe.', 'alert-type' => 'error']);
            }

            $password = $request->password;
            $user = User::create([
                        'name' => $request->first_name,
                        'email' => $request->email,
                        'role_id' => 4,
                        'password' =>bcrypt($request->password)
                    ]);

            // $user->update(['role_id' => 1]);

            $file = $request->file('image');
            if($file)
            {  
                $nombre_origen = $file->getClientOriginalName();
                        
                $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                        
                $dir = "people/perfil/".date('F').date('Y');
                        
                Storage::makeDirectory($dir);
                Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));
                $image_ap = $dir.'/'.$newFileName;
            }   

        
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
                'sex' => $request->sex
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
            // return 0;
            return redirect()->back()->with(['message' => 'Contactese Con Los Administradores.', 'alert-type' => 'error']);
        }
    }

}
