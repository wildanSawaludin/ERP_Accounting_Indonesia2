<?php

/**
 * EmailActiveRecord
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-email-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-email-module/master/LICENSE
 *
 * @package yii-email-module
 */
class EmailActiveRecord extends CActiveRecord
{

    /**
     * @var CDbConnection the default database connection for all active record classes.
     * By default, this is the 'db' application component.
     * @see getDbConnection
     */
    public static $db;

    /**
     * @var array
     */
    private static $_md = [];

    /**
     * @param string $scenario
     */
    public function __construct($scenario = 'insert')
    {
        $email = Yii::app()->getModule('email');
        if ($email->autoCreateTables) {
            try {
                $this->dbConnection->createCommand("SELECT * FROM {$this->tableName()} LIMIT 1")->execute();
            } catch (Exception $e) {
                $this->createTable();
            }
        }
        parent::__construct($scenario);
    }

    /**
     * Returns the meta-data for this AR
     * @return CActiveRecordMetaData the meta for this AR class.
     */
    public function getMetaData()
    {
        $metaData = parent::getMetaData();
        if ($metaData)
            return $metaData;
        $className = get_class($this);
        if (empty(self::$_md[$className])) { // override this from the parent to force it to get the new MetaData
            self::$_md[$className] = null;
            self::$_md[$className] = new CActiveRecordMetaData($this);
        }
        return self::$_md[$className];
    }

    /**
     * Creates the DB table.
     * @throws CException
     */
    public function createTable()
    {
        $db = $this->getDbConnection();
        $file = Yii::getPathOfAlias('email.migrations') . '/' . $this->tableName() . '.' . $db->getDriverName();
        $pdo = $this->getDbConnection()->pdoInstance;
        $sql = file_get_contents($file);
        $sql = rtrim($sql);
        $sqls = preg_replace_callback("/\((.*)\)/", create_function('$matches', 'return str_replace(";"," $$$ ",$matches[0]);'), $sql);
        $sqls = explode(";", $sqls);
        foreach ($sqls as $sql) {
            if (!empty($sql)) {
                $sql = str_replace(" $$$ ", ";", $sql) . ";";
                $pdo->exec($sql);
            }
        }
    }

    /**
     * Guess the table name based on the class
     * @return string the associated database table name
     */
    public function tableName()
    {
        $email = Yii::app()->getModule('email');
        if (!empty($email->modelMap[get_class($this)]['tableName']))
            return $email->modelMap[get_class($this)]['tableName'];
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', get_class($this)));
    }

    /**
     * Returns the relations used for the model
     * @return array
     * @see EmailModule::modelMap
     */
    public function relations()
    {
        $email = Yii::app()->getModule('email');
        if (!empty($email->modelMap[get_class($this)]['relations']))
            return $email->modelMap[get_class($this)]['relations'];
        return parent::relations();
    }

    /**
     * Returns the behaviors used for the model
     * @return array
     * @see EmailModule::modelMap
     */
    public function behaviors()
    {
        $email = Yii::app()->getModule('email');
        if (!empty($email->modelMap[get_class($this)]['behaviors']))
            return $email->modelMap[get_class($this)]['behaviors'];
        return parent::behaviors();
    }

    /**
     * @throws CDbException
     * @return CDbConnection
     */
    public function getDbConnection()
    {
        if (self::$db !== null)
            return self::$db;

        /** @var EmailModule $email */
        $email = Yii::app()->getModule('email');
        self::$db = $email->getDbConnection();
        self::$db->setActive(true);
        return self::$db;
    }

}
