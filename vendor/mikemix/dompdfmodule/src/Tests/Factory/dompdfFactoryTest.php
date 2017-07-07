<?php
namespace dompdfmodule\Tests\Factory;

use dompdfmodule\Factory\dompdfFactory;

class dompdfFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $factory;

    public function setUp()
    {
        $this->factory = new dompdfFactory();
    }

    public function test_it_is_initializable()
    {
        self::assertInstanceOf('dompdfmodule\Factory\dompdfFactory', $this->factory);
    }
}
