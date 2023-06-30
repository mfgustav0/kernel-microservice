<?php

namespace Tests\Kernel;

use Tests\Shared\TestCase;
use Illuminate\Support\Facades\Log;
use Illuminate\Testing\Fluent\AssertableJson;

class LogControllerTest extends TestCase
{
    public function test_user_can_not_list_data_if_not_autenticate(): void
    {
        //Prepare

        //Act
        $this->get('/logs');

        //Assert
        $this
            ->seeJsonEquals([
                'message' => 'Unauthorized.'
            ])
            ->assertEquals(401, $this->response->status());
    }

    public function test_user_can_not_list_data_if_not_admin_user(): void
    {
        //Prepare

        //Act
        $this->get('/logs', $this->getHeaders(is_admin: false));


        //Assert
        $this
            ->seeJsonEquals([
                'message' => 'This action is unauthorized.'
            ])
            ->assertEquals(401, $this->response->status());
    }

    public function test_user_should_list_log_if_autenticate_with_admin(): void
    {
        //Prepare
        Log::error('teste');

        //Act
        $this->get('/logs', $this->getHeaders(is_admin: true));


        //Assert
        $this
            ->seeJson([
                'total' => 1,
                'count' => 1,
                'per_page' => 15,
                'current_page' => 1,
                'total_pages' => 1,
            ])
            ->assertEquals(200, $this->response->status());
    }
}