<?php

declare(strict_types=1);

namespace XivApi\Laravel\Normalizers;

use Spatie\LaravelData\Normalizers\Normalizer;
use XivApi\Contracts\Arrayable;

/**
 * Laravel Data normalizer for XIVAPI response objects.
 *
 * This normalizer converts any XIVAPI response object implementing
 * the Arrayable interface into an array for use with Laravel Data DTOs.
 *
 * @example
 * ```php
 * use Spatie\LaravelData\Data;
 * use XivApi\Laravel\Normalizers\XivApiNormalizer;
 *
 * class ItemData extends Data
 * {
 *     public function __construct(
 *         public int $rowId,
 *         public array $fields,
 *     ) {}
 *
 *     public static function normalizers(): array
 *     {
 *         return [
 *             XivApiNormalizer::class,
 *         ];
 *     }
 * }
 *
 * // Usage
 * $response = XivApi::sheet('Item')->row(4)->get();
 * $item = ItemData::from($response);
 * ```
 */
class XivApiNormalizer implements Normalizer
{
    public function normalize(mixed $value): ?array
    {
        if (! $value instanceof Arrayable) {
            return null;
        }

        return $value->toArray();
    }
}
