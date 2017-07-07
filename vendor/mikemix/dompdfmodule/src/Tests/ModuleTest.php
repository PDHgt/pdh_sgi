<?php
namespace dompdfmodule\Tests;

use dompdfmodule\Module;

class ModuleTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_returns_config()
    {
        $module = new Module();

        self::assertInternalType('array', $module->getConfig());
    }
}
