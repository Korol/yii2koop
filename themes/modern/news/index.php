<?php
use yii\widgets\LinkPager;
?>
<div class="col-md-9 col-md-push-3 content-block">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="lined"><span>Новости</span></h3>
        </div>
    </div>
    <div class="page-content">
        <?php
        if(!empty($news)):
            foreach($news as $k => $item):
        ?>
        <div class="row news-list-item-block">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-9">
                        <h3 class="news-list-header">
                            <a class="news-list-title" href="<?=\yii\helpers\Url::to(['/news/view', 'id' => $item['id'], 'slug' => $item['slug']]); ?>"><?= $item['title']; ?></a>
                        </h3>
                    </div>
                    <div class="col-sm-3">
                        <h5 class="news-list-pubdate text-right"><?= $item['pubdate']; ?></h5>
                    </div>
                </div>
                <div class="row news-list-cut-block">
                    <div class="col-sm-12"><?= $item['cut']; ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <a class="btn btn-default" href="<?=\yii\helpers\Url::to(['/news/view', 'id' => $item['id'], 'slug' => $item['slug']]); ?>">Читать</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
                if($k < (sizeof($news) - 1)):
        ?>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 news-list-items-divider"></div>
        </div>
        <?php
                endif;
            endforeach;
        else:
        ?>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="alert alert-info text-center" role="alert">
                    Новостей пока нет – но мы активно над этим работаем!
                </div>
            </div>
        </div>
        <?php
        endif;
        // navigation
        if(!empty($pages)):
        ?>
        <div class="row text-center">
            <?php
            echo LinkPager::widget([
                'pagination' => $pages,
            ]);
            ?>
        </div>
        <?php endif; ?>
    </div>
</div><!-- /.content-block -->

<div class="col-md-3 col-md-pull-9 sidebar-block">
    <?php echo $this->render('/shop/_sidebar_menu'); ?>
</div><!-- /.sidebar-block -->