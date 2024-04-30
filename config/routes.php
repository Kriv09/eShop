<?php

return [
    // 'product/([0-9]+)' => 'product/view/$1',
    // 'catalog' => 'catalog/index',
    // 'category/([0-9]+)' => 'catalog/category/$1',
    // '' => 'site/index',
    'category/([a-zA-Z]+)' => 'category/showByName/$1',
    'user/([0-9]+)/processOrder' => 'user/processOrder/$1',
    'user/([0-9]+)/removeProduct/([0-9]+)' => 'user/removeProduct/$1/$2',
    'user/([0-9]+)/buyProduct/([0-9]+)' => 'user/buyProduct/$1/$2',
    'user/([0-9]+)/cart' => 'user/cart/$1',
    'user/([0-9]+)/verifyEmail' => 'user/verifyEmail/$1',
    'user/([0-9]+)/processEmailVerif' => 'user/emailVerification/$1',
    'user/([0-9]+)/personalProfile/logout' => 'user/logout',
    'user/([0-9]+)/personalProfile' => 'user/personalProfile/$1',
    'user/login' => 'user/login',
    'user/register' => 'user/register',
    'donation' => 'home/donation',
    'about' => 'home/about',
    'contact' => 'home/contact',
    'product/([0-9]+)' => 'product/view/$1',
    '' => 'home/index'
];

?>
