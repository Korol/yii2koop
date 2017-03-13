<?php if(!empty($slides)): ?>
<div class="row main-carousel">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
        <?php for($i = 0; $i < sizeof($slides); $i++): ?>
            <li data-target="#carousel-example-generic" data-slide-to="<?= $i; ?>" class="<?= ($i == 0) ? 'active' : ''; ?>"></li>
        <?php endfor; ?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
        <?php foreach($slides as $sk => $sv): ?>
            <div class="item<?= ($sk == 0) ? ' active' : ''; ?>">
                <?= \yii\helpers\Html::img('@web/images/modern/carousel/' . $sv['image'], ['alt' => 'Banner ' . $sk]); ?>
            </div>
        <?php endforeach; ?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<?php endif; ?>