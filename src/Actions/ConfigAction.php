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
        // $this->addAdminMenu(
        //     trans('Post Submission'),
        //     'post-submissions',
        //     [
        //         'icon' => 'fa fa-plus',
        //         'position' => 99,
        //     ]
        // );
        //
        // $this->hookAction->registerSettingPage(
        //     'post-submission',
        //     [
        //         'label' => trans('Settings'),
        //         'menu' => [
        //             'parent' => 'post-submissions',
        //             'position' => 99,
        //             'icon' => 'fa fa-cog'
        //         ]
        //     ]
        // );

        $this->hookAction->addSettingForm(
            'post-submission',
            [
                'name' => trans('Post Submission'),
                //'page' => 'post-submissions'
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
                        'description' => trans('Url for post submit: :url', ['url' => url('ajax/post-submit')]),
                    ]
                ],
            ]
        );
    }
}
