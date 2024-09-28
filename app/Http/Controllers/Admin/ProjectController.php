<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Functions\Helper;
use App\Http\Requests\ProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //verificare se è presente direction e se è presente ed è impostata su un ordine ascendente,
        //dovrà essere discendente, altrimenti continuerà ad essere ascendente
        if (isset($_GET['direction'])) {
            $direction = $_GET['direction'] === 'asc' ? 'desc' : 'asc';
        } else {
            //in caso contrario direction sarà sempre ascendente
            $direction = 'asc';
        }

        //verificare se column esiste e se la condizione è vera i progetti devono essere ordinati nel modo opposto a
        //come si presentano di default
        if(isset($_GET['column'])){
            $column = $_GET['column'];

            if($column === 'title' || $column === 'id'){
                $projects = Project::orderBy($column, $direction)->paginate(10);
            }elseif($column === 'type_id'){
                $projects = Project::join('types', 'projects.type_id', '=', 'types.id')
                                    ->orderBy($column, $direction)->paginate(10);
            }
        } else {
            //altrimenti i progetti si presenteranno nel modo preimpostato
            $projects = Project::orderBy('id', 'desc')->paginate(10);
        }

        //verificare se la barra di ricerca riceva correttamente l'elemento inserito
        if (isset($_GET['search'])) {
            $search = $_GET['search'];

            //se l'elemento è stato inserito correttamente, confrontarlo con la query
            $projects = Project::where('title', 'LIKE', '%' . $search . '%')
                ->orderBy('id', 'asc')->paginate(10);

            $projects->append(request()->query());
            return view('admin.projects.index', compact('projects', 'direction'));
        }

        return view('admin.projects.index', compact('projects', 'direction'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();

        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Helper::generateSlug($data['title'], Project::class);

        //verificare se nei data sia presente la chiave img
        if (array_key_exists('img', $data)) {

            //se esiste salvare la chiave nello storage
            $image = Storage::put('uploads', $data['img']);

            $original_name = $request->file('img')->getClientOriginalName();

            $data['img'] = $image;

            $data['original_name_img'] = $original_name;
        }

        $project = Project::create($data);

        //verificare se nei data sia presente la chiave technologies necessaria per selezionare le tecnologie nel checkbox
        if (array_key_exists('technologies', $data)) {

            //se la chiave esiste creare la relazione con attach() tra i progetti e gli id delle tecnologie
            $project->technologies()->attach($data['technologies']);
        }

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::find($id);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::find($id);

        $types = Type::all();

        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, string $id)
    {
        $project = Project::find($id);

        $data = $request->all();

        if ($data['title'] != $project->name) {
            $data['slug'] = Helper::generateSlug($data['title'], Project::class);
        }

        //verificare se nei data sia presente la chiave img
        if (array_key_exists('img', $data)) {
            //se esiste salvare la chiave nello storage
            $image = Storage::put('uploads', $data['img']);
            $original_name = $request->file('img')->getClientOriginalName();
            $data['img'] = $image;
            $data['original_name_img'] = $original_name;
        }

        $project->update($data);

        //se la tecnologia scelta è stata inviata, si aggiornano le relazioni con sync()
        if (array_key_exists('technologies', $data)) {

            $project->technologies()->sync($data['technologies']);
        }else{
            //se non è stata inviata nessuna tecnologia, le relazioni vanno annullate con detach()

            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', compact('project'))->with('edited', 'Il progetto è stato modificato correttamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)

    {
        if($project->img){
            Storage::delete($project->img);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('delete', 'Il progetto è stato eliminato correttamente');
    }
}
