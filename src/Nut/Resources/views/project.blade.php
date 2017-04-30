<h1>{project.name}</h1>

<h3> A total of {tasks.undone} tasks. It's time to fix!</h3>

<div class='tasks'>
	{#tasks.list}

		<div class='tasks-container toggle' data-status='1' data-container='tasks'>
			<div data-panel='1'>

				<div class='fluid task fluid-vcenter' data-id='{id}'>
					<div class='task-check task-done' data-id='{id}' data-priority='{priority}'>

					</div>
					<div data-open='2' class='noselect tasks-element fluid'>
						<span class='tasks-title fill'>{title}</span>
					</div>
				</div>

			</div>

			<div data-panel='2'>
                <div data-container-form class='tasks-edit container-actions'>
                    <input type='hidden' name='id' value='{id}'>
                    <div class='nav-element editing fluid fluid-vcenter'>
                        <input type='text' class='form-control' name='title' value='{title}' autocomplete='off'>
                    </div>
                    <br>
                    <div class='fluid fluid-vcenter bar-actions'>
                    
                        <button data-open='1' type='submit' class='btn btn-primary task-edit'>Save changes</button>
                        <span data-open='1' class='link'>Cancel</span>
                        <div class='fill'></div>
                        <span class='tasks-actions-icon'><i class='fa fa-clock-o'></i></span>
			        	<span 
			        		class='tasks-actions-icon task-priority-icon'
			        		title="Choose task priority"
			        		data-priority='{priority}'
			        		data-popover
			        		data-html="true"
			        		data-placement="bottom"
			        		data-content="
			        			<div class='fluid'>
				        			<div data-container-form>
				        				<input type='hidden' name='id' value='{id}'>
				        				<input type='hidden' name='priority' value='0'>
					        			<button type='submit' class='btn-reset tasks-actions-icon task-priority-icon {#priority_0}selected{/priority_0} task-edit' data-priority='0'>
					        				<i class='fa fa-flag'></i>
					        			</button>
					        		</div>
				        			<div data-container-form>
				        				<input type='hidden' name='id' value='{id}'>
				        				<input type='hidden' name='priority' value='1'>
					        			<button type='submit' class='btn-reset tasks-actions-icon task-priority-icon {#priority_1}selected{/priority_1} task-edit' data-priority='1'>
					        				<i class='fa fa-flag'></i>
					        			</button>
					        		</div>
				        			<div data-container-form>
				        				<input type='hidden' name='id' value='{id}'>
				        				<input type='hidden' name='priority' value='2'>
					        			<button type='submit' class='btn-reset tasks-actions-icon task-priority-icon {#priority_2}selected{/priority_2} task-edit' data-priority='2'>
					        				<i class='fa fa-flag'></i>
					        			</button>
					        		</div>
				        			<div data-container-form>
				        				<input type='hidden' name='id' value='{id}'>
				        				<input type='hidden' name='priority' value='3'>
					        			<button type='submit' class='btn-reset tasks-actions-icon task-priority-icon {#priority_3}selected{/priority_3} task-edit' data-priority='3'>
					        				<i class='fa fa-flag'></i>
					        			</button>
					        		</div>
			        			</div>
			        		"
			        	>
			        		<i class='fa fa-flag' ></i>
			        	</span>
                   		<span class='tasks-actions-icon'><i class='fa fa-ellipsis-h'></i></span>
                    </div>

                </div>
			</div>
		</div>
	{/tasks.list}
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