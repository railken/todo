<h1>{project.name}</h1>

<h3> A total of {tasks.pagination.total} tasks. It's time to fix!</h3>

<div class='tasks'>
	{#tasks.resources}

		<div class='toggle' data-status='1' data-container='tasks'>
			<div data-panel='1'>

				<div class='fluid task fluid-vcenter' data-id='{id}'>
					<div class='task-check' data-priority='{priority}'>

					</div>
					<div data-open='2'>
						<span class='tasks-title'>{title}</span>
					</div>
				</div>

			</div>

			<div data-panel='2'>
                <form method='POST' class='tasks-edit container-actions'>
                    <input type='hidden' name='id' value='{id}'>
                    <div class='nav-element editing fluid fluid-vcenter'>
                        <input type='text' class='form-control' name='name' value='{title}' autocomplete='off'>
                    </div>
                    <div class='fluid fluid-vcenter bar-actions'>
                        <button data-open='1' type='submit' class='btn btn-primary'>Save changes</button>
                        <span data-open='1' class='link'>Cancel</span>
                    </div>
                </form>
			</div>
		</div>
	{/tasks.resources}
	<br>
	<div class='fluid toggle tasks-add-container fluid-cleft' data-status='1'>
		<div data-panel='1'>
	        <span data-open='2' class='action'><i class='fa fa-plus'></i>Add task</span>
	    </div>
	    <div class='fluid' data-panel='2'>
	        <form method='POST' class='tasks-add container-actions'>
	        	<input type='hidden' name='project_id' value='{project.id}'>
	            <div class='fluid'>
	                <input type='text' class='form-control' name='name' autocomplete='off'>
	            </div>
	            <div class='fluid fluid-vcenter bar-actions'>
	                <button data-open='1' type='submit' class='btn btn-primary'>Add task</button>
	                <span data-open='1' class='link'>Cancel</span>
	            </div>
	        </form>
	    </div>
	</div>
</div>