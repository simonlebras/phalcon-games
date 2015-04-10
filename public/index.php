<?php

error_reporting(E_ALL);
$debug = new \Phalcon\Debug();
$debug->listen();

$config = new \Phalcon\Config\Adapter\Ini('../app/config/config.ini');

$di = new Phalcon\DI\FactoryDefault();

$di->set('url', function () use ($config) {
    $url = new \Phalcon\Mvc\Url();
    $url->setBaseUri($config->application->baseURI);
    return $url;
});

$di->set('db', function () use ($config) {
    return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
        'adapter' => $config->database->adapter,
        'host' => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname' => $config->database->dbname
    ));
});

$di->set('session', function () {
    $session = new Phalcon\Session\Adapter\Files();
    $session->start();
    return $session;
});

$di->set('router', function () {
    $router = new \Phalcon\Mvc\Router(false);

    $router->add('/', array(
        'module' => 'front',
        'controller' => 'index',
        'action' => 'index'
    ));

    $router->add('/game/{game}', array(
        'module' => 'front',
        'controller' => 'game',
        'action' => 'index'
    ));

    $router->add('/game/{game}/best', array(
        'module' => 'front',
        'controller' => 'game',
        'action' => 'best'
    ));

    $router->add('/game/bests', array(
        'module' => 'front',
        'controller' => 'game',
        'action' => 'bests'
    ));

    $router->add('/account/:action', array(
        'module' => 'front',
        'controller' => 'account',
        'action' => 1
    ));

    $router->add('/admin', array(
        'module' => 'admin',
        'controller' => 'admin',
        'action' => 'index'
    ));

    $router->add('/admin/:action', array(
        'module' => 'admin',
        'controller' => 'admin',
        'action' => 1
    ));

    $router->notFound(array(
        'module' => 'front',
        'controller' => 'error',
        'action' => 'show404'
    ));

    $router->removeExtraSlashes(true);

    return $router;
});


try {
    $application = new \Phalcon\Mvc\Application($di);
    $application->registerModules(
        array(
            'front' => array(
                'className' => 'App\Front\Module',
                'path' => '../app/front/Module.php',
            ),
            'admin' => array(
                'className' => 'App\Admin\Module',
                'path' => '../app/admin/Module.php',
            )
        )
    );
    echo $application->handle()->getContent();
} catch (\Phalcon\Exception $e) {
    echo $e->getMessage();
}