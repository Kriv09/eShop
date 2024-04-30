<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eShop</title>
    
    <?php include ROOT . '/resources/templates/defaultLibraries.php'; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <style>
        .fixed-top { z-index: 1030; }
        .fixed-bottom { z-index: 1030; }
        .content { margin-top: 70px; margin-bottom: 70px; }
        .navbar-nav { margin: 0 auto; }
        .navbar { padding: 0.5rem 1rem; } /* Add this line */

        .card {
            transition: transform 0.3s ease-in-out;  /* Add this line */
        }

        .card:hover {
            transform: scale(1.05);  /* Add this line */
        }
        .smaller {
            padding: 0.25rem 0.5rem;
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

    
    <div class="content">
        
        <div style="max-width: 47%; margin: auto;">
            <form class="d-flex mt-5 mb-4" id="search-form" method="post" action="/">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="q">
                <button class="btn btn-outline-success smaller" type="submit">Search</button>
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

                <div class="col-md-9">
                    <div class="row" id="products-container">
                    <?php 
                        if(isset($_POST['q'])) {
                            $allProducts = Product::searchProducts($_POST['q']); 
                        }
                        if(!$allProducts)
                        {
                            $searchQuery = $_POST['q'];
                            echo "
                                <div class=\"col-md-12 p-4\">
                                <div class=\"card m-2 p-4\">

                                    <h3 class=\"text-center\">No products found by \"$searchQuery\"</h1>
                                </div>
                                </div>
                            ";
                        }
                    ?>

                        <?php foreach ($allProducts as $product): ?>
                            <div class="col-md-4">
                                <div class="card m-2">

                                    <img class="card-img-top p-4" src="<?= $product['image'] ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title"> <?= $product['name'] ?> </h5>
                                        <p class="card-text"> <?= $product['description'] ?> </p>
                                        <p class="card-text"><i style="opacity: 0.5;"><?= Product::getProductSeller($product['id'])['name'] ?></i></p>
                                        <p class="card-text"><strong>$<?= $product['price'] ?></strong> </p>
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
    </div

    <?php require_once(ROOT . '/resources/templates/footer.php'); ?>
</body>
</body>
</html>