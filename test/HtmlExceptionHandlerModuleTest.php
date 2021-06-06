<?php
declare(strict_types=1);

namespace knotphp\module\knotexceptionhandler\html\test;

use ReflectionClass;
use ReflectionException;

use PHPUnit\Framework\TestCase;

use knotlib\kernel\Exception\ModuleInstallationException;
use knotphp\module\knotexceptionhandler\adapter\KnotExceptionHandlerAdapter;
use knotphp\module\knotexceptionhandler\html\HtmlExceptionHandlerModule;

final class HtmlExceptionHandlerModuleTest extends TestCase
{
    /**
     * @throws ReflectionException
     */
    public function testInstall()
    {
        $module = new HtmlExceptionHandlerModule();

        $app = new TestSimpleApplication();

        try{
            $module->install($app);
        }
        catch(ModuleInstallationException $e){
            $this->fail($e->getMessage());
        }

        $ref_class = new ReflectionClass($app);
        $prop = $ref_class->getParentClass()->getParentClass()->getProperty('ex_handlers');
        $prop->setAccessible(true);
        $ex_handlers = $prop->getValue($app);

        $this->assertCount(1, $ex_handlers);
        $this->assertInstanceOf(KnotExceptionHandlerAdapter::class, $ex_handlers[0]);
    }

}