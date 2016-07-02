<?php

namespace app\controllers;

use Yii;
use app\models\Pasar;
use app\models\PasarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * PasarController implements the CRUD actions for Pasar model.
 */
class PasarController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pasar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PasarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pasar model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pasar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pasar();

        if(Yii::$app->request->isAjax && $model->load($_POST)) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
          $request = Yii::$app->request;
          if(empty($request->post('Pasar')['desakelurahan_id'])) {
            if(empty($request->post('Pasar')['kecamatan_id'])) {
              if(empty($request->post('Pasar')['kabupatenkota_id'])) {
                $model->provinsi_id = $request->post('Pasar')['provinsi_id'];
              } else {
                $model->kabupatenkota_id = $request->post('Pasar')['kabupatenkota_id'];
              }
            } else {
              $model->kecamatan_id = $request->post('Pasar')['kecamatan_id'];
            }
            if($model->save(false)){
              return $this->redirect(['view', 'id' => $model->id]);
            }
          } else {
            $model->desakelurahan_id = $request->post('Pasar')['desakelurahan_id'];
            if($model->save(false)){
              return $this->redirect(['view', 'id' => $model->id]);
            }
          }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pasar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isAjax && $model->load($_POST)) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pasar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model= $this->findModel($id);

        try {
             $model->delete();
        } catch(\yii\db\IntegrityException $e) {
             throw new \yii\web\ForbiddenHttpException('Anda tidak bisa menghapus record ini, karena masih digunakan oleh record yang lain');
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Pasar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pasar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pasar::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
