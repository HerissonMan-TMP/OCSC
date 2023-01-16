<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class DiscordEmbed
{
    protected $embed;

    protected $webhookUrl;

    protected $username = 'OCSC Event';

    protected $avatarUrl = 'https://ocsc-event.com/img/ocsc_logo.png';

    protected $content = '';

    public function __construct()
    {
        $this->embed['fields'] = [];
    }

    public function username(string $username)
    {
        $this->username = $username;

        return $this;
    }

    public function webhook(string $webhookUrl)
    {
        $this->webhookUrl = $webhookUrl;

        return $this;
    }

    public function content(string $message)
    {
        $this->content = $message;

        return $this;
    }

    public function title(string $title)
    {
        $this->embed['title'] = $title;

        return $this;
    }

    public function description(string $description)
    {
        $this->embed['description'] = $description;

        return $this;
    }

    public function url(string $url)
    {
        $this->embed['url'] = $url;

        return $this;
    }

    public function color(int $color)
    {
        $this->embed['color'] = $color;

        return $this;
    }

    public function footer(string $text, string $iconUrl)
    {
        $this->embed['footer']['text'] = $text;
        $this->embed['footer']['icon_url'] = $iconUrl;

        return $this;
    }

    public function image(string $url)
    {
        $this->embed['image']['url'] = $url;

        return $this;
    }

    public function thumbnail(string $url)
    {
        $this->embed['thumbnail']['url'] = $url;

        return $this;
    }

    public function provider(string $name, string $url)
    {
        $this->embed['provider']['name'] = $name;
        $this->embed['provider']['url'] = $url;

        return $this;
    }

    public function author(string $name, string $url, string $iconUrl)
    {
        $this->embed['author']['name'] = $name;
        $this->embed['author']['url'] = $url;
        $this->embed['author']['icon_url'] = $iconUrl;

        return $this;
    }

    public function addField(string $name, string $value, bool $inline)
    {
        $field = ['name' => $name, 'value' => $value, 'inline' => $inline];

        array_push($this->embed['fields'], $field);

        return $this;
    }

    public function send()
    {
        Http::post($this->webhookUrl, [
            'username' => $this->username,
            'avatar_url' => $this->avatarUrl,
            'content' => $this->content,
            'embeds' => [
                $this->embed
            ],
        ]);
    }

    public function applicationEmbed($recruitment, $request)
    {
        $this
            ->webhook(config('discord_webhooks.applications'))
            ->username('OCSC Event - Recruiter')
            ->author('OCSC Event', config('app.url'), asset('img/ocsc_logo.png'))
            ->color(hexdec(ltrim($recruitment->load('role')->role->color, '#')))
            ->thumbnail(config('app.url') . '/img/ocsc_logo.png')
            ->title('📁 - Application received')
            ->description($request->discord . ' (TMP ID: ' . $request->truckersmp_id . ') just sent an application on the website!')
            ->addField('Role', $recruitment->role->name, false)
            ->image('https://cdn.discordapp.com/attachments/819698398872731729/894909102306783262/ets2_20210906_153815_00.png')
            ->footer(config('app.url'), asset('img/ocsc_logo.png'));

        return $this;
    }

    public function contactMessageEmbed($contactCategory, $contactMessage, $request)
    {
        $this
            ->webhook(config('discord_webhooks.support'))
            ->username('OCSC Event - Postman')
            ->author('OCSC Event', config('app.url'), asset('img/ocsc_logo.png'))
            ->color(hexdec('FFFFFF'))
            ->thumbnail(config('app.url') . '/img/ocsc_logo.png')
            ->title('✉️ - Contact message received')
            ->description(($request->discord ?? $request->email) . ' just sent a contact message on the website.')
            ->addField('Category', $contactCategory->label . ' - ' . $contactCategory->name, false)
            ->addField('Read the message', config('app.url') . '/staff/contact-messages/' . $contactMessage->id, false)
            ->image('https://media.discordapp.net/attachments/824978783051448340/849887295611994152/ets2_20210515_230820_00.png?width=1246&height=701')
            ->footer(config('app.url'), asset('img/ocsc_logo.png'));

        return $this;
    }

    public function maintenanceEnabledEmbed()
    {
        $this
            ->webhook(config('discord_webhooks.general'))
            ->username('OCSC Event - Worker')
            ->author('OCSC Event', config('app.url'), asset('img/ocsc_logo.png'))
            ->color(1096065)
            ->thumbnail(config('app.url') . '/img/ocsc_logo.png')
            ->title('🛠 - Maintenance Mode')
            ->description('The website\'s maintenance mode has just been **enabled**.
                You will be notified when it will become available again.
                Thank you for your patience!'
            )
            ->footer(config('app.url'), asset('img/ocsc_logo.png'));

        return $this;
    }

    public function maintenanceDisabledEmbed()
    {
        $this
            ->webhook(config('discord_webhooks.general'))
            ->username('OCSC Event - Worker')
            ->author('OCSC Event', config('app.url'), asset('img/ocsc_logo.png'))
            ->color(15680580)
            ->thumbnail(config('app.url') . '/img/ocsc_logo.png')
            ->title('🛠 - Maintenance Mode')
            ->description('The website\'s maintenance mode has just been **disabled**. You can browse our website again!')
            ->footer(config('app.url'), asset('img/ocsc_logo.png'));

        return $this;
    }

    public function event($convoy)
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $convoy['response']['start_at'])->format('l F jS');
        $time = Carbon::createFromFormat('Y-m-d H:i:s', $convoy['response']['start_at'])->format('H:i');
        $server = $convoy['response']['server']['name'];
        $url = 'https://truckersmp.com/' . $convoy['response']['url'];

        $this
            ->username('OCSC Event - Events of the week')
            ->author('OCSC Event', config('app.url'), asset('img/ocsc_logo.png'))
            ->color(2544047)
            ->thumbnail(asset('img/ocsc_logo.png'))
            ->title($convoy['response']['name'])
            ->url('https://truckersmp.com/' . $convoy['response']['url'])
            ->description("
            __:clock1: Start date & time:__
            **${date}**, at ${time} UTC

            __:globe_with_meridians: Server:__
            ${server}

            __:notepad_spiral: Additional information:__
            - From **{$convoy['response']['departure']['city']}** to **{$convoy['response']['arrive']['city']}**
            - Map [here]({$convoy['response']['map']})

            To attend this event, [register on TruckersMP](${url}) by clicking on \"I will be there!\".
            ")
            ->image($convoy['response']['banner'] || 'https://media.discordapp.net/attachments/824978783051448340/849887295611994152/ets2_20210515_230820_00.png?width=1246&height=701')
            ->footer(config('app.url'), asset('img/ocsc_logo.png'));

        return $this;
    }
}
