<?php

namespace app\controllers;

use app\models\Cliente;
use Yii;
use app\models\Pedido;
use app\models\PedidoSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Detallepedido;
use app\models\Producto;
use yii\filters\AccessControl;
use app\models\User;
/**
 * PedidoController implements the CRUD actions for Pedido model.
 */
class PedidoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','index','view'],
                'rules' => [
                    [
                        'actions' => ['create','index','view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            //Llamada al método que comprueba si es un empleado
                            return User::RolUserSimple(Yii::$app->user->identity->id);
                        },
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
     * Lists all Pedido models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PedidoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pedido model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        if($model =  $this->findModel($id)) {
            $model2 = Detallepedido::findOne(['pedidoid' => $model->id]);
            $transaction->commit();
        }
        return $this->render('view', [
            'model' => $model,
            'model2'=> $model2,


        ]);
    }

    /**
     * Creates a new Pedido model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pedido();
        $model2 = new Detallepedido();

        if ($model->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {
            $isValid = $model->validate();
            $isValid = $model2->validate() && $isValid;

            if ($isValid) {
                $transaction = Yii::$app->db->beginTransaction();
                if($model->save(false)) {
                    $model2->pedidoid = $model->id;
                    $model2->save(false);
                    $transaction->commit();
                }

                return $this->redirect(['pedido/view', 'id' => $model->id]);
            }
            //return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'model2' =>$model2,
            'clients' => ArrayHelper::map(Cliente::find()->all(), 'id', 'rfc'),
            'productos' => ArrayHelper::map(Producto::find()->all(), 'id', 'nombrep'),
        ]);
    }

    /**
     * Updates an existing Pedido model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model =  $this->findModel($id);
        $model2 = Detallepedido::findOne(['pedidoid' => $model->id]);
        if ($model->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {
            $isValid = $model->validate();
            $isValid = $model2->validate() && $isValid;

            if ($isValid) {
                $transaction = Yii::$app->db->beginTransaction();
                if($model->save(false)) {
                    $model2->pedidoid = $model->id;
                    $model2->save(false);
                    $transaction->commit();
                }

                return $this->redirect(['pedido/view', 'id' => $model->id]);
            }
            //return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->renderAjax('update', [
            'model' =>$model,
            'model2' =>$model2,
            'clients' => ArrayHelper::map(Cliente::find()->all(), 'id', 'rfc'),
            'productos' => ArrayHelper::map(Producto::find()->all(), 'id', 'nombrep'),
        ]);
    }

    /**
     * Deletes an existing Pedido model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        $model =  $this->findModel($id);
        $model2 = Detallepedido::findOne(['pedidoid' => $model->id]);
        if( $model2->delete() &&  $model->delete()){
            $transaction->commit();
        }





        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pedido model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pedido the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pedido::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
