<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateProductionData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'production-data:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store the necessary default production data in the database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('groups:generate');
        $this->call('roles:generate');
        $this->call('permission-categories:generate');
        $this->call('permissions:generate');
        $this->call('activity-types:generate');
        $this->call('partner-categories:generate');
        $this->call('contact-categories:generate');

        $this->info('Production data has been successfully stored in the database!');

        return 0;
    }
}
