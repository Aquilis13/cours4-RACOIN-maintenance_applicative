<?php

namespace actions;

use Slim\Http\Request;
use Slim\Http\Response;
use model\Annonce;
use model\Categorie;

/**
 * Route : [GET] -> /api/categorie/{id}
 */
final class DisplayCategorieByIdAction {

    private $app; 

    public function __construct($app) {
        $this->app = $app; 
    }

    public function __invoke(Request $request, Response $response, array $args): Response {
        $id = $arg['id'];
        $response->headers->set('Content-Type', 'application/json');
        $a     = Annonce::select('id_annonce', 'prix', 'titre', 'ville')
            ->where('id_categorie', '=', $id)
            ->get();
        $links = [];

        foreach ($a as $ann) {
            $links['self']['href'] = '/api/annonce/' . $ann->id_annonce;
            $ann->links            = $links;
        }

        $c                     = Categorie::find($id);
        $links['self']['href'] = '/api/categorie/' . $id;
        $c->links              = $links;
        $c->annonces           = $a;
        echo $c->toJson();

        return $response;
    }
}