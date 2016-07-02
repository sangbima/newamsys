<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;

/**
* List/Daftar: Lokasi, Petani, Lahan, Varietas, Produksi
*/
class Websvc8000Controller extends \yii\rest\Controller
{

    protected function verbs()
    {

        return [
            'daftar-provinsi' => ['GET','OPTIONS'],
            'daftar-kabupatenkota' => ['GET','OPTIONS'],
            'daftar-kecamatan' => ['GET','OPTIONS'],
            'daftar-desakelurahan' => ['GET','OPTIONS'],
            'daftar-petani' => ['GET','OPTIONS'],
            'daftar-komoditas' => ['GET','OPTIONS'],
            'daftar-varietas' => ['GET','OPTIONS'],
            'daftar-jenis' => ['GET','OPTIONS'],
            'daftar-jenis-bobot-kering' => ['GET','OPTIONS'],
            'daftar-pasar' => ['GET','OPTIONS'],
            'daftar-pasar-tag' => ['GET','OPTIONS'],
            'daftar-proposal' => ['GET','OPTIONS'],
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
    * Daftar Provinsi
    * Method GET
    * Request -
    * return kode, nama, latitude, longitude
    */
    public function actionDaftarProvinsi()
    {
        $model = \app\models\Provinsi::find()
            ->select('id, kode, nama, latitude, longitude')
            ->orderBy([
            'kode' => SORT_ASC
        ])->all();

        return $model;
    }

    /**
    * Daftar Kabupatenkota
    * Method GET
    * Request -
    * return kode, nama, provinsi_id, tipe, latitude, longitude
    */
    public function actionDaftarKabupatenkota()
    {
        $model = \app\models\Kabupatenkota::find()
            ->select('id, kode, nama, provinsi_id, tipe, latitude, longitude')
            ->orderBy([
            'kode' => SORT_ASC
        ])->all();

        return $model;
    }

    /**
    * Daftar Kecamatan
    * Method GET
    * Request -
    * return kode, nama, kabupatenkota_id, latitude, longitude
    */
    public function actionDaftarKecamatan()
    {
        $model = \app\models\Kecamatan::find()
            ->select('id, kode, nama, kabupatenkota_id, latitude, longitude')
            ->orderBy([
            'kode' => SORT_ASC
        ])->all();

        return $model;
    }

    /**
    * Daftar Desakelurahan
    * Method GET
    * Request -
    * return kode, nama, kecamatan_id, tipe, latitude, longitude
    */
    public function actionDaftarDesakelurahan()
    {
        $model = \app\models\Desakelurahan::find()
            ->select('id, kode, nama, kecamatan_id, tipe, latitude, longitude')
            ->orderBy([
            'kode' => SORT_ASC
        ])->all();

        return $model;
    }

    /**
    * Daftar Petani
    * Method GET
    * Request -
    * return id, nama, no_ktp, alamat, no_tlp, provinsi_id, provinsi_nama, kabupatenkota_id, kabupatenkota_nama, kecamatan_id, kecamatan_nama, desakelurahan_id, desakelurahan_nama
    */
    public function actionDaftarPetani()
    {
        $query = new \yii\db\Query;
        $query->select('petani.*, provinsi.nama AS provinsi_nama, kabupatenkota.nama as kabupatenkota_nama,
            kecamatan.nama as kecamatan_nama, desakelurahan.nama as desakelurahan_nama
        ')
            ->from('petani')
            ->leftJoin('provinsi', 'petani.provinsi_id = provinsi.id')
            ->leftJoin('kabupatenkota', 'petani.kabupatenkota_id = kabupatenkota.id')
            ->leftJoin('kecamatan', 'petani.kecamatan_id = kecamatan.id')
            ->leftJoin('desakelurahan', 'petani.desakelurahan_id = desakelurahan.id')
            ->orderBy([
            'petani.id' => SORT_DESC,
        ]);
        $command = $query->createCommand();

        $model = $command->queryAll();

        return $model;
    }

    /**
    * Daftar Komoditas
    * Method GET
    * Request -
    * return
    */
    public function actionDaftarKomoditas()
    {
        $model = \app\models\Komoditas::find()->all();

        return $model;
    }

    /**
    * Daftar Varietas
    * Method GET
    * Request -
    * return
    */
    public function actionDaftarVarietas()
    {
        $model = \app\models\Varietas::find()->all();

        return $model;
    }

    /**
    * Daftar Jenis
    * Method GET
    * Request -
    * return
    */
    public function actionDaftarJenis()
    {
        $model = \app\models\Jenis::find()->all();

        return $model;
    }

    /**
    * Daftar Jenis Bobot Kering
    * Method GET
    * Request -
    * return
    */
    public function actionDaftarJenisBobotKering()
    {
        $model = \app\models\JenisBobotKering::find()->all();

        return $model;
    }

    /**
    * Daftar Pasar
    * Method GET
    * Request -
    * return
    */
    public function actionDaftarPasar()
    {
        $model = \app\models\Pasar::find()->all();

        return $model;
    }

    /**
    * Daftar Pasar Tag
    * Method GET
    * Request -
    * return
    */
    public function actionDaftarPasarTag()
    {
        $model = \app\models\PasarTag::find()->all();

        return $model;
    }

    /**
    * Daftar Proposal by user ID
    * Method GET
    * Request -
    * return all
    */
    public function actionDaftarProposal()
    {
        $query = new \yii\db\Query;
        $query->select('a.*, b.nama AS provinsi_nama, c.nama AS kabupatenkota_nama, d.nama AS kecamatan_nama, 
                e.nama AS desakelurahan_nama, f.nama AS lapak_prov_nama, g.nama AS lapak_kabkota_nama, 
                h.nama AS lapak_kec_nama, i.nama AS lapak_desakel_nama, j.nama AS petani_nama, k.nama AS komoditas_nama,
                l.nama AS varietas_nama, m.nama AS jenis_nama, n.nama AS jenis_bobot_kering_nama, o.nama AS pasar_tag_nama,
                p.nama AS pasar_nama
            ')
            ->from('proposal a')
            ->leftJoin('provinsi b', 'a.provinsi_id = b.id')
            ->leftJoin('kabupatenkota c', 'a.kabupatenkota_id = c.id')
            ->leftJoin('kecamatan d', 'a.kecamatan_id = d.id')
            ->leftJoin('desakelurahan e', 'a.desakelurahan_id = e.id')
            ->leftJoin('provinsi f', 'a.lapak_prov_id = f.id')
            ->leftJoin('kabupatenkota g', 'a.lapak_kabkota_id = g.id')
            ->leftJoin('kecamatan h', 'a.lapak_kec_id = h.id')
            ->leftJoin('desakelurahan i', 'a.lapak_desakel_id = i.id')
            ->leftJoin('petani j', 'a.petani_id = j.id')
            ->leftJoin('komoditas k', 'a.komoditas_id = k.id')
            ->leftJoin('varietas l', 'a.varietas_id = l.id')
            ->leftJoin('jenis m', 'a.jenis_id = m.id')
            ->leftJoin('jenis_bobot_kering n', 'a.jenis_bobot_kering_id = n.id')
            ->leftJoin('pasar_tag o', 'a.pasar_tag_id = o.id')
            ->leftJoin('pasar p', 'a.pasar_id = p.id')
            ->where(['a.user_id' => Yii::$app->user->id])
            ->orderBy([
                'a.id' => SORT_DESC,
                ]);
        $command = $query->createCommand();

        $model = $command->queryAll();

        return $model;
    }

}
