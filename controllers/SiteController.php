<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\InfoHarga;
use app\models\Petani;
use app\models\Kabupatenkota;
use app\models\Kecamatan;

class SiteController extends Controller
{
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
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {

        $beforex="SELECT DISTINCT tanggal FROM info_harga WHERE tanggal BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";
        $_xseries = InfoHarga::findBysql($beforex)->all();
        $beforn = "SELECT DISTINCT pasar from info_harga";
        $_nseries = InfoHarga::findBysql($beforn)->all();

        $_xseries_data = array();
        $data_series =array();
        $_data = array ();
        $_data_series = array ();


        foreach ($_xseries as $xs)
        {
             $_xseries_data[] = date('d M Y', strtotime($xs["tanggal"]));
        }

        $num=0;
        $nsj=null;
        foreach ($_nseries as $ns)
        {

            array_push($data_series,array("name"=>$ns["pasar"],));

            $nsj=$ns['pasar'];

        }

        $beforn2 = "SELECT DISTINCT pasar from info_harga";
        $_nseries2 = InfoHarga::findBysql($beforn2)->all();

        foreach ($_nseries2 as $ds)
        {
            $num++;
            $pasar=$ds['pasar'];
            $beforem  =  "SELECT harga_kg from info_harga WHERE tanggal BETWEEN NOW() - INTERVAL 30 DAY AND NOW() AND pasar='$pasar'";
            // $beforem  =  "SELECT harga_kg from info_harga WHERE tanggal between NOW() AND NOW()";
            $months = InfoHarga::findBysql($beforem)->all();

            foreach ($months as $m)
            {
                $_data_series[] = (int)$m["harga_kg"];
            }
            array_push($_data,array(
                'name'=>$ds["pasar"],
                'data'=>$_data_series,
            ));


            if($num==5)
            break;
            unset($_data_series);


        }

        //model graph petani

        $graphOk = array();
        $graphLahanOk = array();

        $pilihPetani = 'SELECT * from petani group by kabupatenkota_id';
        $eksPetani = Petani::findBySql($pilihPetani)->all();
        $numPet=0;
        foreach ($eksPetani as $petani) {
                $idProv=1;
                $kabKota=$petani['kabupatenkota_id'];
                $sqlgraphPetani ="SELECT * from kabupatenkota where id='$kabKota' group by id";
                $graphPetani = Kabupatenkota::findBysql($sqlgraphPetani)->one();

                $pilihCount = "SELECT * from petani where kabupatenkota_id='$kabKota'";
                $eksCount = Petani::findBySql($pilihCount)->count();

                array_push($graphOk,array(
                'name'=>$graphPetani->nama,
                'data'=>array((int)$eksCount),
            ));

        }



        $graphOkKec = array();
        

        $pilihPetaniKec = 'SELECT * from petani where kabupatenkota_id=1 group by kecamatan_id';
        $eksPetaniKec = Petani::findBySql($pilihPetaniKec)->all();
        $numPet=0;
        foreach ($eksPetaniKec as $petaniKec) {
                
                $kec=$petaniKec['kecamatan_id'];                                
                
                $sqlgraphPetaniKec ="SELECT * from kecamatan where id=$kec";

                $graphPetaniKec = Kecamatan::findBysql($sqlgraphPetaniKec)->one();

                $pilihCountKec = "SELECT * from petani where kecamatan_id=$kec  group by kecamatan_id";
                $eksCountKec = Petani::findBySql($pilihCountKec)->count();

                array_push($graphOkKec,array(
                'name'=>$graphPetaniKec->nama,
                'data'=>array((int)$eksCountKec),
            ));

        }
    
        return $this->render('index',[
            'modelNama' => $_data,
            'dataX' => $_xseries_data,
            'graphOk' => $graphOk,
            'graphOkKec' => $graphOkKec]);

    }

    public function actionLogin()
    {
        $this->layout = 'loginLayout';
        
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
