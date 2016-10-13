<?php
$selected = ($category['id'] == $this->model->parent_id) ? ' selected="selected" ' : '';
$disabled = ($category['id'] == $this->model->id) ? ' disabled="disabled" ' : '';
?>
<option value="<?=$category['id']; ?>"<?=$selected . $disabled; ?> ><?= $tab . ' ' . $category['title']; ?></option>
<?php if(isset($category['childs'])): ?>
    <ul class="my-category-products">
        <?= $this->getMenuHtml($category['childs'], $tab . '–-'); ?>
    </ul>
<?php endif; ?>