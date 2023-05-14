<?php

namespace Tests\Application;

use Carbon\Carbon;
use Tests\Shared\TestCase;

class HomeTest extends TestCase
{
    public function test_user_can_not_list_data_if_not_autenticate(): void
    {
        //Prepare

        //Act
        $this->get('/');

        //Assert
        $this
            ->seeJsonEquals([
                'message' => 'Unauthorized.'
            ])
            ->assertEquals(401, $this->response->status());
    }

    public function test_user_should_list_data_if_autenticate(): void
    {
        //Prepare

        //Act
        $this->get('/', $this->getHeaders());


        //Assert
        $this
            ->seeJsonEquals([
                'version' => $this->app->version(),
                'today' => Carbon::today()->format('Y-m-d')
            ])
            ->assertEquals(200, $this->response->status());
    }
}
