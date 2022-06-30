<?php

namespace Controllers;

use Database;

require_once('libraries/autoload.php');
session_start();

class Account extends Controller
{

    protected $modelName = \Models\User::class;

    public function signup()
    {
        $userModel = new \Models\User();

        if ($_POST) {
            $signupVerify = $userModel->signup();

            if ($signupVerify === true) {
                // Si la fonction return true l'inscription a fonctionnée 
                \Http::redirect('index.php?controller=account&task=login');
            } else {
                // Sinon elle a retourné une erreur qu'on affiche
                \Http::redirect('index.php?controller=account&task=signup&error=' . $userModel->signup());
            }
        }

        // Affichage

        $pageTitle = "Inscription";
        \Renderer::render('account/signup', compact('pageTitle'));
    }

    public function login()
    {
        $userModel = new \Models\User();

        if ($_POST) {
            $loginVerify = $userModel->login();

            if ($loginVerify === true) {
                // Si la fonction return true la connexion a fonctionnée 
                \Http::redirect('index.php');
            } else {
                // Sinon elle a retourné une erreur qu'on affiche
                \Http::redirect('index.php?controller=account&task=login&error=' . $userModel->login());
            }
        }

        // Affichage

        $pageTitle = "Connexion";
        \Renderer::render('account/login', compact('pageTitle'));
    }

    public function profil()
    {
        $userModel = new \Models\User();

        if ($_POST) {
            $changeProfileTest = $userModel->changeProfile();

            if ($changeProfileTest === true) {
                // Si la fonction return true le changement de données a fonctionnée
                \Http::redirect('index.php?controller=account&task=profil');
            } else {
                // Sinon elle a retourné une erreur qu'on affiche
                \Http::redirect('index.php?controller=account&task=profil&error=' . $userModel->changeProfile());
            }
        }

        // Affichage

        $pageTitle = "Profil";
        \Renderer::render('account/profil', compact('pageTitle'));
    }

    public function logout()
    {
        // Suppression des données de session
        session_start();
        $_SESSION = array();
        session_destroy();

        // Affichage
        
        header("Location: connexion.php");
        $pageTitle = "Acceuil";
        \Renderer::render('articles/index', compact('pageTitle'));
    }
}
