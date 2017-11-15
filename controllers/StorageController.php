<?php

namespace amintado\pinventory\controllers;

use amintado\base\AmintadoFunctions;
use amintado\pinventory\models\Cardex;
use amintado\pinventory\models\Product;
use amintado\pinventory\models\ProductSearch;
use amintado\pinventory\models\StorageItems;
use amintado\pinventory\models\StorageItemsSearch;
use common\models\User;
use Yii;
use amintado\pinventory\models\Storage;
use amintado\pinventory\models\StorageSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StorageController implements the CRUD actions for Storage model.
 */
class StorageController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'stoke' => ['post'],
                    'max-indicator' => ['post'],
                    'min-indicator' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf', 'save-as-new', 'add-storage-items', 'stock', 'min-indicator', 'max-indicator'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Storage models.
     * @return mixed
     */
    public function actionIndex()
    {

        $model = new Storage();
        if (!empty(Yii::$app->request->post())) {
            $model->load(Yii::$app->request->post());
            $model->save();
        }

        $searchModel = new StorageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model=new Storage();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    public function actionMaxIndicator()
    {
        $post = Yii::$app->request->post();
        if (!empty($post['editableKey'])) {
            $id = $post['editableKey'];
            $model = StorageItems::findOne(['id' => $id]);


            $num = (float)$post['StorageItems'][$post['editableIndex']]['max_indicator'];
            if (!empty($model->min_indicator)) {
                if ($num < $model->min_indicator) {
                    return Json::encode(['message' =>
                        'عدد وارد شده از حداقلی که برای موجودی تنظیم کردید کمتر است، میتونید عددی بزرگتر از ' . $model->min_indicator . ' انتخاب کنید.', 'output' => $model->max_indicator]);
                }
                if ($num == $model->min_indicator) {
                    return Json::encode(['message' =>
                        'متاسفانه اعدادی که برای حداقل و حداکثر موجودی این کالا در انبار تنظیم کردید برابر هستند. لطفا اعداد را به طور صحیح تنظیم نمایید.', 'output' => $model->max_indicator]);
                }
            }

            $model->max_indicator = (float)$post['StorageItems'][$post['editableIndex']]['max_indicator'];
            $model->save();
            return Json::encode(['message' => '', 'output' => $model->max_indicator]);
        }
    }

    public function actionMinIndicator()
    {
        $post = Yii::$app->request->post();
        if (!empty($post['editableKey'])) {
            $id = $post['editableKey'];
            $model = StorageItems::findOne(['id' => $id]);

            $num = (float)$post['StorageItems'][$post['editableIndex']]['min_indicator'];

            if (!empty($model->max_indicator)) {
                if ($num > $model->max_indicator) {
                    return Json::encode(['message' => 'عدد وارد شده بیشتر حداکثر موجودی ای است که تنظیم نموده اید.میتونید بین 0 تا ' . ((float)$model->max_indicator - 1) . ' انتخاب داشته باشید', 'output' => $model->min_indicator]);
                }
                if ($num == $model->max_indicator) {
                    return Json::encode(['message' =>
                        'متاسفانه اعدادی که برای حداقل و حداکثر موجودی این کالا در انبار تنظیم کردید برابر هستند. لطفا اعداد را به طور صحیح تنظیم نمایید.', 'output' => $model->max_indicator]);
                }
            }

            $model->min_indicator = $num;
            $model->save();
            return Json::encode(['message' => '', 'output' => $model->min_indicator]);
        }
    }

    public function actionStock()
    {
        $post = Yii::$app->request->post();
        if (!empty($post['editableKey'])) {
            $id = $post['editableKey'];
            $model = StorageItems::findOne(['id' => $id]);
            $oldStock = $model->stock;

            $model->stock = (float)$post['StorageItems'][$post['editableIndex']]['stock'];
            $model->save();


            //<add cardex record>
            {

                $user = User::findOne(['id' => Yii::$app->user->id]);
                $cardex = new Cardex();
                $cardex->date = date('ymd');
                $cardex->description = 'ثبت موجودی جدید به طور مستقیم توسط کاربر ' . $user->username . ' در تاریخ ' . (new AmintadoFunctions())->convertdate(date('ymd'));
                $cardex->stock = $model->stock;
                $cardex->change = $model->stock - $oldStock;
                $cardex->product=$model->product;
                $cardex->storage=$model->storage;
                $cardex->uid = $user->id;
                $cardex->username = $user->username;
                $cardex->module = Cardex::MODULE_CHANGED;
                $cardex->save();
            }
            //</add cardex record>


            return Json::encode(['message' => '', 'output' => $model->stock]);
        }
    }

    /**
     * Displays a single StorageItems model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $id = urldecode($id);
        $searchModel = new StorageItemsSearch();
        $dataProvider = $searchModel->searchItems(Yii::$app->request->queryParams, $id);


        $model = StorageItems::find()->where(['storage' => $id])->all();
        if (empty($model)) {
            throw new ForbiddenHttpException('هیچ کالایی در این انبار موجود نیست');
        }
        return $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Storage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Storage();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Storage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        //<Set Parameters>
        {
            $post = Yii::$app->request->post();
            $id = urldecode($id);
            $model = Storage::findOne(['name' => $id]);
        }
        //</Set Parameters>


        //<Product Index>
        {
            $StorageItems = StorageItems::find()->where(['storage' => $id])->all();
            $items = $StorageItems;

            $StorageItems = ArrayHelper::getColumn($StorageItems, 'product');
            // $StorageItems=implode(',',$StorageItems);

            $pmodel = Product::find()->andWhere(['not', ['name' => $StorageItems]])->all();
        }
        //</Product Index>


        //<if user Posted data>
        {
            if (!empty($post)) {


                //<Check New items that should input to storage>
                {

                    if (!empty($post['Storage']['products'])) {
                        $pmodel = ArrayHelper::getColumn($pmodel, 'name');
                        foreach ($post['Storage']['products'] as $key => $value) {
                            $value = urldecode($value);
//                            echo '<pre>';
//                            echo "value:\n\n";
//                            var_dump(urldecode($value));
//                            var_dump(ArrayHelper::isIn($value,$pmodel));

                            if (ArrayHelper::isIn($value, $pmodel)) {
                                $nmodel = new StorageItems();
                                $nmodel->product = $value;
                                $nmodel->storage = $id;

                                if ($nmodel->save()) {
                                    //<add cardex record>
                                    {
                                        $user = User::findOne(['id' => Yii::$app->user->id]);
                                        $cardex = new Cardex();
                                        $cardex->date = date('ymd');
                                        $cardex->description = 'افزودن کالا به انبار ' . $id . ' توسط ' . $user->username . ' در تاریخ ' . (new AmintadoFunctions())->convertdate(date('ymd'));
                                        $cardex->stock = 0;
                                        $cardex->change = -$nmodel->stock;
                                        $cardex->uid = $user->id;
                                        $cardex->product = $nmodel->product;
                                        $cardex->storage = $nmodel->storage;
                                        $cardex->username = $user->username;
                                        $cardex->module = Cardex::MODULE_ADD_TO_STORAGE;
                                        $cardex->save();
                                    }
                                    //</add cardex record>
                                }


                            }


                        }
                    }
//                    echo "model:\n\n\n";
//                    var_dump($pmodel);
//                    die();

                }
                //</Check New items that should input to storage>


                //<Check items that should exit from storage>
                {
                    if (!empty($post['Storage']['products'])) {
                        //$pmodel = ArrayHelper::getColumn($pmodel, 'name');
                        foreach ($items as $key => $value) {
                            /**
                             * @var $value StorageItems
                             */
                            $value->product = urldecode($value->product);
                            echo '<pre>';
                            echo "value:\n\n";
                            //var_dump($value);
                            var_dump(ArrayHelper::isIn($value->product, $post['Storage']['products']));
                            var_dump($post['Storage']['products']);
                            var_dump($value->product);

                            if (!ArrayHelper::isIn($value->product, $post['Storage']['products'])) {
                                if ($value->delete()) {
                                    //<add cardex record>
                                    {
                                        $user = User::findOne(['id' => Yii::$app->user->id]);
                                        $cardex = new Cardex();
                                        $cardex->date = date('ymd');
                                        $cardex->description = 'حذف کالا از انبار ' . $id . ' توسط ' . $user->username . ' در تاریخ ' . (new AmintadoFunctions())->convertdate(date('ymd'));
                                        $cardex->stock = 0;
                                        $cardex->change = -$value->stock;
                                        $cardex->uid = $user->id;
                                        $cardex->product = $value->product;
                                        $cardex->storage = $value->storage;
                                        $cardex->username = $user->username;
                                        $cardex->module = Cardex::MODULE_DELETE_FROM_STORAGE;
                                        $cardex->save();
                                    }
                                    //</add cardex record>
                                }
                            }
                        }
                    } else {
                        foreach ($items as $key => $value) {
                            /**
                             * @var $value StorageItems
                             */
                            if ($value->delete()) {
                                //<add cardex record>
                                {
                                    $user = User::findOne(['id' => Yii::$app->user->id]);
                                    $cardex = new Cardex();
                                    $cardex->date = date('ymd');
                                    $cardex->description = 'حذف کالا از انبار ' . $id . ' توسط ' . $user->username . ' در تاریخ ' . (new AmintadoFunctions())->convertdate(date('ymd'));
                                    $cardex->stock = 0;
                                    $cardex->change = -$value->stock;
                                    $cardex->uid = $user->id;
                                    $cardex->product = $value->product;
                                    $cardex->storage = $value->storage;
                                    $cardex->username = $user->username;
                                    $cardex->module = Cardex::MODULE_DELETE_FROM_STORAGE;
                                    $cardex->save();
                                }
                                //</add cardex record>
                            }

                        }
                    }
                    // echo "model:\n\n\n";
                    // var_dump($pmodel);
                    //die();
                }
                //</Check items that should exit from storage>


            }
        }
        //</if user Posted data>


        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'items' => $items,
                'products' => $pmodel
            ]);
        }
    }




    public function actionPdf($id)
    {
        $model = $this->findModel($id);
        $providerStorageItems = new \yii\data\ArrayDataProvider([
            'allModels' => $model->storageItems,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerStorageItems' => $providerStorageItems,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_CORE,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }

    /**
     * Creates a new Storage model by another data,
     * so user don't need to input all field from scratch.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @param mixed $id
     * @return mixed
     */

    /**
     * Finds the Storage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Storage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Storage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('common', 'The requested page does not exist.'));
        }
    }

}
