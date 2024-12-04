<?php
include 'authenticator.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/ConsultaDAO.php';

checarLogin();

$consulta = null;

if(isset($_GET['id'])) {
    $consulta = ConsultaDAO::getInstance()->getById($_GET['id']);
}
?>

<!DOCTYPE html>
    <?php include('./head.php'); ?>
    <body class="sb-nav-fixed">
        <?php include("./nav.php"); ?>
        <div id="layoutSidenav">
            <?php include "./sideNav.php" ;?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Consultas</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Consultas</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fa-regular fa-square-plus me-1"></i>
                                Adicionar Consulta
                            </div>
                            <div class="card-body">
                                <form id="consultaAddEditForm" action="./controller/consultaController.php" method="POST">
                                    <?php
                                        if ($consulta != null) {
                                            echo
                                            "<input type='hidden' name='id' value='".$consulta->getId()."'>";
                                        }
                                    ?>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            CPF do Paciente:
                                            <?php
                                            echo
                                            "<input id='inputCpfPaciente' class='form-control' type='text' name='cpfPaciente' value='"
                                            .($consulta == null ? (isset($_SESSION["consultaArrayDados"]) ? $_SESSION["consultaArrayDados"]["cpfPaciente"] : '') : $consulta->getPaciente()->getCpf())."'>"
                                            ?>
                                        </div>
                                        <div class="col-3">
                                            CPF do Médico:
                                            <?php
                                            echo
                                            "<input id='inputCpfMedico' class='form-control' type='text' name='cpfMedico' value='"
                                            .($consulta == null ? (isset($_SESSION["consultaArrayDados"]) ? $_SESSION["consultaArrayDados"]["cpfMedico"] : '') : $consulta->getMedico()->getCpf())."'>"
                                            ?>
                                        </div>
                                        <div class="col-3">
                                            Valor da consulta(R$):
                                            <?php
                                            echo
                                            "<input id='inputValor' class='form-control' type='text' placeholder='Ex: 200.00' name='valor' value='"
                                            .($consulta == null ? (isset($_SESSION["consultaArrayDados"]) ? $_SESSION["consultaArrayDados"]["valor"] : '') : $consulta->getValor())."'>"
                                            ?>
                                        </div>
                                        <div class="col-3">
                                            Método de pagamento:
                                            <select name="metodoPagamento" class="form-select">
                                                <option value="dinheiro">Dinheiro</option>
                                                <option value="pix">Pix</option>
                                                <option value="credito">Cartão de crédito</option>
                                                <option value="debito">Cartão de débito</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-3">
                                            Data da consulta:
                                            <?php
                                            echo
                                            "<input id='inputDataConsulta' class='form-control' type='date' name='dataConsulta' value='"
                                            .($consulta == null ? (isset($_SESSION["consultaArrayDados"]) ? $_SESSION["consultaArrayDados"]["dataConsulta"] : '') : $consulta->getDataConsulta())."'>"
                                            ?>
                                        </div>
                                        <div class="mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkBoxDataConsulta">
                                                <label class="form-check-label" for="checkBoxDataConsulta">
                                                  Marcar para a data de hoje
                                                </label>
                                            </div>
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
                                    <?php
                                        if(isset($_SESSION["consultaArrayErros"])) {
                                            echo 
                                            "<div class='d-flex justify-content-center flex-wrap my-3'>".
                                                "<div class='alert alert-danger text-center w-50'>".
                                                    $_SESSION["consultaArrayErros"][0];
                                                "</div>".
                                            "</div>";
                                                
                                            unset($_SESSION["consultaArrayErros"]);
                                            unset($_SESSION["consultaArrayDados"]);
                                        }
                                    ?>
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
        <script src="./js/consultaFormValidator.js"></script>
    </body>
</html>
