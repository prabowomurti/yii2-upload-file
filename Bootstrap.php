<?php

namespace mdm\upload;

/**
 * Description of Bootstrap
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Bootstrap implements \yii\base\BootstrapInterface
{

    public function bootstrap($app)
    {
        if (
            $app instanceof \yii\web\Application &&
            !isset($app->controllerMap['file'])
        ) {
            $app->controllerMap['file'] = __NAMESPACE__ . '\FileController';
        }
    }
}
