<?php
$hasChilds = false;
//$catLink = \yii\helpers\Url::to(['shop/category/' .$category['id'] . '/' . $category['url']]);
//$catLink = \yii\helpers\Url::to(['shop/category', 'id' => $category['id']]);// , 'url' => $category['url']
$catLink = \yii\helpers\Url::to(['shop/category', ['id' => $category['id'], 'url' => $category['url']]]);
if(isset($category['childs'])){
    $hasChilds = true;
    $catLink = '#';
}
?>
<li>
    <a href="<?=$catLink; ?>"><span class="cat-title"><?= $category['title']; ?></span>
    <?php if($hasChilds): ?>
        <span class="pull-right cat-title-badge"><i class="fa fa-plus"></i></span>
    <?php endif; ?>
    </a>
    <?php if($hasChilds): ?>
        <ul class="my-category-products">
            <?= $this->getMenuHtml($category['childs']); ?>
        </ul>
    <?php endif; ?>
</li>