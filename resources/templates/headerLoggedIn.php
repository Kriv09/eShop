<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="/">eShop</a>
        <div class="collapse navbar-collapse" style="display: flex; justify-content: space-between;">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/donation">Donate</a>
                </li>
            </ul>
        </div>
    <a class="navbar-brand" href="/">
        <a href="/user/<?php if(isset($user)) { echo $user['id']; } else { echo $user_id; } ?>/cart">
            <img src="/resources/images/cartIcon.png" alt="Cart icon..." style="width: 30px; height: 30px; margin-right: 15px;" class="cart">
        </a>
        <a href="/user/<?php if(isset($user)) { echo $user['id']; } else { echo $user_id; } ?>/personalProfile">
            <img src="/resources/images/userIcon.png" alt="User Registration..." style="width: 30px; height: 30px; ">
        </a>
    </a>
</nav>