<?php

namespace BlackCivet\CivetBrowserAppearance\Listeners;

use Statamic\Events\GlobalSetSaved;
use Statamic\Globals\GlobalSet;
use BlackCivet\CivetBrowserAppearance\Generators\Favicons;

class GenerateFavicons
{
    private function shouldHandle(GlobalSet $globals): bool
    {
        return $globals->handle() === 'browser_appearance';
    }

    public function handle(GlobalSetSaved $event): void
    {
        /** @var GlobalSet $globals */
        $globals = $event->globals;

        if (!$this->shouldHandle($globals)) {
            return;
        }

        dispatch(fn () => Favicons::generate())->afterResponse();
    }
}
