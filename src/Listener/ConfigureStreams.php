<?php namespace Anomaly\AppearanceModule\Listener;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Illuminate\Config\Repository;

/**
 * Class ConfigureStreams
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AppearanceModule\Command
 */
class ConfigureStreams
{

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * The variable repository.
     *
     * @var SettingRepositoryInterface
     */
    protected $settings;

    /**
     * Create a new ConfigureStreams instance.
     *
     * @param SettingRepositoryInterface $settings
     * @param Repository                 $config
     */
    public function __construct(SettingRepositoryInterface $settings, Repository $config)
    {
        $this->config   = $config;
        $this->settings = $settings;
    }

    /**
     * Handle the event.
     */
    public function handle()
    {
        $this->config->set(
            'streams::themes.active.standard',
            $this->settings->get('streams::standard_theme', $this->config->get('streams::themes.active.standard'))
        );

        $this->config->set(
            'streams::themes.active.admin',
            $this->settings->get('streams::admin_theme', $this->config->get('streams::themes.active.admin'))
        );
    }
}
