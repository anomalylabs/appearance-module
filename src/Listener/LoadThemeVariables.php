<?php namespace Anomaly\AppearanceModule\Listener;

use Anomaly\AppearanceModule\Listener\Command\LoadSettings;
use Anomaly\AppearanceModule\Listener\Command\LoadVariables;
use Anomaly\Streams\Platform\Asset\Event\ThemeVariablesAreLoading;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class LoadVariables
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AppearanceModule\Listener
 */
class LoadThemeVariables
{

    use DispatchesJobs;

    /**
     * Handle the event.
     *
     * @param ThemeVariablesAreLoading $event
     */
    public function handle(ThemeVariablesAreLoading $event)
    {
        $this->dispatch(new LoadVariables($event->getVariables()));
        $this->dispatch(new LoadSettings($event->getVariables()));
    }
}
