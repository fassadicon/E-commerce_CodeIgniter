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
    <title>Authentication II</title>

</head>

<body>
    <div class="container col-6">
        <h1>Basic Information</h1>
        <label for="first_name">First Name</label>
        <p type="text" name="first_name" class="form-control"><?=$user['first_name']?></p>
        <label for="last_name">Last Name</label>
        <p type="text" name="last_name" class="form-control"><?=$user['last_name']?></p>
        <label for="contact_number">Contact Number</label>
        <p type="text" name="contact_number" class="form-control"><?=$user['contact_number']?></p>
        <label for="email">Email</label>
        <p type="text" name="email" class="form-control"><?=$user['email']?></p>
        <label for="failed_login_at">last failed login</label>
        <p type="text" name="failed_login_at" class="form-control"><?=$user['failed_login_at'] ? $user['failed_login_at'] : 'None'?></p>
        <a href="/users/logout" class="btn btn-warning">Log out</a>
    </div>
    
</body>

</html>