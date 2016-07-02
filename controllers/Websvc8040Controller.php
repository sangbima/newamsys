<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;

/**
* Delete: Lokasi, Petani, Lahan, Varietas, Produksi
*/

class Websvc8040Controller extends \yii\rest\Controller
{
  protected function verbs()
  {

    return [
      'ganti-password' => ['POST','OPTIONS'],
      'options' => ['OPTIONS'],
    ];

  }

  /**
   * @inheritdoc
   */
  public function behaviors()
  {
      $behaviors = parent::behaviors();

      $behaviors['authenticator'] = [
          // 'class' => QueryParamAuth::className(),
          'class' => \app\components\CustomAuth::className(),
          'tokenParam' => 'X-Auth-Token',
          'except' => ['options']
      ];

      $behaviors['corsFilter'] = [
          'class' => \yii\filters\Cors::className(),
          'cors' => [
              'Origin' => ['*'],
              'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
              'Access-Control-Request-Headers' => ['*'],
              'Access-Control-Allow-Credentials' => true,
              //'Access-Control-Max-Age' => 86400,
          ]
      ];

      return $behaviors;
  }

  public function actions()
  {
      return [
          'options' => [
              'class'             => 'yii\rest\OptionsAction',
              'collectionOptions' => ['OPTIONS'],
              'resourceOptions'   => ['OPTIONS'],
          ],
      ];
  }

  public function actionOptions()
  {
    \Yii::$app->getResponse()->getHeaders()->set('Allow', 'OPTIONS');
  }

  /**
  * Ganti Password
  * Method POST
  * Request old_password, new_password
  * Response Success
  * {
  *   "status" : "success",
  * }
  * Response Failed
  * {"status":""}
  */
  public function actionGantiPassword()
  {
    $request = Yii::$app->request;

    $model = \app\models\User::findIdentity(Yii::$app->user->id);
    if (Yii::$app->request->post()) {
      if($model->validatePassword($request->post('old_password'))){
          $model->setPassword($request->post('new_password'));
          if($model->save(false)){
            $response = 'success';
          } else {
            $response = 'failed_change';
          }
      } else {
        $response = 'not_match';
      }
    } else {
      $response = 'failed_connection';
    }
    return $response;
  }

}
