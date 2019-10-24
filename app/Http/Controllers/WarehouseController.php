<?php

namespace App\Http\Controllers;

use App\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::get();

        $warehouses->each(function($warehouses){

            $warehouses->project;
            $warehouses->employee;

        });

        return response()->json([
            'warehouses' => $warehouses
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
                $warehouse = Warehouse::create([
                    'project_id' => $request->project_id,
                    'name' => $request->name,
                    'address' => $request->address,
                    'city' => $request->city,
                    'phone' => $request->phone,
                    'employee_id' => $request->employee_id,
                    
                ]);

                return response()->json([
                    'message' => 'Successfully',
                    'id' => $warehouse->id
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
    public function show(Warehouse $warehouse)
    {
        $warehouse->project;
        $warehouse->employee;

        return response()->json([
            'warehouse' => $warehouse
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        try{

      
            $warehouse->update([
                'project_id' => $request->project_id,
                'name' => $request->name,
                'address' => $request->address,
                'city' => $request->city,
                'phone' => $request->phone,
                'employee_id' => $request->employee_id,
            ]);

            return response()->json([
                'message' => 'Successfully',
                'warehouse' => $warehouse
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
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        return response()->json([
            'message' => 'Successfully'
        ], 200);
    }
}
