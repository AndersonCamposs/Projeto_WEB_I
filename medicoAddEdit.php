<?php
include 'authenticator.php';

checarLogin();

require_once $_SERVER["DOCUMENT_ROOT"] . "/ac_clinic/model/dao/ConselhoDAO.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ac_clinic/model/dao/EstadoDAO.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ac_clinic/model/dao/EspecialidadeDAO.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ac_clinic/model/dao/MedicoDAO.php";

$medico = null;

if(isset($_GET["id"])) {
    if($_GET['id'] != $_SESSION["usuarioLogado"]->getId()) {
        if (!checarAutorizacao(array(PermissaoDAO::getInstance()->getById(1)))) {
            header("Location: ./index.php");
            die();
        }
    }
    $medico = MedicoDAO::getInstance()->getById($_GET["id"]);
} else {
    if (!checarAutorizacao(array(PermissaoDAO::getInstance()->getById(1)))) {
        header("Location: ./index.php");
        die();
    }
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
                        <h1 class="mt-4">Médicos</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Médicos</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fa-regular fa-square-plus me-1"></i>
                                Adicionar Médico
                            </div>
                            <div class="card-body">
                                <form id="medicoAddEditForm" action="./controller/medicoController.php" method="POST">
                                    <?php
                                        if ($medico != null) {
                                            echo
                                            "<input type='hidden' name='id' value='".$medico->getId()."'>";
                                        }
                                    ?>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            Nome:
                                            <?php
                                            echo
                                            "<input id='inputNome' class='form-control' type='text' name='nome' value='"
                                            .($medico == null ? '' : $medico->getNome())."'>"
                                            ?>
                                        </div>
                                        <div class="col-3">
                                            Data de nascimento:
                                            <?php
                                            echo
                                            "<input id='inputDataNasc' class='form-control' type='date' name='dataNascimento' value='"
                                            .($medico == null ? '' : $medico->getDataNascimento())."'>"
                                            ?>
                                        </div>
                                        <div class="col-3">
                                            CPF:
                                            <?php
                                            echo
                                            "<input id='inputCpf' class='form-control' type='text' name='cpf' minlength='11' maxlength='11' value='"
                                            .($medico == null ? '' : $medico->getCpf())."'>"
                                            ?>
                                        </div>
                                        <div class="col-3">
                                            E-mail:
                                            <?php
                                            echo
                                            "<input id='inputEmail' class='form-control' type='text' name='email' placeholder='example@email.com' value='"
                                            .($medico == null ? '' : $medico->getEmail())."'>"
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            Especialidade:
                                            <select class='form-select' name='especialidade'>
                                            <?php
                                            $listaEspecialidades = EspecialidadeDAO::getInstance()->listAll();
                                            foreach($listaEspecialidades as $especialidade) {
                                                if ($medico != null && $medico->getEspecialidade()->getId() == $especialidade->getId()) {
                                                        
                                                } else {
                                                    echo
                                                    "<option value='".$especialidade->getId()."'>".
                                                        $especialidade->getNome().
                                                    "</option>";
                                                }
                                            }
                                            ?>
                                            </select>
                                            
                                        </div>
                                        <div class="col-3">
                                            Estado de Formação:
                                            <select id="estado" name="estado" class="form-select">
                                                <?php
                                                $listaEstados = EstadoDAO::getInstance()->listAll();
                                                foreach ($listaEstados as $estado) {
                                                    if ($medico != null && $medico->getEstadoFormacao()->getId() == $estado->getId()) {
                                                        echo
                                                        "<option selected value='".$estado->getId()."'>".
                                                            $estado->getNome().
                                                        "</option>";
                                                    } else {
                                                        echo
                                                        "<option value='".$estado->getId()."'>".
                                                            $estado->getNome().
                                                        "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            Número do documento da licença:
                                            <?php
                                            echo
                                            "<input id='inputDocumentoLicenca' class='form-control' type='text' name='documentoLicenca' value='"
                                            .($medico == null ? '' : $medico->getDocumentoLicenca())."'>"
                                            ?>
                                        </div>
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
                                    <!-- VALIDATION ERRORS -->
                                    <div id="addEditValidationErrors" class="d-none justify-content-center flex-wrap my-3">

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <?php
                include("./footer.php");
                ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        
        <!-- SCRIPT QUE VALIDA O FORMULÁRIO -->
        <script src="./js/globalFormValidator.js" type="module"></script>
    </body>
</html>
