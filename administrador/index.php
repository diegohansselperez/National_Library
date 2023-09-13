<?php 
    if($_POST){
        header("Location:inicio.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Administrador</title>
</head>

<body>
    <br>
    <br><br><br><br><br>
    <main class="row m-0 py-5">

        <div class="d-flex flex-column gap-4 col-md-12 h-100 justify-content-center align-items-center m-0 p-0">
            
        <h5>Login Administrador</h5>
            <form method="POST" class="col-sm-6 col-md-6 col-lg-3 bg-dark text-white  border px-4 py-3 rounded-2">
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" id="form2Example1" name="user" class="form-control" placeholder="Enter you user..." />
                    <label class="form-label" for="form2Example1">User</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="form2Example2" name="password" class="form-control" placeholder="Enter you password..." />
                    <label class="form-label" for="form2Example2">Password</label>
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-3">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                            <label class="form-check-label" for="form2Example31"> Remember me </label>
                        </div>
                    </div>

                    <div class="col">
                        <!-- Simple link -->
                        <a href="#!">Forgot password?</a>
                    </div>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>


            </form>
        </div>
    </main>



</body>

</html>