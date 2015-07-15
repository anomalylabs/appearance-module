<?php namespace Anomaly\AppearanceModule\Listener\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Theme\ThemeCollection;
use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;

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
     * @param Request                    $request
     */
    public function handle(SettingRepositoryInterface $settings, ThemeCollection $themes, Request $request)
    {
        if (in_array($request->segment(1), ['installer', 'admin'])) {
            $theme = $themes->admin()->active();
        } else {
            $theme = $themes->standard()->active();
        }

        if (!$theme) {
            return;
        }

        foreach ($settings->all($theme->getNamespace()) as $key => $value) {
            $this->variables->put($key, $value);
        }
    }
}
