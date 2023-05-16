<?php

namespace LearnKit\FilamentNotion;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentNotionServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-notion-integration';

    public static string $viewNamespace = 'filament-notion';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->askToStarRepoOnGitHub('learnkit-dev/filament-notion-integration');
            });

        $configFileName = $package->shortName();

        if (file_exists($this->package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($this->package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }
}
