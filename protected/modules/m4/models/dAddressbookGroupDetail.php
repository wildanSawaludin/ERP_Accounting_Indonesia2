<?php

/**
 * This is the model class for table "s_usersms_group_detail".
 *
 * The followings are the available columns in table 's_usersms_group_detail':
 * @property string $id
 * @property string $parent_id
 * @property string $name_id
 */
class dAddressbookGroupDetail extends BaseModel
{

    /**
     * Returns the static model of the specified AR class.
     * @return SUsersmsGroupDetail the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'd_addressbook_group_detail';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['parent_id, name_id', 'required'],
            ['parent_id, name_id', 'length', 'max' => 20],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, parent_id, name_id', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent',
            'name_id' => 'Name',
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('parent_id', $this->parent_id, true);
        $criteria->compare('name_id', $this->name_id, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

}
