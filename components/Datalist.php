<?php

namespace app\components;

use yii\helpers\ArrayHelper;

/**
 *
 */
class Datalist
{
    public function getProvinceList()
    {
        $data = \app\models\Provinsi::find()->all();
        return ArrayHelper::map($data, 'id', 'nama');
    }

    public function getKabupatenKotaList()
    {
        $data = \app\models\Kabupatenkota::find()->all();
        return ArrayHelper::map($data, 'id', 'nama');
    }

    public function getKecamatanList()
    {
        $data = \app\models\Kecamatan::find()->all();
        return ArrayHelper::map($data, 'id', 'nama');
    }

    public function getDesaKelurahanList()
    {
        $data = \app\models\Desakelurahan::find()->all();
        return ArrayHelper::map($data, 'id', 'nama');
    }

    public function getListPetani()
    {
        $data = \app\models\Petani::find()->all();
        return ArrayHelper::map($data, 'id', 'nama');
    }

    public function getListKomoditas()
    {
        $data = \app\models\Komoditas::find()->all();
        return ArrayHelper::map($data, 'id', 'nama');
    }

    public function getListVarietas()
    {
        $data = \app\models\Varietas::find()->all();
        return ArrayHelper::map($data, 'id', 'nama');
    }

    public function getListJenis()
    {
        $data = \app\models\Jenis::find()->all();
        return ArrayHelper::map($data, 'id', 'nama');
    }

    public function getListJenisBobotKering()
    {
        $data = \app\models\JenisBobotKering::find()->all();
        return ArrayHelper::map($data, 'id', 'nama');
    }

    public function getListPasarTag()
    {
        $data = \app\models\PasarTag::find()->all();
        return ArrayHelper::map($data, 'id', 'nama');
    }

    public function getListPasar()
    {
        $data = \app\models\Pasar::find()->all();
        return ArrayHelper::map($data, 'id', 'nama');
    }
}
