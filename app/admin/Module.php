<?php

namespace App\Admin;

use Phalcon\Loader,
    Phalcon\Mvc\View,
    Phalcon\Mvc\ModuleDefinitionInterface,
    Phalcon\Mvc\Dispatcher,
    Phalcon\Events\Manager,
    Phalcon\Mvc\Dispatcher\Exception,
    Phalcon\Config\Adapter\Ini as Config;

class Module implements ModuleDefinitionInterface
{
    private $config;

    public function registerAutoloaders()
    {
        $this->config = new Config('../app/admin/config/config.ini');

        $loader = new Loader();
        $loader->registerNamespaces(
            array(
                'App\Admin\Controllers' => $this->config->module->controllersDir,
                'App\Admin\Models' => $this->config->module->modelsDir,
            )
        );
        $loader->register();
    }

    public function registerServices($di)
    {
        $di->set('config', $this->config);

        $di->set('dispatcher', function() {
            $eventsManager = new Manager();
            $eventsManager->attach("dispatch:beforeException", function($event, $dispatcher, $exception) {
                if ($exception instanceof Exception) {
                    $dispatcher->forward(array(
                        'controller' => 'error',
                        'action' => 'show404'
                    ));
                    return false;
                }
                $dispatcher->forward(array(
                    'controller' => 'error',
                    'action' => 'show503'
                ));
                return false;
            });
            $dispatcher = new Dispatcher();
            $dispatcher->setEventsManager($eventsManager);
            $dispatcher->setDefaultNamespace('App\Admin\Controllers');
            return $dispatcher;
        }, true);

        $di->set('view', function () {
            $view = new View();
            $view->setViewsDir($this->config->module->viewsDir);
            $view->registerEngines(array(
                '.volt' => 'Phalcon\Mvc\View\Engine\Volt'
            ));
            return $view;
        });
    }
}