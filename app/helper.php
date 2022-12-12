<?php

use App\Models\Translation;

if (!function_exists('__translate')) {
    function __translate($expression)
    {
        $languageID = Session::get('languageID') ?? 1;
        $items = cache()->remember('language_cache_' . $languageID, now()->addSeconds(10), function () use ($languageID) {
            return Translation::where('language_id', $languageID)->get();
        });

        return $items->where('key', $expression)->first()->value ?? $expression;
    }
}
