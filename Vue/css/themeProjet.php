
<style>
            /*body*/
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                display: flex;
                align-items: center;
                min-height: 100vh;
                background-color: #f9f9f9;
            }
            form {
                display: flex;
                flex-direction: column;
                gap: 8px;
                width: 100%;
            }
            label {
                font-weight: bold;
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

             /*Filtre de recherche*/
             .container_filtre {
                display: flex;
                flex-direction: column;
                align-items: center; /* Aligne tous les éléments au centre */
                margin-top: 20px;
                position:fixed;
                top:20%;
                left:3%;
                transform: translateX(25%);  /* Pas de décalage initial */
                opacity: 1; /* Transparent au départ */
                transition: transform 0.4s ease; /* Transition fluide */
            }
            .container_filtre.active{
                transform: translateX(0); /* Position finale */
                opacity: 1; /* Complètement opaque */
            }
            .container_filtre h2 {
                display: inline-block; /* Pour garder le titre à côté du bouton */
                margin-right: 10px; /* Espace entre le titre et le bouton */
            }
            .input_filtre {
                max-width: 190px;
                background-color: #f5f5f5;
                color: #242424;
                padding: .15rem .5rem;
                min-height: 40px;
                border-radius: 4px;
                outline: none;
                border: none;
                line-height: 1.15;
                box-shadow: 0px 10px 20px -18px;
            }
            .input_filtre:focus {
                border-bottom: 2px solid #5b5fc7;
                border-radius: 4px 4px 2px 2px;
            }
            .input_filtre:hover {
                outline: 1px solid lightgrey;
            }

             /*button ajouter*/ 
             .button_add {
                position: relative;
                width: 150px;
                height: 40px;
                cursor: pointer;
                display: flex;
                align-items: center;
                border: 1px solid #34974d;
                background-color: #3aa856;
                margin-left: 10px;
                }
            .button_add, .button__icon, .button__text {
                transition: all 0.3s;
            }
            .button_add .button__text {
                transform: translateX(30px);
                color: #fff;
                font-weight: 600;
            }
            .button_add .button__icon {
                position: absolute;
                transform: translateX(109px);
                height: 100%;
                width: 39px;
                background-color: #34974d;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .button_add .svg {
                width: 30px;
                stroke: #fff;
            }
            .button_add:hover {
                background: #34974d;
            }
            .button_add:hover .button__text {
                color: transparent;
            }
            .button_add:hover .button__icon {
                width: 148px;
                transform: translateX(0);
            }
            .button_add:active .button__icon {
            background-color: #2e8644;
            }
            .button_add:active {
                border: 1px solid #2e8644;
            }

            /*Liste de tâche*/
            .divListeTache{
                position: fixed;
                top: 45%;
                left: 15%;
                /*transform: translate(10%, 0%);  Déplace le div pour le centrer */
                height:50% ;
                bottom:3% ;
                width: 450px;
                display: block;
                box-sizing: border-box;/*ajoute le padding au elements du scroll*/ 
                justify-content: center;
                flex-direction: column;
                transform: translateX(48%);  /* Pas de décalage initial */
                opacity: 1; /* Transparent au départ */
                transition: transform 0.4s ease; /* Transition fluide */
                overflow-y:auto; /* Permet de faire défiler le contenu verticalement */
                background: #f1f1f1;
                background-image: linear-gradient(90deg,transparent 50px,#ffb4b8 50px, #ffb4b8 52px,transparent 52px),linear-gradient(#e1e1e1 0.1em, transparent 0.1em);
                background-size: 100% 30px;
                border-radius: 15px;
                /*padding-bottom:500px;
                padding-top: 410px;   Ajoutez un padding-top pour décaler un peu le contenu */
            }
            .divListeTache.active{
                transform: translateX(0); /* Position finale */
                opacity: 1; /* Complètement opaque */
            }
            .button_liste {
                display: inline-block;
                border-radius: 7px;
                font-family: 'Freestyle Script';
                background-color: transparent;
                border: none;
                color: black;
                text-align: left;
                font-size: 17px;
                padding: 12px;
                width:95%;
                transition: all 0.5s;
                cursor: pointer;
                margin: 5px;
            }
            .button_liste span {
                cursor: pointer;
                display: inline-block;
                position: relative;
                transition: 0.5s;
                font-size: 30px;
            }
            .button_liste span:after {
                content: '»';
                position: absolute;
                opacity: 0;
                top: 0;
                right: -15px;
                transition: 0.5s;
            }
            .button_liste:hover span {
                padding-right: 15px;
            }
            .button_liste:hover span:after {
                opacity: 1;
                right: 0;
            }

            /*checkbox*/
            .checkbox-wrapper input[type='checkbox'] {
                visibility: hidden;
                display: none;
            }
            .checkbox-wrapper *,.checkbox-wrapper ::after,.checkbox-wrapper ::before {
                box-sizing: border-box;
                user-select: none;
            }
            .checkbox-wrapper {
                position: relative;
                overflow: hidden;
                display: flex;
                align-items: center;
            }
            .checkbox-wrapper .label {
                cursor: pointer;
            }
            .checkbox-wrapper .check {
                width: 50px;
                height: 50px;
                position: absolute;
                opacity: 0;
            }
            .checkbox-wrapper .label svg {
                vertical-align: middle;
            }
            .checkbox-wrapper .path1 {
                stroke-dasharray: 400;
                stroke-dashoffset: 400;
                transition: .5s stroke-dashoffset;
                opacity: 0;
            }
            .checkbox-wrapper .check:checked + label svg g path {
                stroke-dashoffset: 0;
                opacity: 1;
            }

            /*form*/
            .information {
                width: 30%;
                background: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
                display: none; /* Masque le formulaire par défaut */
                position: fixed;
                left: 66%;
                width: 30%;
                /*right: -100%;  Position initiale hors écran à droite */
                flex-direction: column;
                align-items: center; /* Centre les éléments à l'intérieur */
                transform: translateX(30%);  /* Pas de décalage initial */
                opacity: 0; /* Transparent au départ */
                transition: transform 0.4s ease, opacity 0.4s ease; /* Transition fluide */
            }
            .information.active{
                transform: translateX(0); /* Position finale */
                opacity: 1; /* Complètement opaque */
            }
            .information h1 {
                text-align: center;
                margin-bottom: 10px;
            }
            .buttons_form {
                display: flex;
                justify-content: space-between; /* Aligne les boutons horizontalement */
                margin-top: 20px;
            }
            .buttons_form button {
                padding: 10px 20px;
                font-size: 14px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            .buttons_form .add {
                background-color: #007BFF;
                color: white;
            }
            .buttons_form .add:hover {
                background-color: #0056b3;
            }
            .buttons_form .cancel {
                background-color: #6c757d;
                color: white;
            }
            .buttons_form .cancel:hover {
                background-color: #5a6268;
            }
            .buttons_form .delete {
                background-color: #dc3545;
                color: white;
            }
            .buttons_form .delete:hover {
                background-color: #c82333;
            }
</style>