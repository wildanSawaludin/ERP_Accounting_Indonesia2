<?php

class GLeaveController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2left';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return [
            //array(
            //	'CHttpCacheFilter + index',
            //'lastModified'=>Yii::app()->db->createCommand("SELECT MAX(`updated_date`) FROM g_leave")->queryScalar(),
            //),
            'rights',
            'ajaxOnly + approved, autoLeave, leaveCalendarAjax',
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
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new gLeave;
        $model->setScenario('create');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gLeave'])) {
            $model->attributes = $_POST['gLeave'];
            $model->input_date = date('d-m-Y');
            $model->approved_id = 1; ///request
            $model->activation_code = peterFunc::rand_string(50);
            $model->activation_expire = strtotime($model->end_date);

            $criteria = new CDbCriteria;
            $criteria->compare('parent_id', $model->parent_id);
            $modelCount = gLeave::model()->count($criteria);


            if ($model->save()) {
                if ($modelCount == 0)
                    $this->actionAutoGeneratedLeave($model->parent_id);

                $this->redirect(['/m1/gLeave']);
            }
        }

        $this->render('createWithEmp', [
            'model' => $model,
        ]);
    }

    public function actionAutoLeave($id)
    {
        $modelAttendance = gAttendance::model()->findByPk((int)$id);
        if ($modelAttendance == null)
            return true;

        $model = new gLeave;
        $model->parent_id = $modelAttendance->parent_id;
        $model->input_date = date('d-m-Y');
        $model->start_date = $modelAttendance->cdate;
        $model->end_date = $modelAttendance->cdate;
        $model->number_of_day = 1;
        $model->work_date = $modelAttendance->cdate;
        $model->leave_reason = "by HR Admin. Cuti otomatis pengganti tidak masuk kerja tanpa keterangan pada: " . $modelAttendance->cdate;

        $model->approved_id = 1; ///request
        $model->activation_code = peterFunc::rand_string(50);
        $model->activation_expire = strtotime($model->end_date);

        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $model->parent_id);
        $modelCount = gLeave::model()->count($criteria);


        if ($model->save()) {
            if ($modelCount == 0)
                $this->actionAutoGeneratedLeave($model->parent_id);

            $this->actionApproved($model->id, $model->parent_id);

            $this->newInbox([
                'recipient' => $model->person->userid,
                'subject' => "Auto Leave. Auto Leave has been set by HR Admin",
                'message' => "Dear " . $model->person->employee_name . ",<br/> <br/>
						HR Admin has just set Auto Leave on " . $model->start_date . " and will end at " . $model->end_date . " for: \"" . $model->leave_reason . "\".  
						Now, your new leave balance is: " . $model->balance . " day(s).<br/>
						Thank You.. <br/><br/>"
            ]);

            $modelS = new sNotification;
            $modelS->group_id = 1;
            $modelS->link = 'm1/gLeave/view/id/' . $model->parent_id;
            $modelS->content = 'Leave. New Leave created for <read>' . $model->person->employee_name . '</read> on '
                . $model->start_date . ' for: ' . $model->leave_reason;
            $modelS->photo_path = $model->person->photoPath;
            $modelS->save(false);
        }

        return true;
    }

    /*public function actionCancellation()
    {
        $model = new gLeave;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gLeave'])) {
            $model->attributes = $_POST['gLeave'];
            $model->input_date = date('d-m-Y');
            $model->approved_id = 8; ///Automatic Updated
            if ($model->save()) {
                $this->actionApproved($model->id, $model->parent_id);

                $this->redirect(['/m1/gLeave/view', 'id' => $model->parent_id]);
            }
        }

        $this->render('cancellationWithEmp', [
            'model' => $model,
        ]);
    }*/

    public function actionExtended()
    {
        $model = new gLeave;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gLeave'])) {
            $model->attributes = $_POST['gLeave'];
            $model->input_date = date('d-m-Y');
            $model->approved_id = 5; //Request Extended and will turn to 7 on actionApproved
            $model->end_date = $model->start_date;
            if ($model->save()) {
                $this->actionApproved($model->id, $model->parent_id);

                $this->redirect(['/m1/gLeave/view', 'id' => $model->parent_id]);
            }
        }

        $this->render('extendedWithEmp', [
            'model' => $model,
        ]);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModelLeave($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['gLeave'])) {
            $model->attributes = $_POST['gLeave'];
            if ($model->save())
                //$this->redirect(array('/m1/gLeave'));
                EQuickDlgs::checkDialogJsScript();
        }

        EQuickDlgs::render('_formUpdate', ['model' => $model]);
    }

    public function actionAutoGeneratedLeave($id)
    {
        $model = gPerson::model()->findByPk($id);


        if (isset($model->leaveBalance) && $model->leaveBalance->balance <= -1) {
            $balance = $model->leaveBalance->balance;
        } else
            $balance = 0;

        $new_balance = 12 + $balance;

        $_md = date('Y') . "-" . date("m", strtotime($model->companyfirst->start_date)) . "-" . date("d", strtotime($model->companyfirst->start_date));

        if (strtotime($_md) > time())
            $_md = date('Y-m-d', strtotime($_md . ' -1 year'));

        $connection = Yii::app()->db;
        $sql = "insert into g_leave 
		(parent_id, input_date, year_leave , number_of_day, start_date , end_date  , leave_reason  , balance, remark, approved_id,superior_approved_id) VALUES 
		(" . $id . "  ,'" . $_md . "' ,12,12,'" . $_md . "'  ,'" . $_md . "' ,'Auto Generated Leave',
		" . $new_balance . ",'Auto Generated Leave',9,9)";
        $command = $connection->createCommand($sql)->execute();

        $this->redirect(['/m1/gLeave/view', 'id' => $id]);
    }

    /*
      public function actionMassLeaveChristmas($id) {
      $model = gPerson::model()->findByPk($id);

      if (isset($model->leaveBalance)) {
      $balance = $model->leaveBalance->balance;
      }
      else
      $balance = 0;


      $connection = Yii::app()->db;
      $sql = "insert into g_leave
      (parent_id, input_date, start_date, end_date, number_of_day, leave_reason, balance, approved_id,superior_approved_id) VALUES
      (" . $id . ",'" . Yii::app()->params['currentYearChristmasStart'] . "','" . Yii::app()->params['currentYearChristmasStart'] . "',
      '" . Yii::app()->params['currentYearChristmasEnd'] . "'," . Yii::app()->params['currentYearMassLeaveChristmas'] . ",
      'Cuti Masal Natal " . date('Y') . "'," . $new_balance . ",2,2)";
      $command = $connection->createCommand($sql)->execute();

      $this->redirect(array('/m1/gLeave/view', 'id' => $id));
      }

      public function actionMassLeaveLebaran($id) {
      $model = gPerson::model()->findByPk($id);

      if (isset($model->leaveBalance)) {
      $balance = $model->leaveBalance->balance;
      }
      else
      $balance = 0;

      $new_balance = $balance - Yii::app()->params['currentYearMassLeaveLebaran'];

      $connection = Yii::app()->db;
      $sql = "insert into g_leave
      (parent_id, input_date, start_date, end_date, number_of_day, leave_reason, balance, approved_id,superior_approved_id) VALUES
      (" . $id . ",'" . Yii::app()->params['currentYearLebaranStart'] . "','" . Yii::app()->params['currentYearLebaranStart'] . "',
      '" . Yii::app()->params['currentYearLebaranEnd'] . "'," . Yii::app()->params['currentYearMassLeaveLebaran'] . ",
      'Cuti Masal Lebaran " . date('Y') . "'," . $new_balance . ",2,2)";
      $command = $connection->createCommand($sql)->execute();

      $this->redirect(array('/m1/gLeave/view', 'id' => $id));
      }
     */

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModelLeave($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionOnRecent()
    {
        $model = new gPerson('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;
        $criteria1 = new CDbCriteria;

        if (isset($_GET['gPerson'])) {
            $model->attributes = $_GET['gPerson'];

            $criteria1->compare('employee_name', $_GET['gPerson']['employee_name'], true, 'OR');
            //$criteria1->compare('t_domalamat',$_GET['gPerson']['t_domalamat'],true,'OR');
        }

        $criteria->mergeWith($criteria1);

        $this->render('onRecent', [
            'model' => $model,
        ]);
    }

    public function actionOnLeave()
    {
        $model = new gPerson('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;
        $criteria1 = new CDbCriteria;

        if (isset($_GET['gPerson'])) {
            $model->attributes = $_GET['gPerson'];

            $criteria1->compare('employee_name', $_GET['gPerson']['employee_name'], true, 'OR');
            //$criteria1->compare('t_domalamat',$_GET['gPerson']['t_domalamat'],true,'OR');
        }

        $criteria->mergeWith($criteria1);

        $this->render('onLeave', [
            'model' => $model,
        ]);
    }

    public function actionOnSuperior()
    {
        $model = new gPerson('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;
        $criteria1 = new CDbCriteria;

        if (isset($_GET['gPerson'])) {
            $model->attributes = $_GET['gPerson'];

            $criteria1->compare('employee_name', $_GET['gPerson']['employee_name'], true, 'OR');
            //$criteria1->compare('t_domalamat',$_GET['gPerson']['t_domalamat'],true,'OR');
        }

        $criteria->mergeWith($criteria1);

        $this->render('onSuperior', [
            'model' => $model,
        ]);
    }

    public function actionOnApproved()
    {
        $model = new gPerson('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;
        $criteria1 = new CDbCriteria;

        if (isset($_GET['gPerson'])) {
            $model->attributes = $_GET['gPerson'];

            $criteria1->compare('employee_name', $_GET['gPerson']['employee_name'], true, 'OR');
            //$criteria1->compare('t_domalamat',$_GET['gPerson']['t_domalamat'],true,'OR');
        }

        $criteria->mergeWith($criteria1);

        $this->render('onApproved', [
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {
        $model = new gPerson('search');

        $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Lists all models.
     */
    public function actionList()
    {
        $model = new gPerson('search');
        $model->unsetAttributes();

        $criteria = new CDbCriteria;
        $criteria1 = new CDbCriteria;

        if (isset($_GET['gPerson'])) {
            $model->attributes = $_GET['gPerson'];

            $criteria1->compare('employee_name', $_GET['gPerson']['employee_name'], true, 'OR');
            //$criteria1->compare('t_domalamat',$_GET['gPerson']['t_domalamat'],true,'OR');
        }

        $criteria->mergeWith($criteria1);

        if (Yii::app()->user->name != "admin") {
            $criteria2 = new CDbCriteria;
            $criteria2->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' . implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ') ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->myGroupArray) . ')';
            $criteria->mergeWith($criteria2);

            $criteria3 = new CDbCriteria; //8=RESIGN, 9=TERMINATION, 10=End Of Contract
            $criteria3->condition = '(select status_id from g_person_status s where s.parent_id = t.id ORDER BY start_date DESC LIMIT 1) NOT IN (' . implode(',', Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY) . ')';
            $criteria->mergeWith($criteria3);
        }


        $dataProvider = new CActiveDataProvider('gPerson', [
                'criteria' => $criteria,
            ]
        );

        $this->render('list', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionApproved($id, $pid)
    {
        $model = $this->loadModelLeave($id);

        $modelBalance = gPerson::model()->with('leaveBalance')->findByPk($pid);
        //$criteria=new CDbCriteria;
        //$criteria->compare('parent_id',$pid);
        //$criteria->addNotInCondition('approved_id',array(1,7,8));
        //$criteria->order='end_date DESC';
        //$modelBalance=gLeave::model()->find($criteria);

        if ($model->approved_id == 1) {
            $newbalance = $modelBalance->leaveBalance->balance - $model->number_of_day;
            $approved_value = 2;
        } elseif ($model->approved_id == 5) {
            $newbalance = $modelBalance->leaveBalance->balance + $model->number_of_day;
            $approved_value = 7;
        } elseif ($model->approved_id == 6) {
            $newbalance = $modelBalance->leaveBalance->balance + $model->number_of_day;
            $approved_value = 7;
        } else { //other, no changes
            $newbalance = $modelBalance->leaveBalance->balance;
        }
        gLeave::model()->updateByPk((int)$id, [
            'balance' => $newbalance,
            'approved_id' => $approved_value,
            'superior_approved_id' => $approved_value,
            'updated_date' => time(),
            'updated_by' => Yii::app()->user->id
        ]);

        if (strtotime($model->start_date) > time()) {
            $this->newInbox([
                'recipient' => $modelBalance->userid,
                'subject' => "Leave Approved. Your Leave has been approved by HR Admin",
                'message' => "Dear " . $modelBalance->employee_name . ",<br/> <br/>
				Your leave request on " . $model->start_date . " and will end at " . $model->end_date . " for: \"" . $model->leave_reason . "\" has been approved by HR Admin.  
				Now, your new leave balance is: " . $newbalance . " day(s).<br/>
				Thank You.. <br/><br/>"
            ]);
        }
    }

    public function actionUnblock($id, $pid)
    {

        gLeave::model()->updateByPk((int)$id, [
            'approved_id' => 1,
            //'superior_approved_id' => 1,
        ]);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $criteria = new CDbCriteria;

        if (Yii::app()->user->name != "admin") {
            $criteria->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
                implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
                ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
                implode(",", sUser::model()->myGroupArray) . ') OR ' .
                '(select c2.company_id from g_person_career2 c2 WHERE t.id=c2.parent_id AND c2.company_id IN (' .
                implode(",", sUser::model()->myGroupArray) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
                implode(",", sUser::model()->myGroupArray) . ')';
        }

        $model = gPerson::model()->findByPk((int)$id, $criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModelLeave($id)
    {
        $criteria = new CDbCriteria;

        //$criteria->with=array('person','company');
        //$criteria->addInCondition('company.company_id',sUser::model()->myGroupArray);

        $model = gLeave::model()->findByPk((int)$id, $criteria);
        if ($model === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'g-cuti-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionPrintLeave($id)
    {
        $pdf = new leaveForm('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        //$criteria->compare('parent_id',gPerson::model()->find('userid ='.Yii::app()->user->id)->id);
        $criteria->compare('approved_id', 1);

        $model = gLeave::model()->find($criteria);
        $modelParent = $this->loadmodel($model->parent_id);

        if ($model === null || $modelParent === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

        $pdf->Output();
    }

    public function actionPrintExtendedLeave($id)
    {
        $pdf = new leaveExtendedForm('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        //$criteria->compare('parent_id',gPerson::model()->find('userid ='.Yii::app()->user->id)->id);
        $criteria->compare('approved_id', 5);

        $model = gLeave::model()->find($criteria);
        $modelParent = $this->loadmodel($model->parent_id);

        if ($model === null || $modelParent === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

        $pdf->Output();
    }

    /*public function actionPrintCancellationLeave($id)
    {
        $pdf = new leaveCancellationForm('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        //$criteria->compare('parent_id',gPerson::model()->find('userid ='.Yii::app()->user->id)->id);
        $criteria->compare('approved_id', 6);

        $model = gLeave::model()->find($criteria);
        $modelParent = $this->loadmodel($model->parent_id);

        if ($model === null || $modelParent === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

        $pdf->Output();
    }*/

    public function actionPrintSwitchoverLeave($id)
    {
        $pdf = new leaveSwitchoverForm('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->compare('id', $id);
        //$criteria->compare('parent_id',gPerson::model()->find('userid ='.Yii::app()->user->id)->id);
        $criteria->compare('approved_id', 6);

        $model = gLeave::model()->find($criteria);
        $modelParent = $this->loadmodel($model->parent_id);

        if ($model === null || $modelParent === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($model);

        $pdf->Output();
    }

    public function actionReportByDept()
    {
        $model = new fBeginEndDate;
        $model->setScenario("report");

        if (isset($_POST['fBeginEndDate'])) {
            $model->attributes = $_POST['fBeginEndDate'];
            if ($model->validate()) {

                if ($model->report_id == 1) { //Detail
                    $pdf = new leaveSummaryByDept('L', 'mm', 'A4');
                    $pdf->AliasNbPages();
                    $pdf->AddPage();
                    $pdf->SetFont('Arial', '', 12);

                    $connection = Yii::app()->db;
                    $sql = "SELECT a.employee_name, a.company, a.department, a.level, a.join_date, a.job_title,
						(SELECT l.balance from g_leave l WHERE l.parent_id = a.id AND approved_id NOT IN (1) ORDER BY l.start_date DESC LIMIT 1) as balance,
						(SELECT l.start_date from g_leave l WHERE l.parent_id = a.id AND approved_id NOT IN (1) ORDER BY l.start_date DESC LIMIT 1) as last_leave
						FROM g_bi_person_lite a
						WHERE company_id = " . $model->company_id . " AND employee_status NOT IN ('Resign','End of Contract','Black List','Termination')
						ORDER by a.department, a.employee_name";

                    $command = $connection->createCommand($sql);
                    $rows = $command->queryAll();

                    $pdf->report($rows);
                } elseif ($model->report_id == 2) {
                    $pdf = new leaveSummaryByMonth('L', 'mm', 'A4');
                    $pdf->AliasNbPages();
                    $pdf->AddPage();
                    $pdf->SetFont('Arial', '', 12);

                    $connection = Yii::app()->db;
                    $sql = "
                    	SELECT a.employee_name, a.company, a.department, a.level, a.join_date, a.job_title, month(l.start_date) as cmonth, min(l.start_date) as cdateleave, count(l.start_date) as ccount
						FROM g_bi_person_lite a
						INNER JOIN g_leave l on a.id = l.parent_id
						WHERE company_id = " . $model->company_id . " 
						AND employee_status NOT IN ('Resign','End of Contract','Black List','Termination')
						AND year(l.start_date) =  " . date('Y') . " 
						AND l.approved_id IN (1,2)
						GROUP BY a.employee_name, a.department, a.level, a.join_date, a.job_title, month(l.start_date) 
						ORDER by month(l.start_date), day(l.start_date), a.employee_name
					";

                    $command = $connection->createCommand($sql);
                    $rows = $command->queryAll();

                    $pdf->report($rows);
                } //else

                $pdf->Output();
            }
        }

        $this->render('reportByDept', ['model' => $model]);
    }

    public function actionSummaryLeave($pid)
    {
        $pdf = new leaveSummary('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $criteria = new CDbCriteria;
        $criteria->with = ['leave'];
        $criteria->condition = 'leave.approved_id IN (2,7,9)';
        //$criteria->compare('leave.parent_id', sUser::model()->currentPersonId());
        $criteria->compare('t.id', (int)$pid);
        $models = gPerson::model()->find($criteria);
        if ($models === null)
            throw new CHttpException(401, 'You are not authorized to open this page.');

        $pdf->report($models);

        $pdf->Output();
    }

    public function actionLeaveManual($id,$year)
    {
        $model = gPerson::model()->findByPk($id);
        $_md = $year."-" . date("m", strtotime($model->companyfirst->start_date)) . "-" . date("d", strtotime($model->companyfirst->start_date));
        $connection = Yii::app()->db;
        $sql = "insert into g_leave 
		(parent_id, input_date, year_leave , number_of_day, start_date , end_date  , leave_reason  , balance, remark, approved_id,superior_approved_id) VALUES 
		(" . $id . "  ,'" . $_md . "' ,12,12,'" . $_md . "'  ,'" . $_md . "' ,'Auto Generated Leave',0,'Auto Generated Leave',9,9)";
        $command = $connection->createCommand($sql)->execute();

        $this->redirect(['/m1/gLeave/view', 'id' => $id]);
    }

    public function actionLeaveCalendar()
    {
        $this->render('leaveCalendar', []);
    }

    public function actionLeaveCalendarAjax()
    {

        $connection = Yii::app()->db;
        $sql = '
			SELECT l.parent_id, l.start_date, l.end_date, t.id, t.employee_name, l.approved_id, s.name 
			FROM g_leave l
			INNER JOIN g_person t ON t.id = l.parent_id
			INNER JOIN s_parameter s ON s.code = l.approved_id AND s.type = "cLeaveApproved"
			WHERE l.approved_id IN (1,2) AND
			year(l.start_date) = ' . date('Y') . ' AND 

			(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' .
            implode(',', Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) .
            ') ORDER BY c.start_date DESC LIMIT 1) IN (' .
            implode(",", sUser::model()->myGroupArray) . ') OR ' .
            '(select c2.company_id from g_person_career2 c2 WHERE t.id=c2.parent_id AND c2.company_id IN (' .
            implode(",", sUser::model()->myGroupArray) . ') ORDER BY c2.start_date DESC LIMIT 1) IN (' .
            implode(",", sUser::model()->myGroupArray) . ')
			
		';

        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        $items = [];
        $detail = [];
        foreach ($rows as $row) {
            $detail['title'] = $row['employee_name'] . ' (' . $row['name'] . ')';
            $detail['start'] = strtotime($row['start_date']);
            $detail['end'] = strtotime($row['end_date']);
            if ($row['approved_id'] == 1) {
                $detail['color'] = '#CC0000';
            } else
                $detail['color'] = '#088A4B';

            $detail['allDay'] = true;
            $detail['url'] = Yii::app()->createUrl('/m1/gLeave/view', ["id" => $row['id']]);
            $items[] = $detail;
        }

        echo CJSON::encode($items);
        Yii::app()->end();
    }

    public function actionUpdateLeaveAjax()
    {
        Yii::import('ext.booster.components.TbEditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new TbEditableSaver('gLeave'); // 'User' is classname of model to be updated
        $es->update();
    }

}
