<header class='fluid'>
    <div class='fill'>
        Uhm...
    </div>
    <div>
        {user.email}
    </div>
</header>
<section class='fluid container'>

    <nav>
        <ul class='nav-list'>
            <li><i class='fa fa-calendar-o'></i> Today</li>
        </ul>

        Projects
        <ul class='nav-list project-list'>

        {#user.projects}

            <li class='toggle {#active}active{/active}' data-status='1' data-container='projects'>
                <div data-panel='1' class='fluid fluid-vcenter'>
                    <div class="dropdown">
                        <span class="project-dropdown dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <i class='fa fa-ellipsis-h'></i>
                        </span>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#" data-open='2'>Edit project</a>
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#project-delete" data-modal-id="input,{id}">Delete project</a>
                            <!--
                            <form method='POST' class='projects-delete'>
                                <input type='hidden' name='id' value='{id}'>
                                <button class="dropdown-item" type='submit'>Leave project</button>
                            </form>-->
                        </div>
                    </div>
                    <div class='nav-element fluid fluid-vcenter' data-href='projects/{id}'>

                        <i class='fa fa-circle project-icon'></i>
                        <span class='fill'><span class='project-title'>{name}</span> <span class='project-tasks'>{tasks}</span></span>
                    </div>
                </div>
                <div data-panel='2'>

                    <form method='POST' class='projects-edit container-actions'>
                        <input type='hidden' name='id' value='{id}'>
                        <div class='nav-element editing fluid fluid-vcenter'>

                            <i class='fa fa-circle project-icon'></i>
                            <input type='text' class='form-control' name='name' value='{name}' autocomplete='off'>
                        </div>
                        <div class='fluid fluid-vcenter bar-actions'>
                            <button data-open='1' type='submit' class='btn btn-primary'>Save changes</button>
                            <span data-open='1' class='link'>Cancel</span>
                        </div>
                    </form>
                </div>
            </div>
            </li>
        {/user.projects}

        </div>
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

<div class="modal fade" id='project-delete'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Are you sure?</h5>
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