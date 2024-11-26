<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/MedicoDAO.php';
?>

<!DOCTYPE html>
    <?php include('./head.php'); ?>
    <body class="sb-nav-fixed">
        <?php include("./nav.php") ?>
        <div id="layoutSidenav">
            <?php include "./sideNav.php" ;?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Médicos</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Médicos</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Lista de Médicos
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>CPF</th>
                                            <th>Especialidade</th>
                                            <th>E-mail</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>CPF</th>
                                            <th>Especialidade</th>
                                            <th>E-mail</th>
                                            <th>Ações</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $listaMedicos = MedicoDAO::getInstance()->listAll();
                                        
                                        foreach($listaMedicos as $medico) {
                                            echo 
                                            "<tr>".
                                                "<td>".$medico->getId()."</td>".
                                                "<td>".$medico->getNome()."</td>".
                                                "<td>".$medico->getCpf()."</td>".
                                                "<td>".$medico->getIdEspecialidade()->getNome()."</td>".
                                                "<td>".$medico->getEmail()."</td>".
                                                "<td>
                                                   <a href='./pacienteAddEdit.php?id=".$medico->getId()."' class='btn btn-outline-warning'><i class='fas fa-pen'></i>Editar</a>
                                                   <a href='./controller/pacienteController.php?id=".$medico->getId()."' class='btn btn-outline-danger'><i class='fas fa-trash'></i>Apagar</a>
                                                   <a href='#' class='btn btn-outline-primary'><i class='fas fa-eye'></i>Ver mais</a>    
                                                </td>".
                                            "</tr>";
                                        }
                                       ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
