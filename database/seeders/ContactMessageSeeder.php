<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_messages')->truncate();

        //(#1) Unread contact message from HerissonMan#8014 in the "Question" category.
        $contactMessage = new ContactMessage();
        $contactMessage->fill([
            'truckersmp_id' => '900597',
            'vtc' => 'Forza Logistics',
            'discord' => 'HerissonMan#8014',
            'email' => 'herissonman@example.com',
            'message' => 'This is a message to test the contact system :)'
        ]);
        $contactMessage->category()->associate(1);
        $contactMessage->save();

        //(#2) Unread contact message from RootKiller#1111 in the "Privacy / Personal data" category.
        $contactMessage = new ContactMessage();
        $contactMessage->fill([
            'truckersmp_id' => '1',
            'vtc' => null,
            'discord' => 'RootKiller#1111',
            'email' => 'rootkiller@example.com',
            'message' => 'This is another message to test the contact system :)'
        ]);
        $contactMessage->category()->associate(5);
        $contactMessage->save();

        //(#3) Read contact message from Julien417#0000 in the "Report a Bug (Website / Discord)" category.
        $contactMessage = new ContactMessage();
        $contactMessage->fill([
            'truckersmp_id' => '12345',
            'vtc' => null,
            'discord' => 'Julien417#0000',
            'email' => null,
            'message' => 'Hello!',
            'status' => 'read'
        ]);
        $contactMessage->category()->associate(3);
        $contactMessage->save();

        //(#4) Read contact message from someone@example.com in the "I want OCSC to supervise my convoy" category.
        $contactMessage = new ContactMessage();
        $contactMessage->fill([
            'truckersmp_id' => '99999',
            'vtc' => null,
            'discord' => null,
            'email' => 'someone@example.com',
            'message' => 'Hello!',
            'status' => 'read'
        ]);
        $contactMessage->category()->associate(2);
        $contactMessage->save();
    }
}
