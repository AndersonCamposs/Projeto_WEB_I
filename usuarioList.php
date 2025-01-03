<?php 
include 'authenticator.php';

checarLogin();

require_once $_SERVER['DOCUMENT_ROOT'] . '/ac_clinic/model/dao/UsuarioDAO.php';
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
                        <h1 class="mt-4">Usuários</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Usuários</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Lista de Usuários
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>E-Mail</th>
                                            <th>CPF</th>
                                            <th>Foto</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>E-Mail</th>
                                            <th>CPF</th>
                                            <th>Foto</th>
                                            <th>Ações</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $listaUsuarios = UsuarioDAO::getInstance()->listAll();
                                       
                                        foreach ($listaUsuarios as $usuario) {
                                            echo 
                                            "<tr>".
                                                "<td>".$usuario->getId()."</td>".
                                                "<td>".$usuario->getNome()."</td>".
                                                "<td>".$usuario->getEmail()."</td>".
                                                "<td>".$usuario->getCPF()."</td>".
                                                "<td><img id='profilePhoto' src='".$usuario->getFoto()."'/></td>".
                                                "<td>";
                                                    if(($_SESSION["usuarioLogado"]->getId() == $usuario->getId()) || $isAdmin) {
                                                        echo "<a href='./usuarioAddEdit.php?id=".$usuario->getId()."' class='btn btn-outline-warning'><i class='fas fa-pen'></i>Editar</a> ";
                                                    }
                                                    if($isAdmin) {
                                                        echo "<a href='./controller/usuarioController.php?id=".$usuario->getId()."' class='btn btn-outline-danger'><i class='fas fa-trash'></i>Apagar</a> ";
                                                    }
                                                    if(($_SESSION["usuarioLogado"]->getId() != $usuario->getId()) && !$isAdmin) {
                                                       echo "<h6>N/A</h6>"; 
                                                    }
                                                    
                                            echo "</td>".
                                            "</tr>"
                                                    ;
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
