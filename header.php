<?php

    if ($loggedIn) {
?>


    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">RMSys</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                    Project
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        
                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#selectProjectModal">Select Project</button>
                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#createProject">Create Project</button>
                        <!-- TODO: Alter Project muss noch implementiert werden -->
                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#....">Alter Project</button>
                        
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Project Management</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
            <span class="navbar-text">
                <?php
                    if ($_SESSION['username'] == 'admin') {
                        echo $_SESSION['username'];
                    }
                    else {
                        echo $_SESSION['firstName']." ".$_SESSION['lastName']; 
                    }
                ?>
            </span>
            <!--<form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>-->
            <form class="form-inline my-2 my-lg-0" action="" method="POST">
                <button class="btn btn-danger" type="submit" name="logout">Logout</button>
            </form>
        </div>
    </nav>
<?php
    }
?>



<!-- Modal for selecting projects -->
<div class="modal fade" id="selectProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-10">
                            <label for="selectProject">Project</label>
                            <select name="selectValFromProject" id="selectProject" class="form-control">
                                <?php 
                                    echo showProjects($conn);
                                ?>                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="saveSelectedProject" name="saveSelectedProject" class="btn btn-primary">Save</button>
                </div>
            </form>
            <?php
            // Problem: hier ist eine race condition da der js-part schneller ausgeführt wird als php
                if (isset($_POST['saveSelectedProject'])) {
                    $projectVal = $_POST['selectValFromProject'];
                    $_SESSION['project'] = $projectVal;
                }
            ?>
        </div>
    </div>
</div>




<!-- Modal for creating projects -->
<div class="modal fade" id="createProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-2">
                            <label for="inputCreatePrefix">Prefix</label>
                            <input type="text" name="inputCreatePrefix" class="form-control" id="inputCreatePrefix" maxlength="3">
                        </div>
                        <div class="form-group col-10">
                            <label for="inputCreateProject">Project</label>
                            <input type="text" name="inputCreateProject" class="form-control" id="prefix">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="btnCreateProject" class="btn btn-primary">Create project</button>
                </div>
            </form>
            <?php
                // TODO: Wenn ein projekt nicht erstellt werden konnte soll es zurück
                // zum Modalen Fenster gehen
                createProject();
            ?>
        </div>
    </div>
</div>