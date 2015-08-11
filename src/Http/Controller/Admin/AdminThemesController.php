<?php namespace Anomaly\AppearanceModule\Http\Controller\Admin;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\SettingsModule\Setting\Form\SettingFormBuilder;
use Anomaly\Streams\Platform\Addon\Theme\ThemeCollection;
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

    /**
     * Return the modal list of admin themes.
     *
     * @param ThemeCollection $themes
     * @return \Illuminate\View\View
     */
    public function choose(ThemeCollection $themes)
    {
        $themes = $themes->admin();

        return view('module::ajax/admin_themes', compact('themes'));
    }

    /**
     * Activate the chosen theme.
     *
     * @param SettingRepositoryInterface $settings
     * @param                            $namespace
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function activate(SettingRepositoryInterface $settings, $namespace)
    {
        $settings->set('streams::admin_theme', $namespace);

        return redirect('admin/appearance');
    }
}
