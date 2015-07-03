<?php namespace Anomaly\AppearanceModule\Variable;

use Illuminate\Support\Collection;

/**
 * Class VariableCollection
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AppearanceModule\VariableInterface
 */
class VariableCollection extends Collection
{

    /**
     * Create a new VariableCollection instance.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        foreach ($items as $key => $value) {
            $this->items[substr($key, strpos($key, '::') + 2)] = $value;
        }
    }
}
