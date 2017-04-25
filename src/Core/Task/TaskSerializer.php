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
			'expires_at' => $task->expires_at ? $task->expires_at->format('Y-m-d') : null,
			'expired' => $task->isExpired(),
			'done' => $task->done,
			'done_at' =>  $task->done_at ? $task->done_at->format('Y-m-d H:i:s') : null,
		];
	}
}