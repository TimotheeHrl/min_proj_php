<?php

namespace App\Controller;

use App\Model\SessionManager;
//call the AbstractController islogin function to check if the user is logged in


class SessionController extends AbstractController
{


    public const TABLE = 'session';
    public const ID = 'id';




    public function index(): string
    {
        // call a static function
        AbstractController::islogin();

        $sessionManager = new SessionManager();
        $sessions = $sessionManager->selectAll('session');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //get parameters from the form

            $id = $_POST['id'];

            $sessionManager = new SessionManager();
            $sessionManager = new SessionManager();
            $sessionManager->update($id);
            $session_String =  $sessionManager->selectOneById($id);
            setcookie(
                'session_info',
                $session_String,
                time() + 365 * 24 * 3600,
                '/',
            );
        }
        return $this->twig->render('Session/index.html.twig', ['sessions' => $sessions]);
    }
}
