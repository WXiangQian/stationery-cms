<?php

namespace Jxlwqq\EnvManager;

use Illuminate\Support\ServiceProvider;

class EnvManagerServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(EnvManager $extension)
    {
        if (! EnvManager::boot()) {
            return ;
        }

        $this->app->booted(function () {
            EnvManager::routes(__DIR__.'/../routes/web.php');
        });
    }
}