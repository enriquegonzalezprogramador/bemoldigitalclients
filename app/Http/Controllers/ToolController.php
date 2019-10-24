<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tool;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tools = Tool::get();

        $tools->each(function($tools){

            $tools->warehouse;
            $tools->total = $tools->total($tools->quantity, $tools->price);

        });

        return response()->json([
            'tools' => $tools
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
                $tool = Tool::create([
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
                    'id' => $tool->id
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
    public function show(Tool $tool)
    {
        $tool->warehouse;

        return response()->json([
            'tool' => $tool
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tool $tool)
    {
        try{

      
            $tool->update([
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
                'tool' => $tool
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
    public function destroy(Tool $tool)
    {
        $tool->delete();

        return response()->json([
            'message' => 'Successfully'
        ], 200);
    }
}
