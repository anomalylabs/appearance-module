<?php namespace Anomaly\AppearanceModule\Variable\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class VariableFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AppearanceModule\Variable\Form
 */
class VariableFormBuilder extends FormBuilder
{

    /**
     * The form fields handler.
     *
     * @var string
     */
    protected $fields = 'Anomaly\AppearanceModule\Variable\Form\VariableFormFields@handle';

    /**
     * The form actions handler.
     *
     * @var string
     */
    protected $actions = [
        'save'
    ];

    /**
     * The form buttons handler.
     *
     * @var string
     */
    protected $buttons = [
        'cancel'
    ];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [
        'breadcrumb' => false
    ];

    /**
     * Fire at the very beginning
     * of the build process.
     */
    public function onReady()
    {
        $this->setOption('permission', $this->entry . '::appearance');
    }
}
