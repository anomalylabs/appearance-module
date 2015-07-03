<?php namespace Anomaly\AppearanceModule\Http\Controller\Admin;

use Anomaly\AppearanceModule\Setting\Form\SettingFormBuilder;
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
     * @param SettingFormBuilder $appearance
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(SettingFormBuilder $appearance)
    {
        return $appearance->setOption('breadcrumb', null)->render('streams');
    }
}
