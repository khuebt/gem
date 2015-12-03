<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property string $category_id
 * @property string $category_name
 * @property string $date_add
 * @property string $date_edit
 * @property string $user_id
 * @property string $category_id_root
 *
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name', 'date_add'], 'required'],
            [['date_add', 'date_edit'], 'safe'],
            [['user_id', 'category_id_root'], 'integer'],
            [['category_name'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
            'date_add' => 'Date Add',
            'date_edit' => 'Date Edit',
            'user_id' => 'User ID',
            'category_id_root' => 'Category Id Root',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'category_id']);
    }
    
    public static function showCategory(){
        $category = Category::find()->all();
       
        $categories = array(); // categories 
        foreach($category as $cate){
            $categories[$cate['category_name']] = $cate;  
        }
        return $categories;
    }
   
    

    

}
