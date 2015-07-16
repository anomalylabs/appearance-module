<?php namespace Anomaly\AppearanceModule\Listener\Command;

use Anomaly\Streams\Platform\Addon\Theme\ThemeCollection;
use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class LoadVariables
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AppearanceModule\Listener\Command
 */
class LoadVariables implements SelfHandling
{

    /**
     * The theme variables.
     *
     * @var Collection
     */
    protected $variables;

    /**
     * Create a new LoadVariables instance.
     *
     * @param Collection $variables
     */
    public function __construct(Collection $variables)
    {
        $this->variables = $variables;
    }

    /**
     * Handle the command.
     *
     * @param Repository      $config
     * @param ThemeCollection $themes
     */
    public function handle(Repository $config, ThemeCollection $themes)
    {
        if (!$theme = $themes->current()) {
            return;
        }

        foreach ($config->get($theme->getNamespace('variables'), []) as $key => $value) {
            $this->variables->put($key, $value);
        }
    }
}
