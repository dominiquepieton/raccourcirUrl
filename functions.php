<?php
require_once 'config/config.php';

/**
 * Permet la connection à la bdd.
 *
 * @return void
 */
function connect(){
    return new PDO(HOST,USER,MDP);
}

/**
 * Permet la verification de l'url et return un message d'erreur si elle n'est pas correct
 *
 * @param string $shorcut
 * @return void
 */
function existUrl(string $shorcut){
    $req = connect()->prepare('SELECT COUNT(*) AS x FROM links WHERE shorcut = :shorcut');
    $req->execute([
        'shorcut' => $shorcut
    ]);
    while($result = $req->fetch()){
        if($result['x'] != 1){
            return header('Location: index.php?error=true&message=Adresse url non connue.');
            exit();
        }
    }
}

/**
 * Fait la redirection si elle est valide.
 *
 * @param string $shorcut
 * @return void
 */
function redirect(string $shorcut){
    $req = connect()->prepare('SELECT * FROM links WHERE shorcut = ?');
    $req->execute(array($shorcut));

    while($result = $req->fetch()){
        return header('Location: ' .$result['url']);
        exit();
    }
}

/**
 * Permet de reduire l'url
 *
 * @param [type] $url
 * @return void
 */
function short($url){
   return crypt($url, rand());
}

/**
 * Vérification de l'url. Si elle est déjà prèsente dans la bdd.
 *
 * @param [type] $url
 * @return void
 */
function nodouble($url){
    $req = connect()->prepare('SELECT COUNT(*) AS x FROM links WHERE url = :url');
    $req->execute([
        'url' => $url
    ]);
    while($result = $req->fetch()){
        if($result['x'] != 0){
           return header('Location: index.php?error=true&message=Adresse déjà raccourcie.');
            exit();
        }
    }
}

/**
 * Enregistre l'url dans la bdd
 *
 * @param [type] $url
 * @param [type] $shorcut
 * @return void
 */
function createUrl($url, $shorcut){
    $query = Connect()->prepare('INSERT INTO links (url, shorcut) VALUES(?,?)');
    $query->execute(array($url, $shorcut));
    return header('Location: index.php?short=' . $shorcut);
    exit();
}

/**
 * Vérification de l'url en totalité
 *
 * @param [type] $x
 * @return void
 */
function verif($x){
    if(isset($_GET[$x])){
        $shorcut = htmlspecialchars($_GET[$x]);
        connect();
        existUrl($shorcut);
        //redirection
        redirect($shorcut);   
    }
}

/**
 * Permet la vérification du doublon dans la bdd et si l'url est unique alors il l'enregistre.
 *
 * @param [type] $x
 * @return void
 */
function newPost($x){
    if (isset($_POST[$x])) {
        $url = $_POST[$x];
        //Vérification si valide
        if (!filter_var($url, FILTER_VALIDATE_URL)){
            return header('Location: index.php?error=true&message=Adresse url non valide');
            exit();
        }
        $shorcut = short($url);
        nodouble($url);
        createUrl($url, $shorcut);
    }
}