<?php
/**
 * Created by PhpStorm.
 * User: drumt
 * Date: 07/11/2018
 * Time: 16:53
 */
session_start();
if (!isset($_SESSION['logged'])) {
    $_SESSION['logged'] = 0;
}
if (!isset($_SESSION['items'])) {
    $_SESSION['items'] = [];
}

//redirect if not logged
if ($_SESSION['logged'] == 0 &&
    ((isset($_GET['add_to_cart']) && !empty($_GET['add_to_cart'])) ||
        (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] === '/cart.php'))) {
    header('Location: /login.php', true, 302);
} else {
    if ($_SESSION['logged'] == 1 && isset($_GET['add_to_cart']) && null != $_GET['add_to_cart']) {

        $id = (int)$_GET['add_to_cart'];
        $price = (int)$_GET['price'];
        $label = $_GET['label'];

        $key = array_search($id, array_column($_SESSION['items'], 'id'));
        if (!$key && is_bool($key)) {
            $_SESSION['items'][] = ['id' => $id, 'price' => $price, 'label' => $label, 'qty' => 1];
        } else {
            $_SESSION['items'][$key]['qty'] += 1;
        }
    }

    //store loginname in session
    if (isset($_POST['submit'])) {
        $_SESSION['loginname'] = $_POST['loginname'];
        $_SESSION['logged'] = 1;
        header('Location: /index.php', true, 302);
    }

    //destroy session tool
    if (isset($_GET['logout']) || isset($_REQUEST['delete'])) {
        session_destroy();
        header('Location: /');
    }
}