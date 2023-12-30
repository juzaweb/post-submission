<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://juzaweb.com
 * @license    GNU V2
 */

namespace Juzaweb\PostSubmission\Http\Controllers\Frontend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Juzaweb\Backend\Repositories\PostRepository;
use Juzaweb\CMS\Http\Controllers\FrontendController;
use Juzaweb\PostSubmission\Http\Requests\StorePostRequest;

class PostSubmissionController extends FrontendController
{
    public function __construct(protected PostRepository $postRepository)
    {
    }

    public function store(StorePostRequest $request): JsonResponse|RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $post = $this->postRepository->create($request->safe()->all());

            $post->syncTaxonomies($request->safe()->all());
        });

        return $this->success(
            trans('Post submitted successfully!'),
        );
    }
}
