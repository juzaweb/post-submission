<?php

namespace Juzaweb\PostSubmission\Actions;

use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\PostSubmission\Http\Controllers\Frontend\PostSubmissionController;

class AjaxAction extends Action
{
    /**
     * Execute the actions.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->addAction(Action::FRONTEND_INIT, [$this, 'addFrontendAjaxs']);
    }

    public function addFrontendAjaxs(): void
    {
        $this->registerFrontendAjax(
            'post-submit',
            [
                'method' => 'POST',
                'callback' => [PostSubmissionController::class, 'store'],
            ]
        );
    }
}
