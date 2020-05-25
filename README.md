#                                                       raccourcirUrl

 SHORT-URL est fait pour raccourcir les urls, le tout est codé en PHP, pour le design du site j'ai opté pour un CSS simple 
 et je ne voulais pas utilser Bootstrap, mais bien sur du Javascript.


# Config (connection basse de donnée):
    - Dans ce fichier, c'est les constantes pour pouvoir vous connecter à votre base de donnée.
      Vous n'aurez qu'a rentrer vos valeur à la place des commentaires.


 J'ai préferé simplifier grâce à deux fonction qui gérent toute la logique du traitement.

# verif('x') :
    -Cette fonction a pour but de vérifier si l'url n'est pas présente dans la basse de données.
    -Mais permet aussi la redirection avec l'url simplifiée.

        function verif($x){
            if(isset($_GET[$x])){
                $shorcut = htmlspecialchars($_GET[$x]);
                connect();  
                existUrl($shorcut);
                //redirection
                redirect($shorcut);   
            }
        }    


# newPost('url') :
    - newPost() permet de vérifier si l'url et valide ou pas et de l'enregistrer si elle est correct.

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

