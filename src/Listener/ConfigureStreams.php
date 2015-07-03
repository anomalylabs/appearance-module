<?php namespace Anomaly\AppearanceModule\Listener;

use Anomaly\AppearanceModule\Setting\Contract\SettingRepositoryInterface;
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
     * The appearance repository.
     *
     * @var SettingRepositoryInterface
     */
    protected $appearance;

    /**
     * Create a new ConfigureStreams instance.
     *
     * @param SettingRepositoryInterface $appearance
     * @param Repository                 $config
     */
    public function __construct(SettingRepositoryInterface $appearance, Repository $config)
    {
        $this->config   = $config;
        $this->appearance = $appearance;
    }

    /**
     * Handle the event.
     */
    public function handle()
    {
        $this->config->set(
            'streams.force_https',
            $this->appearance->get('streams::force_https', $this->config->get('streams.force_https'))
        );

        $this->config->set(
            'streams.site_enabled',
            $this->appearance->get('streams::site_enabled', $this->config->get('streams.site_enabled'))
        );

        $this->config->set(
            'streams.ip_whitelist',
            $this->appearance->get('streams::ip_whitelist', $this->config->get('streams.ip_whitelist'))
        );
    }
}
