<?php
/**
 * Site URL Rules
 *
 * You can define custom site URL rules here, which Craft will check in addition
 * to routes defined in Settings → Routes.
 *
 * Read about Craft’s routing behavior (and this file’s structure), here:
 * @link https://craftcms.com/docs/5.x/system/routing.html
 */

/**
 * @TODO Route e.g. sh/bendovi throws 404 error.
 * Using route bendovi, works for sh/bendovi, but expectedly
 * also creates /bendovi.
 * 
 * Not sure if there is a way to tackle the issue in this config file.
 * Possible alternative is to simply create index per language in the admin.
 * 
 * @TODO It could be this is the reason why when you're on /sh/bendovi, 
 * clicking en switches to the default site but shows /bendovi 
 * instead of /artists.
 */

return [
    'artists' => ['template' => 'pages/generic/index'],
    'albums'  => ['template' => 'pages/generic/index'],
    'bendovi' => ['template' => 'pages/generic/index'],
    'albumi'     => ['template' => 'pages/generic/index'],
];