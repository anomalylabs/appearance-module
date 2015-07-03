<?php namespace Anomaly\AppearanceModule\Variable;

use Anomaly\AppearanceModule\Variable\Contract\VariableInterface;
use Anomaly\Streams\Platform\Model\Appearance\AppearanceVariablesEntryModel;

/**
 * Class VariableModel
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AppearanceModule\VariableInterface
 */
class VariableModel extends AppearanceVariablesEntryModel implements VariableInterface
{

    /**
     * The cache minutes.
     *
     * @var int
     */
    protected $cacheMinutes = 99999;

}
