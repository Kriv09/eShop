<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <?php include ROOT . '/resources/templates/defaultLibraries.php'; ?>

    <style> 
        .custom-margin {
            margin-top: 100px;
        }
    </style>
</head>
<body>

    <?php 
        if($user_id == "None")
            require_once(ROOT . '/resources/templates/header.php'); 
        else
            require_once(ROOT . '/resources/templates/headerLoggedIn.php');
    ?>

    <div class="container">
        <div class="custom-margin">
            <h1 class="text-center">Contact Us</h1>
        </div>
        <form method="post" action="/contact">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php if($user) echo $user['name']; else "";  ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php if($user) echo $user['email']; else "";  ?>" >
            </div>
            <div class="mb-3">
                <label for="problem" class="form-label">Type of Problem: </label>
                <select class="form-select form-select-lg" id="problem" name="problemType">
                    <option value="Technical Issue" selected>Technical Issue</option>
                    <option value="Billing Issue">Billing Issue</option>
                    <option value="General Inquiry">General Inquiry</option>
                    <option value="Other...">Other...</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" rows="3" name="message"></textarea>
            </div>
            <input type="submit" class="btn btn-primary" name="submit"></input>
        </form>
    </div>

    <?php include ROOT . '/resources/templates/footer.php'; ?>
</body>
</html>