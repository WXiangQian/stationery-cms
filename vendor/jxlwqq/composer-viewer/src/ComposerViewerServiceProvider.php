<?php

namespace Jxlwqq\ComposerViewer;

use Illuminate\Support\ServiceProvider;

class ComposerViewerServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(ComposerViewer $extension)
    {
        if (! ComposerViewer::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'composer-viewer');
        }

        $this->app->booted(function () {
            ComposerViewer::routes(__DIR__.'/../routes/web.php');
        });
    }
}
