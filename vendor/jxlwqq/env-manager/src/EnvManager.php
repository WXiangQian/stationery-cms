<?php

namespace Jxlwqq\EnvManager;

use Encore\Admin\Extension;

class EnvManager extends Extension
{
    public $name = 'env-manager';

    public $menu = [
        'title' => 'EnvManager',
        'path'  => 'env-manager',
        'icon'  => 'fa-gears',
    ];
}