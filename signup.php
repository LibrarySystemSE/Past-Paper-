<?php include './includes/login_verifier.php';
session_start();
if(check_login()){
    header("Location:download");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Library Catalogue</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container d-flex flex-column justify-content-center" style="min-height: 100vh;">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-3 text-center my-4">
                    <img src="images/icon.png" class="img-fluid" style="max-width: 15rem;">
                    <h3> Library Catalogue<br>
                        <small class="text-muted">Vavuniya Campus</small>
                    </h3>
                </div>
                <div class="col-sm-12 col-md-8 col-lg-9 d-flex flex-column justify-content-center my-4">
                    <div class="card">
                        <div class="card-header">
                            <span class="h3 text-uppercase"> Create an Account</span>
                        </div>
                        <div class="card-body">


                            <?php
                            if (isset($_GET["error"])) {


                                if ($_GET["error"] === "invalid") {
                                    ?>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        Please fill all fields correctly.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?php
                                } else if ($_GET["error"] === "exist") {
                                    ?>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        You already have an account. Please <a href="backend/../">sign in</a>.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?php
                                } else if ($_GET["error"] === "taken") {
                                    ?>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        This username is taken. Please enter another username.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?php
                                }
                            } else if (isset($_GET["success"])) {
                                ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Sign up successful. Please contact your librarian to verify your account.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <?php
                            }
                            ?>


                            <form method="post" action="backend/signup_handler.php">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                            </div>
                                            <input name="name" class="form-control" placeholder="Name" type="text" required>
                                        </div>

                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fas fa-address-card"></i> </span>
                                            </div>
                                            <input name="username" class="form-control" placeholder="Username" type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fas fa-address-card"></i> </span>
                                            </div>
                                            <input name="nic" class="form-control" placeholder="NIC" type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                                            </div>
                                            <select class="form-control" name="account" required>
                                                <option selected disabled value="">Account Type</option>
                                                <option value="ACDSTAFF">Academic Staff</option>
                                                <option value="STUDENT">Student</option>
                                                <option value="LIBRARIAN">Librarian</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                            </div>
                                            <input name="password1" class="form-control" placeholder="Password" type="password" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                            </div>
                                            <input name="password2" class="form-control" placeholder="Confirm Password" type="password" required>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Create Account">


                            </form>


                        </div>
                        <div class="card-footer">
                            <span class="text-center">Already have an account? <a href="index.php">Sign In</a></span>                                                                 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>