<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\data\Pagination;
/**
 * This is the model class for table "product".
 *
 * @property string $product_id
 * @property string $product_name
 * @property string $short_describe
 * @property string $full_describe
 * @property string $date_add
 * @property string $date_edit
 * @property string $user_id
 * @property string $category_id
 * @property string $fileImage
 *
 * @property Category $category
 * @property User $user
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_name', 'short_describe', 'full_describe'], 'required'],
            [['full_describe', 'fileImage'], 'string'],
            [['date_add', 'date_edit'], 'safe'],
            [['user_id', 'category_id'], 'integer'],
            [['product_name'], 'string', 'max' => 20],
            [['short_describe'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'product_name' => 'Product Name',
            'short_describe' => 'Short Describe',
            'full_describe' => 'Full Describe',
            'date_add' => 'Date Add',
            'date_edit' => 'Date Edit',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
            'fileImage' => 'Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
     public function getProductSameId($category_id){
        
        $product = Product::find()->where(['category_id'=>$category_id])->all();           
        return $product;
    }
    public function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public static function getCategoryArr(){
        
        $category_id_root = Yii::$app->getRequest()->getQueryParam('category_id_root');
        $category_id = Yii::$app->getRequest()->getQueryParam('category_id');
        
        if (!$category_id) {
            return false;
        }

        $category = Category::find()->all();

        $categories = []; // categories
        $parents = [];
        foreach ($category as $cate) {
            $categories[$cate['category_name']] = $cate;
            $parents[$cate['category_id_root']][$cate['category_id']] = $cate['category_id'];
        }

        $cateQueryArr = array();
        $queue = array();
        array_push($queue, $category_id);
        while ($subCate = array_shift($queue)) {
            $cateQueryArr[$subCate] = $subCate;
            if (isset($parents[$subCate])) {
                foreach ($parents[$subCate] as $cid) {
                    array_push($queue, $cid);
                }
            }
        }
//        echo'<pre>';
//        var_dump($cateQueryArr);
//        echo'</pre>';
//        die();
        return $cateQueryArr;
    }
    
        public function getProductsInCate($options = array()) {
        
        $listCategories = (isset($options['listCategories'])) ? $options['listCategories'] : array();
        if (!$listCategories) {
            return array();
        }
        $limit = (isset($options['limit'])) ? $options['limit'] : 10;
        $page = (isset($options['page']) && $options['page']>0) ? $options['page'] : 1;
        $offset = ($page - 1) * $limit;
        
        $query = new Query();
        $query->select('*')
                ->from('product')
                ->where(['category_id' => $listCategories])
                ->limit($limit)
                ->offset($offset);
        
        $command = $query->createCommand();
//        echo $command->getSql();
//        die;
        $data = $command->queryAll();
//        echo'<pre>';
//        var_dump($data);
//        echo'</pre>';
        return $data;
    }
   
 
}
