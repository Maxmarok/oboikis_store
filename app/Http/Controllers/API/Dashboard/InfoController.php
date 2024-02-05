<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class InfoController extends Controller
{
    public function getInfo()
    {
        $data = Info::first();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function updateInfo(Request $request)
    {
        $info = $request->info;

        Info::first()->update($info);

        Cache::put('info', Info::first(), 5000);

        return response()->json([
            'success' => true,
        ]);
    }
}
