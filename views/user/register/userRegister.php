<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include ROOT . '/resources/templates/defaultLibraries.php'; ?>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .small-text {
                font-weight: semi-bold;
                font-size: 1.2em;
        }
    </style>
</head>
<body>
    <?php include ROOT . '/resources/templates/header.php'; ?>
    
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-dark">
                <div class="card-body">
                    <h2 class="text-center">Register</h2>
                    <form action="/user/register" method="post">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control form-control-sm" id="username" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control form-control-sm" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control form-control-sm" id="password" name="password" required>
                        </div>
                        <div class="form-group text-center">
                            <input name="submit" type="submit" class="btn btn-primary" value="Register">
                        </div>
                    </form>
                    <div class="text-center">
                        <small class="small-text">Already have an account? <a href="/user/login">Log in</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php include ROOT . '/resources/templates/footer.php'; ?>
</body>
</html>