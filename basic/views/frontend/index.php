<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Danh sách sản phẩm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
    <div class="container">
        <div class="row">        
            <div class="col-md-8">
               <?php foreach ($product as $sp): ?>   
                    <div class="col-md-4">
                        <ul class="list-unstyled">
                            <li><a href="<?php echo \yii\helpers\Url::to('index.php?r=frontend/detail&product_id='.$sp->product_id); ?>"><?= Html::encode(" {$sp->product_name}") ?></a></li>         
                        </ul>
                    </div>
               <?php endforeach; ?>
              <div class="col-md-12">      
                 <?= LinkPager::widget(['pagination' => $pagination]) ?>
                  </div>
            </div>

            <div class="col-md-3 col-md-offset-1">  
                <div class="sidebar-module">
                    <h4>Danh mục sản phẩm</h4>
                      <?php foreach ($category as $cat): ?>
                      <ul>
                           
                         <li>
                             <a href="<?php echo \yii\helpers\Url::to('index.php?r=frontend/view-category&category_id='.$cat->category_id); ?>"><?= Html::encode(" {$cat->category_name}") ?></a>
                         </li>     
       
                         <ul> 
                             
                            
                         </ul>
                             
                      </ul>  
                      <?php endforeach; ?>
                </div> 
            </div> 
        </div>
    </div>
 </div>

