<?php

use yii\grid\GridView;
use yii\helpers\Html;
?>

<h2>Sản phẩm</h2>
<?= Gridview::widget([
        'dataProvider'=>$dataProvider,
        'columns'=>[
            'product_id',
            'product_name',
        ],
]);
?>