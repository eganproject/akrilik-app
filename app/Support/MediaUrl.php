<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaUrl
{
    public static function publicStorage(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://', '//'])) {
            return $path;
        }

        $normalized = ltrim($path, '/');
        $normalized = preg_replace('#^(public/)?storage/#', '', $normalized);
        $normalized = ltrim($normalized, '/');

        $url = Storage::disk('public')->url($normalized);
        $parts = parse_url($url);

        return $parts['path'] ?? $url;
    }
}
