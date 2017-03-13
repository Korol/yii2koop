<div class="col-md-9 col-md-push-3 content-block">
    <h1 class="page-title text-center"><?= $page['title']; ?></h1>
    <div class="page-content"><?= $page['content']; ?></div>
</div><!-- /.content-block -->

<div class="col-md-3 col-md-pull-9 sidebar-block">
    <?php echo $this->render('_sidebar_menu'); ?>
</div><!-- /.sidebar-block -->