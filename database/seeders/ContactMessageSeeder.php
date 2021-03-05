<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contactMessage1 = new ContactMessage;
        $contactMessage1->truckersmp_id = '900597';
        $contactMessage1->vtc = null;
        $contactMessage1->discord = 'HerissonMan#8014';
        $contactMessage1->email = 'herissonman@gmail.com';
        $contactMessage1->message = 'This is a message to test the contact system :)';
        $contactMessage1->category()->associate(1);
        $contactMessage1->save();

        $contactMessage2 = new ContactMessage;
        $contactMessage2->truckersmp_id = '111111';
        $contactMessage2->vtc = 'Forza Trucking';
        $contactMessage2->discord = 'Antho#1111';
        $contactMessage2->email = 'antho@gmail.com';
        $contactMessage2->message = 'This is another message to test the contact system :)';
        $contactMessage2->category()->associate(2);
        $contactMessage2->save();

        $contactMessage3 = new ContactMessage;
        $contactMessage3->truckersmp_id = '12345';
        $contactMessage3->vtc = null;
        $contactMessage3->discord = 'Julien417#1234';
        $contactMessage3->email = null;
        $contactMessage3->message = 'Hello !';
        $contactMessage3->status = 'read';
        $contactMessage3->category()->associate(2);
        $contactMessage3->save();
    }
}
