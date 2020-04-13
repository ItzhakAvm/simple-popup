<?php
use Framework\Routing\Router;

return [
    'routes' => function(Router $router) {
        $router->get('/', 'PopupController@index');
        $router->get('/popup/getContent', 'PopupController@getContent');
    },
];