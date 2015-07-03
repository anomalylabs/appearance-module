<?php namespace Anomaly\AppearanceModule\Variable;

use Anomaly\AppearanceModule\Variable\Contract\VariableInterface;
use Anomaly\AppearanceModule\Variable\Contract\VariableRepositoryInterface;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeModifier;
use Illuminate\Config\Repository;

/**
 * Class VariableRepositoryInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AppearanceModule\VariableInterface
 */
class VariableRepository implements VariableRepositoryInterface
{

    /**
     * The Variable model.
     *
     * @var VariableModel
     */
    protected $model;

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * Create a new VariableRepositoryInterface instance.
     *
     * @param VariableModel $model
     * @param Repository   $config
     */
    public function __construct(VariableModel $model, Repository $config)
    {
        $this->model  = $model;
        $this->config = $config;
    }

    /**
     * Find a Variable by it's key
     * or return a new instance.
     *
     * @param $key
     * @return VariableInterface
     */
    public function findOrNew($key)
    {
        $Variable = $this->model->where('key', $key)->first();

        if (!$Variable) {
            return $this->model->newInstance();
        }

        return $Variable;
    }

    /**
     * Get a Variable value.
     *
     * @param      $key
     * @param null $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $Variable = $this->model->where('key', $key)->first();

        if (!$Variable) {
            return $this->config->get($key, $default);
        }

        if (!$field = config(str_replace('::', '::variables/variables.', $key))) {
            $field = config(str_replace('::', '::variables.', $key));
        }

        if (is_string($field)) {
            $field = [
                'type' => $field
            ];
        }

        $type = app(array_get($field, 'type'));

        if (!$type instanceof FieldType) {
            return null;
        }

        return $Variable->value;
    }

    /**
     * Set a Variable value.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
    {
        $Variable = $this->model->where('key', $key)->first();

        if (!$Variable) {

            $Variable = $this->model->newInstance();

            $Variable->key = $key;
        }

        if (!$field = config(str_replace('::', '::appearance/appearance.', $key))) {
            $field = config(str_replace('::', '::appearance.', $key));
        }

        if (is_string($field)) {
            $field = [
                'type' => $field
            ];
        }

        $type = app(array_get($field, 'type'));

        $modifier = $type->getModifier();

        if ($modifier instanceof FieldTypeModifier) {
            $value = $modifier->modify($value);
        }

        $Variable->value = $value;

        $Variable->save();

        return $this;
    }

    /**
     * Get all appearance for a namespace.
     *
     * @param $getNamespace
     * @return VariableCollection
     */
    public function getAll($namespace)
    {
        $appearance = $this->model->where('key', 'LIKE', $namespace . '::%')->get();

        return new VariableCollection($appearance->lists('value', 'key'));
    }
}
