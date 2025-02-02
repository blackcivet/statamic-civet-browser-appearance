<?php

namespace BlackCivet\CivetBrowserAppearance;

use Statamic\Events\GlobalSetSaved;
use Statamic\Providers\AddonServiceProvider;
use BlackCivet\CivetBrowserAppearance\Listeners\GenerateFavicons;
use BlackCivet\CivetBrowserAppearance\Updates\UpdateBrowserAppearanceGlobals;
use BlackCivet\CivetBrowserAppearance\Updates\UpdateFaviconsPath;

class ServiceProvider extends AddonServiceProvider
{
    protected $listen = [
        GlobalSetSaved::class => [
            GenerateFavicons::class,
        ],
    ];

    protected $routes = [
        'web' => __DIR__ . '/../routes/web.php',
    ];

    protected $updateScripts = [
        UpdateBrowserAppearanceGlobals::class,
        UpdateFaviconsPath::class,
    ];

    public function bootAddon()
    {
        $this->registerPublishableFieldsets();
        $this->registerPublishableViews();
    }

    protected function registerPublishableFieldsets()
    {
        $this->publishes([
            __DIR__ . '/../resources/fieldsets' => resource_path('fieldsets/vendor/statamic-civet-browser-appearance'),
        ], 'statamic-civet-browser-appearance-fieldsets');
    }

    protected function registerPublishableViews()
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/statamic-civet-browser-appearance'),
        ], 'statamic-civet-browser-appearance-views');
    }
}
