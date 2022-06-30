<?php

namespace Models;

require_once('libraries/models/Model.php');

class User extends Model
{
    protected $table = "users";
    protected $bdd;

    public function signup()
    {
        if (isset($_POST['submit_signup'])) {
            if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
                $username = htmlspecialchars($_POST['username']);
                $email = htmlspecialchars($_POST['email']);
                $password = sha1($_POST['password']);
                $confirm_password = sha1($_POST['confirm_password']);


                if (preg_match("/^[a-zA-Z]{4,20}+$/", $username) === 1) //Entre 4 et 20 lettres seulement
                {

                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                        if (preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.).{6,20}$/", $_POST['password'])) //Entre 6 & 20 minuscule maj chiffre obligation [a-zA-Z0-9]
                        {

                            if ($password === $confirm_password) {
                                $addMember = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                                $addMember->execute(array($username, $email, $password));

                                return true;
                            } else {
                                $error = "Vos mots de passe doivent être identiques";
                                return $error;
                            }
                        } else {
                            $error = "Votre mot de passe doit contenir entre 6 et 20 caractères, avoir une minuscule, une majuscule et un chiffre";
                            return $error;
                        }
                    } else {
                        $error = "Votre email n'est pas valide";
                        return $error;
                    }
                } else {
                    $error = "Votre pseudo doit contenir entre 4 et 20 lettres";
                    return $error;
                }
            } else {
                $error = "Veuillez remplir tous les champs";
                return $error;
            }
        }
    }

    public function login()
    {
        if (!empty($_POST)) {
            $email = htmlspecialchars($_POST['email']);
            $password = sha1($_POST['password']);

            $recupInfos = $this->pdo->prepare("SELECT id, username, email, role_admin FROM users WHERE email=? and password=?");
            $recupInfos->execute(array($email, $password));
            $verifyRecupInfos = $recupInfos->rowCount();

            if ($verifyRecupInfos === 1) {
                $fetchRecupInfos = $recupInfos->fetch();
                $_SESSION['id'] = $fetchRecupInfos["id"];
                $_SESSION['email'] = $fetchRecupInfos["email"];
                $_SESSION['username'] = $fetchRecupInfos["username"];
                $_SESSION['role_admin'] = $fetchRecupInfos["role_admin"];
                return true;
            } else {
                $error = "Email ou mot de passe incorect";
                return $error;
            }
        }
    }

    public function changeProfile()
    {
        if ($_POST['edit_username']) {
            if (isset($_POST['new_username'])) {
                $newUsername = htmlspecialchars($_POST['new_username']);

                if (preg_match("/^[a-zA-Z]{4,20}+$/", $newUsername) === 1) {
                    $recupInfos = $this->pdo->prepare("UPDATE users SET username=? WHERE id=?");
                    $recupInfos->execute(array($newUsername, $_SESSION['id']));

                    $_SESSION['username'] = $newUsername;
                    return true;
                } else {
                    $error = "Votre pseudo doit contenir entre 4 et 20 lettres";
                    return $error;
                }
            }
        } elseif ($_POST['edit_email']) {
            $oldEmail = htmlspecialchars($_POST['old_email']);
            $newEmail = htmlspecialchars($_POST['new_email']);


            $recupInfos = $this->pdo->prepare("SELECT email FROM users WHERE email=? and id=?");
            $recupInfos->execute(array($oldEmail, $_SESSION['id']));

            $verifyRecupInfos = $recupInfos->rowCount();

            if ($verifyRecupInfos === 1) {
                if (filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
                    $changeEmail = $this->pdo->prepare("UPDATE users SET email=? WHERE id=?");
                    $changeEmail->execute(array($newEmail, $_SESSION['id']));

                    $_SESSION['email'] = $newEmail;
                    return true;
                } else {
                    $error = "Votre email n'est pas valide";
                    return $error;
                }
            } else {
                $error = "L'email entrée ne correspond pas à l'email du compte.";
                return $error;
            }
        } elseif ($_POST['edit_password']) {
            $oldPassword = sha1($_POST['old_password']);
            $newPassword = sha1($_POST['new_password']);


            $recupInfos = $this->pdo->prepare("SELECT password FROM users WHERE password=? and id=?");
            $recupInfos->execute(array($oldPassword, $_SESSION['id']));

            $verifyRecupInfos = $recupInfos->rowCount();

            if ($verifyRecupInfos === 1) {
                if (preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.).{6,20}$/", $_POST['new_password'])) {
                    $changePassword = $this->pdo->prepare("UPDATE users SET password=? WHERE id=?");
                    $changePassword->execute(array($newPassword, $_SESSION['id']));
                    return true;
                } else {
                    $error = "Votre mot de passe doit contenir entre 6 et 20 caractères, avoir une minuscule, une majuscule et un chiffre";
                    return $error;
                }
            } else {
                $error = "Mot de passe incorect";
                return $error;
            }
        }
    }
    
}
