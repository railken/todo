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
        <ul>
            <li><i class='fa fa-calendar-o'></i> Today</li>
        </ul>


        Projects
        <ul>
        {#user.projects}
            <li>{name}</li>
        {/user.projects}

        <li class='toggle' data-status='1'>
            <div data-panel='1'>
                <span data-open='2' class='action'><i class='fa fa-plus'></i>Add project</span>
            </div>
            <div data-panel='2'>
                <form method='POST' class='projects_add'>
                    <div class='fluid'>
                        <input type='text' class='form-control' name='name'>
                    </div>
                    <div class='fluid'>
                        <button data-open='1' type='submit' class='btn btn-primary'>Add project</button>
                        <span data-open='1' class='btn btn-danger'>Cancel</span>
                    </div>
                </form>
            </div>
        </li>
        </ul>
    </nav>

    <div class='paper fill'>

    <h1>Some content goes here</h1>
    </div>
</section>