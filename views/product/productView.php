<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Name</title>
    <?php include ROOT . '/resources/templates/defaultLibraries.php'; ?>
    <style>
        .center-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
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

    <div class="container center-content">
        <div class="card mx-auto my-5" style="width: 18rem;">
            <img src="<?= $selectedProduct['image'] ?>" class="card-img-top p-4" alt="Product Image">
            <div class="card-body">
                <h5 class="card-title"><?= $selectedProduct['name'] ?></h5>
                <p class="card-text"><?= $selectedProduct['description'] ?></p>
                <p class="card-text"><strong>$<?= $selectedProduct['price'] ?></strong></p>
                <a href="/user/<?= $user_id ?>/buyProduct/<?= $selectedProduct['id'] ?>"><button class="btn btn-primary" onclick="alert('Product was added to carty')">Buy Now</button></a>
            </div>
        </div>
        <h2>About Seller</h2>
        <div class="card mx-auto my-5" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">
                    <?= $seller['name'] ?>
                    <div class="rating">
                        <?php for($i = 0; $i < $seller['rate']; $i++): ?>
                            <span class="fa fa-star checked">★</span>
                        <?php endfor; ?>
                    </div>
                </h5>
                
                <p class="card-text"><?= $seller['details'] ?></p>
                <a href="<?= $seller['about'] ?>" class="btn btn-primary"> More from this seller </a>
            </div>
        </div>
    </div>

    <?php include ROOT . '/resources/templates/footer.php'; ?>
</body>
</html>