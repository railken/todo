<?php

namespace Core\Project;

class ProjectSerializer
{
    public function all(Project $project)
    {
        return [
            'id' => $project->id,
            'name' => $project->name,
            'tasks' => $project->tasks->count(),
        ];
    }
}
