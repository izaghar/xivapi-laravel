# XIVAPI Laravel

Laravel integration for the [XIVAPI PHP client](https://github.com/izaghar/xivapi-php).

## Installation

```bash
composer require izaghar/xivapi-laravel
```

The service provider will be auto-discovered.

## Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=xivapi-config
```

### Environment Variables

```env
XIVAPI_LANGUAGE=en
XIVAPI_GAME_VERSION=7.0
XIVAPI_SCHEMA=exdschema@latest
XIVAPI_LOCALIZATIONS=en,de,fr,ja
```

### Config File

```php
// config/xivapi.php
return [
    'language' => env('XIVAPI_LANGUAGE'),
    'game_version' => env('XIVAPI_GAME_VERSION'),
    'schema' => env('XIVAPI_SCHEMA'),
    'localizations' => env('XIVAPI_LOCALIZATIONS'),
];
```

## Usage

### Via Facade

```php
use XivApi\Laravel\Facades\XivApi;

// Fetch an item
$item = XivApi::sheet('Item')->row(4)->get();

// Search with query string
$results = XivApi::search()
    ->query('+Name~"Potion" +LevelItem>=10')
    ->sheets(['Item'])
    ->get();

// Search with SearchQuery builder
use XivApi\Query\SearchQuery;

$results = XivApi::search()
    ->query(SearchQuery::where('Name')->contains('Potion'))
    ->sheets(['Item'])
    ->get();

// Override global settings per-request
$item = XivApi::sheet('Item')
    ->row(4)
    ->language(Language::German)
    ->get();
```

### Via Dependency Injection

```php
use XivApi\XivApi;

class ItemController extends Controller
{
    public function show(XivApi $api, int $id)
    {
        return $api->sheet('Item')->row($id)->get();
    }
}
```

### Via Service Container

```php
$api = app(XivApi::class);
$item = $api->sheet('Item')->row(4)->get();

// Or using the alias
$api = app('xivapi');
```

## License

MIT