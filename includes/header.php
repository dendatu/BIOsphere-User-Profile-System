<?php
    if (!isset($currentPage)) {
        $currentPage = "";
    }
?>

<!DOCTYPE html>
<html>

<head>

    <title>SkillConnect</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>

        /* ======================================================
        GLOBAL STYLES (APPLIES TO ALL PAGES)
        ====================================================== */

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Segoe UI", Helvetica, Arial, sans-serif;
            background: #f0f2f5;
            color: #333;
        }

        /* MAIN AREA */

        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
            padding: 20px;
        }

        /* ======================================================
        NAVIGATION BAR (ALL PAGES)
        ====================================================== */

        .navbar {
            background: white;
            border-bottom: 1px solid #ddd;
            padding: 12px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            color: #1877f2;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-links a {
            margin-left: 20px;
            text-decoration: none;
            color: #444;
            font-size: 14px;
            padding-bottom: 4px;
        }

        .nav-links a:hover {
            color: #1877f2;
        }

        .active {
            color: #1877f2;
            border-bottom: 2px solid #1877f2;
        }

        /* ======================================================
        SHARED COMPONENTS (FORMS / CARDS / BUTTONS)
        ====================================================== */

        .card {
            width: 420px;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #1877f2;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: none;
            border-radius: 6px;
            background: #1877f2;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #166fe5;
        }

        .secondary {
            background: #42b72a;
        }

        .secondary:hover {
            background: #36a420;
        }

        .form-group {
            text-align: left;
            margin-bottom: 12px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #333;
        }

        .message {
            color: #e63946;
            margin-top: 10px;
        }

        /* ======================================================
        LANDING PAGE STYLES
        ====================================================== */

        .landing {
            width: 100%;
            max-width: 1200px;
            margin: auto;
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 80px 20px;
            gap: 40px;
            min-height: 500px;

            background:
                linear-gradient(rgb(2,34,94), rgba(255,255,255,0.89), rgba(255,255,255,0.41)),
                url('assets/hero_image.png');

            background-size: cover;
            background-position: center;
            color: white;
        }

        .hero-text {
            flex: 1;
        }

        .hero-text h1 {
            font-size: 42px;
            margin-bottom: 20px;
            line-height: 1.2;
            color: white;
            text-shadow: 2px 2px 4px #000;
        }

        .hero-text p {
            font-size: 16px;
            color: black;
            margin-bottom: 30px;
            max-width: 500px;
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
        }

        .hero-image {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        .hero-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            width: 260px;
        }

        .hero-card h3 {
            margin-bottom: 10px;
        }

        .hero-card ul {
            margin-left: 20px;
            color: #555;
        }

        .primary-btn {
            padding: 12px 22px;
            background: #1877f2;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .primary-btn:hover {
            background-color: #001c5c;
        }

        .secondary-btn {
            padding: 12px 22px;
            background: white;
            border: 2px solid #1877f2;
            color: #1877f2;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .secondary-btn:hover {
            background: #1877f2;
            color: white;
        }

        .big-btn {
            font-size: 18px;
            padding: 14px 28px;
        }

        /* FEATURES */

        .features {
            padding: 60px 20px;
            text-align: center;
        }

        .features h2 {
            font-size: 30px;
            margin-bottom: 40px;
        }

        .highlight-blue {
            color: #1878f2;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
            gap: 30px;
        }

        .feature {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .feature:hover {
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        /* CTA */

        .cta {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 80px 20px;
            background:
                linear-gradient(rgb(2,34,94), rgba(125,176,253,0.89)),
                url('assets/hero_image.png');
            background-size: cover;
            background-position: center;
            color: white;
            border-radius: 12px;
            margin: 40px 20px;
        }

        .cta-content h2 {
            font-size: 28px;
            margin-bottom: 30px;
            line-height: 1.3;
        }

        .cta-btn {
            display: inline-block;
            padding: 16px 36px;
            background-color: white;
            color: #1877f2;
            font-weight: bold;
            font-size: 18px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .cta-btn:hover {
            background-color: #042652;
            color: white;
            transform: scale(1.05);
        }

        /* PROFILE PAGE */

        .profile-page {
            width: 100%;
            max-width: 1000px;
            margin: auto;
        }

        .profile-cover {
            width: 100%;
            height: 260px;
            background:
                linear-gradient(rgb(2,34,94), rgba(255,255,255,0.89), rgba(255,255,255,0.41)),
                url('assets/hero_image.png');
            background-size: cover;
            background-position: center;
            position: relative;
            border-radius: 8px;

            display: flex;
            justify-content: center;
            align-items: flex-end;
        }

        .profile-avatar {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            object-fit: cover;
            border: 6px solid white;
            background: #eee;
            position: relative;
            bottom: -80px;
        }

        .profile-info {
            margin-top: 100px;
            padding: 20px 40px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .skills {
            background: #f0f2f5;
            padding: 10px;
            border-radius: 6px;
            margin-top: 10px;
        }

        .preview-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-top: 10px;
            display: none;
            border: 3px solid #ddd;
        }

    </style>

</head>

<body>

<div class="navbar">

    <div class="logo">
        <img style="width: 30px; height: 30px;" src="assets/logo.png">
        BIOsphere
    </div>

    <div class="nav-links">

        <?php if ($currentPage == "profile") { ?>

            <a href="logout.php"
               style="background-color:#1877f2;color:white;padding:10px 20px;text-decoration:none;border-radius:4px;">
                Logout
            </a>

        <?php } else { ?>

            <a href="index.php" class="<?php if ($currentPage == "home") echo 'active'; ?>">Home</a>

            <a href="login.php" class="<?php if ($currentPage == "login") echo 'active'; ?>">Login</a>

            <a href="register.php" class="<?php if ($currentPage == "register") echo 'active'; ?>">Register</a>

        <?php } ?>

    </div>

</div>

<div class="main">