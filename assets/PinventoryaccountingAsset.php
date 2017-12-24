<?php
/*******************************************************************************
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 ******************************************************************************/

/**
 * Created by PhpStorm.
 * User: amin__000
 * Date: 11/21/2017
 * Time: 9:21 AM
 */

namespace amintado\pinventory\assets;


use yii\web\AssetBundle;

class PinventoryaccountingAsset extends AssetBundle
{
    public $sourcePath = '@vendor/amintado/yii2-module-printing-office-inventory/assets';
    public $js=
        [
          'js/accounting.js'
        ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}