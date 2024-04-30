<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Successful</title>
    <?php include ROOT . '/resources/templates/defaultLibraries.php'; ?>
    <style>
        .center-screen {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
        }
        .receipt-card {
            width: 15%;
        }
    </style>
</head>
<body>
    <?php include ROOT . '/resources/templates/headerLoggedIn.php'; ?>

    <div class="center-screen">
        <div class="receipt-card">
            <h1 class="text-center">Receipt</h1>
            <div class="card mt-5 text-center">
                <div class="card-body">
                    <p class="card-text"><strong>Name:</strong> <?= $_POST['takerName'] ?></p>
                    <p class="card-text"><strong>Email:</strong> <?= $_POST['takerEmail'] ?></p>
                    <p class="card-text"><strong>Phone Number:</strong> <?= $_POST['takerPhoneNumber'] ?></p>
                    <p class="card-text"><strong>Delivery Service:</strong> <?= $_POST['deliveryService'] ?></p>
                    <p class="card-text"><strong>Address:</strong> <?= $_POST['takerAddress'] ?></p>
                    <p class="card-text"><strong>Payment method:</strong> <?= $_POST['paymentMethod'] ?></p>
                    <?php
                        if($_POST['paymentMethod'] == 'card')
                        {
                            echo '<p class="card-text"><strong>Card Number:</strong> ' . $_POST['cardNumber'] . '</p>';
                            echo '<p class="card-text"><strong>Card Date:</strong> ' . $_POST['cardData'] . '</p>';
                            echo '<p class="card-text"><strong>Card CVV:</strong> ' . $_POST['cvv'] . '</p>';
                        } 
                    ?>
                    <hr>
                    <p class="card-text"><strong>Total Price:</strong> $<?= $totalPrice ?></p>
                    <a href="/" class="btn btn-primary mt-3">Home</a>
                </div>
            </div>
        </div>
    </div>

    <?php include ROOT . '/resources/templates/footer.php'; ?>
</body>
</html>