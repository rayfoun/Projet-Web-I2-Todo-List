<!DOCTYPE html>
<html>
    <head>
        <title>Projetweb/To-Do List/Modification</title>
        <link rel="stylesheet" type="text/css" href="<?=$themeCSS?>">
    </head>
    <style>
        /*Page*/
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            background-color: #f9f9f9;
        }
        label {
            font-weight: bold;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }

        input, textarea, select {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            resize: vertical;
        }
        button {
            display: inline-block;
            border-radius: 7px;
            background-color: #3d405b;
            border: none;
            color: #FFFFFF;
            text-align: center;
            font-size: 17px;
            padding: 16px;
            width:95%;
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;
        }
        /*navbar*/
        nav{
            background-color:rgba(17, 24, 39, 1);
            padding: 10px 20px;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px;
            transition: background-color 0.3s ease;
        }
        .profil-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
        }
        /*Form*/
        .information {
            width: 90%;
            max-width: 400px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;


            align-items: center; /* Centre les éléments à l'intérieur */
        }
        .information h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .buttons {
            display: flex;
            justify-content: space-between; /* Aligne les boutons horizontalement */
            margin-top: 20px;
        }

        .buttons button {
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .buttons .add {
            background-color: #007BFF;
            color: white;
        }

        .buttons .add:hover {
            background-color: #0056b3;
        }

        .buttons .cancel {
            background-color: #6c757d;
            color: white;
        }

        .buttons .cancel:hover {
            background-color: #5a6268;
        }

        .buttons .delete {
            background-color: #dc3545;
            color: white;
        }

        .buttons .delete:hover {
            background-color: #c82333;
        }
        .form-container {
            position: fixed;
            top: 0;
            right: -100%; /* Hors écran par défaut */
            width: 50%;
            height: 100%;
            background-color: #f9f9f9;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
            transition: right 0.5s ease;
            overflow-y: auto;
            padding: 20px;
        }

        .form-container.active {
            right: 10%; /* Affiche le formulaire */
        }
        /*liste de tâches*/
        .divListeTache{
            position: absolute;
            top: 57%;
            left: 53%;
            transform: translate(-50%, -20%); /* Déplace le div pour le centrer */
            height:50% ;
            width: 30%; /* Le div prend 40% de la largeur de la page */
            display: flex; /* Active Flexbox */
            justify-content: center;
            flex-direction: column;
        }

        button span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }

        button span:after {
            content: '»';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -15px;
            transition: 0.5s;
        }
        button:hover span {
            padding-right: 15px;
        }
        button:hover span:after {
            opacity: 1;
            right: 0;
        }
        /*filtre tâches*/
        .divFiltreTache{
            position: absolute;
            width: 51%;
            top: 35%; /* Centre verticalement */
            left: 52%; /* Centre horizontalement */
            transform: translate(-50%, -50%); /* Centre exact */
            display: flex; /* Active un modèle de boîte flexible */
            align-items: center; /* Aligne les éléments verticalement au centre */
        }
        .input_filtre {
            width: 20%;
            height: 7px;
            padding: 12px;
            margin-right: 3px;
            margin-left: 9px;
            border-radius: 7px;
            border: 1.5px solid lightgrey;
            outline: none;
            transition: all 0.3s cubic-bezier(0.19, 1, 0.22, 1);
            box-shadow: 0px 0px 20px -18px;
        }
        .input_filtre:hover {
            border: 2px solid lightgrey;
            box-shadow: 0px 0px 20px -17px;
        }

        .input_filtre:active {
            transform: scale(0.95);
        }

        .input_filtre:focus {
            border: 2px solid grey;
        }
        /*button ajouter*/
        .divFiltre{
            position: absolute;
            width: 50%;
            top: 25%; /* Centre verticalement */
            left: 52%; /* Centre horizontalement */
            transform: translate(-50%, -50%); /* Centre exact */
            display: flex; /* Active un modèle de boîte flexible */
            display: flex; /* Active Flexbox */
            justify-content: center; /* Centre horizontalement */
        }
        #bottone5 {
            align-items: center;
            background-color:rgb(178, 175, 175);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: .25rem;
            box-shadow: rgba(0, 0, 0, 0.02) 0 1px 3px 0;
            box-sizing: border-box;
            color: rgba(0, 0, 0, 0.85);
            cursor: pointer;
            display: inline-flex;
            font-family: system-ui,-apple-system,system-ui,"Helvetica Neue",Helvetica,Arial,sans-serif;
            font-size: 16px;
            font-weight: 600;
            justify-content: center;
            line-height: 1.25;
            min-height: 3rem;
            padding: calc(.875rem - 1px) calc(1.5rem - 1px);
            text-decoration: none;
            transition: all 250ms;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: baseline;
            width: auto;
        }

        #bottone5:hover,
        #bottone5:focus {
            border-color: rgba(0, 0, 0, 0.15);
            box-shadow: rgba(0, 0, 0, 0.1) 0 4px 12px;
            color: rgba(0, 0, 0, 0.65);
        }

        #bottone5:hover {
            transform: translateY(-1px);
        }

        #bottone5:active {
            background-color: #F0F0F1;
            border-color: rgba(0, 0, 0, 0.15);
            box-shadow: rgba(0, 0, 0, 0.06) 0 2px 4px;
            color: rgba(0, 0, 0, 0.65);
            transform: translateY(0);
        }
    </style>
    <body>
         <!-- Affichage de la navbar -->
        <?php echo $navbar; ?>
        <h1>Accueil</h1>

        <!-- Zone pour le formulaire -->
    <div class="form-container" id="taskForm">
        <?php echo $formTache; ?>
    </div>

        <!-- Affichage du filtre-->
        <?php echo $filtreTache; ?>
        <!-- Affichage de la liste des tache -->
        <?php echo $listeTache; ?>

        <script src="script.js"></script>
        <script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.getElementById('bottone5'); // Bouton
        const form = document.getElementById('taskForm'); // Formulaire

        button.addEventListener('click', function () {
            form.classList.toggle('active'); // Active ou désactive la classe
        });
    });
</script>

    </body>
</html>