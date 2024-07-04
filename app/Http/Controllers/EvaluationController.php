<?php

namespace App\Http\Controllers;

use App\Http\Requests\EvalFormRequest;
use App\Models\Evaluation;
use App\Models\Matiere;
use Illuminate\Http\Request;

class EvaluationController extends Controller
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
    public function create(Request $request,Matiere $matiere)
    {
        // dd($request->matiere);
        return view("admin.eval.form",['matiere'=> $matiere,'eval'=>new Evaluation()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EvalFormRequest $request)
    {
        
        $eval=Evaluation::create($request->validated());
        return to_route('admin.eval.show', $eval);
    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluation $eval)
    {
        // dd($eval->questions);
        return view('admin.eval.show',['eval'=>$eval]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $eval)
    {
        return view("admin.eval.form",['eval'=>$eval->load('matiere')]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EvalFormRequest $request, Evaluation $eval)
    {
        $data= $request->validated();
        $eval->update($data);
        return to_route('admin.eval.show', $eval);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $eval)
    {
        $eval->delete();
        return back()->with('success','l\'evaluation a ete supprimer');
    }
}
