<?php
/**
 * Created by PhpStorm.
 * User: rustam
 * Date: 26.10.17
 * Time: 18:40
 */

namespace Providers;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ControllersProvider implements ServiceProviderInterface
{
    private $directory;

    public function __construct($directory)
    {
        $this->directory = $directory;
    }

    public function register(Container $app)
    {
        $this->registerControllers($app);
    }

    public function registerControllers(Container $app) {
        $files = array_diff(scandir($this->directory),['..','.']);
//        var_dump($files);

        foreach ($files as $file) {
            $className =$this->translateDirectoryToNamespace($file);
//            var_dump($className);
            $reflection = new \ReflectionClass($className);

            $constructor = $reflection->getConstructor();

            $parameters = [];

            if ($constructor) {
                $parameters = $this->resolveDependecies($constructor->getParameters());
            }

            $controller = $reflection->newInstanceArgs($parameters);

            $app[$className] = function () use($controller) {
                return $controller;
            };
        }
    }
    private function translateDirectoryToNamespace($classFile)
    {
//        $fileName = $this->directory . '/' . $classFile;
//        $fileArray = array_reverse(explode('/', $fileName));
//        $className = '';
//        foreach ($fileArray as $piece) {
//            $className = $piece . '\\' . $className;
//        }
        $className =  ReflectionClass::getNamespaceName
        return rtrim($className, '.php\\');
    }
    private function resolveDependecies(array $params)
    {
        $controllerParams = [];

        foreach ($params as $param) {

            $class = $param->getClass()->name;

            $reflectClass = new \ReflectionClass($class);

            $dependencyParams = [];
            if($construct = $reflectClass->getConstructor()) {
                $dependencyParams = $this->resolveDependecies($construct->getParameters());
            }
            $controllerParams[] = $reflectClass->newInstanceArgs($dependencyParams);
        }
        return $controllerParams;
    }
}