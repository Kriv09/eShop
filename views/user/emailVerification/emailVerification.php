<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once(ROOT . '/resources/templates/defaultLibraries.php'); ?>
    <title>Email Verfication</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>
    <?php include(ROOT . '/resources/templates/headerLoggedIn.php'); ?>

    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Email has been sent</h5>
            <p class="card-text">A verification email has been sent <?= $user['email']?>. Please check your inbox and click the link in the email to verify your email address.</p>
        </div>
    </div>

    <?php include(ROOT . '/resources/templates/footer.php'); ?>
</body>
</html>