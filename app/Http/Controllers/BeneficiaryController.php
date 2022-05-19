<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Beneficiary;
use Illuminate\Support\Str;

class BeneficiaryController extends Controller
{
    
    public function create()
    {
        return view('beneficiary.add-beneficiary');
    }

    public function add_people()
    {
        $data = User::where('id',1)->select('email')->first();
        $data->password = 'password';
        return $data;
    }
    public function store(Request $request)
    {
        // return $request;

        // dd($request);

        DB::beginTransaction();
        try {
            $password = $request->password;
            $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'role_id' => 5,
                        'password' =>bcrypt($request->password)
                    ]);
// return 1;
            $file = $request->file('image');
            if($file)
            {
                $nombre_origen = $file->getClientOriginalName();
                $newFileName = Str::random(20).time().'.'.$file->getClientOriginalExtension();
                $dir = "beneficiary/perfil/".date('F').date('Y');
                        
                Storage::makeDirectory($dir);
                Storage::disk('public')->put($dir.'/'.$newFileName, file_get_contents($file));
                $image_ap = $dir.'/'.$newFileName;
            }  

        
            $people = Beneficiary::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'responsible' => $request->responsible,
                'email' => $request->email,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
                'address' => $request->address,
                'website' => $request->website,
                'image' => $file? $image_ap: null,
            ]);

            // return 1;

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
            return 0;
        }
    }

    public function perfilView()
    {
        // return 1;
        $beneficiary = Beneficiary::where('user_id', Auth::user()->id)->first();
        return view('beneficiary.perfil', compact('beneficiary'));
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            // return $request;
            $beneficiary = Beneficiary::find($request->id);
            $beneficiary->update([
                'name' => $request->name,
                'responsible' => $request->responsible,
                'email' => $request->email,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
                'address' => $request->address
                // 'website' => $request->website,
            ]);
            DB::commit();
            return redirect()->route('beneficiary.perfil-view')->with(['message' => 'Perfil Actualizado exitosamente.', 'alert-type' => 'success']);

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('beneficiary.perfil-view')->with(['message' => 'Error al actualizar el perfil.', 'alert-type' => 'error']);
        }

    }


}
