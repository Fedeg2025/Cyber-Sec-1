<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cyber Sec</title>

    <!-- CSS principal -->
    <link rel="stylesheet" href="../css/style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

<header>

    <div class="header-container">

        <div class="logo">
            <h1>Cyber Sec</h1>
            <p>Experts en cybersécurité et protection des systèmes informatiques</p>
        </div>

        <!-- Burger menu -->
        <button class="burger" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </button>

    </div>

    <nav>

        <ul class="menu" id="menu">

            <li>
                <a href="/Projet Quizz/index.php">
                    Accueil
                </a>
            </li>

            <li>
                <a href="/Projet Quizz/Views/candidats/home.php">
                    Candidature
                </a>
            </li>

            <li>
                <a href="/Projet Quizz/Views/candidats/register.php">
                    Inscription
                </a>
            </li>

            <li>
                <a href="#">
                    Services
                </a>
            </li>

            <li>
                <a href="#">
                    Contact
                </a>
            </li>

        </ul>

    </nav>

</header>

<main>

<script>

function toggleMenu() {

    const menu = document.getElementById("menu");
    menu.classList.toggle("active");

}

</script>