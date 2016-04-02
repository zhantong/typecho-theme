<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php include('common.php'); ?>
<?php
    if(isset($_GET['load_type']) and $_GET['load_type'] == 'ajax'){
        $is_ajax=true;
    }
    else{
        $is_ajax=false;
    }
?>
<?php if(!$is_ajax):  ?>
    <?php
        $this->need('header.php');
    ?>
<?php else:  ?>
    <a id="content-title" style="display:none"><?php $this->archiveTitle('','',' - '); ?><?php $this->options->title(); ?></a>
    <?php $this->need('crumbpatch.php'); ?>
<?php endif ?>
<article class="post">
    <h1 class="post-title"><?php $this->title() ?></h1>
    <ul class="post-meta list-inline">
        <li><span class="glyphicon glyphicon-calendar" title="发表时间"><?php $this->date('Y-m-d'); ?></span></li>
        <li><span class="glyphicon glyphicon-fire" title="阅读量"></span> <span class="badge"><?php $this->viewsNum(); ?></span></li>
        <li><span class="glyphicon glyphicon-bookmark" title="分类"><?php $this->category(', '); ?></span></li>
        <li><span class="glyphicon glyphicon-tag category" title="标签"><?php $this->tags(', ', true, 'none'); ?></span></li>
        <li><a href="#comments" title="评论数"><span class="glyphicon glyphicon-comment"></span> <span class="badge"><?php $this->commentsNum(); ?></span></a></li>
    </ul>
    <div class="post-content">
        <?php $this->content(); ?>
    </div>
    <?php $this->need('comments.php'); ?>
    <?php $this->footer(); ?>
</article>
<?php if($is_ajax):  ?>
    <?php $this->need('showinpost.php'); ?>
<?php else: ?>
    <?php
        echo $main_tail;
        $this->need('footer.php');
    ?>
<?php endif ?>
