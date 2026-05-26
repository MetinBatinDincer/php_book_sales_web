<?php

use Illuminate\Support\Str;

if (! function_exists('money')) {
    function money(float|int|string|null $amount): string
    {
        return number_format((float) $amount, 2, ',', '.') . ' TL';
    }
}

if (! function_exists('product_image')) {
    function product_image(?string $path): string
    {
        if (! $path) {
            return 'https://picsum.photos/seed/book/600/800';
        }

        if (Str::startsWith($path, ['http://', 'https://', '/'])) {
            return $path;
        }

        return asset($path);
    }
}
