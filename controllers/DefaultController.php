<?php

class DefaultController extends Controller
{
    #public $layout='//layouts/column2';

    public $defaultAction = "admin";
    public $scenario = "crud";

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'       => array('create', 'editableSaver', 'update', 'delete', 'admin', 'view'),
                'expression'    => 'Yii::app()->user->checkAccess("SlitSlider.Default.*")',
            ),
            array('allow',
                'actions'       => array('admin', 'view'),
                'expression'    => 'Yii::app()->user->checkAccess("SlitSlider.Default.View")',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function beforeAction($action)
    {
        parent::beforeAction($action);
        // map identifcationColumn to id
        if (!isset($_GET['id']) && isset($_GET['id'])) {
            $model = Slit::model()->find('id = :id', array(
                ':id' => $_GET['id']));
            if ($model !== null) {
                $_GET['id'] = $model->id;
            } else {
                throw new CHttpException(400);
            }
        }
        if ($this->module !== null) {
            $this->breadcrumbs[$this->module->Id] = array('/' . $this->module->Id);
        }
        return true;
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);

        if ($this->checkAccess($model))
            
            $this->render('view', array('model' => $model,));
        else
            throw new CHttpException('403', 'No Access!');
    }

    public function actionCreate()
    {
        $model = new Slit;
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'slit-form');

        if (isset($_POST['Slit'])) {
            $model->attributes  = $_POST['Slit'];
            $model->updated_by  = Yii::app()->user->id;
            $model->language    = Yii::app()->getLanguage();
            
//            if ($_POST['Slit']['start_date'] === NULL) $model->start_date = $now = new CDbExpression("NOW()");   
//            if ($_POST['Slit']['start_date'] === NULL) $model->start_date = $now = new CDbExpression("NOW()");

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('id', $e->getMessage());
            }
        } elseif (isset($_GET['Slit'])) {
            $model->attributes = $_GET['Slit'];
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $model->scenario = $this->scenario;
        //$now = new CDbExpression("NOW()");

        if ($this->checkAccess($model)) {
            $this->performAjaxValidation($model, 'slit-form');

            if (isset($_POST['Slit'])) {
                $model->attributes  = $_POST['Slit'];
                $model->updated_by  = Yii::app()->user->id;
                $model->language    = Yii::app()->getLanguage();
                
//                if ($model->start_date === NULL) $model->start_date = $now;
//                if ($model->end_date === NULL) $model->end_date = $now;

                try {
                    if ($model->save()) {
                        if (isset($_GET['returnUrl'])) {
                            $this->redirect($_GET['returnUrl']);
                        } else {
                            $this->redirect(array('view', 'id' => $model->id));
                        }
                    }
                } catch (Exception $e) {
                    $model->addError('id', $e->getMessage());
                }
            }

            $this->render('update', array('model' => $model,));
        } else {
            throw new CHttpException('403', 'No Access!');
        }
    }

    public function actionEditableSaver()
    {
        Yii::import('EditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new EditableSaver('Slit');  // classname of model to be updated
        $es->update();
    }

    public function actionDelete($id)
    {

        if (Yii::app()->request->isPostRequest) {
            try {
                if ($this->checkAccess($this->loadModel($id))) {
                    $this->loadModel($id)->delete();
                }
            } catch (Exception $e) {
                throw new CHttpException(500, $e->getMessage());
            }

            if (!isset($_GET['ajax'])) {
                if (isset($_GET['returnUrl'])) {
                    $this->redirect($_GET['returnUrl']);
                } else {
                    $this->redirect(array('admin'));
                }
            }
        }
        else
            throw new CHttpException(400, Yii::t('SlitSliderModule.crud', 'Invalid request. Please do not repeat this request again.'));
    }

    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Slit');
        $this->render('index', array('dataProvider' => $dataProvider,));
    }

    public function actionAdmin()
    {
        $model = new Slit('search');
        $model->unsetAttributes();

        if (isset($_GET['Slit'])) {
            $model->attributes = $_GET['Slit'];
        }

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id)
    {
        $model = Slit::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('SlitSliderModule.crud', 'The requested page does not exist.'));
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'slit-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function checkAccess($model)
    {
        if ($model->language === Yii::app()->getLanguage())
            return true;
        else
            throw new CHttpException('403', 'No Access!');
    }
}
