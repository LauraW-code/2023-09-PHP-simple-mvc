<?php

namespace App\Controller;

use App\Model\ConnexionManager;

class HomeController extends AbstractController
{
    /**
     * Display home page
     */
    public function indexCadeaux(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // DEBUG: Affiche le path courant.
            // $currentPath = $_SERVER['REQUEST_URI'];
            // echo "Current Path: $currentPath";

            // ------------ GESTION UPLOAD IMAGE --------------------------
            // Si le dossier UPLOAD n'existe pas, on le créée.
            $uploadDir = __DIR__ . '/../../public/upload/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir);
            }
            var_dump($_FILES);
            // Recupere le nom et le nom temporaire de l'image selectionnée
            $photoName = $_FILES['photo']['name'];
            $photoTmpName = $_FILES['photo']['tmp_name'];
            //Et on le déplace dans le dossier UPLOAD.
            $uniqueFile = time() . '_' . basename($photoName);
            move_uploaded_file($photoTmpName, $uploadDir . $uniqueFile);
            // -------------------------------------------------------------

            // On interroge la BDD.
            $connexionManager = new ConnexionManager();
            $connexionManager->insert($_POST, $uniqueFile);
            // redirection sur la 1ere page du dashboard.
            header('Location: /accueil');
        }
        return $this->twig->render('Home/main_cadeaux.html.twig');
    }

    public function indexGoddies(): string
    {
        return $this->twig->render('Home/main_goddies.html.twig');
    }

    public function indexVisite(): string
    {
        return $this->twig->render('Home/main_visite.html.twig');
    }

    public function indexAccueil(): string
    {
        return $this->twig->render('Home/main_accueil.html.twig');
    }

    public function indexConnexion(): string
    {
        return $this->twig->render('Home/connexion.html.twig');
    }

    public function indexAdmin(): string
    {
        return $this->twig->render('Home/admin.html.twig');
    }

    public function login()
    {
        $errors = [];

        if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] === true) {
            header('Location: /accueil');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['username'] === '') {
                $errors['username'] = 'Veuillez saisir votre identifiant';
            }

            if ($_POST['password'] === '') {
                $errors['password'] = 'Veuillez saisir votre mot de passe';
            }

            if (!$errors) {
                $connexionManager = new ConnexionManager();
                $user = $connexionManager->userLogin($_POST);
                if ($user) {
                    $_SESSION['isLogin'] = true;
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['password'] = $user['password'];
                    header('Location: /');
                }
            }
        }

        return $this->twig->render('Home/connexion.html.twig', ['errors' => $errors]);
    }

    public function logout()
    {
        unset($_SESSION['isLogin']);
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        header('Location: /connexion');
    }
}
