<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problem Accepted</title>
    <?php include ROOT . '/resources/templates/defaultLibraries.php';  ?>
</head>
<body>
    <?php 
        if($user_id == "None")
            require_once(ROOT . '/resources/templates/header.php'); 
        else
            require_once(ROOT . '/resources/templates/headerLoggedIn.php');
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h2 class="card-title">Thank You!</h2>
                        <p class="card-text">Your problem has been received successfully. We'll contact you as soon as possible</p>
                        <a href="/" class="btn btn-primary">Return Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include ROOT . '/resources/templates/footer.php'; ?>
</body>
</html>