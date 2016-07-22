<?php

namespace app\controllers;

use Yii;
use app\models\SurveyTanam;
use app\models\SurveyTanamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * SurveyTanamController implements the CRUD actions for SurveyTanam model.
 */
class SurveyTanamController extends Controller
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
     * Lists all SurveyTanam models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SurveyTanamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SurveyTanam model.
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
     * Creates a new SurveyTanam model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SurveyTanam();

        if(Yii::$app->request->isAjax && $model->load($_POST)) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            // Konversi tanggal
            $model->tgl_tanam = date('Y-m-d', strtotime($model->tgl_tanam));
            $model->tgl_panen = date('Y-m-d', strtotime($model->tgl_panen));

            // Konversi luas lahan
            // 1 bahu = 7140 m2
            // 1 hektar = 10000 m2
            if($model->luas_unit == 'bahu'){
                $model->luas_m2 = $model->luas_lahan * 7140;
            } elseif($model->luas_unit == 'hektar') {
                $model->luas_m2 = $model->luas_lahan * 10000;
            } else {
                $model->luas_m2 = $model->luas_lahan;
            }

            $model->harga_bibit = str_replace(',', '', $model->harga_bibit);

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->luas_unit = 'bahu';
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SurveyTanam model.
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

        if ($model->load(Yii::$app->request->post())) {
            // Konversi tanggal
            $model->tgl_tanam = date('Y-m-d', strtotime($model->tgl_tanam));
            $model->tgl_panen = date('Y-m-d', strtotime($model->tgl_panen));

            // Konversi luas lahan
            // 1 bahu = 7140 m2
            // 1 hektar = 10000 m2
            if($model->luas_unit == 'bahu'){
                $model->luas_m2 = $model->luas_lahan * 7140;
            } elseif($model->luas_unit == 'hektar') {
                $model->luas_m2 = $model->luas_lahan * 10000;
            } else {
                $model->luas_m2 = $model->luas_lahan;
            }

            $model->harga_bibit = str_replace(',', '', $model->harga_bibit);

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->tgl_tanam = date('d-m-Y', strtotime($model->tgl_tanam));
            $model->tgl_panen = date('d-m-Y', strtotime($model->tgl_panen));
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SurveyTanam model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SurveyTanam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SurveyTanam the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SurveyTanam::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
