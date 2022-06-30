<?php

namespace Controllers;

require_once('libraries/autoload.php');


class Comment extends Controller
{
    protected $modelName = \Models\Comment::class;

    public function insert()
    {

        $articleModel = new \Models\Article();
        
        // On recupere l'auteur
        $author = $_SESSION['username'];

        // Ensuite le contenu
        $content = null;
        if (!empty($_POST['content'])) {
            // On sécurise l'entrée du commentaire
            $content = htmlspecialchars($_POST['content']);
        }

        // On récupère l'id de l'article
        $article_id = null;
        if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
            $article_id = $_POST['article_id'];
        }

        // Vérification finale des infos envoyées dans le formulaire (donc dans le POST)
        // Si il n'y a pas d'auteur ou qu'il n'y a pas de contenu ou qu'il n'y a pas d'identifiant d'article
        if (!$author || !$article_id || !$content) {
            die("Votre formulaire a été mal rempli !");
        }

        // Vérification que l'id de l'article pointe bien vers un article qui existe
        $article = $articleModel->find($article_id);

        // Si rien n'est revenu, on fait une erreur
        if (!$article) {
            die("Ho ! L'article $article_id n'existe pas boloss !");
        }

        $id_user = $_SESSION['id'];
        // Insertion du commentaire
        $this->model->insert($author, $content, $article_id, $id_user);

        // Redirection vers l'article en question :
        \Http::redirect('index.php?controller=article&task=show&id=' . $article_id);
    }

    public function delete()
    {

        // Si l'utilisateur est connecté
        if (isset($_SESSION)) {

            // Récupération du paramètre "id" en GET
            
            if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
                die("Ho ! Fallait préciser le paramètre id en GET !");
            }

            $id = $_GET['id'];

            // Vérification de l'existence du commentaire            
            $commentaire = $this->model->find($id);
            if (!$commentaire) {
                die("Aucun commentaire n'a l'identifiant $id !");
            }

            
            // On récupère l'identifiant de l'article avant de supprimer le commentaire 
             $article_id = $commentaire['article_id'];

             if ($_SESSION['role_admin'] == '1' || $_SESSION['id'] == $commentaire['id_user']) {
                // Suppression du commentaire
                $this->model->delete($id);
            }

            /**
             * 5. Redirection vers l'article en question
             */
            \Http::redirect('index.php?controller=article&task=show&id=' . $article_id);
        }
    }
}
