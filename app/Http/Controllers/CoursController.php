<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoursFormRequest;
use App\Models\Chapitre;
use App\Models\Cours;
use App\Models\Faculte;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $slug,Chapitre $chapitre)
    {
        // $cours=$chapitre->cours;
        // // dd($cours);
        return view("admin.cours.index", compact('chapitre'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Chapitre $chapitre)
    {
        return view("admin.cours.form",['chapitre'=>$chapitre,'cours'=>new Cours()]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CoursFormRequest $request)
    {
        $data=$request->validated();
        if($data['cover']){
            dump($data['cover']);
        }
        // $cours=Cours::create($data);
        if($data['files'][0]){
            dd($data['files']);
        }
        dd('far');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd('show');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
