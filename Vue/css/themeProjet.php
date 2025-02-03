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
h2 {
    font-family: 'Freestyle Script', Arial, sans-serif;
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

/*Nom et Bienvenu*/
.bienvenu{
    position: fixed;
    top:15%;
    left: 1%;
    font-family: 'Freestyle Script';
    font-size: 40px;
}

 /*Filtre de recherche*/
.container_filtre {
    display: flex;
    flex-direction: column;
    align-items: center; /* Aligne tous les éléments au centre */
    margin-top: 20px;
    position:fixed;
    top:15%;
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
    font-family: Arial, sans-serif;
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

/*button recherche*/
.button_search {
background-color: transparent;
border: 2px solid #000;
border-radius: 0;
box-sizing: border-box;
color: #fff;
cursor: pointer;
display: inline-block;
float: right;
font-weight: 700;
letter-spacing: 0.05em;
margin-left: 14px;
outline: none;
overflow: visible;
padding: 1.25em 2em;
position: relative;
text-align: center;
text-decoration: none;
text-transform: none;
transition: all 0.3s ease-in-out;
user-select: none;
font-size: 8.5px;
}

.button_search::before {
content: " ";
width: 1rem;
height: 2px;
background: black;
top: 50%;
left: 1.5em;
position: absolute;
transform: translateY(-50%);
transform-origin: center;
transition: background 0.3s linear, width 0.3s linear;
}

.button_search .text {
font-size: 1.125em;
line-height: 1.33333em;
padding-left: 2em;
display: block;
text-align: left;
transition: all 0.3s ease-in-out;
text-transform: uppercase;
text-decoration: none;
color: black;
}

.button_search .top-key {
height: 2px;
width: 1.5625rem;
top: -2px;
left: 0.625rem;
position: absolute;
background: #e8e8e8;
transition: width 0.5s ease-out, left 0.3s ease-out;
}

.button_search .bottom-key-1 {
height: 2px;
width: 1.5625rem;
right: 1.875rem;
bottom: -2px;
position: absolute;
background: #e8e8e8;
transition: width 0.5s ease-out, right 0.3s ease-out;
}

.button_search .bottom-key-2 {
height: 2px;
width: 0.625rem;
right: 0.625rem;
bottom: -2px;
position: absolute;
background: #e8e8e8;
transition: width 0.5s ease-out, right 0.3s ease-out;
}

.button_search:hover {
color: white;
background: black;
}

.button_search:hover::before {
width: 0.9375rem;
background: white;
}

.button_search:hover .text {
color: white;
padding-left: 1.5em;
}

.button_search:hover .top-key {
left: -2px;
width: 0px;
}

.button_search:hover .bottom-key-1,
.button_search:hover .bottom-key-2 {
right: 0;
width: 0;
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
    width: 37%;
    display: block;
    
    justify-content: center;
    flex-direction: column;
    transform: translateX(42%);  /* Pas de décalage initial */
    opacity: 1; /* Transparent au départ */
    transition: transform 0.4s ease; /* Transition fluide */
    overflow-y:auto;
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
.checkbox-wrapper input[type="checkbox"] {
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
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    display: none; /* Masque le formulaire par défaut */
    position: fixed;
    left: 66%;
    width: 30%;
    height: 92%;
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
/*loarder*/
#container_filtre1{
    font-family:'Freestyle Script';
    position:flex;
    margin: 2%;
}
#container_filtre2{
    display: block;
    position:flex;
    overflow-y:auto; /* Permet de faire défiler le contenu verticalement */
}
.cta {
position: relative;
margin: auto;
padding: 12px 18px;
transition: all 0.2s ease;
border: none;
background: none;
cursor: pointer;
}

.cta:before {
content: "";
position: absolute;
top: 0;
left: 0;
display: block;
border-radius: 50px;
background: #b1dae7;
width: 45px;
height: 45px;
transition: all 0.3s ease;
}

.cta span {
position: relative;
font-family: "Freestyle Script", sans-serif;
font-size: 23px;
font-weight: 700;
letter-spacing: 0.05em;
color: #234567;
}

.cta svg {
position: relative;
top: 0;
margin-left: 10px;
fill: none;
stroke-linecap: round;
stroke-linejoin: round;
stroke: #234567;
stroke-width: 2;
transform: translateX(-5px);
transition: all 0.3s ease;
}

.cta:hover:before {
width: 100%;
background: #b1dae7;
}

.cta:hover svg {
transform: translateX(0);
}

.cta:active {
transform: scale(0.95);
}
</style>