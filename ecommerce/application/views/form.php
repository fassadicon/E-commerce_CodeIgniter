<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <style>
        p {
            margin: 0;
        }

        .red {
            color: red;
        }

        .green {
            color: green;
        }
    </style>
    <title>Authentication II</title>

</head>

<body>
    <div class="container col-6">
        
        <h6 class="red"><?= $errors ?></h6>
        <h6 class="green"><?= $message ?></h6>
        <div class="row">
            <div class="col-6">
                <h1>Sign up</h1>
                <form action="users/add" method="post" class="form">
                    <label for="first_name">First name</label>
                    <input type="text" name="first_name" class="form-control">
                    <label for="last_name">Last name</label>
                    <input type="text" name="last_name" class="form-control">
                    <label for="contact_number">Contact number</label>
                    <input type="text" name="contact_number" class="form-control">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control">
                    <label for="repeat_password">Repeat Password</label>
                    <input type="password" name="repeat_password" class="form-control">
                    <input type="submit" class="btn btn-success">
                </form>
            </div>
            <div class="col-6">
                <h1>Log In</h1>
                <form action="users/login" method="post" class="form">
                    <label for="user_identifaction">Contact number or Email</label>
                    <input type="text" name="user_identifaction" class="form-control">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control">
                    <input type="submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</body>

</html>