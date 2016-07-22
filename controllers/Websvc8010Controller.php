<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;

/**
* Tambah: Lokasi, Petani, Lahan, Varietas, Produksi
*/

class Websvc8010Controller extends \yii\rest\Controller
{

    protected function verbs()
    {

        return [
            'tambah-proposal' => ['POST','OPTIONS'],
            'tambah-petani' => ['POST','OPTIONS'],
            'tambah-kebpasar' => ['POST','OPTIONS'],
            'tambah-survey-tanam' => ['POST','OPTIONS'],
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
    * Tambah Petani
    * Method POST
    * Request nama, alamat, no_ktp, lokasi_kode
    * Response Success
    * {
    *   "status" : "success",
    *   "data" : {"id":"<val>", "nama":"<val>", "alamat":"<val>", "no_ktp":"<val>",
    *             "lokasi_kode":"<val>", "lokasi_nama":"<val>"}
    * }
    * Response Failed
    * {"status":""}
    */
    public function actionTambahPetani()
    {
        $model = new \app\models\Petani();
        $request = Yii::$app->request;

        if (isset($request)) {
            $model->nama = $request->post('nama');
            $model->alamat = $request->post('alamat');
            $model->no_ktp = $request->post('no_ktp');
            $model->no_telp = $request->post('no_telp');
            $model->keterangan = $request->post('keterangan');
            $model->provinsi_id = $request->post('provinsi_id');
            $model->kabupatenkota_id = $request->post('kabupatenkota_id');
            $model->kecamatan_id = $request->post('kecamatan_id');
            $model->desakelurahan_id = $request->post('desakelurahan_id');

            if($model->save(false)){
                $response = [
                    "status" => "success",
                    "data" => [
                        "id" => $model->id,
                        "nama" => $model->nama,
                        "alamat" => $model->alamat,
                        "no_ktp" => $model->no_ktp,
                        "no_telp" => $model->no_telp,
                        "keterangan" => $model->keterangan,
                        "provinsi_id" => $model->provinsi_id,
                        "provinsi_nama" => $model->provinsi->nama,
                        "kabupatenkota_id" => $model->kabupatenkota_id,
                        "kabupatenkota_nama" => $model->kabupatenkota->nama,
                        "kecamatan_id" => $model->kecamatan_id,
                        "kecamatan_nama" => $model->kecamatan->nama,
                        "desakelurahan_id" => $model->desakelurahan_id,
                        "desakelurahan_nama" => $model->desakelurahan->nama
                    ]
                ];
            } else {
                $response = "";
            }
        } else {
            $response = "";
        }

        return $response;
    }

    /**
    * Tambah Lahan
    * Method POST
    * Request petani_id, lokasi_kode, luas_m2, keterangan
    * Response Success
    * {
    *   "status" : "success",
    *   "data" : {"id":"<val>", "petani_id":"<val>", "petani_nama":"<val>",
    *             "lokasi_kode":"<val>", "lokasi_nama":"<val>", "luas_m2":"<val>",
    *             "keterangan":"<val>"}
    * }
    * Response Failed
    * {"status":""}
    */
    public function actionTambahLahan()
    {
        $model = new \app\models\Lahan();
        $request = Yii::$app->request;

        if (isset($request)) {
            $model->petani_id = $request->post('petani_id');
            $model->lokasi_kode = $request->post('lokasi_kode');
            $model->luas_m2 = $request->post('luas_m2');
            $model->keterangan = $request->post('keterangan');
            $model->status = 'aktif';

            if($model->save(false)){
                $response = [
                    "status" => "success",
                    "data" => [
                        "id" => $model->id,
                        "petani_id" => $model->petani_id,
                        "petani_nama" => $model->petani->nama,
                        "lokasi_kode" => $model->lokasi_kode,
                        "lokasi_nama" => $model->lokasiKode->nama,
                        "luas_m2" => $model->luas_m2,
                        "keterangan" => $model->keterangan
                    ]
                ];
            } else {
                $response = "";
            }
        } else {
            $response = "";
        }

        return $response;
    }

    /**
    * Tambah Proposal
    * Method POST
    * Request tgl_tanam, tgl_panen, est_tgl_kirim, prop_kadaluarsa, petani_id, provinsi_id, kabupatenkota_id, kecamatan_id,
    *           desakelurahan_id, luas_lahan, luas_unit, komoditas_id, varietas_id, jenis_id, lapak_prov_id, lapak_kabkota_id,
    *           lapak_kec_id, lapak_desakel_id, est_bobot_basah, est_bobot_kering, jenis_bobot_kering_id, biaya_tebas, biaya_proses,
    *           pasar_tag_id, biaya_kirim, kapasitas_pasar, pasar_id, est_harga_jual, latitude, longitude
    * Response Success
    * {
    *   "status" : "success",
    *   "data" : {"id":"<val>", "lahan_id":"<val>", "komoditas_kode":"<val>",
    *             "tgl_tanam":"<val>", "tgl_panen":"<val>", "est_bobot_panen":"<val>","harga_panen":"<val>",
    *             "no_proposal":"<val>", "created":"<val>", "updated":"<val>"
    *             }
    * }
    * Response Failed
    * {"status":""}
    */
    public function actionTambahProposal()
    {
        $model = new \app\models\Proposal();
        $request = Yii::$app->request;

        if (isset($request)) {
            // Konversi tanggal
            $model->tgl_tanam = date('Y-m-d', strtotime($request->post('tgl_tanam')));
            $model->tgl_panen = date('Y-m-d', strtotime($request->post('tgl_panen')));
            $model->est_tgl_kirim = date('Y-m-d', strtotime($request->post('est_tgl_kirim')));
            $model->prop_kadaluarsa = date('Y-m-d', strtotime($request->post('prop_kadaluarsa')));

            $model->petani_id = $request->post('petani_id');
            $model->provinsi_id = $request->post('provinsi_id');
            $model->kabupatenkota_id = $request->post('provinsi_id');
            $model->kecamatan_id = $request->post('kecamatan_id');
            $model->desakelurahan_id = $request->post('desakelurahan_id');
            $model->luas_lahan = $request->post('luas_lahan');
            $model->luas_unit = $request->post('luas_unit');
            $model->komoditas_id = $request->post('komoditas_id');
            $model->varietas_id = $request->post('varietas_id');
            $model->jenis_id = $request->post('jenis_id');

            $model->lapak_prov_id = $request->post('lapak_prov_id');
            $model->lapak_kabkota_id = $request->post('lapak_kabkota_id');
            $model->lapak_kec_id = $request->post('lapak_kec_id');
            $model->lapak_desakel_id = $request->post('lapak_desakel_id');

            $model->est_bobot_basah = $request->post('est_bobot_basah');
            $model->est_bobot_kering = $request->post('est_bobot_kering');
            $model->jenis_bobot_kering_id = $request->post('jenis_bobot_kering_id');

            $model->biaya_tebas = strval($request->post('biaya_tebas'));
            $model->biaya_proses = strval($request->post('biaya_proses'));
            $model->pasar_tag_id = $request->post('pasar_tag_id');
            $model->biaya_kirim = strval($request->post('biaya_kirim'));

            $model->kapasitas_pasar = $request->post('kapasitas_pasar');
            $model->pasar_id = $request->post('pasar_id');
            $model->est_harga_jual = strval($request->post('est_harga_jual'));

            $model->latitude = $request->post('latitude');
            $model->longitude = $request->post('longitude');

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

            $model->no_proposal = $this->generateProposalNo();

            if($model->save(false)){
                $response = [
                    "status" => "success",
                    "data" => [
                        'no_proposal' => $model->no_proposal,
                        'tgl_tanam' => $model->tgl_tanam,
                        'tgl_panen' => $model->tgl_panen,
                        'est_tgl_kirim' => $model->est_tgl_kirim,
                        'prop_kadaluarsa' => $model->prop_kadaluarsa,
                        'petani_nama' => $model->petani->nama,
                        'provinsi_nama' => $model->provinsi->nama,
                        'kabupatenkota_nama' => $model->kabupatenkota->nama,
                        'kecamatan_nama' => $model->kecamatan->nama,
                        'desakelurahan_nama' => $model->desakelurahan->nama,
                        'luas_lahan' => $model->luas_lahan,
                        'luas_unit' => $model->luas_unit,
                        'luas_m2' => $model->luas_m2,
                        'komoditas_nama' => $model->komoditas->nama,
                        'varietas_nama' => $model->varietas->nama,
                        'jenis_nama' => $model->jenis->nama,
                        'lapak_prov_nama' => $model->lapakProv->nama,
                        'lapak_kabkota_nama' => $model->lapakKabkota->nama,
                        'lapak_kec_nama' => $model->lapakKec->nama,
                        'lapak_desakel_nama' => $model->lapakDesakel->nama,
                        'est_bobot_basah' => $model->est_bobot_basah,
                        'est_bobot_kering' => $model->est_bobot_kering,
                        'jenis_bobot_kering_nama' => $model->jenisBobotKering->nama,
                        'biaya_tebas' => (int)$model->biaya_tebas,
                        'biaya_proses' => (int)$model->biaya_proses,
                        'pasar_tag_nama' => $model->pasarTag->nama,
                        'biaya_kirim' => (int)$model->biaya_kirim,
                        'kapasitas_pasar' => $model->kapasitas_pasar,
                        'pasar_nama' => $model->pasar->nama,
                        'est_harga_jual' => (int)$model->est_harga_jual,
                        'latitude' => $model->latitude,
                        'longitude' => $model->longitude,
                    ]
                ];
            } else {
                $response = "1";
            }
        } else {
            $response = "2";
        }

        return $response;
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

    public function actionTambahKebpasar()
    {
        $model = new \app\models\KebutuhanPasar();
        $request = Yii::$app->request;

        if (isset($request)) {

            $model->pasar_id = $request->post('pasar_id');
            $model->kuantitas = $request->post('kuantitas');
            $model->kuantitas_unit = $request->post('kuantitas_unit');
            $model->pembeli = $request->post('pembeli');
            $model->tgl_butuh = date('Y-m-d', strtotime($request->post('tgl_butuh')));
            $model->keterangan = $request->post('keterangan');
            $model->latitude = $request->post('latitude');
            $model->longitude = $request->post('longitude');
            $model->harga = $request->post('harga');

            if($model->save(false)){
                $response = [
                    "status" => "success",
                    "data" => [
                        "id" => $model->id,
                        "pasar_id" => $model->pasar_id,
                        "kuantitas" => $model->kuantitas,
                        "kuantitas_unit" => $model->kuantitas_unit,
                        "pembeli" => $model->pembeli,
                        "tgl_butuh" => $model->tgl_butuh,
                        "keterangan" => $model->keterangan,
                        "latitude" => $model->latitude,
                        "longitude" => $model->longitude,
                        "harga" => $model->harga
                    ]
                ];
            } else {
                $response = "";
            }
        } else {
            $response = "";
        }

        return $response;
    }

    /**
    * Tambah Survey Tanam
    * Method POST
    * Request petani_id, provinsi_id, kabupatenkota_id, kecamatan_id, desakelurahan_id, luas_lahan, luas_unit, komoditas_id,
    *           varietas_id, jenis_id, tgl_panen, tgl_tanam, harga_bibit, est_bobot_ton
    * Response Success
    * {
    *   "status" : "success",
    *   "data" : {"id":"<val>", "petani_nama":"<val>", "desakelurahan_nama":"<val>", "kecamatan_nama":"<val>",
    *             "kabupatenkota_nama":"<val>", "provinsi_nama":"<val>", "luas_lahan":"<val>", "luas_unit":"<val>",
    *             "luas_m2":"<val>", "komoditas_nama":"<val>", "varietas_nama":"<val>", "jenis_nama":"<val>",
    *             "tgl_panen":"<val>", "tgl_tanam":"<val>", "harga_bibit":"<val>", "est_bobot_ton":"<val>", "latitude":"<val>", "longitude":"<val>",
    *             "created_at":"<val>", "updated_at":"<val>"
    *             }
    * }
    * Response If Failed
    * {"status":""}
    */
    public function actionTambahSurveyTanam()
    {
        $model = new \app\models\SurveyTanam();
        $request = Yii::$app->request;

        if (isset($request)) {
            $model->petani_id = $request->post('petani_id');
            $model->provinsi_id = $request->post('provinsi_id');
            $model->kabupatenkota_id = $request->post('kabupatenkota_id');
            $model->kecamatan_id = $request->post('kecamatan_id');
            $model->desakelurahan_id = $request->post('desakelurahan_id');
            $model->luas_lahan = $request->post('luas_lahan');
            $model->luas_unit = $request->post('luas_unit');
            $model->komoditas_id = $request->post('komoditas_id');
            $model->varietas_id = $request->post('varietas_id');
            $model->jenis_id = $request->post('jenis_id');
            $model->tgl_panen = date('Y-m-d', strtotime($request->post('tgl_panen')));
            $model->tgl_tanam = date('Y-m-d', strtotime($request->post('tgl_tanam')));
            $model->harga_bibit = strval($request->post('harga_bibit'));
            $model->est_bobot_ton = $request->post('est_bobot_ton');
            $model->latitude = $request->post('latitude');
            $model->longitude = $request->post('longitude');

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

            if($model->save()) {
                $response = [
                    'status' => 'success',
                    'data' => [
                        'id' => $model->id,
                        'petani_nama' => $model->petani->nama,
                        'desakelurahan_nama' => $model->desakelurahan->nama,
                        'kecamatan_nama' => $model->kecamatan->nama,
                        'kabupatenkota_nama' => $model->kabupatenkota->nama,
                        'provinsi_nama' => $model->provinsi->nama,
                        'luas_lahan' => $model->luas_lahan,
                        'luas_unit' => $model->luas_unit,
                        'luas_m2' => $model->luas_m2,
                        'komoditas_nama' => $model->komoditas->nama,
                        'varietas_nama' => $model->varietas->nama,
                        'jenis_nama' => $model->jenis->nama,
                        'tgl_panen' => $model->tgl_panen,
                        'tgl_tanam' => $model->tgl_tanam,
                        'harga_bibit' => (int)$model->harga_bibit,
                        'est_bobot_ton' => $model->est_bobot_ton,
                        'latitude' => $model->latitude,
                        'longitude' => $model->longitude,
                        'created_at' => $model->created_at,
                        'updated_at' => $model->updated_at,
                    ]
                ];
            } else {
                $response = '';
            }
        } else {
            $response = '';
        }

        return $response;
    }
}
