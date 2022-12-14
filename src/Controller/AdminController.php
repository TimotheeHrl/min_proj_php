<?php

namespace App\Controller;

use App\Model\AdminManager;

class AdminController  extends AbstractController
{


    public function login(): ?string
    {
        $res = [''];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $admin = array_map('trim', $_POST);
            $adminManager = new AdminManager();
            $admin = $adminManager->selectOneByLoginAndPassword($admin['loginid'], $admin['password']);

            if ($admin) {

                $cookieValue =  $admin['loginid'] . "," . $admin['password'];

                setcookie(
                    'logincookie',
                    $cookieValue,
                    time() + 365 * 24 * 3600,
                    '/',
                );
                $res = $admin['loginid'];
            } else {
                $res = 'Login ou mot de passe incorrect';
            }
        }
        return $this->twig->render('Admin/login.html.twig', ['res' => $res]);
    }


    public function logout(): void
    {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_COOKIE['logincookie'])) {
                unset($_COOKIE['logincookie']);
                setcookie('logincookie', 'nonnon', time() - 3600, '/');
            }
            header('Location:/');
        }
    }
}
