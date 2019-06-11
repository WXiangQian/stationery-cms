<?php

namespace Jxlwqq\ComposerViewer;

use Encore\Admin\Extension;

class ComposerViewer extends Extension
{
    public $name = 'composer-viewer';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';

    public $menu = [
        'title' => 'ComposerViewer',
        'path'  => 'composer-viewer',
        'icon'  => 'fa-gears',
    ];
}
