<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;
# La estructura es darle una uri, luego, cuando visiten esa uri se activara la funcion que queramos
Route::get('/', function () {
    return view('home');
});

# Esto es para retornar un json automaticamente :D
#Route::get('/about', function () {
#   return ['foo' => 'bar', 'hola' => 'mundo'];
#});

// index
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    return view('jobs.index',
        [
            'jobs' => $jobs
        ]
    );
});

//create
Route::get('jobs/create', function () {
    return view('jobs.create');
});

//show a job
Route::get('/jobs/{id}', function ($id){
    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});

// job forms
Route::post('/jobs', function () {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);
    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);
    return redirect('/jobs');
});


// edit a job
Route::get('/jobs/{id}/edit', function ($id){
    $job = Job::find($id);
    return view('jobs.edit', ['job' => $job]);
});

// update a job
Route::patch('/jobs/{id}', function ($id){
    // validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);
    // authorize
    // update
    $job = Job::findOrFail($id);
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);
    // redirect
    return redirect('/jobs/' . $job->id);
});


// delete a job
Route::delete('/jobs/{id}', function ($id){
    Job::findOrFail($id)->delete();
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});

