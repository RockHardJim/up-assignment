<!DOCTYPE html>
<html lang="en">
<head>
    <!-- meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>UP Assignment Gaming Site</title>
    <!-- vendor css -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" href="<?php use App\kernel\Session;

    echo URL; ?>assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>assets/plugins/animate/animate.min.css">
    <!-- plugins css -->
    <link href="<?php echo URL; ?>assets/plugins/owl-carousel/css/owl.carousel.min.css" rel="stylesheet">
    <!-- theme css -->
    <?php

    if(Session::userIsLoggedIn()){

        $user = $_SESSION['user'];

        if($user['theme'] === 'dark'){
    ?>
    <link rel="stylesheet" href="<?php echo URL; ?>assets/css/theme.css">

    <?php
    }else{
            ?>
            <link rel="stylesheet" href="<?php echo URL; ?>assets/css/light.css">
    <?php
        }
    }
    ?>

    <link rel="stylesheet" href="<?php echo URL; ?>assets/css/theme.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .light-mode {
            background-color: white;
            color: black;
        }
    </style>
</head>
<body class="fixed-header">
<!-- header -->
<header id="header">
    <div class="container">
        <div class="navbar-backdrop">
            <div class="navbar">
                <div class="navbar-left">
                    <a class="navbar-toggle"><i class="fa fa-bars"></i></a>
                    <a href="<?php echo URL; ?>default/index" class="logo">UP-Gamerz</a>
                    <nav class="nav">
                        <ul>
                            <li>
                                <a href="<?php echo URL; ?>default/index">Home</a>
                            </li>

                            <li>
                                <a href="<?php echo URL; ?>default/games">Games</a>
                            </li>

                            <li>
                                <a href="<?php echo URL; ?>default/gamers">Gamers</a>
                            </li>

                            <li>
                                <a href="<?php echo URL; ?>default/about">About</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="nav navbar-right">
                    <ul>
                        <?php

                        if(isset($_SESSION['user_logged_in'])){
                            $user = $_SESSION['user'];
                        ?>

                            <ul>
                                <li class="dropdown dropdown-profile">
                                    <a href="login.html" data-toggle="dropdown"><img src="<?php echo 'https://www.gravatar.com/avatar/"' . md5( strtolower( trim( $user->email ) ) ); ?>" alt=""> <span><?php echo ucfirst($user->name) .' ' . ucfirst($user->surname) ?></span></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="<?php echo URL; ?>dashboard/index"><i class="fa fa-user"></i> My Dashboard</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-envelope-open"></i> Inbox</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-heart"></i> Games</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-cog"></i> Settings</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?php echo URL; ?>auth/logout"><i class="fa fa-sign-out"></i> Logout</a>
                                    </div>
                                </li>
                            </ul>
                        <?php
                        }else{
                        ?>
                        <li class="hidden-xs-down"><a href="<?php echo URL; ?>auth/login">Login</a></li>
                        <li class="hidden-xs-down"><a href="<?php echo URL; ?>auth/register">Register</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>