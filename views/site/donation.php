<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation</title>
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

    <div class="container custom-margin">
        <h2 class="text-center">Support Our Cause</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/donation">
                            <div class="mb-3">
                                <label for="donationAmount" class="form-label">Donation Amount</label>
                                <input type="number" class="form-control" id="donationAmount" name="donationAmount" placeholder="Enter amount">
                            </div>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter your full name" value="<?php if($user) echo $user['name']; else "";  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php if($user) echo $user['email']; else "";  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="cardNumber" class="form-label">Card Number</label>
                                <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="Enter your card number">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="3" placeholder="Enter your message"></textarea>
                            </div>
                            <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Donate"></input>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
    <?php include ROOT . '/resources/templates/footer.php'; ?>
</body>
</html>