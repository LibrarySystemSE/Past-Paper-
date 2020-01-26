<?php include './includes/login_verifier.php';
session_start();
if(check_login()){
    header("Location:download");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Past Paper System</title>
        <link rel="shortcut icon" type="image/png" href="images/icon.png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container d-flex flex-column justify-content-center" style="min-height: 100vh;">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-8 text-center my-4">
                    <img src="images/icon.png" class="img-fluid" style="max-width: 15rem;">
                    <h3>Library Catalogue<br>
                        <small class="text-muted">Vavuniya Campus</small>
                    </h3>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 d-flex flex-column justify-content-center my-4">
                    <div class="card">
                        <div class="card-header">
                            <span class="h3 text-uppercase">Sign In</span>
                        </div>
                        <div class="card-body">

                            <?php
                            if (isset($_GET["error"])) {


                                if ($_GET["error"] === "new") {
                                    ?>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        Please contact your librarian to verify your account.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?php
                                } else if ($_GET["error"] === "disabled") {
                                    ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Your account is disabled. Please contact your librarian.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?php
                                }else if($_GET["error"] === "invalid"){
                                    ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Invalid username or password.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?php
                                }
                            }
                            ?>

                            <form method="post" action="backend/login_handler.php">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="nic" class="form-control input_user" value="" placeholder="Username or NIC" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control input_pass" value="" placeholder="Password" required>
                                </div>
                                <input type="submit" class="btn btn-primary mr-2" value="Sign In">
                            </form>
                        </div>
                          <div class="card-footer text-center">
                            <a href="signup.php">Create an account</a>
                            <hr>
                            <a href="javascript:forgotMessage();" id="forgotpwbutton">Forgot password?</a>
                            <span id="forgetpwtext"></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script>
            function forgotMessage(){
                document.querySelector("#forgetpwtext").innerHTML = 'Please contact your librarian to reset your password.';
                document.querySelector("#forgotpwbutton").innerHTML = '';
            }
        </script>
    
    </body>
</html>