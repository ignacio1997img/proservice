<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;
use App\Models\User;

class AjaxQueryController extends Controller
{
    public function ajaxCi($data)
    {
        $ok = People::where('ci', $data)->where('deleted_at', null)->first();
        if($ok)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function ajaxEmail($data)
    {
        $ok = User::where('email', $data)->first();
        if($ok)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
}
