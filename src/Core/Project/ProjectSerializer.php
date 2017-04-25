<?php

namespace Core\Project;

class ProjectSerializer
{
    public function all(Project $project)
    {
        return [
            'id' => $project->id,
            'name' => $project->name,
            'tasks' => [
            	'done' => $project->tasks()->where('done', 1)->count(),
            	'undone' => $project->tasks()->where('done', 0)->count(),
            ]
        ];
    }
}
