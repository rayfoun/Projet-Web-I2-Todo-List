<?php
// Fonction globale renderComponent
function renderComponent($path) {
    return $path; // Traitement logique ici
}

$img = renderComponent(__DIR__ . "../../include/image/icon_profil.png");

$navbar = "
<div>
    <nav>
        <ul>
            <li><a href=''>To-Do List</a></li>
            <li><a href=''><img src='$img'></a></li>
        </ul>
    </nav> 
</div>
";

echo $navbar;
?>
