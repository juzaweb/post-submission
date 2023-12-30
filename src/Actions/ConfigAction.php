<?php

namespace Juzaweb\PostSubmission\Actions;

use Juzaweb\CMS\Abstracts\Action;

class ConfigAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::INIT_ACTION, [$this, 'addAdminConfigs']);
    }

    public function addAdminConfigs(): void
    {
        $this->registerPostType(
            'post-submissions',
            [
                'label' => trans('Post Submission'),
                'description' => trans('Post Submit by users'),
                'menu_icon' => 'fa fa-plus',
                'menu_position' => 99,
            ]
        );

        $this->hookAction->registerSettingPage(
            'post-submission',
            [
                'label' => trans('Settings'),
                'menu' => [
                    'parent' => 'post-type.post-submissions',
                    'position' => 99,
                    'icon' => 'fa fa-cog'
                ]
            ]
        );

        $this->hookAction->addSettingForm(
            'post-submission',
            [
                'name' => trans('Settings'),
                'page' => 'post-submission'
            ]
        );

        $this->hookAction->registerConfig(
            [
                'post_submit_enable' => [
                    'type' => 'select',
                    'label' => trans('Enable Post Submit'),
                    'form' => 'post-submission',
                    'data' => [
                        'options' => [
                            0 => trans('cms::app.disabled'),
                            1 => trans('cms::app.enable')
                        ],
                        'validators' => [
                            'required',
                            'in:0,1'
                        ],
                    ]
                ],
            ]
        );
    }
}
