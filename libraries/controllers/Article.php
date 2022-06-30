<?php

namespace Controllers;

use Models\Article as ModelsArticle;

require_once('libraries/autoload.php');


class Article extends Controller
{

    protected $modelName = \Models\Article::class;

    public function index()
    {

        // Récupération des articles

        $articles = $this->model->findAll("created_at DESC");

        // Affichage

        $pageTitle = "Accueil";
        \Renderer::render('articles/index', compact('pageTitle', 'articles'));
    }

    public function show()
    {

        $commentModel = new \Models\Comment();
        $userModel = new \Models\User();

        // On part du principe qu'on ne possède pas de param "id"
        $article_id = null;

        // Mais s'il y en a un et que c'est un nombre entier, on le récupère
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }

        // On envoie une erreur
        if (!$article_id) {
            die("Vous devez préciser un paramètre `id` dans l'URL !");
        }

        // Récupération de l'article en question
         
        $article = $this->model->find($article_id);

        $user = $userModel->find($article['id_user']);
        $username = $user['username'];

        // Récupération des commentaires de l'article en question
         
        $commentaires = $commentModel->findAllWithArticle($article_id);

        // Affichage
        
        $pageTitle = $article['title'];
        \Renderer::render('articles/show', compact('pageTitle', 'article', 'commentaires', 'article_id', 'username'));
    }

    public function create()
    {

        $articleModel = new ModelsArticle;

        date_default_timezone_set('UTC');
        $createdAt = date("Y-m-d H:i:s");

        if(isset($_POST['create_article'])) {
            $createArticle = $articleModel->create($this->model->slugify($_POST['title']), $createdAt);

            if ($createArticle === true) {
                // Si la fonction return true l'article a été créer
                \Http::redirect('index.php');
            } else {
                // Sinon elle a retourné une erreur qu'on affiche
                \Http::redirect('index.php?controller=article&task=create&error=' . $articleModel->create($_POST['title'], $createdAt));
            }
        }

        // Affichage

        $pageTitle = "Créer un article";
        \Renderer::render('articles/create', compact('pageTitle'));
    }

    public function delete()
    {

        if (isset($_SESSION)) {

            // On vérifie que le GET possède bien un paramètre "id" et que c'est bien un nombre
            if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
                die("Tu n'as pas précisé l'id de l'article !");
            }

            $id = $_GET['id'];

            // Vérification que l'article existe bel et bien
            $article = $this->model->find($id);
            if (!$article) {
                die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
            }

            // Suppression de l'article si c'est le commentaire de l'utilisateur ou s'il est admin
            if ($_SESSION['role_admin'] == '1' || $_SESSION['id'] == $article['id_user']) {
                $this->model->delete($id);
            } else {
                \Http::redirect("index.php?error=Vous n'avez pas les droits pour supprimer cet article.");
            }

            // Redirection vers la page d'accueil
            
            \Http::redirect("index.php");
        }
    }
}