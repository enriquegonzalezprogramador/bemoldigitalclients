<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequirementMaterial;
use App\InputMaterial;

class RequirementMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requirementmaterials = RequirementMaterial::get();

        $requirementmaterials->each(function($requirementmaterials){
            $requirementmaterials->project;
            $requirementmaterials->warehouse;
            $requirementmaterials->inventary;
            $requirementmaterials->employee;
            $requirementmaterials->total = $requirementmaterials->total($requirementmaterials->deliveried, $requirementmaterials->price);
            $requirementmaterials->notdeliveried = $requirementmaterials->calcularFaltante($requirementmaterials->quantity, $requirementmaterials->deliveried);

        });

        return response()->json([
            'requirementmaterials' => $requirementmaterials
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
                $requirementmaterial = RequirementMaterial::create([
                    'project_id' => $request->project_id,
                    'warehouse_id' => $request->warehouse_id,
                    'inventary_id' => $request->inventary_id,
                    'activity' => $request->activity,
                    'quantity' => $request->quantity,
                    'price' => $request->price,
                    'deliveried' => $request->deliveried,
                    'employee_id' => $request->employee_id,
                    'observation' => $request->observation,
                    'start_date' => $request->start_date,
                    'status' => $request->status,
                    
                ]);

                return response()->json([
                    'message' => 'Successfully',
                    'id' => $requirementmaterial->id
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
    public function show(RequirementMaterial $requirementmaterial)
    {
        $requirementmaterial->project;
        $requirementmaterial->warehouse;
        $requirementmaterial->inventary;
        $requirementmaterial->employee;

        return response()->json([
            'requirementmaterial' => $requirementmaterial
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequirementMaterial $requirementmaterial)
    {
        try{
 
            $requirementmaterial->update([
                'project_id' => $request->project_id,
                'warehouse_id' => $request->warehouse_id,
                'inventary_id' => $request->inventary_id,
                'activity' => $request->activity,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'deliveried' => $request->deliveried,
                'employee_id' => $request->employee_id,
                'observation' => $request->observation,
                'start_date' => $request->start_date,
                'status' => $request->status,
            ]);

            return response()->json([
                'message' => 'Successfully',
                'requirementmaterial' => $requirementmaterial
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
    public function destroy(RequirementMaterial $requirementmaterial)
    {
        
        $requirementmaterial->delete();

        return response()->json([
            'message' => 'Successfully'
        ], 200);
    }
}
