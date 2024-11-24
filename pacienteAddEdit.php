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
                                <form>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            Nome:
                                            <input class="form-control" type="text" name="name">
                                        </div>
                                        <div class="col-3">
                                            Data de nascimento:
                                            <input class="form-control" type="date" name="name">
                                        </div>
                                        <div class="col-3">
                                            CPF:
                                            <input class="form-control" type="text" name="name" maxlength="11" minlength="11">
                                        </div>
                                        <div class="col-3">
                                            Estado civil:
                                            <select class="form-select">
                                                <option>Solteiro(a)</option>
                                                <option>Casado(a)</option>
                                                <option>Viúvo(a)</option>
                                                <option>União Estável</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            Celular:
                                            <input type="text" class="form-control" maxlength="11" minlength="11">
                                        </div>
                                        <div class="col-3">
                                            Logradouro:
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-3">
                                            Bairro:
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-3">
                                            CEP:
                                            <input type="text" class="form-control" maxlength="8" minlength="8">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            Complemento:
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-3">
                                            Número:
                                            <input type="number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
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
