<h1>{project.name}</h1>

<h3> A total of {tasks.pagination.total} tasks. It's time to fix!</h3>

<div class='tasks'>
	{#tasks.resources}
		<div class='fluid task fluid-vcenter' data-id='{id}'>
			<div class='task-check' data-priority='{priority}'>

			</div>
			<div>
				{title}
			</div>
		</div>
	{/tasks.resources}
	<br>
	<div class='fluid toggle tasks-add-container fluid-cleft' data-status='1'>
		<div data-panel='1'>
	        <span data-open='2' class='action'><i class='fa fa-plus'></i>Add task</span>
	    </div>
	    <div class='fluid' data-panel='2'>
	        <form method='POST' class='tasks-add'>
	            <div class='fluid'>
	                <input type='text' class='form-control' name='name'>
	            </div>
	            <div class='fluid fluid-vcenter bar-actions'>
	                <button data-open='1' type='submit' class='btn btn-primary'>Add task</button>
	                <span data-open='1' class='link'>Cancel</span>
	            </div>
	        </form>
	    </div>
	</div>
</div>