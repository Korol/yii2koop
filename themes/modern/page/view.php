<div class="col-md-9 col-md-push-3 content-block">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="lined"><span><?= $page['title']; ?></span></h3>
        </div>
    </div>
    <div class="row page-content">
        <div class="col-lg-12">
            <?= $page['content']; ?>
        </div>
    </div>
</div><!-- /.content-block -->

<div class="col-md-3 col-md-pull-9 sidebar-block">
    <?php echo $this->render('/shop/_sidebar_menu'); ?>
</div><!-- /.sidebar-block -->