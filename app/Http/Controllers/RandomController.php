<?php

namespace App\Http\Controllers;

use App\Models\Random;
use Illuminate\Http\Request;
use App\Models\Breakdown;
use Illuminate\Support\Facades\DB;

class RandomController extends Controller
{
    
    public function store(Request $request)
    {
        $flag = Random::all()->last();

        if($flag == null){
            $newFlag = 0;
        }
        else{
            $newFlag = $flag->flag;
        }
        foreach($request['id'] as $id)
        {
            
            $values = new Random;
            $values->values = $id;
            $values->flag = $newFlag + 1;
            $values->save();

        }
        return response()->json("success");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Random  $random
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $showRandoms = [];
        $randoms = Random::all();
        $flag = Random::all()->last();

        foreach($randoms as $r){
            if($r->flag == $flag->flag){
                
                array_push($showRandoms, $r->values);

                $breakdowns = DB::table('breakdowns')->where('random_id', '=', $r->id)->get('name');
                foreach($breakdowns as $b){
                    array_push($showRandoms, $b->name);
                }
            }
        }

        return response()->json($showRandoms);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Random  $random
     * @return \Illuminate\Http\Response
     */
    
}