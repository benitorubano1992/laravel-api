<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Tecnology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $tecnologies = Tecnology::all();
        return view('admin.projects.create', compact('types', 'tecnologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {

        $form_data = $request->validated();

        $form_data['slug'] = Project::generateSlug($form_data['title']);;
        if ($request->hasFile('cover_image')) {
            $path = Storage::put('projects-images', $request->cover_image);
            $form_data['cover_image'] = $path;
        }
        $project = Project::create($form_data);
        if ($request->has('tecnologies')) {
            $project->tecnologies()->attach($request->tecnologies);
        }
        return redirect()->route('admin.projects.index')->with('message', "il progetto $project->title è stato aggiunto correttamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $tecnologies = $project->tecnologies;
        return view('admin.projects.show', compact('project', 'tecnologies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $tecnologies = Tecnology::all();
        return view('admin.projects.edit', compact('project', 'types', 'tecnologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        $form_data = $request->validated();

        $form_data['slug'] = Project::generateSlug($form_data['title']);
        if ($request->hasFile('cover_image')) {
            //cancellare immafine precedente
            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }
            $path = Storage::put('project-image', $request->cover_image);
            $form_data['cover_image'] = $path;
        }
        $project->update($form_data);
        if ($request->has('tags')) {
            $project->tecnologies()->sync($request->tecnologies);
        } else {
            $project->tecnologies()->sync($request->tecnologies);
        }
        return redirect()->route('admin.projects.index')->with('message', "il progettp con  titolo $project->title è stato aggiornato correttamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $titolo = $project->title;
        $project->tecnologies()->detach();
        $project->delete();

        return redirect()->route('admin.projects.index')->with('message', "il progetto $titolo è stato eliminato");
    }
}
