<?php namespace Anomaly\AppearanceModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class AppearanceModule
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Appearance\Module
 */
class AppearanceModule extends Module
{

    /**
     * The module icon.
     *
     * @var string
     */
    protected $icon = 'brush';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'admin',
        'public'
    ];

}
