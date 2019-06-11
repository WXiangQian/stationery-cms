<?php

namespace Jxlwqq\ComposerViewer\Http\Controllers;

use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;

class ComposerViewerController extends Controller
{
    public function index(Content $content)
    {
        $packages = $this->getComposerPackages();
        return $content
            ->header('Composer Packages')
            ->body(view('composer-viewer::index', ['packages' => $packages]));
    }

    private function getComposerPackages()
    {
        try {
            $command = 'cd '.base_path().' && composer show --latest --format=json';
            exec($command, $output);
            $packages = json_decode(implode('', $output), true)['installed'];

            /*
             * up-to-date
             * green (=): Dependency is in the latest version and is up to date.
             *
             * update-possible
             * yellow (~): Dependency has a new version available that includes backwards compatibility breaks according to semver, so upgrade when you can but it may involve work.
             *
             * semver-safe-update
             * red (!): Dependency has a new version that is semver-compatible and you should upgrade it.
             */

            foreach ($packages as &$package) {
                switch ($package['latest-status']) {
                    case 'up-to-date':
                        $package['label'] = 'label-success';
                        break;
                    case 'update-possible':
                        $package['label'] = 'label-warning';
                        break;
                    case 'semver-safe-update':
                        $package['label'] = 'label-danger';
                        break;
                }
            }
            return $packages;
        } catch (\Exception $e) {
            return [];
        }
    }
}
