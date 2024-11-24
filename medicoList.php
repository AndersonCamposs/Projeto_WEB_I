<!DOCTYPE html>
<html lang="en">
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
                                            <th>Conselho Regional</th>
                                            <th>Estado</th>
                                            <th>Número do Documento</th>
                                            <th>Especilidade(s)</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Conselho Regional</th>
                                            <th>Estado</th>
                                            <th>Número do Documento</th>
                                            <th>Especilidade(s)</th>
                                            <th>Ações</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Antonio Ferreira</td>
                                            <td>CRM</td>
                                            <td>PE</td>
                                            <td>10213456</td>
                                            <td>Cardiologista</td>
                                            <td>
                                                <a href="#" class="btn btn-outline-warning"><i class="fas fa-pen"></i>Editar</a>
                                                <a href="#" class="btn btn-outline-danger"><i class="fas fa-trash"></i>Apagar</a>
                                            </td>
                                        </tr>                                        
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
