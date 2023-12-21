<?php

namespace Juzaweb\PostSubmit\Http\Controllers;

use Juzaweb\CMS\Http\Controllers\BackendController;

class PostSubmitController extends BackendController
{
    public function index()
    {
        //

        return view(
            'post_submit::index',
            [
                'title' => 'Title Page',
            ]
        );
    }
}
