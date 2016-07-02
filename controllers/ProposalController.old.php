<?php

namespace app\controllers;

use Yii;
use app\models\Proposal;
use app\models\ProposalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use app\models\ApprovalBgrForm;
use app\models\ApprovalAbmiForm;
use app\models\ApprovalPpiForm;
use yii\web\UploadedFile;

/**
 * ProposalController implements the CRUD actions for Proposal model.
 */
class ProposalController extends Controller
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
     * Lists all Proposal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProposalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Proposal model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $model->setuju_status = json_decode($model->setuju_status, true);
        $model->setuju_alasan = json_decode($model->setuju_alasan, true);
        $model->setuju_berkas = json_decode($model->setuju_berkas, true);

        return $this->render('view', [
            'model' => $model,
        ]);
    }


    public function actionPrintProp($id){

            return $this->renderPartial('print',[
                'model' => $this->findModel($id),
            ]);
    }
    /**
     * Creates a new Proposal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Proposal();

        if(Yii::$app->request->isAjax && $model->load($_POST)) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            // Konversi tanggal
            $model->tgl_tanam = date('Y-m-d', strtotime($model->tgl_tanam));
            $model->tgl_panen = date('Y-m-d', strtotime($model->tgl_panen));
            $model->est_tgl_kirim = date('Y-m-d', strtotime($model->est_tgl_kirim));
            $model->prop_kadaluarsa = date('Y-m-d', strtotime($model->prop_kadaluarsa));

            // Default Value setuju_alasan
            $model->setuju_alasan = '{"BGR":"","ABMI":"","PPI":""}';

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

            $model->biaya_tebas = str_replace(',', '', $model->biaya_tebas);
            $model->biaya_proses = str_replace(',', '', $model->biaya_proses);
            // $model->biaya_kirim = str_replace(',', '', $model->biaya_kirim);
            // $model->est_harga_jual = str_replace(',', '', $model->est_harga_jual);

            // Ambil nomor proposal dari hasil generate
            $model->no_proposal = $this->generateProposalNo();

            if($model->save(false)){
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
     * Updates an existing Proposal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            // Konversi tanggal
            $model->tgl_tanam = date('d-m-Y', strtotime($model->tgl_tanam));
            $model->tgl_panen = date('d-m-Y', strtotime($model->tgl_panen));
            $model->est_tgl_kirim = date('d-m-Y', strtotime($model->est_tgl_kirim));
            $model->prop_kadaluarsa = date('d-m-Y', strtotime($model->prop_kadaluarsa));

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionBgrApproval($id)
    {
        $model = new ApprovalBgrForm();

        $proposal = $this->findModel($id);
        $model->setuju_status = json_decode($proposal->setuju_status, true);
        $model->setuju_alasan = json_decode($proposal->setuju_alasan, true);
        $model->setuju_berkas = json_decode($proposal->setuju_berkas, true);
        $model->biaya_kirim = $proposal->biaya_kirim;

        if($model->load(Yii::$app->request->post())) {
            $proposal->setuju_status = json_encode($model->setuju_status);
            $proposal->biaya_kirim = str_replace(',', '', $model->biaya_kirim);
            $proposal->setuju_alasan = json_encode($model->setuju_alasan);

            $pathBerkas = \Yii::getAlias('@app').'/uploads/proposals/berkas';
            $berkasFile = json_decode($proposal->setuju_berkas, true);
            $description = json_decode($proposal->setuju_alasan, true);
            $berkasFile['BGR'] = UploadedFile::getInstance($model, 'setuju_berkas[BGR]');
            $newFileName = date('U').'-'.\Yii::$app->security->generateRandomString();

            if(!empty($berkasFile['BGR'])) {
                $saveTo = $pathBerkas . '/' . $newFileName . '.' . $berkasFile['BGR']->extension;

                if($berkasFile['BGR']->saveAs($saveTo)) {
                    $fileName = $newFileName . '.' . $berkasFile['BGR']->extension;
                    $proposal->setuju_berkas = '{"BGR":"'.$fileName.'","ABMI":"'.$berkasFile['ABMI'].'","PPI":"'.$berkasFile['PPI'].'"}';
                }
            } else {
                $proposal->setuju_berkas = '{"BGR":"'.$berkasFile['BGR'].'","ABMI":"'.$berkasFile['ABMI'].'","PPI":"'.$berkasFile['PPI'].'"}';
            }

            if($proposal->save(false)) {
                return $this->redirect(['view', 'id' => $proposal->id]);
            }
        } else {
            return $this->render('bgr-approval', [
                'model' => $model,
            ]);
        }

        // $proposal = $this->findModel($id);
        // $model->setuju_status = json_decode($proposal->setuju_status, true);
        // $model->setuju_alasan = json_decode($proposal->setuju_alasan, true);
        // $model->biaya_kirim = $proposal->biaya_kirim;
        // $model->setuju_berkas = json_decode($proposal->setuju_berkas, true);
        //
        // if(\Yii::$app->request->post()) {
        //     $proposal->setuju_status = json_encode($model->setuju_status);
        //     $proposal->biaya_kirim = str_replace(',', '', $model->biaya_kirim);
        //     $proposal->setuju_alasan = json_encode($model->setuju_alasan);
        //
        //     $pathBerkas = \Yii::getAlias('@app').'/uploads/proposals/berkas';
        //     $berkasFile = json_decode($proposal->setuju_berkas, true);
        //     $description = json_decode($proposal->setuju_alasan, true);
        //     $berkasFile['BGR'] = UploadedFile::getInstance($model, 'setuju_berkas[BGR]');
        //     $newFileName = date('U').'-'.\Yii::$app->security->generateRandomString();
        //
        //     $saveTo = $pathBerkas . '/' . $newFileName . '.' . $berkasFile['BGR']->extension;
        //
        //     if($berkasFile['BGR']->saveAs($saveTo)) {
        //         $fileName = $newFileName . '.' . $berkasFile['BGR']->extension;
        //         $proposal->setuju_berkas = '{"BGR":"'.$fileName.'","ABMI":"'.$berkasFile['ABMI'].'","PPI":"'.$berkasFile['PPI'].'"}';
        //     }
        //     if($proposal->save(false)) {
        //         return $this->redirect(['view', 'id' => $proposal->id]);
        //     }
        // } else {
        //     return $this->render('bgr-approval', [
        //         'model' => $model,
        //     ]);
        // }
    }

    public function actionAbmiApproval($id)
    {
        $model = new ApprovalAbmiForm();

        $proposal = $this->findModel($id);
        $model->setuju_status = json_decode($proposal->setuju_status, true);
        $model->setuju_alasan = json_decode($proposal->setuju_alasan, true);
        $model->setuju_berkas = json_decode($proposal->setuju_berkas, true);
        $model->est_harga_jual = $proposal->est_harga_jual;

        if($model->load(Yii::$app->request->post())) {
            $proposal->setuju_status = json_encode($model->setuju_status);
            $proposal->est_harga_jual = str_replace(',', '', $model->est_harga_jual);
            $proposal->setuju_alasan = json_encode($model->setuju_alasan);

            $pathBerkas = \Yii::getAlias('@app').'/uploads/proposals/berkas';
            $berkasFile = json_decode($proposal->setuju_berkas, true);
            $description = json_decode($proposal->setuju_alasan, true);
            $berkasFile['ABMI'] = UploadedFile::getInstance($model, 'setuju_berkas[ABMI]');
            $newFileName = date('U').'-'.\Yii::$app->security->generateRandomString();

            if(!empty($berkasFile['ABMI'])) {
                $saveTo = $pathBerkas . '/' . $newFileName . '.' . $berkasFile['ABMI']->extension;

                if($berkasFile['ABMI']->saveAs($saveTo)) {
                    $fileName = $newFileName . '.' . $berkasFile['ABMI']->extension;
                    $proposal->setuju_berkas = '{"BGR":"'.$berkasFile['BGR'].'","ABMI":"'.$fileName.'","PPI":"'.$berkasFile['PPI'].'"}';
                }
            } else {
                $proposal->setuju_berkas = '{"BGR":"'.$berkasFile['BGR'].'","ABMI":"'.$berkasFile['ABMI'].'","PPI":"'.$berkasFile['PPI'].'"}';
            }

            if($proposal->save(false)) {
                return $this->redirect(['view', 'id' => $proposal->id]);
            }
        } else {
            return $this->render('abmi-approval', [
                'model' => $model,
            ]);
        }
    }

    public function actionPpiApproval($id)
    {
        $model = new ApprovalPpiForm();

        $proposal = $this->findModel($id);
        $model->setuju_status = json_decode($proposal->setuju_status, true);
        $model->setuju_alasan = json_decode($proposal->setuju_alasan, true);
        $model->setuju_berkas = json_decode($proposal->setuju_berkas, true);

        if($model->load(Yii::$app->request->post())) {
            $proposal->setuju_status = json_encode($model->setuju_status);
            $proposal->setuju_alasan = json_encode($model->setuju_alasan);

            $pathBerkas = \Yii::getAlias('@app').'/uploads/proposals/berkas';
            $berkasFile = json_decode($proposal->setuju_berkas, true);
            $description = json_decode($proposal->setuju_alasan, true);

            $berkasFile['PPI'] = UploadedFile::getInstance($model, 'setuju_berkas[PPI]');
            $newFileName = date('U').'-'.\Yii::$app->security->generateRandomString();

            if(!empty($berkasFile['PPI'])) {
                $saveTo = $pathBerkas . '/' . $newFileName . '.' . $berkasFile['PPI']->extension;

                if($berkasFile['PPI']->saveAs($saveTo)) {
                    $fileName = $newFileName . '.' . $berkasFile['PPI']->extension;
                    $proposal->setuju_berkas = '{"BGR":"'.$berkasFile['BGR'].'","ABMI":"'.$berkasFile['ABMI'].'","PPI":"'.$fileName.'"}';
                }
            } else {
                $proposal->setuju_berkas = '{"BGR":"'.$berkasFile['BGR'].'","ABMI":"'.$berkasFile['ABMI'].'","PPI":"'.$berkasFile['PPI'].'"}';
            }
            if($proposal->save(false)) {
                return $this->redirect(['view', 'id' => $proposal->id]);
            }
        } else {
            return $this->render('ppi-approval', [
                'model' => $model,
            ]);
        }
    }

    public function actionDownloadBerkas($id, $inline=false)
    {
        $proposal = $this->findModel($id);

        $path = \Yii::getAlias("@app").'/uploads/proposals/berkas';
    }

    /**
     * Deletes an existing Proposal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function generateProposalNo()
    {
        // Format Nomor proposal: (nourut)/PROPOSAL/(bulan-Romawi)/(tahun)

        $modelHelperNo = \app\models\Helper::findOne(['parameter' => 'last_proposal_tebas']);
        $modelHelperNo->value = $modelHelperNo->value + 1;

        if($modelHelperNo->save(false)){
            return $modelHelperNo->value."/PROPOSAL/".date('m')."/".date('Y');
        } else {
            return false;
        }
    }

    /**
     * Finds the Proposal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Proposal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Proposal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
