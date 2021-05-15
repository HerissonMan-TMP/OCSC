<?php

namespace App\Console\Commands;

use App\Models\Group;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateGroups extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'groups:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store the default groups for production in the database.';

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

        if (Group::exists()) {
            $continue = $this->confirm('The groups table is not empty. By continuing, the current data will be deleted and replaced by new ones. Do you want to continue?');
        }

        if ($continue) {
            DB::table('groups')->delete();

            //Administrators.
            Group::create([
                'name' => 'Administrators',
            ]);

            //Managers.
            Group::create([
                'name' => 'Managers',
            ]);

            //Staff.
            Group::create([
                'name' => 'Staff',
            ]);

            $this->info('The groups have been successfully stored!');
        }

        return 0;
    }
}
