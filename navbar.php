<!-- Begin Nav Bar  -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="index.php">Mon Département</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="professeurs.php">Professeurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="specialite.php">Spécialités</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="module.php">Modules</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="etudiants.php">Etudiants</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href=""><i class="fa fa-user" aria-hidden="true"></i>
                            <?php echo $Admin_Nom; ?></a>
                        <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
                            Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Nav Bar  -->