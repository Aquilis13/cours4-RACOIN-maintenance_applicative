<?php

namespace actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use controller\item;

/**
 * Route : [GET] -> /item/{n}
 */
final class DisplayItemAction {

    private $twig; 
    private $menu; 
    private $chemin; 
    private $cat;

    public function __construct($twig, $menu, $chemin, $cat) {
        $this->twig = $twig; 
        $this->menu = $menu; 
        $this->chemin = $chemin; 
        $this->cat = $cat; 
    }

    public function __invoke(Request $request, Response $response, array $args): Response {
        $n    = $args['n'];
        $item = new item();
        $item->afficherItem($this->twig, $this->menu, $this->chemin, $n, $this->cat->getCategories());

        return $response;
    }
}