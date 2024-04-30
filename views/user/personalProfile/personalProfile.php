<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
    <?php include(ROOT . '/resources/templates/defaultLibraries.php'); ?>
    <style>
        a {
            color: lightgreen;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
            min-width: 450px;
        }
        .card-header {
            font-size: 1.25rem;
            font-weight: 500;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            flex: 1;
        }
    </style>
</head>
<body>

    <?php include(ROOT . '/resources/templates/headerLoggedIn.php'); ?>
   
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0"><?= $user['name'] ?>'s Profile</h3>
        </div>
        <div class="card-body">
            <div class="mb-3 d-flex align-items-center">
                <h5 class="card-title m-0">Name: <?= $user['name'] ?></h5>
            </div>
            <div class="mb-3 d-flex align-items-center">
            <p class="card-text m-0"><strong>Email:</strong> <?= $user['email'] ?> </p>
            <?php 
                if($user['isEmailVerified'] == false) {
                    echo '<button class="btn btn-primary me-3 ml-3"><a href="/user/' . $user['id'] . '/processEmailVerif">Verify</a></button>';
                } else {
                    echo '<button class="btn btn-primary me-3 ml-3" disabled>Verified</button>';
                }
            ?>
            </div>
            <div class="mb-3">
                <h5 class="card-title">Orders:</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($userOrders as $order) {
                                echo '<tr>';
                                echo '<td>' . $order['id'] . '</td>';
                                echo '<td>' . $order['order_date'] . '</td>';
                                echo '<td>$' . $order['totalPrice'] . '</td>';
                                echo '<td>' . '<strong>DELIVERED</strong>' . '</td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="mb-3">
                <a href="/user/<?= $user['id'] ?>/personalProfile/logout">
                    <button class="btn btn-primary">Log Out</button>
                </a>
            </div>
        </div>
    </div>

    <?php include(ROOT . '/resources/templates/footer.php'); ?>
</body>
</html>