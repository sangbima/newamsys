<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

class DataListController extends Controller
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

    public function actionListkotakab()
    {
        $out = [];
        if(isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if($parents != null) {
                $provinsi_id = $parents[0];

                $data = self::getKotakab($provinsi_id);
                echo Json::encode(['output'=>$data, 'selected'=>'']);

                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getKotakab($provinsi_id)
    {
        $data = \app\models\Kabupatenkota::find()->where(['provinsi_id' => $provinsi_id])->all();

        foreach ($data as $key => $value) {
            $mapping[] = ['id'=>$value['id'], 'name'=>$value['nama']];
        }

        return $mapping;
    }

    public function actionListkecamatan()
    {
        $out = [];
        if(isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if($parents != null) {
                $kabupatenkota_id = $parents[0];

                $data = self::getKecamatan($kabupatenkota_id);
                echo Json::encode(['output'=>$data, 'selected'=>'']);

                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getKecamatan($kabupatenkota_id)
    {
        $data = \app\models\Kecamatan::find()->where(['kabupatenkota_id' => $kabupatenkota_id])->all();

        foreach ($data as $key => $value) {
            $mapping[] = ['id' => $value['id'], 'name' => $value['nama']];
        }
        return $mapping;
    }

    public function actionListdesakelurahan()
    {
        $out = [];
        if(isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if($parents != null) {
                $kecamatan_id = end($parents);

                $data = self::getDesaKelurahan($kecamatan_id);
                echo Json::encode(['output'=>$data, 'selected'=>'']);

                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getDesaKelurahan($kecamatan_id)
    {
        $data = \app\models\Desakelurahan::find()->where(['kecamatan_id' => $kecamatan_id])->all();

        foreach ($data as $key => $value) {
            $mapping[] = ['id'=>$value['id'], 'name'=>$value['nama']];
        }

        return $mapping;
    }

    public function actionListvarietas()
    {
        $out = [];
        if(isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if($parents != null) {
                $komoditas_id = $parents[0];

                $data = self::getVarietas($komoditas_id);
                echo Json::encode(['output'=>$data, 'selected'=>'']);

                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getVarietas($komoditas_id)
    {
        $data = \app\models\Varietas::find()->where(['komoditas_id' => $komoditas_id])->all();

        foreach ($data as $key => $value) {
            $mapping[] = ['id'=>$value['id'], 'name'=>$value['nama']];
        }

        return $mapping;
    }

    public function actionListjenis()
    {
        $out = [];
        if(isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if($parents != null) {
                $varietas_id = $parents[0];

                $data = self::getJenis($varietas_id);
                echo Json::encode(['output'=>$data, 'selected'=>'']);

                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getJenis($varietas_id)
    {
        $data = \app\models\Jenis::find()->where(['varietas_id' => $varietas_id])->all();

        foreach ($data as $key => $value) {
            $mapping[] = ['id' => $value['id'], 'name' => $value['nama']];
        }
        return $mapping;
    }

}
