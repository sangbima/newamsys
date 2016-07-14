<?php

use yii\helpers\Html;
use yii\helpers\Url;
use mdm\admin\components\Helper;


$this->title = Yii::$app->user->identity->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Profil', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="profile-page">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-widget widget-user">
                <div class="box-tools pull-right">
                    <a class="btn btn-warning btn-xs btn-raised btnSpecial" href="#"><i class="fa fa-key"></i> Change Password</a><a class="btn btn-primary btn-xs btn-raised btnSpecial" href="#"><i class="fa fa-edit"></i> Update</a>
                </div>
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-teal">
                    <h3 class="widget-user-username">Administrator's Profile</h3>
                    <h5 class="widget-user-desc">Founder &amp; CEO</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="/images/default-profile.png" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header"> 08-05-2016 13:38:23</h5>
                                <span class="description-text">LAST LOGIN</span>
                            </div><!-- /.description-block -->
                        </div><!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">admin@bms.com</h5>
                                <span class="description-text">EMAIL</span>
                            </div><!-- /.description-block -->
                        </div><!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header"> 02-02-2000</h5>
                                <span class="description-text">BIRTHDATE</span>
                            </div><!-- /.description-block -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div>
                <hr class="hr-primary">
                <div class="box-body with-border">
                    <p>Log Activity</p>
                </div>
            </div>
        </div>
    </div>
</div>
