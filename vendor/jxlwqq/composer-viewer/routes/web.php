<?php

use Jxlwqq\ComposerViewer\Http\Controllers\ComposerViewerController;

Route::get('composer-viewer', ComposerViewerController::class.'@index');