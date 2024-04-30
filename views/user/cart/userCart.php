<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Cart</title>
    <?php include(ROOT . '/resources/templates/defaultLibraries.php'); ?>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            position: relative;
        }
    </style>
</head>
<body>
    <?php include(ROOT . '/resources/templates/headerLoggedIn.php'); ?>
    
    <?php if (empty($allUserProducts)): ?>
        <div class="container mt-5">
            <h2 class="text-center">Your Cart is Empty</h2>
            <h3 class="text-center"><a href="/">Home</a></h3>
        </div>
        <?php include(ROOT . '/resources/templates/footer.php'); ?>
        <?php exit; ?>
    <?php endif; ?>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Your Cart</h2>
        <table class="table table-striped mx-auto" style="width: 80%;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($allUserProducts as $product): ?>
                <tr>
                    <th scope="row"><?=$product->number ?></th>
                    <td><?=$product->name ?></td>
                    <td><?=$product->quantity ?></td>
                    <td>$<?=$product->price ?></td>
                    <td>$<?=$product->total ?></td>
                    <td><a class="btn btn-primary" href="/user/<?= $user['id'] ?>/removeProduct/<?=$product->id ?>">Remove</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <h4>Total Price: $<?= $totalPrice ?></h4>
        </div>
        <div class="text-center">
            <a class="btn btn-primary" href="/user/<?= $user['id']?>/processOrder">Order</a>
        </div>
    </div>

    <?php include(ROOT . '/resources/templates/footer.php'); ?>
</body>
</html>