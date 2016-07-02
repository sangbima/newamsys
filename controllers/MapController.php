<?php

namespace app\controllers;

use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use app\models\InfoHarga;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * LokasiController implements the CRUD actions for Lokasi model.
 */
class MapController extends Controller
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['POST'],
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Lokasi models.
     * @return mixed
     */
    
    public function actionInfoHarga()
    {
        $dnow=strtotime(date('Y-m-d'))-1;
        $tanggal=date('Y-m-d',$dnow);
        $sqlModel = "SELECT distinct info_harga.pasar, pasar.id, pasar.nama, pasar.latitude, pasar.longitude, info_harga.harga_kg, info_harga.tanggal FROM info_harga inner join pasar on info_harga.pasar=pasar.nama where info_harga.tanggal='$tanggal'";
        // $sqlModel = "SELECT * FROM pasar";
        // $model = Pasar::findBySql($sqlModel)->all();
        $items = \app\models\InfoHarga::findBySql($sqlModel)->asArray()->all();
        $dataJson = json_encode($items);
        

        return $this->render('info-harga', [
            'model' => $dataJson,
        ]);
    }


    public function actionPetaniMap()
    {
        
        
        $sqlModelPetani = "SELECT petani.nama, petani.latitude, petani.longitude, petani.kecamatan_id, kecamatan.nama as namkec FROM petani inner join kecamatan on petani.kecamatan_id=kecamatan.id";
        // $sqlModel = "SELECT * FROM pasar";
        // $model = Pasar::findBySql($sqlModel)->all();
        $itemPetani = \app\models\Petani::findBySql($sqlModelPetani)->asArray()->all();
        $dataJsonPetani = json_encode($itemPetani);
        

        return $this->render('petani', [
            'model' => $dataJsonPetani,
        ]);
    }


    public function actionPetaniKecamatanMap()
    {
        
        
        $sqlModelPetaniKec = "SELECT count(petani.id) as jumlahPetani, kecamatan.latitude as keclat, kecamatan.longitude as keclong, petani.nama, petani.latitude, petani.longitude, petani.kecamatan_id, kecamatan.nama as namkec FROM petani inner join kecamatan on petani.kecamatan_id=kecamatan.id GROUP BY petani.kecamatan_id";
        // $sqlModel = "SELECT * FROM pasar";
        // $model = Pasar::findBySql($sqlModel)->all();
        $itemPetaniKec = \app\models\Petani::findBySql($sqlModelPetaniKec)->asArray()->all();
        $dataJsonPetaniKec = json_encode($itemPetaniKec);
        

        return $this->render('petani-kecamatan', [
            'model' => $dataJsonPetaniKec,
        ]);
    }


    public function actionPetaniKelurahanMap()
    {
        
        
        $sqlModelPetaniKel = "SELECT count(petani.id) as jumlahPetani, desakelurahan.latitude as kellat, desakelurahan.longitude as kellong, petani.nama, petani.latitude, petani.longitude, petani.desakelurahan_id, desakelurahan.nama as namkel FROM petani inner join desakelurahan on petani.desakelurahan_id=desakelurahan.id GROUP BY petani.desakelurahan_id";
        // $sqlModel = "SELECT * FROM pasar";
        // $model = Pasar::findBySql($sqlModel)->all();
        $itemPetaniKel = \app\models\Petani::findBySql($sqlModelPetaniKel)->asArray()->all();
        $dataJsonPetaniKel = json_encode($itemPetaniKel);
        

        return $this->render('petani-kelurahan', [
            'model' => $dataJsonPetaniKel,
        ]);
    }





    
}
