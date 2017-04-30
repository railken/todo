<header class='fluid'>
</header>
<section class='fluid container'>

    <nav>
        <ul class='nav-list'>
            <li><i class='fa fa-calendar-o'></i> Today</li>
        </ul>

        <div class='nav-projects'></div>

        <ul class='nav-list'>
        <li class='toggle' data-status='1'>
            <div data-panel='1'>
                <span data-open='2' class='action'><i class='fa fa-plus'></i>Add project</span>
            </div>
            <div data-panel='2'>
                <form method='POST' class='projects-add container-actions'>
                    <div class='fluid'>
                        <input type='text' class='form-control' name='name' autocomplete='off'>
                    </div>
                    <div class='fluid fluid-vcenter bar-actions'>
                        <button data-open='1' type='submit' class='btn btn-primary'>Add project</button>
                        <span data-open='1' class='link'>Cancel</span>
                    </div>
                </form>
            </div>
        </li>
        </ul>
    </nav>

    <div class='paper fill content'></div>
</section>

<div class="modal fade modal-small" id='project-delete'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header fluid">
                <h5 class="modal-title">Are you sure?</h5>
                <div class='fill'></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>You can't go back.</p>
            </div>
            
            <form method='POST' class="modal-footer projects-delete">
                <input type='hidden' name='id' value=''>
                <button type="submit" class="btn btn-primary" >Yes, delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Close</button>
                
            </form>
        </div>
    </div>
</div>

<div class="modal fade modal-small" id='task-delete'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header fluid">
                <h5 class="modal-title">Are you sure?</h5>
                <div class='fill'></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>You can't go back.</p>
            </div>
            <form method='POST' name='task-delete' class="modal-footer">
                <input type='hidden' name='id' value=''>
                <button type="submit" class="btn btn-primary" >Yes, delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Close</button>
                
            </form>
        </div>
    </div>
</div>