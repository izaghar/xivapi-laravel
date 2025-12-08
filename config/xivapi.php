<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Language
    |--------------------------------------------------------------------------
    |
    | The default language for all API requests. Available options:
    | 'en', 'de', 'fr', 'ja'
    |
    */
    'language' => env('XIVAPI_LANGUAGE'),

    /*
    |--------------------------------------------------------------------------
    | Game Version
    |--------------------------------------------------------------------------
    |
    | Lock requests to a specific game version. Leave null to use the latest.
    |
    */
    'game_version' => env('XIVAPI_GAME_VERSION'),

    /*
    |--------------------------------------------------------------------------
    | Schema
    |--------------------------------------------------------------------------
    |
    | Use a specific schema for field definitions.
    | Example: 'exdschema@latest'
    |
    */
    'schema' => env('XIVAPI_SCHEMA'),

    /*
    |--------------------------------------------------------------------------
    | Localizations
    |--------------------------------------------------------------------------
    |
    | Languages used when expanding localized fields with Field::localized().
    | Comma-separated string via env or array in config.
    | Example: 'en,de,fr,ja' or ['en', 'de', 'fr', 'ja']
    |
    */
    'localizations' => env('XIVAPI_LOCALIZATIONS'),
];
