<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
define("_IS_POST_", true);
$this->need('header.php');
?>
<article class="post">
    <h1 class="post-title"><?php $this->title() ?></h1>
    <ul class="post-meta list-inline">
        <li>
            <i class="fa fa-calendar fa-fw" aria-hidden="true" title="发表时间"></i>
            <?php $this->date('Y-m-d'); ?>
        </li>
        <li>
            <i class="fa fa-heart fa-fw" aria-hidden="true" title="阅读量"></i>
            <span class="badge"><?php $this->viewsNum(); ?></span>
        </li>
        <li>
            <i class="fa fa-bookmark fa-fw" aria-hidden="true" title="分类"></i>
            <?php $this->category(', '); ?>
        </li>
        <li>
            <i class="fa fa-tag fa-fw" aria-hidden="true" title="标签"></i>
            <?php $this->tags(', ', true, 'none'); ?>
        </li>
        <li>
            <i class="fa fa-comments fa-fw" aria-hidden="true" title="评论"></i>
            <a href="#comments" title="评论数"><span class="badge"><?php $this->commentsNum(); ?></span></a>
        </li>
    </ul>
    <div class="post-content">
        <?php $this->content(); ?>
    </div>
</article>
<?php $this->need('comments.php'); ?>
<?php $this->need('footer.php'); ?>
