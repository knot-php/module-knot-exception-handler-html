<?php
declare(strict_types=1);

namespace KnotPhp\Module\KnotExceptionHandler\Html\Test;

use KnotLib\Kernel\Exception\ModuleInstallationException;
use KnotPhp\Module\KnotExceptionHandler\Adapter\KnotExceptionHandlerAdapter;
use KnotPhp\Module\KnotExceptionHandler\Html\HtmlExceptionHandlerModule;
use PHPUnit\Framework\TestCase;

final class HtmlExceptionHandlerModuleTest extends TestCase
{
    /**
     * @throws \ReflectionException
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

        $ref_class = new \ReflectionClass($app);
        $prop = $ref_class->getParentClass()->getParentClass()->getProperty('ex_handlers');
        $prop->setAccessible(true);
        $ex_handlers = $prop->getValue($app);

        $this->assertCount(1, $ex_handlers);
        $this->assertInstanceOf(KnotExceptionHandlerAdapter::class, $ex_handlers[0]);
    }

}