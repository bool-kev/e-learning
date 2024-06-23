<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoursFormRequest;
use App\Models\Chapitre;
use App\Models\Cours;
use App\Models\Faculte;
use App\Models\Fichier;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CoursController extends Controller
{
    private function extractData(CoursFormRequest $request)
    {
        $data=$request->validated();
        if ($data['content']) $data['content']=str_replace("<p><br></p>","",$data['content']);
        if (!( $request->validated('files') || $data['content'])) {
            session()->flash('error','Le champ content et le champs files ne peuvent pas etre tous les deux vides');
            throw ValidationException::withMessages(['content'=>'']);
        }
        dd($data);
        if($fic=$request->validated('cover')) $data['cover']=$fic->store('Cover_Cours','public');
        return $data;
    }

    private function storeFiles(array $files,Cours $cours)
    {
        foreach($files as $file){
            $path=$file->store('Fichiers_Cours','public');
            Fichier::create([
                'path'=>$path,
                'type'=>$file->getMimeType(),
                'cours_id'=>$cours->id
            ]);
        }
    }
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
    public function store(CoursFormRequest $request,Chapitre $chapitre)
    {
        $data=$this->extractData($request);
        $data['chapitre_id']=$chapitre->id;
        $cours=Cours::create($data);
        if($data['files']??false) $this->storeFiles($data['files'],$cours);
        return redirect('/admin');
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
