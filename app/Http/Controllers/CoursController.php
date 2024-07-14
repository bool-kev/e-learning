<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Faculte;
use App\Models\Fichier;
use App\Models\Matiere;
use App\Models\Chapitre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CoursFormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

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
     * Display a listing of the resource.
     */
    public function rootListing(Request $request)
    {
        $matiere=$request->user()->eleve->niveau->test->first()->load('chapitres');
        $chapitre=$matiere->chapitres->first();
        return redirect()->route('user.cours.list',['matiere'=>$matiere,'chapitre'=>$chapitre]);
    }

    public function listing(Request $request,Matiere $matiere,Chapitre $chapitre)
    {
        if($matiere->id!==$chapitre->matiere->id) throw new NotFoundResourceException('cours non trouve',404);
        $chapitre->load(['matiere.faculte','cours']);
        return view('frontend.cours.index',['chapitre'=>$chapitre]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Chapitre $chapitre)
    {
        $chapitre->load('matiere');
        return view("admin.cours.form2",['chapitre'=>$chapitre,'cours'=>new Cours(),'matiere'=>$chapitre->matiere]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CoursFormRequest $request,Chapitre $chapitre)
    {
        $data=$this->extractData($request);
        $data['chapitre_id']=$chapitre->id;
        $data['user_id']=Auth::user()->id;
        if(Cours::where('titre',$data['titre'])->where('chapitre_id',$chapitre->id)->exists()) return back()->withErrors('titre','le titre du cours doit unique dans le meme chapitre');
        $cours=Cours::create($data);
        if($data['files']??false) $this->storeFiles($data['files'],$cours);
        return back()->with('success','cours ajoute avec success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,Cours $cours)
    {
        $cours->load('files','commentaires.reponses','chapitre');
        return view('frontend.cours.show',['cours'=>$cours]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cours $cours)
    {
        $cours->load('chapitre.matiere');
        return view("admin.cours.form2",['cours'=>$cours,'matiere'=>$cours->chapitre->matiere]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CoursFormRequest $request, Cours $cours)
    {
        $data=$this->extractData($request);
        if(Cours::where('titre',$data['titre'])->where('id','!=',$cours->id)->where('chapitre_id',$cours->chapitre->id)->exists()) return back()->withErrors('titre','le titre du chapitre doit unique dans la matiere');
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
            <div id="cover2"></div>
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
            <div id="cover2"></div>
        PHP;
    }
}
