<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page non disponible</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        h1 {
            font-size: 4rem;
            color: #333;
            text-align: center;
        }
        /*la navbar*/
        .outline {
                position: absolute;
                inset: 0;
                pointer-events: none;
            }
            .rect {
                stroke-dashoffset: 5;
                stroke-dasharray: 0 0 10 40 10 40;
                transition: 0.5s;
                stroke: #333;
            }
            .nav {
                position: fixed;
                width: 400px;
                height: 60px;
                top:1%;
                left: 1%;
            }
            .container_nav:hover .outline .rect {
                transition: 999999s;
                /* Must specify these values here as something *different* just so that the transition works properly */
                stroke-dashoffset: 1;
                stroke-dasharray: 0;
            }
            .container_nav {
                position: absolute;
                inset: 0;
                background: #f0f0f0;
                display: flex;
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
                padding: 0.5em;
            }
            .btn {
                padding: 0.5em 1.5em;
                color: #333;
                cursor: pointer;
                transition: 0.1s;
            }
            .btn:hover {
                background:  #e2e2e2;
            }
    </style>
</head>
<body>
     <!--La navbar-->
     <?=$navbar?>
     
    <h1>Page non disponible</h1>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
                 //button de navigation
                const deconButton = document.getElementById("deconnexion");//button deconnexion
                const profButton = document.getElementById("profil");//button de profil
                const toDoButton = document.getElementById("toDoList");//button d'acceuil
                
                deconButton.addEventListener('click', function () {
                    window.location.href = "/../Projet-Web-I2-Todo-List/Routeur/routeur.php";
                });
                profButton.addEventListener('click', function () {
                    window.location.href = "/../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=profil";
                });
                toDoButton.addEventListener('click', function () {
                    window.location.href = "/../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=accueil";
                });
            });
    </script>
</body>
</html>
