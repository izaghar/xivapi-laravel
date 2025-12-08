<?php

declare(strict_types=1);

namespace XivApi\Laravel\Facades;

use Illuminate\Support\Facades\Facade;
use XivApi\Client\AssetClient;
use XivApi\Client\MapAssetClient;
use XivApi\Client\SearchClient;
use XivApi\Client\SheetIndexClient;
use XivApi\Client\SheetRowsClient;
use XivApi\Client\VersionClient;
use XivApi\Enums\AssetFormat;
use XivApi\Enums\Language;
use XivApi\XivApi as XivApiClient;

/**
 * @method static XivApiClient language(Language $language)
 * @method static XivApiClient gameVersion(string $version)
 * @method static XivApiClient schema(string $schema)
 * @method static XivApiClient localizations(Language ...$languages)
 * @method static VersionClient version()
 * @method static SheetIndexClient sheetIndex()
 * @method static SheetRowsClient sheet(string $sheet)
 * @method static SearchClient search()
 * @method static AssetClient asset(string $path, AssetFormat $format = AssetFormat::Png)
 * @method static MapAssetClient map(string $territory, string $index)
 *
 * @see XivApiClient
 */
class XivApi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return XivApiClient::class;
    }
}
