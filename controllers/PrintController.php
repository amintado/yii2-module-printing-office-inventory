<?php

namespace amintado\pinventory\controllers;

use amintado\base\AmintadoFunctions;
use amintado\pinventory\models\Cardex;
use amintado\pinventory\models\Product;
use amintado\pinventory\models\Storage;
use amintado\pinventory\models\StorageItems;
use common\models\User;
use Yii;
use amintado\pinventory\models\Sprint;
use amintado\pinventory\models\PrintSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * PrintController implements the CRUD actions for Sprint model.
 */
class PrintController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'productlist' => ['post']
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf', 'save-as-new', 'productlist','factor'],
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
     * Lists all Sprint models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PrintSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $post=Yii::$app->request->post();
        $model = new Sprint();
        if (!empty($post)){


            $model->load(Yii::$app->request->post());
            if (empty($model->date)){
                $model->date=date('ymd');
            }
            if ($model->save()){
                //<add cardex record>
                {
                    //<Change Stock In StorageItem>
                    {
                        $StorageItem=StorageItems::findOne(['storage'=>$model->storage,'product'=>$model->product]);
                        $oldStock=$StorageItem->stock;
                        $StorageItem->stock=((float)$StorageItem->stock)-((float)$model->page_count);
                        $StorageItem->save();
                    }
                    //</Change Stock In StorageItem>

                    $user = User::findOne(['id' => Yii::$app->user->id]);
                    $cardex = new Cardex();
                    $cardex->date = date('ymd');
                    $cardex->description = 'ثبت چاپ توسط کاربر ' . $user->username . ' در تاریخ ' . (new AmintadoFunctions())->convertdate(date('ymd'));
                    $cardex->stock = $StorageItem->stock;
                    $cardex->change = $model->page_count - $oldStock;
                    $cardex->product=$model->product;
                    $cardex->storage=$model->storage;
                    $cardex->uid = $user->id;
                    $cardex->model=(string)$model->id;
                    $cardex->username = $user->username;
                    $cardex->module = Cardex::MODULE_PRINT;
                    $cardex->save();
                }
                //</add cardex record>
            }


        }
        $model=new Sprint();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    public function actionProductlist()
    {
        $post = Yii::$app->request->post();
        Yii::$app->response->format = Response::FORMAT_HTML;
        $model = StorageItems::find()->where(['storage' => $post['dat']])->all();
        $out = '<div class="form-group field-sprint-storage has-success">
<label class="control-label" for="sprint-storage">محصول</label><select id="sprint-product" class="form-control" name="Sprint[product]" data-s2-options="s2options_d6851687" data-krajee-select2="select2_e05632a1" style="display:none">';
        foreach ($model as $key => $value) {
//            $array = [
//                'id' => $value->product,
//                'text' => $value->product];
//            $out[]=$array;
            $out.='<option value="'.$value->product.'">'.$value->product.'</option>';
        }
        $out.='</select></div>';
        return $out;
    }

    /**
     * Displays a single Sprint model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Sprint model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sprint();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Sprint model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->request->post('_asnew') == '1') {
            $model = new Sprint();
            $update=false;
        } else {
            $model = $this->findModel($id);
            $update=true;
            $stock=$model->page_count;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($update){
                if ($model->page_count!==$stock){
                    $items=StorageItems::findOne(['storage'=>$model->storage,'product'=>$model->product]);
                    $oldStock=$items->stock;
                    $items->stock=$items->stock - ($model->page_count - (float)$stock);
                    $items->save();
                    $user = User::findOne(['id' => Yii::$app->user->id]);
                    $cardex = new Cardex();
                    $cardex->date = date('ymd');
                    $cardex->description = 'ثبت چاپ توسط کاربر ' . $user->username . ' در تاریخ ' . (new AmintadoFunctions())->convertdate(date('ymd'));
                    $cardex->stock = $items->stock;
                    $cardex->change = $model->page_count - $oldStock;
                    $cardex->product=$model->product;
                    $cardex->storage=$model->storage;
                    $cardex->uid = $user->id;
                    $cardex->model=(string)$model->id;
                    $cardex->username = $user->username;
                    $cardex->module = Cardex::MODULE_PRINT;
                    $cardex->save();

                }





            }


            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'update'=>true
            ]);
        }
    }

    /**
     * Deletes an existing Sprint model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $count=$model->page_count;
        if ($model->delete()){
            $item=StorageItems::find()->where(['storage'=>$model->storage,'product'=>$model->product])->one();
            $item->stock=$item->stock+(float)$count;
            $item->save();
        }


        return $this->redirect(['index']);
    }

    /**
     *
     * Export Sprint information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id)
    {
        $model = $this->findModel($id);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
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
     * Creates a new Sprint model by another data,
     * so user don't need to input all field from scratch.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @param mixed $id
     * @return mixed
     */
    public function actionSaveAsNew($id)
    {
        $model = new Sprint();

        if (Yii::$app->request->post('_asnew') != '1') {
            $model = $this->findModel($id);
        }

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('saveAsNew', [
                'model' => $model,
            ]);
        }
    }

    public function actionFactor($id){

    }

    /**
     * Finds the Sprint model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sprint the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sprint::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('common', 'The requested page does not exist.'));
        }
    }
}
