<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Product;
use app\modules\admin\models\ProductSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->image = UploadedFile::getInstance($model, 'image');
            if($model->image){
                $model->upload();
            }
            unset($model->image); // !!!! IMPORTANT !!!!
            $model->gallery = UploadedFile::getInstances($model, 'gallery');
            if($model->gallery){
                $model->uploadGallery();
            }

            Yii::$app->session->setFlash('success', 'Товар ' . $model->title . ' успешно создан!');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->image = UploadedFile::getInstance($model, 'image');
            if($model->image){
                $model->upload();
            }
            unset($model->image); // !!!! IMPORTANT !!!!
            $model->gallery = UploadedFile::getInstances($model, 'gallery');
            if($model->gallery){
                $model->uploadGallery();
            }

            Yii::$app->session->setFlash('success', 'Товар ' . $model->title . ' успешно отредактирован!');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->removeImages();
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDelphoto()
    {
        $return = 0;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if(!empty($data['model']) && !empty($data['photo'])){
                $model = $this->findModel($data['model']); // получили модель
                $images = $model->getImages(); // получили все фото модели
                if(!empty($images)){
                    foreach($images as $k => $image){
                        if($image->id == $data['photo']){
                            $model->removeImage($image); // удалили фото
                            $return = 1;
                            unset($images[$k]); // удалили этот элемент массива
                            break;
                        }
                    }
                    // если после удаления элемента массива с удаленным фото
                    // массив $images не пуст – назначаем главным первое фото в оставшемся массиве
                    if(!empty($images)){
                        reset($images); // сброс указателя
                        $firstImage = current($images); // первый элемент оставшегося массива
                        $model->setMainImage($firstImage); // назначаем новое главное фото
                    }
                }
            }
            return $return;
        }
        return $return;
    }
}
