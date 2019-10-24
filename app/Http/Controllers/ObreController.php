<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Obre;

class ObreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obres = Obre::get();

        $obres->each(function($obres){

            $obres->project;
            $obres->employee;

        });

        return response()->json([
            'obres' => $obres
        ], 200);
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
                $obre = Obre::create([
                    'project_id' => $request->project_id,
                    'name' => $request->name,
                    'description' => $request->description,
                    'address' => $request->address,
                    'ubication' => $request->ubication,
                    'start_date' => $request->start_date,
                    'employee_id' => $request->employee_id,
                    'status' => $request->status
                    
                ]);

                return response()->json([
                    'message' => 'Successfully',
                    'id' => $obre->id
                ], 200);

        }catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Obre $obre)
    {
        $obre->project;
        $obre->employee;

        return response()->json([
            'obre' => $obre
        ], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Obre $obre)
    {
        try{

      
            $obre->update([
                'name' => $request->name,
                'description' => $request->description,
                'address' => $request->address,
                'ubication' => $request->ubication,
                'start_date' => $request->start_date,
                'employee_id' => $request->employee_id,
                'status' => $request->status
            ]);

            return response()->json([
                'message' => 'Successfully',
                'obre' => $obre
            ], 200);


        }catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Obre $obre)
    {
        $obre->delete();

        return response()->json([
            'message' => 'Successfully'
        ], 200);
    }
}
