<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">
                <img src="/resources/assets/img/logo_forum.png">
            </a>
        </div>

        <ul class="nav navbar-nav navbar-right">

            <?php if ( $this->aauth_library->is_loggedin(true) ): ?>
                Welcome, <?= $this->aauth->CI->session->userdata('username') ;?>
                <button type="button" class="btn btn-default navbar-btn" onclick="window.location='/login/logout'" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Logout">Logout</button>
            <?php else : ?>
                <button type="button" class="btn btn-success navbar-btn" onclick="window.location='/login'">Sign In</button>
                <a href="<?php echo site_url('register')?>" class="btn btn-warning navbar-btn">Sign Up</a>
            <?php endif; ?>
        </ul>

        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="/articles">Home</a></li>
                <li><a href="/news">News</a></li>

                <!-- User links -->

                <?php if ( $this->aauth_library->is_loggedin(true) ): ?>
                    <li>
                        <a href="/users">
                            User cabinet
                            <span class="sr-only"></span>
                        </a>
                    </li>

                <?php endif; ?>

                <!-- Admin links -->
                <?php if ( $is_admin ): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">Admin
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="admin/index">User search</a></li>
                            <li><a href="admin/create_user">Create user</a></li>

                            <li class="divider"></li>

                            <li><a href="admin/create_section">Create section</a></li>
                            <li><a href="admin/create_subsection">Create subsection</a></li>
                            <li><a href="admin/search_section">Section search</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>

<div id="main-content">
