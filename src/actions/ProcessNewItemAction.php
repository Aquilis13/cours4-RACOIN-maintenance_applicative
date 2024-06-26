<?php

namespace App\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use OpenApi\Annotations as OA;
use App\controller\addItem;

/**
 * @OA\Post(path="/add", 
 * tags={"Application"},
 * 
 *  @OA\Response(
 *      response="200", 
 *      description="Ajoute une nouvelle annonce"),
 * )
 */
final class ProcessNewItemAction {

    private \Twig\Environment $twig; 
    private array $menu; 
    private string $chemin; 
    private \Slim\App $app;

    public function __construct(\Twig\Environment $twig, \Slim\App $app, array $menu, string $chemin) {
        $this->app = $app; 
        $this->twig = $twig; 
        $this->menu = $menu; 
        $this->chemin = $chemin; 
    }

    public function __invoke(Request $request, Response $response, array $args): Response {
        $allPostVars = $request->getParsedBody();
        $ajout       = new addItem();
        $ajout->addNewItem($this->twig, $this->menu, $this->chemin, $allPostVars);

        return $response;
    }
}