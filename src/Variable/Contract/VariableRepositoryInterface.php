<?php namespace Anomaly\AppearanceModule\Variable\Contract;

use Anomaly\AppearanceModule\Variable\VariableCollection;

/**
 * Interface VariableRepositoryInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AppearanceModule\VariableInterface\Contract
 */
interface VariableRepositoryInterface
{

    /**
     * Find a Variable by it's key
     * or return a new instance.
     *
     * @param $key
     * @return VariableInterface
     */
    public function findOrNew($key);

    /**
     * Get a Variable value.
     *
     * @param      $key
     * @param null $default
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * Set a Variable value.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value);

    /**
     * Get all appearance for a namespace.
     *
     * @param $getNamespace
     * @return VariableCollection
     */
    public function getAll($namespace);
}
