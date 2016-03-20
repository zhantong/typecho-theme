<?php if(isset($_GET['type']) and $_GET['type'] == 'ajax'):  ?>
    <article class="post">
        <h1 class="post-title"><?php $this->title() ?></h1>
        <ul class="post-meta list-inline">
            <li><small><span class="glyphicon glyphicon-calendar"><?php $this->date('Y-m-d'); ?></span></small></li>
            <li><span class="glyphicon glyphicon-user"><a href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></span></li>
            <li><small><span class="glyphicon glyphicon-tag"><?php $this->category(', '); ?></span></small></li>
            <li><small><span class="glyphicon glyphicon-paperclip"><?php $this->tags(', ', true, 'none'); ?></span></small></li>
            <li><a href="#comments"><span class="glyphicon glyphicon-comment"></span> <small><span class="badge"><?php $this->commentsNum(); ?></span></a></small></li>
        </ul>
        <div class="post-content">
            <?php $this->content(); ?>
        </div>
        <?php $this->need('comments.php'); ?>
    </article>
    <?php return; //完成ajax方式返回，退出此页面?>
<?php endif ?>

<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="column col-xs-12 col-sm-4 col-md-4 col-lg-4 post-navi auto-scroll" id="m-nav">
    <div class="post-list" id="main" >
    </div>
    <div class="progress">
        <div id="load-more" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
            加载中...
        </div>
    </div>
</div><!-- end #main-->

<div class="column col-xs-12 col-sm-8 col-md-8 ol-lg-8">
    <div id="post">
        <article class="post">
            <h1 class="post-title"><?php $this->title() ?></h1>
            <ul class="post-meta list-inline">
                <li><small><span class="glyphicon glyphicon-calendar"><?php $this->date('Y-m-d'); ?></span></small></li>
                <li><span class="glyphicon glyphicon-user"><a href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></span></li>
                <li><small><span class="glyphicon glyphicon-tag"><?php $this->category(', '); ?></span></small></li>
                <li><small><span class="glyphicon glyphicon-paperclip"><?php $this->tags(', ', true, 'none'); ?></span></small></li>
                <li><a href="#comments"><span class="glyphicon glyphicon-comment"></span> <small><span class="badge"><?php $this->commentsNum(); ?></span></a></small></li>
            </ul>
            <div class="post-content">
                <?php $this->content(); ?>
            </div>
            <?php $this->need('comments.php'); ?>
        </article>
    </div>
</div>




<?php //$this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
