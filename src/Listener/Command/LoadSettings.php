<?php namespace Anomaly\AppearanceModule\Listener\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Theme\ThemeCollection;
use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class LoadSettings
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AppearanceModule\Listener\Command
 */
class LoadSettings implements SelfHandling
{

    /**
     * The theme variables.
     *
     * @var Collection
     */
    protected $variables;

    /**
     * Create a new LoadSettings instance.
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
     * @param SettingRepositoryInterface $settings
     * @param ThemeCollection            $themes
     * @param Repository                 $config
     */
    public function handle(SettingRepositoryInterface $settings, ThemeCollection $themes, Repository $config)
    {
        if (!$theme = $themes->current()) {
            return;
        }

        if (!$fields = $config->get($theme->getNamespace('settings/settings'))) {
            $fields = $config->get($theme->getNamespace('settings'));
        }

        if (!$fields) {
            return;
        }

        foreach (array_keys($fields) as $field) {
            $this->variables->put(
                $field,
                $settings->get($theme->getNamespace($field), array_get($fields, $field . '.config.default_value'))
            );
        }
    }
}
