<?php

namespace App\Http\Controllers;

use App\Models\Chapitre;
use App\Models\Faculte;
use App\Models\Matiere;
use Illuminate\Http\Request;

class ChapitreController extends Controller
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
    public function create(Matiere $matiere)
    {
        return view("admin.chap.form",['matiere'=>$matiere,'chap'=>new Chapitre()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Matiere $matiere)
    {
        $data=$request->validate([
            'titre'=>['string','required','min:2']
        ]);
        $chap=Chapitre::create([
            'titre'=> strtolower($data['titre']),
            'matiere_id'=>$matiere->id
        ]);
        return back()->with('success','le chapitre a ete ajouter');
        return redirect()->route('admin.index')->with('success','la chapitre a ete ajoute');
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
    public function edit(Chapitre $chapitre)
    {
        // dd($chapitre);
        return view("admin.chap.form",['facultes'=>Faculte::all(),'chap'=>$chapitre]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chapitre $chapitre)
    {
        $data=$request->validate([
            'titre'=>['required','min:2','string']
        ]);
        $chapitre->update($data);
        return back()->with('success','chapitre modifier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chapitre $chapitre)
    {
        $data=$chapitre->delete();
        return redirect('/admin');
    }
}
