<?php

namespace Core\Project;

use Core\Task\TaskSerializer;

class ProjectSerializer
{
    public function all(Project $project)
    {

        $ts = new TaskSerializer;

        return [
            'id' => $project->id,
            'name' => $project->name,
            'tasks' => [
                'list' => $project->tasks->map(function($task) use ($ts){
                    return $ts->all($task);
                }),
            	'done' => $project->tasks()->where('done', 1)->count(),
            	'undone' => $project->tasks()->where('done', 0)->count(),
            ]
        ];
    }
}
