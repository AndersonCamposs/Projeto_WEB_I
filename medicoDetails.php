<?php
include 'authenticator.php';

checarLogin();

require_once $_SERVER["DOCUMENT_ROOT"] . "/ac_clinic/model/dao/MedicoDAO.php";

$medico = null;

if (isset($_GET['id'])) {
    $medico = MedicoDAO::getInstance()->getById($_GET['id']);
    $arrayDataNasc = explode("-", $medico->getDataNascimento());
} else {
    echo "<script>window.location.href='./404.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php include("./head.php"); ?>
    <body class="bg-dark">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header text-center border-0">
                                        <?php echo "<h4 class='modal-title'>" . $medico->getNome() . "(" . $medico->getEspecialidade()->getConselho()->getSigla() . "-" . $medico->getEstadoFormacao()->getSigla() . ":" . $medico->getDocumentoLicenca() . ")</h4>"; ?>
                                    </div>
                                    <div class="card-body m-0 p-0">
                                        <?php
                                        echo 
                                        "<div class = 'container p-0'>
                                            <div class = 'p-3 border-bottom border-top' style = 'background-color: var(--bs-card-cap-bg)'>
                                                <h5 class = 'text-center m-0'>Informações pessoais</h5>
                                            </div>
                                            <div class = 'border-bottom d-flex align-items-center text-center'>
                                                <h6 class = 'p-2 m-0 w-50 border-end'>CPF</h6>
                                                <p class = 'p-2 m-0 w-50 border-end'>". $medico->getCpf()."</h6>
                                            </div>
                                            <div class = 'border-bottom d-flex align-items-center text-center'>
                                                <h6 class = 'p-2 m-0 w-50 border-end' >Data de nascimento</h6>
                                                <p class = 'p-2 m-0 w-50 border-end fs-6'>$arrayDataNasc[2]/$arrayDataNasc[1]/$arrayDataNasc[0]</p>
                                            </div>
                                            <div class = 'border-bottom d-flex align-items-center text-center'>
                                                <h6 class = 'p-2 m-0 w-50 border-end'>E-mail</h6>
                                                <p class = 'p-2 m-0 w-50 border-end fs-6'>".$medico->getEmail()."</p>
                                            </div>
                                        </div>

                                        <br/>

                                        <div class = 'container p-0'>
                                            <div class = 'p-3 border-bottom border-top' style = 'background-color: var(--bs-card-cap-bg)'>
                                                <h5 class = 'text-center m-0'>Informações profissionais</h5>
                                            </div>
                                            <div class = 'border-bottom d-flex align-items-center text-center'>
                                                <h6 class = 'p-2 m-0 w-50 border-end'>Especialidade</h6>
                                                <p class = 'p-2 m-0 w-50 border-end fs-6'>".$medico->getEspecialidade()->getNome()."</p>
                                            </div>
                                            <div class = 'border-bottom d-flex align-items-center text-center'>
                                                <h6 class = 'p-2 m-0 w-50 border-end'>Descrição da especialidade</h6>
                                                <p class = 'p-2 m-0 w-50 border-end fs-6'>".$medico->getEspecialidade()->getDescricao()."</p>
                                            </div>
                                        </div>";
                                        ?>
                                    </div>
                                    <div class="card-footer border-0 d-flex justify-content-center py-3">
                                        <button type="button" class="btn btn-dark" onclick="window.location.href='./medicoList.php'">
                                            Voltar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
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
    </body>
</html>


