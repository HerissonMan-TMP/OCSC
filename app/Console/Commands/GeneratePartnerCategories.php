<?php

namespace App\Console\Commands;

use App\Models\PartnerCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GeneratePartnerCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'partner-categories:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store the default partner categories for production in the database.';

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

        if (PartnerCategory::exists()) {
            $continue = $this->confirm('The partner categories table is not empty. By continuing, the current data will be deleted and replaced by new ones. Do you want to continue?');
        }

        if ($continue) {
            DB::table('partner_categories')->delete();

            //VTC Partnership.
            PartnerCategory::create([
                'name' => 'VTC Partnership',
                'description' => 'Choose the OCSC Event partnership and benefit from exclusive advantages on our community and our various Convoys / Mega Convoys.',
                'opening_at' => null,
            ]);

            //Community Partnership.
            PartnerCategory::create([
                'name' => 'Community Partnership',
                'description' => 'You are a gaming community linked to ETS2 or TruckersMP and wish to work in cooperation with OCSC Event?',
                'opening_at' => null,
            ]);

            $this->info('The partner categories have been successfully stored!');
        }

        return 0;
    }
}
