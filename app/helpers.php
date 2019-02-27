<?php

if (!function_exists('getExternalContent')) {
    /**
     * @param string $url
     * @return string
     */
    function getExternalContent($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_URL, $url);

        $content = curl_exec($ch);

        curl_close($ch);

        return $content;
    }
}

if (!function_exists('fetchCardFromSet')) {
    /**
     * @param string $setIdentifier
     * @param string $cardIdentifier
     * @return string
     */
    function fetchCardFromSet($setIdentifier, $cardIdentifier)
    {
        $minutes = env('YUGIOH_CARD_API_CACHE_MINUTES');

        return \Illuminate\Support\Facades\Cache::remember("fetchCardFromSet.${setIdentifier}-${cardIdentifier}", $minutes, function () use ($setIdentifier, $cardIdentifier) {
            return getYuGiOhCardApiContent("/cards/from_set/{$setIdentifier}-{$cardIdentifier}");
        });
    }
}

if (!function_exists('fetchSet')) {
    /**
     * @param string $setIdentifier
     * @return string
     */
    function fetchSet($setIdentifier)
    {
        $minutes = env('YUGIOH_CARD_API_CACHE_MINUTES');

        return \Illuminate\Support\Facades\Cache::remember("fetchSet.${setIdentifier}", $minutes, function () use ($setIdentifier) {
            return getYuGiOhCardApiContent("/sets/{$setIdentifier}");
        });
    }
}

if (!function_exists('getCardImageUrl')) {
    /**
     * @param string $setIdentifier
     * @param string $cardIdentifier
     * @return string
     */
    function getCardImageUrl($setIdentifier, $cardIdentifier)
    {
        $minutes = env('YUGIOH_CARD_API_CACHE_MINUTES');

        return env('YUGIOH_CARD_API_BASE_URL') . "/cards/from_set/{$setIdentifier}-{$cardIdentifier}/image";
    }
}

if (!function_exists('getYuGiOhCardApiContent')) {
    /**
     * @param string $uri
     * @return string
     */
    function getYuGiOhCardApiContent($uri)
    {
        return getExternalContent(env('YUGIOH_CARD_API_BASE_URL') . $uri);
    }
}

if (!function_exists('objGet')) {
    /**
     * @param string $key
     * @param $obj
     * @return mixed|null
     */
    function objGet($key, $obj)
    {
        if (!is_object($obj)) {
            return null;
        }

        $keyArr = explode('.', $key);

        $firstKey = array_shift($keyArr);

        if (count($keyArr) == 0 && property_exists($obj, $firstKey)) {
            return $obj->{$firstKey};
        }

        if (!is_object($obj) && count($keyArr) > 0) {
            return null;
        }

        if (property_exists($obj, $firstKey)) {
            return objGet(implode('.', $keyArr), $obj->{$firstKey});
        }
    }
}