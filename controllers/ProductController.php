<?php

namespace app\controllers;

use app\models\ProductRatio;
use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'view',
                            'create',
                            'update',
                            'delete',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
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
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'ratio' => ProductRatio::find()->where(['product_id' => $id])->all(),
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

        if ($model->load(Yii::$app->request->post())) {
            $ratio = $model->ratio;
            $model->save();

            if(isset($ratio) && count($ratio) != 0)
            foreach ($ratio as $r){
                $product_ratio = new ProductRatio();
                $product_ratio->product_id = $model->id;
                $product_ratio->sub_product_id = $r['component_id'];
                $product_ratio->ratio = $r['count'];
                $product_ratio->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $ratio = ProductRatio::find()->select(['sub_product_id', 'ratio'])->where(['product_id' => $id])->asArray()->all();
        for($i=0;$i < count($ratio);$i++){
            $model->ratio[$i]['component_id'] = $ratio[$i]['sub_product_id'];
            $model->ratio[$i]['count'] = $ratio[$i]['ratio'];
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->updated_at = date('U');
            $ratio = $model->ratio;
            $model->save();
            if(isset($ratio) && count($ratio) != 0) {
                $delete = ProductRatio::find()->select(['id'])->where(['product_id' => $id])->all();
                foreach ($delete as $d){
                    ProductRatio::findOne($d)->delete();
                }
                foreach ($ratio as $r) {
                    $product_ratio = new ProductRatio();
                    $product_ratio->product_id = $model->id;
                    $product_ratio->sub_product_id = $r['component_id'];
                    $product_ratio->ratio = $r['count'];
                    $product_ratio->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

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
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
