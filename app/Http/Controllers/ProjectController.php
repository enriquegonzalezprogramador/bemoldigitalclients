<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::get();

        $projects->each(function($projects){

            $projects->employee;

        });

        return response()->json([
            'projects' => $projects
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
                $project = Project::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'address' => $request->address,
                    'ubication' => $request->ubication,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'start_date' => $request->start_date,
                    'employee_id' => $request->employee_id,
                    'status' => $request->status
                    
                ]);

                return response()->json([
                    'message' => 'Successfully',
                    'id' => $project->id
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
    public function show(Project $project)
    {
        $project->employee;

        return response()->json([
            'project' => $project
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        try{

      
            $project->update([
                'name' => $request->name,
                'description' => $request->description,
                'address' => $request->address,
                'ubication' => $request->ubication,
                'phone' => $request->phone,
                'email' => $request->email,
                'start_date' => $request->start_date,
                'employee_id' => $request->employee_id,
                'status' => $request->status
            ]);

            return response()->json([
                'message' => 'Successfully',
                'project' => $project
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
    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json([
            'message' => 'Successfully'
        ], 200);
    }
}
