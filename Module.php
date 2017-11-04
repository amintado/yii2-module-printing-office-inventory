<?php
namespace amintado\pinventory;

use kartik\mpdf\Pdf;
use Yii;
use yii\helpers\ArrayHelper;

class Module extends \yii\base\Module{
    public $controllerNamespace='amintado\pinventory\controllers';

    public function init(){
        $this->initI18N();
        $this->initComponents();
    }

    /**
     * TranslationTrait manages methods for all translations used in Krajee extensions
     *
     * @property array $i18n
     *
     * @author Kartik Visweswaran <kartikv2@gmail.com>
     * @since 1.8.8
     * Yii i18n messages configuration for generating translations
     * source : https://github.com/kartik-v/yii2-krajee-base/blob/master/TranslationTrait.php
     * Edited by : Yohanes Candrajaya <moo.tensai@gmail.com>
     *
     *
     * @return void
     */
    public function initI18N()
    {
        $reflector = new \ReflectionClass(get_class($this));
        $dir = dirname($reflector->getFileName());

        Yii::setAlias("@atpinventory", $dir);
        $config = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => "@atpinventory/messages",
            'forceTranslation' => true
        ];
        $globalConfig = ArrayHelper::getValue(Yii::$app->i18n->translations, "atpinventory*", []);
        if (!empty($globalConfig)) {
            $config = array_merge($config, is_array($globalConfig) ? $globalConfig : (array)$globalConfig);
        }
        Yii::$app->i18n->translations["atpinventory*"] = $config;
    }

    public function initComponents(){
        $pdf=
            [
                'class'=>'kartik\mpdf\Pdf',
                'mode'=>Pdf::MODE_UTF8,
                'format' => Pdf::FORMAT_A4,
                'marginLeft' => 20,
                'marginRight' => 20,
                'marginTop' => 10,
                'marginBottom' => 10,
                'orientation' => Pdf::ORIENT_PORTRAIT,
                'cssFile' => '@vandor/amintado/yii2-module-pay/assets/css/factor.css',

            ];


        //Yii::$app->components['pdf']= $pdf;
        Yii::$app->setComponents([$pdf]);
    }
}