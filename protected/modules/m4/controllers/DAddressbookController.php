<?php

class dAddressbookController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return [
            'rights',
        ];
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', [
            'model' => $this->loadModel($id),
        ]);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['dAddressbook'])) {
            $model->attributes = $_POST['dAddressbook'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'data has been saved successfully');
                $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $addressbook = $this->newAddressbook();

        $model = new dAddressbook('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['dAddressbook']))
            $model->attributes = $_GET['dAddressbook'];

        $this->render('index', [
            'model' => $model,
            'modelAddressbook' => $addressbook,
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function newAddressbook()
    {
        $model = new dAddressbook;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['dAddressbook'])) {
            $model->attributes = $_POST['dAddressbook'];
            $model->save();

            if (isset($_POST['dAddressbook']['defaultgroup'])) {
                $modelgroup = new dAddressbookGroupDetail;
                $modelgroup->parent_id = $_POST['dAddressbook']['defaultgroup'];
                $modelgroup->name_id = $model->id;
                $modelgroup->save();
                Yii::app()->user->setFlash('success', 'data has been saved successfully');
            }


            $this->redirect(['index']);
        }

        return $model;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = dAddressbook::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'daddressbook-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
