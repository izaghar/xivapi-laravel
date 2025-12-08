<?php

declare(strict_types=1);

namespace XivApi\Laravel;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use XivApi\Enums\Language;
use XivApi\XivApi;

class XivApiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/xivapi.php', 'xivapi');

        $this->app->singleton(XivApi::class, function (Application $app): XivApi {
            $config = $app['config']['xivapi'];

            $api = new XivApi(
                new Client,
                new HttpFactory,
            );

            if ($config['language']) {
                $api = $api->language(Language::from($config['language']));
            }

            if ($config['game_version']) {
                $api = $api->gameVersion($config['game_version']);
            }

            if ($config['schema']) {
                $api = $api->schema($config['schema']);
            }

            $localizations = $this->parseLocalizations($config['localizations']);
            if ($localizations !== []) {
                $api = $api->localizations(...$localizations);
            }

            return $api;
        });

        $this->app->alias(XivApi::class, 'xivapi');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/xivapi.php' => $this->app->configPath('xivapi.php'),
            ], 'xivapi-config');
        }
    }

    /**
     * Parse localizations from config (string or array).
     *
     * @return list<Language>
     */
    private function parseLocalizations(mixed $value): array
    {
        if ($value === null) {
            return [];
        }

        if (is_string($value)) {
            $value = array_filter(array_map('trim', explode(',', $value)));
        }

        if (! is_array($value)) {
            return [];
        }

        return array_map(
            fn (string $lang): Language => Language::from($lang),
            $value,
        );
    }
}
