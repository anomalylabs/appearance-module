<?php namespace Anomaly\AppearanceModule\Variable\Form;

use Anomaly\AppearanceModule\Variable\Contract\VariableRepositoryInterface;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Ui\Form\Contract\FormRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Config\Repository;
use Illuminate\Container\Container;

/**
 * Class VariableFormRepositoryInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AppearanceModule\Variable\Form
 */
class VariableFormRepository implements FormRepositoryInterface
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
     * @var VariableRepositoryInterface
     */
    protected $appearance;

    /**
     * The application container.
     *
     * @var Container
     */
    protected $container;

    /**
     * Create a new VariableFormRepositoryInterface instance.
     *
     * @param Repository                 $config
     * @param Container                  $container
     * @param VariableRepositoryInterface $appearance
     */
    public function __construct(Repository $config, Container $container, VariableRepositoryInterface $appearance)
    {
        $this->config    = $config;
        $this->appearance  = $appearance;
        $this->container = $container;
    }

    /**
     * Find an entry or return a new one.
     *
     * @param $id
     * @return string
     */
    public function findOrNew($id)
    {
        return $id;
    }

    /**
     * Save the form.
     *
     * @param FormBuilder $builder
     * @return bool|mixed
     */
    public function save(FormBuilder $builder)
    {
        $form = $builder->getForm();

        $namespace = $form->getEntry() . '::';

        /* @var FieldType $field */
        foreach ($form->getFields() as $field) {
            $this->appearance->set(
                $namespace . $field->getField(),
                $form->getValue($field->getInputName())
            );
        }
    }
}
