<?php namespace Anomaly\AppearanceModule\Http\Controller\Admin;

use Anomaly\SettingsModule\Setting\Form\SettingFormBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class AdminThemesController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AppearanceModule\Http\Controller\Admin
 */
class AdminThemesController extends AdminController
{

    /**
     * Return the settings form for the admin theme.
     *
     * @param SettingFormBuilder $settings
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function settings(SettingFormBuilder $settings)
    {
        return $settings->render(config('streams::themes.admin.active'));
    }
}
