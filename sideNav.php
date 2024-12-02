<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/PermissaoDAO.php';
?>

<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseConsultas" aria-expanded="false" aria-controls="collapsePacientes">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-suitcase-medical"></i></div>
                                Consultas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseConsultas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="consultaAddEdit.php">
                                        <i class="fa-regular fa-square-plus mx-2"></i>
                                        Adicionar
                                    </a>
                                    <a class="nav-link" href="consultaList.php">
                                        <i class="fa-regular fa-rectangle-list mx-2"></i>
                                        Listar
                                    </a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePacientes" aria-expanded="false" aria-controls="collapsePacientes">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Pacientes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePacientes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="pacienteAddEdit.php">
                                        <i class="fa-regular fa-square-plus mx-2"></i>
                                        Adicionar
                                    </a>
                                    <a class="nav-link" href="pacienteList.php">
                                        <i class="fa-regular fa-rectangle-list mx-2"></i>
                                        Listar
                                    </a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMedicos" aria-expanded="false" aria-controls="collapseMedicos">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-stethoscope"></i></div>
                                Médicos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseMedicos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php
                                    if(checarAutorizacao(array(PermissaoDAO::getInstance()->getById(1)))) {
                                        echo 
                                        "<a class='nav-link' href='medicoAddEdit.php'>
                                            <i class='fa-regular fa-square-plus mx-2'></i>
                                            Adicionar
                                        </a>";
                                    } 
                                    ?>
                                    <a class="nav-link" href="medicoList.php">
                                        <i class="fa-regular fa-rectangle-list mx-2"></i>
                                        Listar
                                    </a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsuarios" aria-expanded="false" aria-controls="collapseMedicos">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-id-card-clip"></i></div>
                                Usuários
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseUsuarios" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php
                                    if(checarAutorizacao(array(PermissaoDAO::getInstance()->getById(1)))) {
                                        echo 
                                        "<a class='nav-link' href='usuarioAddEdit.php'>
                                            <i class='fa-regular fa-square-plus mx-2'></i>
                                            Adicionar
                                        </a>";
                                    } 
                                    ?>
                                    <a class='nav-link' href='usuarioList.php'>
                                        <i class='fa-regular fa-rectangle-list mx-2'></i>
                                        Listar
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Usuário ativo:</div>
                        <?php
                        echo $_SESSION["usuarioLogado"]->getNome();
                        ?>
                    </div>
                </nav>
            </div>