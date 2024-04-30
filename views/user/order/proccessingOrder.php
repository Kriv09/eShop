<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Process</title>

    <?php include(ROOT . '/resources/templates/defaultLibraries.php'); ?>

    <style>
        .center-screen {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin-top: -50px;
        }
    </style>
</head>
<body>

    <?php include(ROOT . '/resources/templates/headerLoggedIn.php'); ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
            <div class="center-screen">
                <div class="card mt-5" style="width: 80%;">
                        <div class="card-body">
                            <form action="/user/<?= $user['id'] ?>/processOrder" method="post">
                                <div class="form-group">
                                    <label for="takerName">Your Name</label>
                                    <input type="text" class="form-control" id="takerName" name="takerName" required value="<?= $user['name'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="takerEmail">Your Email</label>
                                    <input type="email" class="form-control" id="takerEmail" name="takerEmail" required value="<?= $user['email'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="takerPhoneNumber">Your Phone Number</label>
                                    <input type="number" class="form-control" id="takerPhoneNumber" name="takerPhoneNumber" required>
                                </div>
                                <div class="form-group">
                                    <label for="takerAddress">Your Address</label>
                                    <input type="text" class="form-control" id="takerAddress" name="takerAddress" required placeholder="City / Street / HouseNumber">
                                </div>
                                <div class="form-group">
                                    <label for="deliveryService">Delivery Service</label>
                                    <select class="form-control" id="deliveryService" name="deliveryService">
                                        <option>NovaPoshta</option>
                                        <option>UkrPoshta</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Payment Method</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="paymentMethod" id="cash" value="cash" checked>
                                        <label class="form-check-label" for="cash">
                                            Cash
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="paymentMethod" id="card" value="card">
                                        <label class="form-check-label" for="card">
                                            Card
                                        </label>
                                    </div>
                                    <div id="cardDetails" style="display: none;">
                                        <div class="form-group">
                                            <label for="cardNumber">Card Number</label>
                                            <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="5168 7559 0430 2557">
                                        </div>
                                        <div class="form-group">
                                            <label for="cardD">Card Date</label>
                                            <input type="text" class="form-control" id="cardD" name="cardD" placeholder="MM/YY">
                                        </div>
                                        <div class="form-group">
                                            <label for="cvv">CVV</label>
                                            <input type="text" class="form-control" id="cvv" name="cvv" placeholder="398">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><strong>Total Price: $<?= $totalPrice ?></strong></label>
                                </div>
                                <button type="submit" class="btn btn-primary">Confirm Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include(ROOT . '/resources/templates/footer.php'); ?>

    <script>
     window.onload = function() {
        document.getElementById('card').addEventListener('change', function() {
            document.getElementById('cardDetails').style.display = this.checked ? 'block' : 'none';
        });
        document.getElementById('cash').addEventListener('change', function() {
            document.getElementById('cardDetails').style.display = this.checked ? 'none' : 'block';
        });
    };
    </script>
</body>
</html>