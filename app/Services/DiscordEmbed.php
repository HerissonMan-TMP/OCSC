<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DiscordEmbed
{
    protected $embed;

    protected $webhookUrl;

    protected $username = 'OCSC Event';

    protected $avatarUrl = 'https://ocsc.fr/img/ocsc_logo.png';

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
            ]
        ]);
    }
}
