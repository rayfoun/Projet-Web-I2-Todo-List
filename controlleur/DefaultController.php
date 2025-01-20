<?php
Class DefaultController{

    public function persit($entity){
        
    }

    protected function renderComponent($file) {
        ob_start(); // Démarrer la capture de sortie
        require $file; // Inclure le fichier du composant
        return ob_get_clean(); // Retourner la sortie capturée
    }


    protected function renderView ($vue, $tabParam=null){
        if($tabParam!=null) extract($tabParam);
        require $vue;
    }

    protected function renderWithLayout(string $template, String $composant, array $params=null){
        if($params !=null)extract ($params);

        //utilisation d'un "cache" pour récupéerer la flux de sortie
        ob_start();
        require $composant;
        $contenu = ob_get_clean();
        // => $contenu contient le "corps de la vue"

        // on appelle le layout, dans lequel le $contenu sera affiche
        require $template;
    }
}
?>