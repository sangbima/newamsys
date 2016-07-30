<?php

namespace app\controllers;

use Yii;
use app\models\LapakProses;
use app\models\LapakKarung;
use app\models\LapakProsesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use app\models\MultiInput;

/**
 * LapakProsesController implements the CRUD actions for LapakProses model.
 */
class LapakProsesController extends Controller
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
     * Lists all LapakProses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LapakProsesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LapakProses model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelsLapakKarung = $model->lapakKarungs;
        return $this->render('view', [
            'model' => $model,
            'modelsLapakKarung' => $modelsLapakKarung
        ]);
    }

    /**
     * Creates a new LapakProses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LapakProses();
        $modelsLapakKarung = [new LapakKarung];

        if(Yii::$app->request->isAjax && $model->load($_POST)) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            $modelsLapakKarung = MultiInput::createMultiple(LapakKarung::classname());
            MultiInput::loadMultiple($modelsLapakKarung, Yii::$app->request->post());

            $valid = $model->validate();
            $valid = MultiInput::validateMultiple($modelsLapakKarung) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if($flag = $model->save(false)) {
                        foreach($modelsLapakKarung as $modelLapakKarung) {
                            $modelLapakKarung->lapak_proses_id = $model->id;
                            if(!($flag = $modelLapakKarung->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelsLapakKarung' => (empty($modelsLapakKarung)) ? [new LapakKarung] : $modelsLapakKarung
        ]);
    }

    /**
     * Updates an existing LapakProses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsLapakKarung = $model->lapakKarungs;

        if(Yii::$app->request->isAjax && $model->load($_POST)) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            $oldIDs = ArrayHelper::map($modelsLapakKarung, 'id', 'id');
            $modelsLapakKarung = MultiInput::createMultiple(LapakKarung::classname(), $modelsLapakKarung);
            MultiInput::loadMultiple($modelsLapakKarung, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsLapakKarung, 'id', 'id')));

            $valid = $model->validate();
            $valid = MultiInput::validateMultiple($modelsLapakKarung) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            LapakKarung::deleteAll(['id' => $deletedIDs]);
                        }

                        foreach($modelsLapakKarung as $modelLapakKarung) {
                            $modelLapakKarung->lapak_proses_id = $model->id;
                            if(!($flag = $modelLapakKarung->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsLapakKarung' => (empty($modelsLapakKarung)) ? [new LapakKarung] : $modelsLapakKarung
        ]);
    }

    /**
     * Deletes an existing LapakProses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        //
        // return $this->redirect(['index']);
        $model= $this->findModel($id);

        try {
             $model->delete();
        } catch(\yii\db\IntegrityException $e) {
             throw new \yii\web\ForbiddenHttpException('Anda tidak bisa menghapus record ini, karena masih digunakan oleh record yang lain');
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the LapakProses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LapakProses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LapakProses::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
