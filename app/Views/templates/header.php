<!doctype html>
<html class="h-100">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My tutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Bootstrap -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' rel='stylesheet'
        type='text/css'>
</head>
<style>
    main.container {
        padding: 60px 15px 0;
    }

    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 100;

    }

    .popup form {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .popup form label {
        display: block;
        margin-bottom: 10px;
    }

    .popup form input[type="text"],
    .popup form input[type="password"],
    .popup form input[type="email"],
    .popup form button[type="submit"] {
        display: block;
        margin-bottom: 10px;
        padding: 5px;
        border-radius: 3px;
        border: 1px solid gray;
    }

    .popup form button[type="submit"] {
        background-color: #4CAF50;
        color: white;
    }

    .calendar-day {
        display: inline-block;
        vertical-align: top;
        margin-right: 10px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 10px;
        width: 150px;
    }

    .calendar-day-header {
        text-align: center;
        font-weight: bold;
        margin-bottom: 10px;
        background-color: #007bff;
        color: #fff;
        border-radius: 4px 4px 0 0;
        padding: 5px;
    }

    .calendar-day-body {
        border: 1px solid #dee2e6;
        padding: 10px;
        min-height: 50px;
    }

    .calendar-time-slot {
        margin-bottom: 5px;
        background-color: #fff;
        border-radius: 4px;
        padding: 5px;
        border: 1px solid #dee2e6;
    }
</style>



<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">MyTutor</a>
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <!--if student then go to student profile if tutor go to tutor profile id admin go to admin list-->
                        <?php if (session()->get('role') == 'student'): ?>
                            <a class="nav-link" href="<?php echo ('/student/profile') ?>">Profile</a>
                        <?php elseif (session()->get('role') == 'tutor'): ?>
                            <a class="nav-link" href="<?php echo ('/tutor/profile') ?>">Profile</a>
                        <?php elseif (session()->get('role') == 'admin'): ?>
                            <a class="nav-link" href="<?php echo ('/admin/list') ?>">Admin</a>
                        <?php endif; ?>
                    </li>
                </ul>
                <div class="collapse navbar-collapse justify-content-center" id="navbarCenteredExample">

                </div>

                <!--if not logged in show login and register button -->
                <?php if (!session()->get('isLoggedIn')): ?>

                    <div class="d-flex">
                        <a id="login-button" class="btn btn-outline-primary" role="button"
                            href="<?php echo ('/user/login') ?>">Login</a>
                        <!--Para redirigir usar echo-->
                        <a id="register-button" class="btn btn-outline-primary" role="button"
                            href="<?php echo ('/user/register') ?>">Register</a>

                    </div>
                <?php else: ?>
                    <!--if logged in show logout button -->
                    <div class="d-flex">
                        <a id="logout-button" class="btn btn-outline-primary" role="button"
                            href="<?php echo ('/user/logout') ?>">Logout</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>


<!-- Begin page content -->
<main>
    <div>
        <!-- nav => navigation bar 
     for href, use the same format as autorouting: /controller/method/arg
-->