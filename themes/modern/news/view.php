<div class="col-md-9 col-md-push-3 content-block">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="lined"><span>Новости</span></h3>
        </div>
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-sm-9">
                <h3 class="news-list-header"><?= $news['title']; ?></h3>
            </div>
            <div class="col-sm-3">
                <h5 class="news-list-pubdate text-right"><?= $news['pubdate']; ?></h5>
            </div>
        </div>
        <div class="row news-list-cut-block">
            <div class="col-sm-12"><?= $news['content']; ?></div>
        </div>
    </div>
</div><!-- /.content-block -->

<div class="col-md-3 col-md-pull-9 sidebar-block">
    <?php echo $this->render('/shop/_sidebar_menu'); ?>
</div><!-- /.sidebar-block -->