<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://juzaweb.com
 * @license    GNU V2
 */

namespace Juzaweb\PostSubmission\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Juzaweb\Backend\Models\Taxonomy;
use Juzaweb\CMS\Facades\Theme;
use Juzaweb\CMS\Facades\HookAction;

class StorePostRequest extends FormRequest
{
    public function rules(): array
    {
        $postTypes = $this->getPostTypeSubmitable();
        $taxonomies = HookAction::getTaxonomies($this->input('type'));

        $rules = [
            'title' => ['required', 'max:255'],
            'content' => ['required'],
            'type' => ['required', Rule::in($postTypes)],
        ];

        foreach ($taxonomies as $taxonomy) {
            $rules[$taxonomy->get('taxonomy')] = [
                'nullable',
                'array',
            ];

            $taxonomyIds = Taxonomy::whereIn('id', $this->input($taxonomy->get('taxonomy'), []))->get(['id']);

            $rules[$taxonomy->get('taxonomy').'.*'] = [
                'nullable',
                'integer',
                Rule::in($taxonomyIds),
            ];
        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return get_config('post_submit_enable', 0) == 1
            && count($this->getPostTypeSubmitable()) > 0;
    }

    protected function getPostTypeSubmitable(): array
    {
        $type = Theme::currentTheme()->getRegister('post_type_submitable', []);

        if (!is_array($type)) {
            $type = [$type];
        }

        return $type;
    }
}
