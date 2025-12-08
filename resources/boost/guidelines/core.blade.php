## XIVAPI Laravel

This package provides a Laravel integration for XIVAPI v2 (Final Fantasy XIV game data).

### Features

- **Facade**: Access XIVAPI via `XivApi::` facade.
- **Sheet Queries**: Fetch game data from sheets (Item, Action, Quest, etc.).
- **Search**: Search across sheets with query strings or fluent builder.
- **Field Builder**: Select and localize fields.
- **Config**: Set default language, version, schema via environment.

### Usage

@verbatim
<code-snippet name="Fetch a single row" lang="php">
use XivApi\Laravel\Facades\XivApi;

$item = XivApi::sheet('Item')->row(4)->get();
echo $item->fields['Name']; // "Wind Shard"
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="Query multiple rows" lang="php">
use XivApi\Laravel\Facades\XivApi;
use XivApi\Enums\Language;

$items = XivApi::sheet('Item')
    ->fields('Name,Icon')
    ->language(Language::German)
    ->limit(50)
    ->get();
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="Search with query string" lang="php">
use XivApi\Laravel\Facades\XivApi;

$results = XivApi::search()
    ->query('Name~"Potion" +LevelItem>=10')
    ->sheets(['Item'])
    ->get();
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="Search with SearchQuery builder" lang="php">
use XivApi\Laravel\Facades\XivApi;
use XivApi\Query\SearchQuery;

$query = SearchQuery::on('Name')->contains('Potion')
    ->andMust()->on('LevelItem')->greaterOrEqual(10);

$results = XivApi::search()->query($query)->sheets(['Item'])->get();
</code-snippet>
@endverbatim

@verbatim
<code-snippet name="Field builder with localization" lang="php">
use XivApi\Laravel\Facades\XivApi;
use XivApi\Query\Field;
use XivApi\Enums\Transform;

XivApi::sheet('Item')
    ->fields([
        Field::make('Name')->localized(),
        Field::make('Description')->as(Transform::Html),
    ])
    ->get();
</code-snippet>
@endverbatim

### Configuration

Environment variables:

- `XIVAPI_LANGUAGE` - Default language (en, de, fr, ja)
- `XIVAPI_GAME_VERSION` - Lock to game version
- `XIVAPI_LOCALIZATIONS` - Comma-separated languages for Field::localized()