<?php

use craft\helpers\App;

return [
  //'useDevServer' => App::env('ENVIRONMENT') === 'dev' || App::env('CRAFT_ENVIRONMENT') === 'dev',
  'useDevServer' => App::env('VITE_USE_DEV_SERVER') ?? false,
	'devServerInternal' => 'https://localhost:3000',
	'devServerPublic' => App::env('PRIMARY_SITE_URL') . ':3000',
	'serverPublic' => App::env('PRIMARY_SITE_URL') . '/static/dist/',
  'manifestPath' => '@webroot/static/dist/manifest.json',
  'errorEntry' => '',
  'cacheKeySuffix' => '',
  'includeReactRefreshShim' => false,
  'includeModulePreloadShim' => true,
];


    