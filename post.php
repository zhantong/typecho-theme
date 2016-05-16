<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
    if($this->request->isAjax()){
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
<?php endif ?>
<article class="post">
    <h1 class="post-title"><?php $this->title() ?></h1>
    <ul class="post-meta list-inline">
        <li><i class="fa fa-calendar fa-fw" aria-hidden="true" title="发表时间"></i><?php $this->date('Y-m-d'); ?></li>
        <li><i class="fa fa-heart fa-fw" aria-hidden="true" title="阅读量"></i><span class="badge"><?php $this->viewsNum(); ?></span></li>
        <li><i class="fa fa-bookmark fa-fw" aria-hidden="true" title="分类"></i><?php $this->category(', '); ?></li>
        <li><i class="fa fa-tag fa-fw" aria-hidden="true" title="标签"></i><?php $this->tags(', ', true, 'none'); ?></li>
        <li><i class="fa fa-comments fa-fw" aria-hidden="true" title="评论"></i><a href="#comments" title="评论数"><span class="badge"><?php $this->commentsNum(); ?></span></a></li>
    </ul>
    <div class="post-content">
        <?php $this->content(); ?>
    </div>
</article>
<?php $this->need('comments.php'); ?>
<?php if($is_ajax):  ?>
    <?php $this->need('showinpost.php'); ?>
<?php else: ?>
    </div>
    <?php $this->need('footer.php'); ?>
<?php endif ?>
