<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/01/18
 * Time: 15:30
 */

namespace App\Controller;


use App\Renderer\TwigRenderer;
use Symfony\Component\HttpFoundation\Response;

class VisionneuseController
{

    public function connexion()
    {
        $renderer = new TwigRenderer();
        $view = $renderer->render("Connexion");


        return new Response($view);
    }

    public function accueil(): String
    {
        return "";
    }

    public function visionneuse(): String
    {
        return "";
    }

}