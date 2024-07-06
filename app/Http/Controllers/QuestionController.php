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
        $data=$this->extract_data($request);
        Question::create($data);
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
        $data=$this->extract_data($request);
        $question->update($data);
        return to_route('admin.eval.show',$question->evaluation)->with('success','La question a ete mis a jour');
    }

    public function extract_data(QuestionFormRequest $request):array
    {
        $data=$request->validated();
        $opts=$request->validated('options')??[];
        for($i=1;$i<=3;$i++) $data["opt".$i]=null;
        foreach($opts as $key=>$opt){
            $data["opt".$key+1]=$opt;
        }
        return $data;
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
