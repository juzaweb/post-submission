<?php

namespace Juzaweb\Postsubmission\Actions;

use Juzaweb\CMS\Abstracts\Action;

class ConfigAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::INIT_ACTION, [$this, 'addAdminConfigs']);
    }

    public function addAdminConfigs(): void
    {
        $this->addAdminMenu(
            trans('Post submission'),
            'post-submission',
            [
                'icon' => 'fa fa-plus',
                'position' => 99,
            ]
        );

        $this->registerPostType(
            'post-submission',
            [

            ]
        );

        $this->hookAction->registerSettingPage(
            'post-submission',
            [
                'label' => trans('Post Submission'),
                'menu' => [
                    'parent' => 'post-submission',
                    'position' => 99,
                ]
            ]
        );

        $this->hookAction->addSettingForm(
            'post-submission',
            [
                'name' => 'Crawler Settings',
                'page' => 'post-submission'
            ]
        );

        $this->hookAction->registerConfig(
            [
                'post_submit_enable' => [
                    'type' => 'select',
                    'label' => 'Enable Post Submit',
                    'form' => 'post-submission',
                    'data' => [
                        'options' => [
                            0 => trans('cms::app.disabled'),
                            1 => trans('cms::app.enable')
                        ],
                    ]
                ],
            ]
        );
    }
}
