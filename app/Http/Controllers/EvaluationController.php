<?php

namespace App\Http\Controllers;

use App\Http\Requests\EvalFormRequest;
use App\Models\Evaluation;
use App\Models\Matiere;
use App\Models\Note;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Matiere $matiere)
    {
        $matiere->load('evaluations.questions');
        return view('frontend.eval.index', ['matiere'=> $matiere]);
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
        $eval->load('questions');
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

    public function submit(Request $request, Evaluation $eval){
        $eval->load('questions');
        $reponses=$request->input('question',[]);
        $note=0;
        foreach($reponses as $question_id=>$reponse){
           if($eval->questions->find($question_id)?->reponse===$reponse) $note++;
        }
        $eleve=$request->user()->eleve->load('notes');
        Note::create([
            'eleve_id'=>$eleve->id,
            'evaluation_id'=>$eval->id,
            'note'=>$note
        ]);
        return view('frontend.eval.details',['reponses'=>$reponses,'eval'=>$eval,'note'=>$note]);

    }
    
    public function solution(Request $request ,Evaluation $eval)
    {
        $eval->load('questions');
        return view('frontend.eval.form',['eval'=>$eval]);
    }
}
