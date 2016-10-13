<?php
$selected = ($category['id'] == $this->model->category_id) ? ' selected="selected" ' : '';
?>
<option value="<?=$category['id']; ?>"<?=$selected; ?> ><?= $tab . ' ' . $category['title']; ?></option>
<?php if(isset($category['childs'])): ?>
    <ul class="my-category-products">
        <?= $this->getMenuHtml($category['childs'], $tab . '–-'); ?>
    </ul>
<?php endif; ?>