<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoursFormRequest;
use App\Models\Chapitre;
use App\Models\Cours;
use App\Models\Faculte;
use App\Models\Fichier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CoursController extends Controller
{
    private function extractData(CoursFormRequest $request)
    {
        $data=$request->validated();
        if ($data['content']) $data['content']=str_replace("<p><br></p>","",$data['content']);
        if (!( $request->validated('files') || $data['content'])) {
            session()->flash('error','Le champ content et le champs files ne peuvent pas etre tous les deux vides');
            throw ValidationException::withMessages(['','']);
        }
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
        // dd($slug);
        return view("admin.cours.index", compact('chapitre'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Chapitre $chapitre)
    {
        $chapitre->load('matiere');
        return view("admin.cours.form",['chapitre'=>$chapitre,'cours'=>new Cours(),'matiere'=>$chapitre->matiere]);
        
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
        return back()->with('success','cours ajoute avec success');
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
    public function edit(Cours $cours)
    {
        $cours->load('chapitre.matiere');
        return view("admin.cours.form",['cours'=>$cours,'matiere'=>$cours->chapitre->matiere]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CoursFormRequest $request, Cours $cours)
    {
        $data=$this->extractData($request);
        if($data['cover']??false and $cours->cover) Storage::disk('public')->delete($cours->cover);
        if($data['files']??false) $this->storeFiles($data['files'],$cours);
        $cours->update($data);
        return back()->with('success','Le cours a ete bien mis a jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cours $cours)
    {
        $cours->delete();
        return back()->with('success','cours supprimer avec success');
    }
    public function removeCover(Cours $cours){
        // dd($cours);
        Storage::disk('public')->delete($cours->cover);
        $cours->update(['cover'=>null]);
        return <<<PHP
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert" id="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong >Le cover a ete supprimer avec sucess</strong>
            </div>
            <script>
                setTimeout(() => {
                    document.getElementById('alert')?.remove();
                }, 5000);
                document.getElementById('card')?.remove();
            </script>
        PHP;
    }

    public function removeFile(Fichier $file){
        // dd($cours);
        $file->delete();
        Storage::disk('public')->delete($file->path);
        return <<<PHP
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert" id="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong >Le fichier a ete supprimer avec sucess</strong>
            </div>
            <script>
                setTimeout(() => {
                    document.getElementById('alert')?.remove();
                }, 5000);
                document.getElementById('file-$file->id')?.remove();
            </script>
        PHP;
    }
}
