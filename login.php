<?php session_start(); ?>

<!DOCTYPE html>
    <?php include("./head.php"); ?>
    <body class="bg-dark">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <a href="./index.php" class="btn btn-dark"><i class="fa-solid fa-house"></i></a>
                                        <h3 class="text-center font-weight-light mb-4 mt-1">Login</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="./controller/loginController.php" method="POST">
                                            <div class="form-floating mb-3">
                                                <?php  
                                                echo 
                                                "<input class='form-control' id='inputEmail' type='email' placeholder='example@email.com' name='email' required ".
                                                "value='".(isset($_SESSION['emailInformado']) ? $_SESSION['emailInformado'] : '')."'/>"
                                                ?>
                                                <label for="inputEmail">E-mail</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <?php  
                                                echo 
                                                "<input class='form-control' id='inputPassword' type='password' placeholder='Senha' name='senha' required ".
                                                "value='".(isset($_SESSION['senhaInformada']) ? $_SESSION['senhaInformada'] : '')."'/>"
                                                ?>
                                                <label for="inputPassword">Senha</label>
                                            </div>
                                            <?php
                                            if (isset($_SESSION["loginErro"])) {
                                                echo 
                                                "<div class='alert alert-danger text-center'>".
                                                htmlspecialchars($_SESSION['loginErro']).
                                                "</div>";
                                                session_unset();
                                            }
                                            ?>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Esqueceu a senha?</a>
                                                <button class="btn btn-primary" type="submit">Login</a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="./usuarioAddEdit.php">Precisa de uma conta? Registre-se</a></div>
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


