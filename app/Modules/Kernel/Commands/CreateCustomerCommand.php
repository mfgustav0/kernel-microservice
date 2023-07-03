<?php

namespace App\Modules\Kernel\Commands;

use Illuminate\Console\Command;
use App\Modules\Kernel\Models\Customer;
use App\Modules\Kernel\Enums\Customer\CustomerCreatedBy;

class CreateCustomerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:create 
                                {name? : The name to create customer}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create customer in database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $name = $this->argument('name');
        if(!$name) {
            $this->error(' [name] is required for to create "Customer"! ');
            $this->newLine();

            return Command::FAILURE;
        }

        if($this->hasCustumer($name)) {
            $this->error(" [{$name}] already exists! ");
            $this->newLine();

            return Command::FAILURE;
        }

        $customer = Customer::create([
            'name' => $name,
            'created_by' => CustomerCreatedBy::App
        ]);

        $this->info('Create "Customer" [' . $customer->id . '] with successfully.');
        $this->newLine();

        return Command::SUCCESS;
    }

    /**
     * Verify if exists 'customer' in database with both name.
     *
     * @param  string  $name
     * @return bool
     */
    private function hasCustumer(string $name): bool
    {
        $found = Customer::where(compact('name'))->withTrashed()->count();
        
        return $found > 0;
    }
}