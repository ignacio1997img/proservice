<?php

namespace App\Http\Controllers;

use App\Models\Busine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RubroBusine;
use App\Models\RubroPeople;
use App\Models\Busines;
use App\Models\People;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


use App\Models\MessagePeople;
use App\Models\MessageBusines;

class AjaxController extends Controller
{
    public function getNotifications()
    {
        $user = Auth::user();
        $notifications = [];
        if($user->role_id == 4)
        {
            $people = people::where('user_id', $user->id)->first();
            return DB::table('message_people as m')
                    ->join('rubro_busines as r', 'm.rubro_busine_id', 'r.id')
                    ->where('m.people_id', $people->id)
                    ->where('m.status','!=', 0)
                    ->where('m.view', null)
                    ->select('r.name')
                    ->get();


            // return MessagePeople::where('people_id', $people->id)->where('view', null)->count();
        }
        if($user->role_id == 3)
        {
            $busines = Busine::where('user_id', $user->id)->first();
            return DB::table('message_busines as m')
                    // ->join('rubro_busines as r', 'm.rubro_busines_id', 'r.id')
                    ->join('beneficiaries as b', 'm.beneficiary_id', 'b.id')
                    ->where('m.busine_id', $busines->id)
                    ->where('m.status','!=', 0)
                    ->where('m.view', null)
                    ->select('b.name')
                    ->get();
        }
    }
}
