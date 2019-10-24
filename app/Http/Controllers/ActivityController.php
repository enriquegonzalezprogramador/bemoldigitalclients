<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activitys = Activity::get();

        $activitys->each(function($activitys){

            $activitys->project;
            $activitys->obre;
            $activitys->employee;

        });

        return response()->json([
            'activitys' => $activitys
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
                $activity = Activity::create([
                    'project_id' => $request->project_id,
                    'obre_id' => $request->obre_id,
                    'activity' => $request->activity,
                    'employee_id' => $request->employee_id,
                    'observation' => $request->observation,
                    'start_date' => $request->start_date,
                    'status' => $request->status,
                    
                ]);

                return response()->json([
                    'message' => 'Successfully',
                    'id' => $activity->id
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
    public function show(Activity $activity)
    {
        $activity->project;
        $activity->obre;
        $activity->employee;

        return response()->json([
            'activity' => $activity
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        try{
 
            $activity->update([
                'project_id' => $request->project_id,
                'obre_id' => $request->obre_id,
                'activity' => $request->activity,
                'employee_id' => $request->employee_id,
                'observation' => $request->observation,
                'start_date' => $request->start_date,
                'status' => $request->status,
            ]);

            return response()->json([
                'message' => 'Successfully',
                'activity' => $activity
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
    public function destroy(Activity $activity)
    {
        
        $activity->delete();

        return response()->json([
            'message' => 'Successfully'
        ], 200);
    }
}
