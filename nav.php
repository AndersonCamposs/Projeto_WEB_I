<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/vo/UsuarioVO.php';

?>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.php"><i class="fa-solid fa-hospital"></i> AC Clinic</a>
    
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php
            echo 
            ((isset($_SESSION["usuarioLogado"]) && $_SESSION['usuarioLogado']->getFoto() != null) ? 
            "<img id='profilePhoto' src='".$_SESSION['usuarioLogado']->getFoto()."'>"
                :
            "<i class='fas fa-user fa-fw'></i>");
            ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li><hr class="dropdown-divider" /></li>
                <?php
                if(isset($_SESSION["usuarioLogado"])) {
                    echo 
                    "<li><a class='dropdown-item' href='./controller/logoutController.php'>Sair</a></li>";
                } else {
                    echo
                    "<li><a class='dropdown-item' href='./login.php'>Entrar</a></li>";
                }
                
                ?>
            </ul>
        </li>
    </ul>
</nav>