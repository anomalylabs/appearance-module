<?php namespace Anomaly\AppearanceModule\Http\Controller\Admin;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\SettingsModule\Setting\Form\SettingFormBuilder;
use Anomaly\Streams\Platform\Addon\Theme\ThemeCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class PublicThemesController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AppearanceModule\Http\Controller\Admin
 */
class PublicThemesController extends AdminController
{

    /**
     * Return the settings form for the public theme.
     *
     * @param SettingFormBuilder $settings
     * @para ThemeCollection $themes
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function settings(SettingFormBuilder $settings, ThemeCollection $themes)
    {
        if ($theme = $themes->standard()->active()) {
            $settings->setOption(
                'title',
                trans($theme->getName()) . ' <span class="text-success">(' . trans(
                    'module::message.active'
                ) . ')</span>'
            );
        } else {
            $settings->setOption(
                'title',
                '<span class="text-danger">' . trans('module::message.no_public_theme') . '</span>'
            );
        }

        return $settings->render(config('streams::themes.active.standard'));
    }

    /**
     * Return the modal list of public themes.
     *
     * @param ThemeCollection $themes
     * @return \Illuminate\View\View
     */
    public function choose(ThemeCollection $themes)
    {
        $themes = $themes->standard();

        return view('module::ajax/standard_themes', compact('themes'));
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
        $settings->set('streams::public_theme', $namespace);

        return redirect('admin/appearance');
    }
}
