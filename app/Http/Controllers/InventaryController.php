<?php

namespace App\Http\Controllers;
use App\Inventary;
use Illuminate\Http\Request;

class InventaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventarys = Inventary::get();

        $inventarys->each(function($inventarys){

            $inventarys->warehouse;
            $inventarys->total = $inventarys->total($inventarys->quantity, $inventarys->price);

        });

        return response()->json([
            'inventarys' => $inventarys
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
                $inventary = Inventary::create([
                    'warehouse_id' => $request->warehouse_id,
                    'description' => $request->description,
                    'provider' => $request->provider,
                    'category' => $request->category,
                    'quantity' => $request->quantity,
                    'price' => $request->price,
                    'observation' => $request->observation
                    
                ]);

                return response()->json([
                    'message' => 'Successfully',
                    'id' => $inventary->id
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
    public function show(Inventary $inventary)
    {
        $inventary->warehouse;

        return response()->json([
            'inventary' => $inventary
        ], 200);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventary $inventary)
    {
        try{

      
            $inventary->update([
                'warehouse_id' => $request->warehouse_id,
                'description' => $request->description,
                'provider' => $request->provider,
                'category' => $request->category,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'observation' => $request->observation
            ]);

            return response()->json([
                'message' => 'Successfully',
                'inventary' => $inventary
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
    public function destroy(Inventary $inventary)
    {
        $inventary->delete();

        return response()->json([
            'message' => 'Successfully'
        ], 200);
    }
}
