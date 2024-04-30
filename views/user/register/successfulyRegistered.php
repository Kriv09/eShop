<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <?php include(ROOT . '/resources/templates/defaultLibraries.php'); ?>
</head>
<body>
    <?php 
        require_once(ROOT . '/resources/templates/header.php'); 
    ?>

    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="text-center">Registration Successful</h2>
                        <p class="text-center">You have successfully registered. You can now <a href="/user/login">log in</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include(ROOT . '/resources/templates/footer.php'); ?>
</body>
</html>