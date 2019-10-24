<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InputMaterial;
use App\Inventary;

class InputMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inputmaterials = InputMaterial::get();

        $inputmaterials->each(function($inputmaterials){
            $inputmaterials->project;
            $inputmaterials->warehouse;
            $inputmaterials->inventary;
            $inputmaterials->employee;
            $inputmaterials->total = $inputmaterials->total($inputmaterials->quantity, $inputmaterials->price);

        });

        return response()->json([
            'inputmaterials' => $inputmaterials
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
                $inputmaterial = InputMaterial::create([
                    'project_id' => $request->project_id,
                    'warehouse_id' => $request->warehouse_id,
                    'inventary_id' => $request->inventary_id,
                    'quantity' => $request->quantity,
                    'price' => $request->price,
                    'employee_id' => $request->employee_id,
                    'observation' => $request->observation,
                    'start_date' => $request->start_date,
                    'status' => $request->status,
                    
                ]);

                $inventary = Inventary::find($request->inventary_id);
                $inventary->quantity = $inventary->sumar($inventary->quantity, $request->quantity);
                $inventary->update();

                return response()->json([
                    'message' => 'Successfully',
                    'id' => $inputmaterial->id
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
    public function show(InputMaterial $inputmaterial)
    {
        $inputmaterial->project;
        $inputmaterial->warehouse;
        $inputmaterial->inventary;
        $inputmaterial->employee;

        return response()->json([
            'inputmaterial' => $inputmaterial
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InputMaterial $inputmaterial)
    {
        try{

            $inventary = Inventary::find($request->inventary_id);
            $inputmaterialbefore = InputMaterial::find($inputmaterial->id);
 
            $inputmaterial->update([
                'project_id' => $request->project_id,
                'warehouse_id' => $request->warehouse_id,
                'inventary_id' => $request->inventary_id,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'employee_id' => $request->employee_id,
                'observation' => $request->observation,
                'start_date' => $request->start_date,
                'status' => $request->status,
            ]);

            if ( $inputmaterialbefore->quantity > $request->quantity ) {
                
                $remove_value = $inventary->restar($inputmaterialbefore->quantity, $request->quantity);
                $inventary->quantity = $inventary->restar($inventary->quantity, $remove_value);
                $inventary->update();
            }

            if ( $inputmaterialbefore->quantity < $request->quantity ) {

                $add_value = $inventary->restar( $request->quantity, $inputmaterialbefore->quantity);
                $inventary->quantity = $inventary->sumar($inventary->quantity, $add_value);
                $inventary->update();
            }

            

            return response()->json([
                'message' => 'Successfully',
                'inputmaterial' => $inputmaterial
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
    public function destroy(InputMaterial $inputmaterial)
    {
        $inputmaterial = InputMaterial::find($inputmaterial->id);
        $inventary = Inventary::find($inputmaterial->inventary_id);

        $inventary->quantity = $inventary->restar($inventary->quantity, $inputmaterial->quantity);
        $inventary->update();
        

        $inputmaterial->delete();

        return response()->json([
            'message' => 'Successfully'
        ], 200);
    }
}
