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
 * Date: 11/18/2017
 * Time: 12:05 PM
 */

namespace amintado\pinventory\widgets;


use yii\base\Widget;

class SettingsWidget extends Widget
{
    public function init()
    {
        echo $this->render('@vendor/amintado/yii2-module-printing-office-inventory/widgets/views/settings.php');
    }
}