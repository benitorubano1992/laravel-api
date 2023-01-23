<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('type_id')) {
            $projects = Project::with(['type', 'tecnologies'])->where('type_id', $request->type_id)->paginate(3);
            return response()->json([
                "success" => true,
                "results" => $projects
            ]);
        } else {
            $projects = Project::with(['type', 'tecnologies'])->paginate(3);
            return response()->json([
                'success' => true,
                'results' => $projects

            ]);
        };
    }
    public function show($slug)
    {
        $project = Project::with(['type', 'tecnologies'])->where('slug', $slug)->first();
        if ($project) {
            return response()->json([
                "success" => true,
                "results" => $project
            ]);
        } else {
            return response()->json([
                "success" => false,
                "error" => "There isn't a project with that slug"
            ]);
        }
    }
}
