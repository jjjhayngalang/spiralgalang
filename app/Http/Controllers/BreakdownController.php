<?php

namespace App\Http\Controllers;

use App\Models\Breakdown;
use App\Models\Random;
use Illuminate\Http\Request;

class BreakdownController extends Controller
{
   
    public function store(Request $request)
    {
        foreach($request['datas'] as $breakdowns)
        {
            $name = new Breakdown(['name' => $breakdowns['values']]);
            $random = Random::where('values', $breakdowns['id'])->firstOrFail();

            //echo $random;
            $random->breakdown()->save($name);

        }
        //return response()->json($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Breakdown  $breakdown
     * @return \Illuminate\Http\Response
     */
   
   
}