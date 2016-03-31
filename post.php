<?php if(isset($_GET['load_type']) and $_GET['load_type'] == 'ajax'):  ?>
    <a id="content-title" style="display:none"><?php $this->archiveTitle('','',' - '); ?><?php $this->options->title(); ?></a>
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

<div class="column col-xs-12 col-sm-6 col-md-6 ol-lg-6" id="m-nav">
    <div id="main">
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

<?php $this->need('footer.php'); ?>
