<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use App\Model\AdminManager;

/**
 * Initialized some Controller common features (Twig...)
 */
abstract class AbstractController
{
    protected Environment $twig;


    public function __construct()
    {
        $loader = new FilesystemLoader(APP_VIEW_PATH);
        $this->twig = new Environment(
            $loader,
            [
                'cache' => false,
                'debug' => true,
            ]
        );
        $this->twig->addExtension(new DebugExtension());
    }
    public function islogin(): void
    {
        if (isset($_COOKIE['logincookie'])) {
            $logincookie = $_COOKIE['logincookie'];
            $logincookie = explode(",", $logincookie);
            $loginid = $logincookie[0];
            $password = $logincookie[1];
            $adminManager = new AdminManager();
            $admin = $adminManager->selectOneByLoginAndPassword($loginid, $password);
            if (!$admin) {
                header('Location:/admin/login');
            }
        } else {
            header('Location:/admin/login');
        }
    }
}
