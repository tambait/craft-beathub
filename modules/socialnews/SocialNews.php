<?php

namespace modules\socialnews;

use Craft;
use yii\base\Module as BaseModule;

/**
 * SocialNews module
 *
 * @method static SocialNews getInstance()
 */
class SocialNews extends BaseModule
{
    public function init(): void
    {
        Craft::setAlias('@modules/socialnews', __DIR__);

        // Set the controllerNamespace based on whether this is a console or web request
        if (Craft::$app->request->isConsoleRequest) {
            $this->controllerNamespace = 'modules\\socialnews\\console\\controllers';
        } else {
            $this->controllerNamespace = 'modules\\socialnews\\controllers';
        }

        parent::init();


        $this->setComponents([
            'feed' => \modules\socialnews\services\SocialNewsService::class,
        ]);        

        $this->attachEventHandlers();

        // Any code that creates an element query or loads Twig should be deferred until
        // after Craft is fully initialized, to avoid conflicts with other plugins/modules
        Craft::$app->onInit(function() {
            // ...
        });
    }

    private function attachEventHandlers(): void
    {
        // Register event handlers here ...
        // (see https://craftcms.com/docs/5.x/extend/events.html to get started)
    }
}
