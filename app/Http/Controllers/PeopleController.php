<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\People;
use App\Models\RubroPeople;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\TypeModel;
use App\Models\Department;
use App\Models\PeopleExperience;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;
class PeopleController extends Controller
{
    public function index()
    {
        $people = People::where('status',1)->where('deleted_at', null)->get();
        // return 1;
        return view('people.browse', compact('people'));
    }
    
    public function create()
    {
        // retur
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
                'sex' => $request->sex,
                'image' => $file? $image_ap: null
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
                    'sex' => $request->sex,
                    'facebook' => $request->facebook,
                    'instagram' => $request->instagram,
                    'tiktok' => $request->tiktok
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



    //para que el administrador pueda ver los datos de una persona

    public function read($id)
    {
        $people = People::find($id);
        $city = City::with('department')->where('id', $people->city_id)->first();
        $department= Department::where('status', 1)->get();
        $cities = City::with('department')->get();
        $model = TypeModel::all();
        
        $rubro = RubroPeople::where('status',1)->where('deleted_at', null)->get();
        $experiences = PeopleExperience::with('rubro_people')->where('people_id',$id)->where('deleted_at', null)->where('status', '!=', 0)->get();
        // return $experiences;
        return view('people.perfil', compact('people','department', 'city', 'cities', 'model', 'experiences', 'rubro'));
    }
}
