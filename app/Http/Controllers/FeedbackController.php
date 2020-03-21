<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedback = Feedback::with('user')->latest()->paginate(10);
        return view('feedback.index', compact('feedback'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        if ($user->is_admin) {
            return abort(403);
        }

        return view('feedback.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->is_admin) {
            return abort(403);
        }

        request()->validate([
            'content' => 'required',
            'attachment' => 'nullable|file',
        ]);

        $feedback = Feedback::create([
            'user_id' => auth()->user()->id,
            'posted_at' => date('Y-m-d'),
            'content' => request('content'),
        ]);

        $file = request('attachment');
        if ($file) {
            $dir = 'uploads';
            $fileName = time() . '-' . str_random(8) . '.' . $file->extension();
            $file->move($dir, $fileName);
            $filepath = $dir . '/' . $fileName;

            $feedback->attachment = $filepath;
            $feedback->save();
        }

        session()->flash('successMessage', 'Data saved');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        $feedback->load('user', 'responses');
        return view('feedback.show', compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
