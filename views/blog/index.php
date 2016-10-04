<?php
/**
 *  @var $this \yii\web\View
 * @see Blog::actionIndex()
 * @var Blog $page
 */
use yii\helpers\Html;
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Blog:</h2>
            <?php
            for($i = 1; $i <= 5; $i++){
                echo Html::a('Blog Article ' . $i, ['blog/article', 'id' => $i, 'slug' => 'article-' . $i]) . '<br/>';
            }
            ?>
        </div>
    </div>
</div>