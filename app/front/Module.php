<?php

namespace App\Front;

use Phalcon\Loader,
    Phalcon\Mvc\View,
    Phalcon\Mvc\ModuleDefinitionInterface,
    Phalcon\Mvc\Dispatcher,
    Phalcon\Events\Manager,
    Phalcon\Mvc\Dispatcher\Exception,
    Phalcon\Mvc\View\Engine\Volt,
    Phalcon\Config\Adapter\Ini as Config;

class Module implements ModuleDefinitionInterface
{
    private $config;

    public function registerAutoloaders()
    {
        $this->config = new Config('../app/front/config/config.ini');

        $loader = new Loader();
        $loader->registerNamespaces(
            array(
                'App\Front\Controllers' => $this->config->module->controllersDir,
                'App\Front\Models' => $this->config->module->modelsDir,
                'App\Front\Forms' => $this->config->module->formsDir,
            )
        );
        $loader->register();
    }

    public function registerServices($di)
    {
        $di->set('config', $this->config);

        $di->set('dispatcher', function () {
            $eventsManager = new Manager();
            $eventsManager->attach("dispatch:beforeException", function ($event, $dispatcher, $exception) {
                if ($exception instanceof Exception) {
                    $dispatcher->forward(array(
                        'controller' => 'error',
                        'action' => 'show404'
                    ));
                    return false;
                }
                return false;
            });
            $dispatcher = new Dispatcher();
            $dispatcher->setEventsManager($eventsManager);
            $dispatcher->setDefaultNamespace('App\Front\Controllers');
            return $dispatcher;
        }, true);

        $di->set('view', function () {
            $view = new View();
            $view->setViewsDir($this->config->module->viewsDir);
            $view->registerEngines(array(
                ".volt" => function ($view, $di) {
                    $volt = new Volt($view, $di);
                    $compiler = $volt->getCompiler();
                    $compiler->addFunction('strtotime', 'strtotime');
                    return $volt;
                }
            ));
            return $view;
        });
    }
}