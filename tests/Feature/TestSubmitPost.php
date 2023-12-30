<?php

namespace Juzaweb\PostSubmission\tests\Unit;

use Illuminate\Foundation\Testing\WithFaker;
use Juzaweb\Tests\TestCase;

class TestSubmitPost extends TestCase
{
    use WithFaker;

    protected $defaultHeaders = [
        'Accept' => 'application/json',
        'X-Requested-With' => 'XMLHttpRequest',
    ];

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample(): void
    {
        $this->post('ajax/post-submit', [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'type' => 'posts',
            'taxonomies' => [],
        ])
            ->assertStatus(200)
            ->assertJson(['status' => true]);
    }
}
