<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function($app, $twig, $menu, $chemin, $cat, $dpt):void {
    
    $app->get('/', new actions\AcceuilAction($twig, $menu, $chemin, $cat));

    $app->get('/item/{n}', new actions\DisplayItemAction($twig, $menu, $chemin, $cat));
    
    $app->get('/add', new actions\DisplayAddItemViewAction($twig, $app, $menu, $chemin, $cat, $dpt));
    
    $app->post('/add', new actions\ProcessNewItemAction($twig, $app, $menu, $chemin));
    
    $app->get('/item/{id}/edit', new actions\DisplayEditItemViewAction($twig, $menu, $chemin));
    
    $app->post('/item/{id}/edit', new actions\ProcessItemEditAction($twig, $app, $menu, $chemin, $cat, $dpt));
    
    $app->map(['GET, POST'], '/item/{id}/confirm', new actions\ConfirmItemEditAction($twig, $app, $menu, $chemin));
    
    $app->get('/search', new actions\DisplaySearchViewAction($app, $twig, $menu, $chemin, $cat));
    
    $app->post('/search', new actions\ProcessSearchAction($app, $twig, $menu, $chemin, $cat));
    
    $app->get('/annonceur/{n}', new actions\DisplayAnnonceurAction($twig, $menu, $chemin, $cat));
    
    $app->get('/del/{n}', new actions\DisplayDeleteItemViewAction($twig, $menu, $chemin));
    
    $app->post('/del/{n}', new actions\ProcessItemDeletionAction($twig, $menu, $chemin, $cat));
    
    $app->get('/cat/{n}', new actions\DisplayCategorieAction($twig, $menu, $chemin, $cat));
    
    $app->get('/api(/)', new actions\DisplayApiViewAction($twig, $menu, $chemin, $cat));
    
    $app->get('/api/annonce/{id}', new actions\DisplayAnnonceByIdAction($app));

    $app->get('/api/annonces(/)', new actions\DisplayAllAnnoncesAction($app));

    $app->get('/api/categorie/{id}', new actions\DisplayCategorieByIdAction($app));

    $app->get('/api/categories(/)', new actions\DisplayAllCategoriesAction($app));

    $app->get('/api/key', new actions\DisplayKeyGeneratorViewAction($app, $twig, $menu, $chemin, $cat));

    $app->post('/api/key', new actions\GenerateNewKeyAction($app, $twig, $menu, $chemin, $cat));
    
};
