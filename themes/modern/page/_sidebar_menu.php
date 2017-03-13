<?php
if(!empty($this->params['sidebar_menu'])):
    $active_menu_id = (!empty($this->params['active_menu_id'])) ? $this->params['active_menu_id'] : 0;
    $active_category_id = (!empty($this->params['active_category_id'])) ? $this->params['active_category_id'] : 0;
?>
    <div class="row">
        <div class="col-lg-12 sidebar-banner">
            <h3 class="lined"><span>Меню</span></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 sidebar-menu-block">
            <ul class="nav nav-pills nav-stacked sidebar-menu">
                <?php foreach($this->params['sidebar_menu'] as $level1): ?>
                    <?php $class_in = ($level1['id'] == $active_menu_id) ? ' in' : ''; ?>
                    <?php $l1_active = ($level1['id'] == $active_menu_id) ? 'active' : ''; ?>
                    <li role="presentation" class="<?=$l1_active;?>">
                        <a class="s-menu-level1" href="<?=\yii\helpers\Url::to(['shop/category', 'id' => $level1['id'], 'slug' => $level1['url']]); ?>"><?=$level1['title'];?></a>
                    </li>
                    <?php
                    if(!empty($level1['childs'])):
                        ?>
                        <ul class="nav nav-pills nav-stacked sidebar-menu sidebar-menu-inner collapse<?=$class_in; ?>">
                            <?php foreach($level1['childs'] as $level2): ?>
                                <?php $l2_active = ($level2['id'] == $active_category_id) ? 'active' : ''; ?>
                                <li role="presentation" class="<?=$l2_active;?>">
                                    <a class="s-menu-level2" href="<?=\yii\helpers\Url::to(['shop/category', 'id' => $level2['id'], 'slug' => $level2['url']]); ?>"><?=$level2['title'];?></a>
                                </li>
                                <?php
                                if(!empty($level2['childs'])):
                                    ?>
                                    <ul class="nav nav-pills nav-stacked sidebar-menu sidebar-menu-inner collapse<?=$class_in; ?>">
                                        <?php foreach($level2['childs'] as $level3): ?>
                                            <?php $l3_active = ($level3['id'] == $active_category_id) ? 'active' : ''; ?>
                                            <li role="presentation" class="<?=$l3_active;?>">
                                                <a class="s-menu-level3" href="<?=\yii\helpers\Url::to(['shop/category', 'id' => $level3['id'], 'slug' => $level3['url']]); ?>"><?=$level3['title'];?></a>
                                            </li>
                                            <?php
                                            if(!empty($level3['childs'])):
                                                ?>
                                                <ul class="nav nav-pills nav-stacked sidebar-menu sidebar-menu-inner collapse<?=$class_in; ?>">
                                                    <?php foreach($level3['childs'] as $level4): ?>
                                                        <?php $l4_active = ($level4['id'] == $active_category_id) ? 'active' : ''; ?>
                                                        <li role="presentation" class="<?=$l4_active;?>">
                                                            <a class="s-menu-level4" href="<?=\yii\helpers\Url::to(['shop/category', 'id' => $level4['id'], 'slug' => $level4['url']]); ?>"><?=$level4['title'];?></a>
                                                        </li>
                                                        <?php
                                                        if(!empty($level4['childs'])):
                                                            ?>
                                                            <ul class="nav nav-pills nav-stacked sidebar-menu sidebar-menu-inner collapse<?=$class_in; ?>">
                                                                <?php foreach($level4['childs'] as $level5): ?>
                                                                    <?php $l5_active = ($level5['id'] == $active_category_id) ? 'active' : ''; ?>
                                                                    <li role="presentation" class="<?=$l5_active;?>">
                                                                        <a class="s-menu-level5" href="<?=\yii\helpers\Url::to(['shop/category', 'id' => $level5['id'], 'slug' => $level5['url']]); ?>"><?=$level5['title'];?></a>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php
                                                        endif;
                                                        ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php
                                            endif;
                                            ?>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php
                                endif;
                                ?>
                            <?php endforeach; ?>
                        </ul>
                    <?php
                    endif;
                    ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>