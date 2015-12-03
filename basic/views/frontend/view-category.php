<?php
use yii\helpers\Html;
use yii\bootstrap;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;
use yii\widgets\LinkPager;
$this->title = 'Danh mục';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="container">
        <div class="row">
            
            <div class="col-md-8">
               <?php foreach ($products as $sp): ?>   
                    <div class="col-md-4">
                        <ul class="list-unstyled">
                            <li><a href="<?php echo \yii\helpers\Url::to('index.php?r=frontend/detail&product_id='.$sp['category_id']); ?>"><?= Html::encode(" {$sp['product_name']}") ?></a></li>         
                        </ul>
                    </div>
               <?php endforeach; ?>
                <div class="col-md-12">      
            
                  </div>
            </div>
            
            <div class="col-md-3 col-md-offset-1">
                <div class="sidebar-module">
                    
                    <h4>Danh mục sản phẩm</h4>
                      <?php foreach ($categories as $cate): ?>
                    
                      <ul>
                            
                         <li>
                             <a href="<?php echo \yii\helpers\Url::to('index.php?r=frontend/view-category&category_id='.$cate['category_id']); ?>"><?= Html::encode(" {$cate['category_name']}") ?></a>
                         </li> 
                       
                           
                      </ul>  
                      <?php endforeach;?>
                </div> 
            </div> 
        </div>
    </div>
 </div>

