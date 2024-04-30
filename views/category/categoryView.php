<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eShop</title>
    
    <?php include ROOT . '/resources/templates/defaultLibraries.php'; ?>
    <style>
        .fixed-top { z-index: 1030; }
        .fixed-bottom { z-index: 1030; }
        .content { margin-top: 70px; margin-bottom: 70px; }
        .navbar-nav { margin: 0 auto; }
        .navbar { padding: 0.5rem 1rem; } /* Add this line */
    </style>
</head>
<body>

    <?php 
        if($user_id == "None")
            require_once(ROOT . '/resources/templates/header.php'); 
        else
            require_once(ROOT . '/resources/templates/headerLoggedIn.php');
    ?>

    <div class="content">
        <div style="max-width: 47%; margin: auto;">
            <form class="d-flex mt-5 mb-4" method="post" action="/">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="q">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="list-group">
                        <?php foreach ($allCategories as $category): ?>
                            <a href="/category/<?= $category['name'] ?>" class="list-group-item list-group-item-action"> <?= $category['name'] ?> </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php 
                        if(isset($_POST['q'])) {
                            $categoryProducts = Product::searchProducts($_POST['q']); 
                            $categoryProducts = Category::filterProducts($categoryProducts,$category['name']);
                        }
                ?>

                <div class="col-md-9">
                    <div class="row">
                        <?php foreach ($categoryProducts as $product): ?>
                            <div class="col-md-3">
                                <div class="card">
                                    <img class="card-img-top" src="<?= $product['image'] ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title"> <?= $product['name'] ?> </h5>
                                        <p class="card-text"> <?= $product['description'] ?> </p>
                                        <p class="card-text"><strong>$<?= $product['price'] ?></strong></p>
                                        <a href="/product/<?= $product['id'] ?>/viewProduct" class="btn btn-primary">View</a>
                                        <a href="/user/<?= $user_id ?>/buyProduct/<?= $product['id'] ?>" class="btn btn-primary" onclick="alert('Product was added to cart')">Buy</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require_once(ROOT . '/resources/templates/footer.php'); ?>
</body>
</html>