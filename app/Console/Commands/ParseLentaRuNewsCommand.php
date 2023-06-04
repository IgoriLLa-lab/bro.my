<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ParseLentaRuNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parse-lenta-ru-news-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = 'https://lenta.ru/rss/news';
        $xmlFile = file_get_contents($url);
        $xmlObject = (array) simplexml_load_string($xmlFile, null, LIBXML_NOCDATA);
        $jsonFormatData = json_encode($xmlObject);
        $result = json_decode($jsonFormatData, true);
        $count = 0;

        foreach ($result['channel']['item'] as $item) {
            $tag = Tag::firstOrCreate(['name' => $item['category']]);

            if (Article::where('name', $item['title'])->doesntExist()) {
                $filename = basename($item['enclosure']['@attributes']['url']);
                $filename = 'images/' . $filename;
                Storage::disk('local')->put($filename, file_get_contents($item['enclosure']['@attributes']['url']), 'public');

                $article = Article::create([
                    'name' => $item['title'],
                    'description' => $item['description'],
                    'image' => $filename,
                ]);

                if (isset($tag)) {
                    $article->tags()->attach($tag);
                }

                $count++;
            }
        }

        $this->info('Добавлено ' . $count . ' новостей');

        return CommandAlias::SUCCESS;
    }
}
