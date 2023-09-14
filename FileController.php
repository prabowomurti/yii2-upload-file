<?php

namespace mdm\upload;

use Yii;
use yii\web\NotFoundHttpException;

/**
 * Use to show or download uploaded file. Add configuration to your application
 * 
 * ~~~
 * 'controllerMap' => [
 *     'file' => 'mdm\upload\FileController',
 * ],
 * ~~~
 * 
 * Then you can show your file in url `Url::to(['/file','id'=>$file_id])`,
 * and download file in url `Url::to(['/file/download','id'=>$file_id])`
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class FileController extends \yii\web\Controller
{
    public $defaultAction = 'show';

    /**
     * Show file
     * @param string $uuid
     */
    public function actionShow($uuid)
    {
        $model = $this->findModel($uuid);
        $response = Yii::$app->getResponse();
        return $response->sendFile($model->filename, $model->name, [
                'mimeType' => $model->type,
                'fileSize' => $model->size,
                'inline' => true
        ]);
    }

    /**
     * Download file
     * @param string $uuid
     * @param mixed $inline
     */
    public function actionDownload($uuid, $inline = false)
    {
        $model = $this->findModel($uuid);
        $response = Yii::$app->getResponse();
        return $response->sendFile($model->filename, $model->name, [
                'mimeType' => $model->type,
                'fileSize' => $model->size,
                'inline' => $inline
        ]);
    }

    /**
     * Get model
     * @param string $uuid
     * @return FileModel
     * @throws NotFoundHttpException
     */
    protected function findModel($uuid)
    {
        if (($model = FileModel::findOne(['uuid' => $uuid])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}