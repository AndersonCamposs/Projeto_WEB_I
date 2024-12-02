<?php
include 'authenticator.php';

checarLogin();

require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/PacienteDAO.php';

$paciente = null;

if(isset($_GET['id'])) {
    $paciente = PacienteDAO::getInstance()->getById($_GET['id']);
}
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
                        <h1 class="mt-4">Pacientes</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pacientes</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fa-regular fa-square-plus me-1"></i>
                                Adicionar Paciente
                            </div>
                            <div class="card-body">
                                <form action="./controller/pacienteController.php" method="POST">
                                    <?php
                                        if ($paciente != null) {
                                            echo
                                            "<input type='hidden' name='id' value='".$paciente->getId()."'>";
                                        }
                                    ?>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            Nome:
                                            <?php
                                            echo
                                            "<input class='form-control' type='text' name='nome' value='"
                                            .($paciente == null ? '' : $paciente->getNome())."'>"
                                            ?>
                                        </div>
                                        <div class="col-3">
                                            Data de nascimento:
                                            <?php
                                            echo
                                            "<input class='form-control' type='date' name='dataNascimento' value='"
                                            .($paciente == null ? '' : $paciente->getDataNascimento())."'>"
                                            ?>
                                        </div>
                                        <div class="col-3">
                                            CPF:
                                            <?php
                                            echo
                                            "<input class='form-control' type='text' name='cpf' minlength='11' maxlength='11' value='"
                                            .($paciente == null ? '' : $paciente->getCpf())."'>"
                                            ?>
                                        </div>
                                        <div class="col-3">
                                            RG:
                                            <?php
                                            echo
                                            "<input class='form-control' type='text' name='rg' value='"
                                            .($paciente == null ? '' : $paciente->getRg())."'>"
                                            ?>

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            Celular:
                                            <?php
                                            echo
                                            "<input class='form-control' type='text' name='celular' value='"
                                            .($paciente == null ? '' : $paciente->getCelular())."'>"
                                            ?>
                                        </div>
                                        <div class="col-3">
                                            E-mail:
                                            <?php
                                            echo
                                            "<input class='form-control' type='text' name='email' placeholder='example@email.com' value='"
                                            .($paciente == null ? '' : $paciente->getEmail())."'>"
                                            ?>
                                        </div>
                                    <div class="row my-3">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-success m-1">
                                                    Salvar  <i class="fa-solid fa-check"></i>
                                                </button>

                                                <button type="reset" class="btn btn-secondary m-1">
                                                    Limpar  <i class="fa-solid fa-rotate-left"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
