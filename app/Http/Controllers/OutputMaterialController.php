<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OutputMaterial;
use App\InputMaterial;
use App\Inventary;

class OutputMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outputmaterials = OutputMaterial::get();

        $outputmaterials->each(function($outputmaterials){
            $outputmaterials->project;
            $outputmaterials->obre;
            $outputmaterials->warehouse;
            $outputmaterials->inventary;
            $outputmaterials->employee;
            $outputmaterials->total = $outputmaterials->total($outputmaterials->quantity, $outputmaterials->price);

        });

        return response()->json([
            'outputmaterials' => $outputmaterials
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
                $outputmaterial = OutputMaterial::create([
                    'project_id' => $request->project_id,
                    'obre_id' => $request->obre_id,
                    'warehouse_id' => $request->warehouse_id,
                    'inventary_id' => $request->inventary_id,
                    'quantity' => $request->quantity,
                    'price' => $request->price,
                    'employee_id' => $request->employee_id,
                    'observation' => $request->observation,
                    'start_date' => $request->start_date,
                    'status' => $request->status            
                ]);

                $inventary = Inventary::find($request->inventary_id);
                $inventary->quantity = $inventary->restar($inventary->quantity, $request->quantity);
                $inventary->update();

                return response()->json([
                    'message' => 'Successfully',
                    'id' => $outputmaterial->id
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
    public function show(OutputMaterial $outputmaterial)
    {
        $outputmaterial->project;
        $outputmaterial->obre;
        $outputmaterial->warehouse;
        $outputmaterial->inventary;
        $outputmaterial->employee;

        return response()->json([
            'outputmaterial' => $outputmaterial
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OutputMaterial $outputmaterial)
    {
        try{

            $inventary = Inventary::find($request->inventary_id);
            $outputmaterialbefore = OutputMaterial::find($outputmaterial->id);
 
            $outputmaterial->update([
                'project_id' => $request->project_id,
                'obre_id' => $request->obre_id,
                'warehouse_id' => $request->warehouse_id,
                'inventary_id' => $request->inventary_id,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'employee_id' => $request->employee_id,
                'observation' => $request->observation,
                'start_date' => $request->start_date,
                'status' => $request->status
            ]);

            if ( $outputmaterialbefore->quantity > $request->quantity ) {
                
                $add_value = $inventary->restar($outputmaterialbefore->quantity, $request->quantity);
                $inventary->quantity = $inventary->sumar($inventary->quantity, $add_value);
                $inventary->update();
            }

            if ( $outputmaterialbefore->quantity < $request->quantity ) {

                $remove_value = $inventary->restar($request->quantity, $outputmaterialbefore->quantity);
                $inventary->quantity = $inventary->restar($inventary->quantity, $remove_value);
                $inventary->update();
            }

            

            return response()->json([
                'message' => 'Successfully',
                'outputmaterial' => $outputmaterial
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
    public function destroy(OutputMaterial $outputmaterial)
    {
        $outputmaterial = OutputMaterial::find($outputmaterial->id);
        $inventary = Inventary::find($outputmaterial->inventary_id);

        $inventary->quantity = $inventary->sumar($inventary->quantity, $outputmaterial->quantity);
        $inventary->update();
        

        $outputmaterial->delete();

        return response()->json([
            'message' => 'Successfully'
        ], 200);
    }
}
