<?php
declare(strict_types=1);

namespace knotphp\module\knotexceptionhandler\html\test;

use knotlib\kernel\kernel\ApplicationType;
use knotlib\module\application\SimpleApplication;

final class TestSimpleApplication extends SimpleApplication
{
    public static function type() : ApplicationType
    {
        return ApplicationType::of(ApplicationType::CLI);
    }
}