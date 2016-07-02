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
      'tambah-produksi' => ['POST','OPTIONS'],
      'tambah-petani' => ['POST','OPTIONS'],
      'tambah-kebpasar' => ['POST','OPTIONS'],
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
  * Tambah Produksi
  * Method POST
  * Request user_id, lahan_id, komoditas_kode, tgl_tanam, tgl_panen, est_bobot_panen, harga_panen
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
  // function tambah produksi sebelum perubahan struktur database
  // public function actionTambahProduksi()
  // {
  //   $model = new \app\models\Produksi();
  //   $request = Yii::$app->request;

  //   if (isset($request)) {
  //       $model->no_proposal = $this->generateProposalNo();
  //       $model->lahan_id = $request->post('lahan_id');
  //       $model->komoditas_kode = $request->post('komoditas_kode');
  //       $model->tgl_tanam = date('Y-m-d', strtotime($request->post('tgl_tanam')));
  //       $model->tgl_panen = date('Y-m-d', strtotime($request->post('tgl_panen')));
  //       $model->est_bobot_panen = $request->post('est_bobot_panen');
  //       $model->harga_panen = $request->post('harga_panen');
  //       $model->status = 'pending';

  //       if($model->save(false)){
  //         $response = [
  //           "status" => "success",
  //           "data" => [
  //             "id" => $model->id,
  //             "no_proposal" => $model->no_proposal,
  //             "lahan_id" => $model->lahan_id,
  //             "petani_nama" => $model->petani->nama,
  //             "luas_m2" => $model->lahan->luas_m2,
  //             "lokasi_nama" => $model->lokasi->nama,
  //             "komoditas_kode" => $model->komoditas_kode,
  //             "komoditas_nama" => $model->komoditasKode->nama,
  //             "tgl_tanam" => date('d F Y', strtotime($model->tgl_tanam)),
  //             "tgl_panen" => date('d F Y', strtotime($model->tgl_panen)),
  //             "est_bobot_panen" => $model->est_bobot_panen,
  //             "harga_panen" => $model->harga_panen,
  //             "created" => $model->created,
  //             "updated" => $model->updated,
  //           ]
  //         ];
  //       } else {
  //         $response = "";
  //       }
  //   } else {
  //     $response = "";
  //   }

  //   return $response;
  // }

    public function actionTambahProposal()
    {
        $model = new \app\models\Proposal();
        $request = Yii::$app->request;

        if (isset($request)) {
            $model->no_proposal = $this->generateProposalNo();
            // $model->lahan_id = $request->post('lahan_id');


            if($model->save(false)){
                $response = [
                    "status" => "success",
                    "data" => [
                        
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

  public function buatkode() // Untuk tambah Komoditas/Varietas
  {
      // Kode utama komoditas bawang 1
      $kodeutama = 1;
      $records = app\models\Komoditas::find()->where(['parent' => 1, 'level' => 'Variatas'])->all();

      $codes = [];
      $id = [0];
      $i=0;
      foreach ($records as $key) {
        $codes[$i] = explode('.', $key['kode']);
        $id[] = $codes[$i][1] ? $codes[$i][1] : 0;
        $i++;
      }

      $maxId = max($id);

      $nextcode = $maxId+1;

      $code = $kodeutama.'.'.$nextcode;
      return $code;
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

}
