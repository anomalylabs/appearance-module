<?php namespace Anomaly\AppearanceModule;

use Anomaly\AppearanceModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;

/**
 * Class AppearanceModulePlugin
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AppearanceModule
 */
class AppearanceModulePlugin extends Plugin
{

    /**
     * The appearance repository.
     *
     * @var SettingRepositoryInterface
     */
    protected $appearance;

    /**
     * Create a new AppearanceModulePlugin instance.
     *
     * @param SettingRepositoryInterface $appearance
     */
    public function __construct(SettingRepositoryInterface $appearance)
    {
        $this->appearance = $appearance;
    }

    /**
     * Get the plugin functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('setting_get', [$this->appearance, 'get'])
        ];
    }
}
