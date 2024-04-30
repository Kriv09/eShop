<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <?php include ROOT . '/resources/templates/defaultLibraries.php'; ?>
    <link rel="stylesheet" type="text/css" href="/views/site/css/aboutStyle.css">
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
            <h1 class="text-center">About Us</h1>
        </div>
        <div class="d-flex flex-column align-items-center mt-5">
            <div class="card my-4 animate-card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Author</h5>
                    <p class="card-text">The author of the shop is Nazar Kryvychko. He has a passion for creating unique and high-quality products. His dedication to quality and customer satisfaction has made this shop one of the best in the industry.</p>
                </div>
            </div>
            <div class="card my-4 animate-card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Products</h5>
                    <p class="card-text">
                        At out eShop, we prioritize customer satisfaction above all else. That's why we offer competitive prices, fast shipping, and exceptional customer service to ensure your shopping experience is nothing short of excellent.
                        Explore our eShop today and discover the latest in technology innovation. With our diverse range of products and commitment to quality, you're sure to find the perfect tech companion for your lifestyle.
                    </p>
                </div>
            </div>
            <div class="card my-4 animate-card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Feedbacks</h5>
                    <p class="card-text">
                    <b>John D. : </b> "I recently purchased a laptop from eShop, and I couldn't be happier with my experience. The ordering process was smooth, the laptop arrived quickly, and the quality exceeded my expectations. I'll definitely be returning for my future tech needs!"
                    </p>
                    <p class="card-text">
                    <b>Emily S. :</b> "I'm so impressed with the service I received from [Your eShop Name]. I ordered a smartphone for my daughter's birthday, and it arrived right on time. The customer support team was also incredibly helpful when I had questions about the product. Thanks for making my shopping experience stress-free!"
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php include ROOT . '/resources/templates/footer.php'; ?>
</body>
</html>