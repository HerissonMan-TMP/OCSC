<?php

namespace App\Console\Commands;

use App\Models\Download;
use App\Models\Picture;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Faker\Generator;

class UploadFakeFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake-files:upload
                            {--D|downloads : upload fake download files}
                            {--P|pictures : upload fake picture files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload fake files for testing / seeding purposes.';
    /**
     * @var Generator
     */

    /**
     * A Faker Generator instance.
     *
     * @var Generator
     */
    protected Generator $faker;

    /**
     * Create a new command instance.
     *
     * @param Generator $faker
     */
    public function __construct(Generator $faker)
    {
        $this->faker = $faker;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->option('downloads')) {
            $files = Storage::allFiles('downloads');
            Storage::delete($files);

            $this->withProgressBar(Download::all(), function ($download) {
                $url = $this->faker->imageUrl(
                    1920,
                    1080,
                    null,
                    false,
                    $this->faker->word()
                );

                $filename = uniqid('download_', true) . '.png';
                $contents = file_get_contents($url);

                Storage::put('downloads/' . $filename, $contents);

                $download->update([
                    'original_file_name' => $filename,
                    'path' => $filename,
                ]);
            });

            $this->newLine();

            $this->info("Download files have been successfully uploaded using the \"" . config('filesystems.default') . "\" driver!");
        }

        if ($this->option('pictures')) {
            $files = Storage::allFiles('pictures');
            Storage::delete($files);

            $this->withProgressBar(Picture::all(), function ($picture) {
                $url = $this->faker->imageUrl(
                    1920,
                    1080,
                    null,
                    false,
                    $this->faker->word()
                );

                $filename = uniqid('img_', true) . '.png';
                $contents = file_get_contents($url);

                if (config('filesystems.default') === 'local') {
                    Storage::disk('public')->put('gallery/' . $filename, $contents);
                } else {
                    Storage::put('gallery/' . $filename, $contents);
                }

                $picture->update([
                    'path' => $filename,
                ]);
            });

            $this->newLine();

            $this->info("Picture files have been successfully uploaded using the \"" . config('filesystems.default') . "\" driver!");
        }

        return 0;
    }
}
