<?php

namespace Core\Task;

class TaskSerializer
{	
	/**
	 * Serialize task model
	 *
	 * @return array
	 */
	public function all(Task $task)
	{	
		return [
			'id' => $task->id,
			'title' => $task->title,
			'priority' => $task->priority,
			'expires_at' => $task->expires_at->format('Y-m-d'),
			'expired' => $task->isExpired(),
			'user' => [
				'id' => $task->user->id,
			],
			'project' => [
				'id' => $task->project->id,
			],

		];
	}
}