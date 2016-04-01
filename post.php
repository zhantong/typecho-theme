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
        <li><small><span class="glyphicon glyphicon-calendar"><?php $this->date('Y-m-d'); ?></span></small></li>
        <li><small><span class="glyphicon glyphicon-tag category"><?php $this->category(', '); ?></span></small></li>
        <li><small><span class="glyphicon glyphicon-paperclip tag"><?php $this->tags(', ', true, 'none'); ?></span></small></li>
        <li><a href="#comments"><span class="glyphicon glyphicon-comment"></span> <small><span class="badge"><?php $this->commentsNum(); ?></span></a></small></li>
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
