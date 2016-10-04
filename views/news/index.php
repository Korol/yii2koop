<?php
/**
 * @var $this \yii\web\View
 * @see News::actionIndex()
 * @var News $page
 */
use yii\helpers\Html;

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>News:</h2>
            <?php
            for($i = 1; $i <= 5; $i++){
                echo Html::a('News Article ' . $i, ['news/article', 'id' => $i, 'slug' => 'article-' . $i]) . '<br/>';
            }
            ?>
        </div>
    </div>
</div>