<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Http\Requests\StoreResumeRequest;
use App\Http\Requests\UpdateResumeRequest;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResumeRequest $request)
    {
        // return response()->json($request->school);
        $resumeValues = [
            'summary' => $request->summary,
            'user_id' => auth()->user()->id,
        ];

        $experience = [
            'job_id' => $request->job_id,
            'duty_id' => $request->duty_id,
            'organisation' => $request->organisation,
            'start' => $request->start,
            'end' => $request->end,
        ];

        $school = [
            'certificate_id' => $request->certificate_id,
            // 'school' => $request->school,
            // 'started' => $request->started,
            // 'finished' => $request->finished,
        ];

        $resume = Resume::create($resumeValues);

        // $resume->skills()->attach($request->skill_id);
        $resume->certificates()->attach($school);

        $referral = [
            'full_name' => $request->full_name,
            'organisation' => $request->organisation,
            'phone' => $request->phone,
            'email' => $request->email,
            'resume_id' => $resume->id
        ];
        
        $resume->jobs()->attach($request->job_id, [
            'duty_id' => $request->duty_id,
            'organisation' => $request->organisation,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        // $resume->referrals()->create($referral);

        return response()->json('Resume Created Successfully', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = auth()->user();
        $resume = Resume::where('user_id', $user->id)->get();
        return response()->json(['resume' => $resume], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resume $resume)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResumeRequest $request, Resume $resume)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resume $resume)
    {
        //
    }
}
