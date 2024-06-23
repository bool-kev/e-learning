<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoursFormRequest;
use App\Models\Chapitre;
use App\Models\Cours;
use App\Models\Faculte;
use App\Models\Fichier;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class CoursController extends Controller
{
    private function extractData(CoursFormRequest $request)
    {
        $data=$request->validated();
        if($fic=$request->validated('cover')) $data['cover']=$fic->store('Cover_Cours','public');
        return $data;
    }

    private function storeFiles(array $files,Cours $cours)
    {
        foreach($files as $file){
            $path=$file->store('Fichiers_Cours');
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
        dd('store');

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
