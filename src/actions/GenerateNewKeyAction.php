<?php

namespace App\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\controller\KeyGenerator;

/**
 * Route : [POST] -> /api/key
 */
final class GenerateNewKeyAction {

    private $app; 
    private $twig; 
    private $menu; 
    private $chemin; 
    private $cat;

    public function __construct($app, $twig, $menu, $chemin, $cat) {
        $this->app = $app; 
        $this->twig = $twig; 
        $this->menu = $menu; 
        $this->chemin = $chemin; 
        $this->cat = $cat; 
    }

    public function __invoke(Request $request, Response $response, array $args): Response {
        $nom = $_POST['nom'];

        $kg = new KeyGenerator();
        $kg->generateKey($this->twig, $this->menu, $this->chemin, $this->cat->getCategories(), $nom);

        return $response;
    }
}