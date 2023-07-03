<?php

namespace Tests\Kernel\Commands;

use Tests\Shared\TestCase;
use App\Modules\Kernel\Models\Customer;

class CreateCustomerCommandTest extends TestCase
{
    public function test_cant_create_customer_if_dont_tell_name(): void
    {
        //Prepare

        //Act
        $code = $this->artisan('customer:create');

        //Assert
        $this->assertEquals(1, $code);
    }

    public function test_cant_create_customer_if_already_exist_with_both_name(): void
    {
        //Prepare
        $customer = Customer::factory()->create();

        //Act
        $code = $this->artisan('customer:create', [
            'name' => $customer->name
        ]);

        //Assert
        $this->assertEquals(1, $code);
    }

    public function test_command_shold_create_customer_with_name_available(): void
    {
        //Prepare

        //Act
        $code = $this->artisan('customer:create', [
            'name' => 'name'
        ]);

        //Assert
        $this->assertEquals(0, $code);

        $this->seeInDatabase('customers', [
            'name' => 'name',
            'created_by' => 'app'
        ]);
    }
}