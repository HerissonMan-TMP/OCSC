<?php

namespace App\Console\Commands;

use App\Models\ContactCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateContactCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contact-categories:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store the default contact categories for production in the database.';

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
        $continue = true;

        if (ContactCategory::exists()) {
            $continue = $this->confirm('The partner categories table is not empty. By continuing, the current data will be deleted and replaced by new ones. Do you want to continue?');
        }

        if ($continue) {
            DB::table('contact_categories')->delete();

            //Question.
            ContactCategory::create([
                'name' => 'Question',
            ]);

            //I want OCSC to supervise my convoy.
            ContactCategory::create([
                'name' => 'I want OCSC to supervise my convoy',
            ]);

            //Report a Bug (Website / Discord).
            ContactCategory::create([
                'name' => 'Report a Bug (Website / Discord)',
            ]);

            //Report a Staff member.
            ContactCategory::create([
                'name' => 'Report a Staff member',
            ]);

            //Privacy / Personal data.
            ContactCategory::create([
                'name' => 'Privacy / Personal data',
            ]);

            $this->info('The contact categories have been successfully stored!');
        }

        return 0;
    }
}
