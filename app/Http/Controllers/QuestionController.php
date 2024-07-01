<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionFormRequest;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
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
    public function store(QuestionFormRequest $request)
    {
        $data=$request->validated();
        $question=new Question($data);
        if(! $question->is_valid()) {
            return back()->withErrors(["opts"=>'Au moins deux options pour les questions de type QCM']);
        }
        // dd($question);
        $question->save();
        return back()->with('success','La question a ete ajouter');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        return view('admin.eval.edit',['question'=>$question]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionFormRequest $request, Question $question)
    {
        $data=$request->validated();
        $test=new Question($data);
        if(! $test->is_valid()) {
            return back()->withErrors(["opts"=>'Au moins deux options pour les questions de type QCM']);
        }
        $question->update($data);
        return to_route('admin.eval.show',$question->evaluation)->with('success','La question a ete mis a jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        
        $question=Question::findOrFail($request->validate(['question'=>'required|exists:questions,id']))->first();
        $question->delete();
        return back()->with('success','la question a ete supprimer');
    }
}
