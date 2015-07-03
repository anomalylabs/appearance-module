<?php namespace Anomaly\AppearanceModule\Http\Controller\Admin;

use Anomaly\AppearanceModule\Variable\Form\VariableFormBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class AppearanceController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AppearanceModule\Http\Controller\Admin
 */
class AppearanceController extends AdminController
{

    /**
     * Return the system appearance form.
     *
     * @param VariableFormBuilder $appearance
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(VariableFormBuilder $appearance)
    {
        return $appearance->setOption('breadcrumb', null)->render('streams');
    }
}
