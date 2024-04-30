<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once(ROOT . '/resources/templates/defaultLibraries.php'); ?>
    <title>Success</title>
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
            <h5 class="card-title">Email was successfuly verified</h5>
            <p class="card-text">You can now order products in our shop</p>
        </div>
    </div>

    <?php include(ROOT . '/resources/templates/footer.php'); ?>
</body>
</html>