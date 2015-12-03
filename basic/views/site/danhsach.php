<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1>Danh sách sản phẩm</h1>
 

    <table class="table-bordered">
        <tr>
            <td>Id</td>
            <td>Tên sản phẩm</td>
            <td>Mô tả</td>
        </tr>
        <?php foreach ($product as $sp): ?>
        <tr>
            <td> <?= Html::encode(" {$sp->product_id}") ?></td>
            <td> <?= Html::encode(" {$sp->product_name}") ?></td>
            <td> <?= Html::encode(" {$sp->short_describe}") ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

 

<?= LinkPager::widget(['pagination' => $pagination]) ?>