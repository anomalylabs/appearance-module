<?php namespace Anomaly\AppearanceModule\Variable\Form;

use Anomaly\AppearanceModule\Variable\Contract\VariableRepositoryInterface;
use Illuminate\Config\Repository;

/**
 * Class VariableFormFields
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AppearanceModule\Variable\Form
 */
class VariableFormFields
{

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * Create a new VariableFormFields instance.
     *
     * @param Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * Return the form fields.
     *
     * @param VariableFormBuilder $builder
     */
    public function handle(VariableFormBuilder $builder, VariableRepositoryInterface $appearance)
    {
        $namespace = $builder->getFormEntry() . '::';

        /**
         * Get the fields from the config system. Sections are
         * optionally defined the same way.
         */
        if (!$fields = $this->config->get($namespace . 'appearance/appearance')) {
            $fields = $fields = $this->config->get($namespace . 'appearance', []);
        }

        if ($sections = $this->config->get($namespace . 'appearance/sections')) {
            $builder->setSections($sections);
        }

        /**
         * Finish each field.
         */
        foreach ($fields as $slug => &$field) {

            /**
             * Force an array. This is done later
             * too in normalization but we need it now
             * because we are normalizing / guessing our
             * own parameters somewhat.
             */
            if (is_string($field)) {
                $field = [
                    'type' => $field
                ];
            }

            // Make sure we have a config property.
            $field['config'] = array_get($field, 'config', []);

            // Default the label.
            $field['label'] = trans(
                array_get(
                    $field,
                    'label',
                    $namespace . 'Variable.' . $slug . '.label'
                )
            );

            // Default the placeholder.
            $field['config']['placeholder'] = trans(
                array_get(
                    $field['config'],
                    'placeholder',
                    $namespace . 'Variable.' . $slug . '.placeholder'
                )
            );

            // Default the instructions.
            $field['instructions'] = trans(
                array_get(
                    $field,
                    'instructions',
                    $namespace . 'Variable.' . $slug . '.instructions'
                )
            );

            // Get the value defaulting to the default value.
            $field['value'] = $appearance->get($namespace . $slug, array_get($field['config'], 'default_value'));
        }

        $builder->setFields($fields);
    }
}
