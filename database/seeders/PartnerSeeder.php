<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('partners')->truncate();

        $partner = new Partner();
        $partner->name = 'RLC';
        $partner->logo = 'https://static.truckersmp.com/images/vtc/logo/4.1588057695.png';
        $partner->truckersmp_link = 'https://truckersmp.com/vtc/redlinecargo';
        $partner->trucksbook_link = null;
        $partner->website_link = 'https://redlinecargovtc.com/';
        $partner->twitter_link = 'https://twitter.com/redlinecargovtc';
        $partner->instagram_link = 'https://www.instagram.com/redlinecargovtc/';
        $partner->category()->associate(1);
        $partner->save();

        $partner = new Partner();
        $partner->name = 'TTFR';
        $partner->logo = 'https://static.truckersmp.com/images/vtc/logo/16860.1610725460.png';
        $partner->truckersmp_link = 'https://truckersmp.com/vtc/16860';
        $partner->trucksbook_link = 'https://trucksbook.eu/company/20246';
        $partner->website_link = 'https://sites.google.com/view/team-transport-fr/accueil';
        $partner->twitter_link = 'https://twitter.com/teamtransportfr';
        $partner->instagram_link = 'https://www.instagram.com/ttfr.team.transport.fr/?hl=fr';
        $partner->category()->associate(1);
        $partner->save();

        $partner = new Partner();
       $partner->name = 'Instant Gaming';
       $partner->logo = 'https://www.instant-gaming.com/themes/igv1/images/opengraph-banner.png';
       $partner->truckersmp_link = null;
       $partner->trucksbook_link = null;
       $partner->website_link = 'https://www.instant-gaming.com/?igr=ocsc-officiel';
       $partner->twitter_link = null;
       $partner->instagram_link = null;
        $partner->category()->associate(2);
        $partner->save();

    }
}
