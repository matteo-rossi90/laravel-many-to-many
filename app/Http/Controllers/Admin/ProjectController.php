<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Functions\Helper;
use App\Http\Requests\ProjectRequest;
use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('id', 'desc')->paginate(10);
        return view('admin.projects.index', compact('projects'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Helper::generateSlug($data['title'], Project::class);

        $new_project = Project::create($data);

        return redirect()->route('admin.projects.show', $new_project);
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

        return view('admin.projects.edit', compact('project', 'types'));
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

        $project->update($data);

        return redirect()->route('admin.projects.show', compact('project'))->with('edited', 'Il progetto è stato modificato correttamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)

    {
        $projects = Project::find($id);
        $projects->delete();

        return redirect()->route('admin.projects.index')->with('delete', 'Il progetto è stato eliminato correttamente');
    }
}
