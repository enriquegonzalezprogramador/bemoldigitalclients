<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::get();

        $employees->each(function($employees){

            $employees->fullname = $employees->first_name . ' ' .$employees->last_name;

        });

        return response()->json([
            'employees' => $employees
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
                $employee = Employee::create([
                    'dni' => $request->dni,
                    'first_name' => $request->first_name,
                    'second_name' => $request->second_name,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'salary' => $request->salary,
                    'start_date' => $request->start_date,
                    'position' => $request->position,
                    'status' => $request->status
                    
                ]);

                return response()->json([
                    'message' => 'Successfully',
                    'id' => $employee->id
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
     * @param  \App\Employee  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return response()->json([
            'employee' => $employee
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        try{

      
            $employee->update([
                'dni' => $request->dni,
                'first_name' => $request->first_name,
                'second_name' => $request->second_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'salary' => $request->salary,
                'start_date' => $request->start_date,
                'position' => $request->position,
                'status' => $request->status
            ]);

            return response()->json([
                'message' => 'Successfully',
                'id' => $employee->id
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
     * @param  \App\Employee  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json([
            'message' => 'Successfully'
        ], 200);
    }
}
