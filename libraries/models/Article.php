<?php

namespace Models;

require_once('libraries/models/Model.php');

class Article extends Model{
    protected $table = 'articles';

    public function create($slug, $createdAt){
        // Si on a envoyé le formulaire pour poster un article
        if(isset($_POST['create_article'])){
            
            // Si on a rempli le formulaire
            if(!empty($_POST['title']) && !empty($_POST['introduction']) && !empty($_POST['content'])){


                $title = htmlspecialchars($_POST['title']);
                $introduction = htmlspecialchars($_POST['introduction']);
                $content = htmlspecialchars($_POST['content']);

                $createArticle = $this->pdo->prepare("INSERT INTO articles (title, slug, introduction, content, created_at, id_user) VALUES (?, ?, ?, ?, ?, ?)");
                $createArticle->execute(array($title, $slug, $introduction, $content, $createdAt, $_SESSION['id']));
                return true;
            } else {
                $error = "Veuillez remplir tous les champs";
                return $error;
            }
        }
    }
}