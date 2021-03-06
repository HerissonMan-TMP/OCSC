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
        $contactMessage = new ContactMessage;
        $contactMessage->fill([
            'truckersmp_id' => '900597',
            'vtc' => null,
            'discord' => 'HerissonMan#8014',
            'email' => 'herissonman@gmail.com',
            'message' => 'This is a message to test the contact system :)'
        ]);
        $contactMessage->category()->associate(1);
        $contactMessage->save();

        $contactMessage = new ContactMessage;
        $contactMessage->fill([
            'truckersmp_id' => '111111',
            'vtc' => 'Forza Trucking',
            'discord' => 'Antho#1111',
            'email' => 'antho@gmail.com',
            'message' => 'This is another message to test the contact system :)'
        ]);
        $contactMessage->category()->associate(2);
        $contactMessage->save();

        $contactMessage = new ContactMessage;
        $contactMessage->fill([
            'truckersmp_id' => '12345',
            'vtc' => null,
            'discord' => 'Julien417#1234',
            'email' => null,
            'message' => 'Hello !',
            'status' => 'read'
        ]);
        $contactMessage->category()->associate(2);
        $contactMessage->save();
    }
}
