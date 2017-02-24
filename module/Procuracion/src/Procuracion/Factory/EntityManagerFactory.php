<?php

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use MyModule\Service\Foo;

class FooFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sl)
    {
        $bar = $sl->get('Bar');
        $foo = new Foo($bar);

        return $foo;
    }
}