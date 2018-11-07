<?php
/**
 * Created by PhpStorm.
 * User: drumt
 * Date: 07/11/2018
 * Time: 16:53
 */
session_start();

//redirect if not logged
if ((!$_SESSION['logged'] && isset($_GET['add_to_cart']) && $_GET['add_to_cart']) || (!$_SESSION['logged'] && isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] === '/cart.php')) {
    header('Location: /login.php', true, 302);
} else {
    if (null != $_GET['add_to_cart']) {
        $_SESSION['items'][] = ['id' => $_GET['add_to_cart']];
    }
}

//store loginname in session
if (isset($_POST['submit'])) {
    $_SESSION['loginname'] = $_POST['loginname'];
    $_SESSION['logged'] = true;
    header('Location: /index.php', true, 302);
}

//destroy session tool
if (isset($_GET['logout']) || isset($_REQUEST['delete'])) {
    session_destroy();
    header('Location: /');
}