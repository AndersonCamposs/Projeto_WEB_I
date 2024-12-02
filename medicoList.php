<?php
include 'authenticator.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/MedicoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/UsuarioPermissaoDAO.php';

$isAdmin = false;
$usuarioLogadoPermissoes = UsuarioPermissaoDAO::getInstance()->listWhere("WHERE idUsuario = :idUsuario", array(0 => ":idUsuario"), array(0 => $_SESSION["usuarioLogado"]->getId()));
foreach($usuarioLogadoPermissoes as $usuarioLogadoPermissao) {
    if ($usuarioLogadoPermissao->getPermissao()->getNome() == "ADMINISTRADOR") {
        $isAdmin = true;
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
                                            $arrayDataNasc = explode("-", $medico->getDataNascimento());
                                            echo 
                                            "<tr>".
                                                "<td>".$medico->getId()."</td>".
                                                "<td>".$medico->getNome()."</td>".
                                                "<td>".$medico->getCpf()."</td>".
                                                "<td>".$medico->getEspecialidade()->getNome()."</td>".
                                                "<td>".$medico->getEmail()."</td>".
                                                "<td>";
                                                   if(checarAutorizacao(array(PermissaoDAO::getInstance()->getById(1)))) {echo "<a href='./medicoAddEdit.php?id=".$medico->getId()."' class='btn btn-outline-warning'><i class='fas fa-pen'></i>Editar</a> ";}
                                        if(checarAutorizacao(array(PermissaoDAO::getInstance()->getById(1)))) {echo "<a href='./controller/medicoController.php?id=".$medico->getId()."' class='btn btn-outline-danger'><i class='fas fa-trash'></i>Apagar</a> ";}
                                            echo "<a href='./medicoDetails.php?id=".$medico->getId()."' class='btn btn-outline-primary'></i><i class='fa-solid fa-eye'></i>Ver mais</a>
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
                <?php
                include("./footer.php");
                ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
