<?php

namespace App\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\controller\Search;

/**
 * Route : [GET] -> /search
 */
final class DisplaySearchViewAction {

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
        $search = new Search();
        $search->show($this->twig, $this->menu, $this->chemin, $this->cat->getCategories());

        return $response;
    }
}