<?php

namespace Juzaweb\PostSubmission\Providers;

use Juzaweb\CMS\Support\ServiceProvider;
use Juzaweb\PostSubmission\Actions\AjaxAction;
use Juzaweb\PostSubmission\Actions\ConfigAction;

class PostSubmitServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerHookActions([ConfigAction::class, AjaxAction::class]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }
}
