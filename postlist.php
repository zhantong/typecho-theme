<?php
/**
 * 自定义页面模板
 *
 * @package custom
 */
?>
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
<?php endif ?>
<?php $this->widget('Widget_Archive@index', 'pageSize=10000&type=index')->to($posts); ?>
<article>
    <h1 class="archive-title"><?php $this->archiveTitle('','',''); ?></h1>
    <ul class="listing" style="padding-left:0;">
        <?php while($posts->next()): ?>
            <li class="list-group-item">
                <small><em><?php $posts->date('Y-m-d'); ?></em></small>
                <a class="post-url" href="<?php $posts->permalink() ?>"><?php $posts->title() ?></a>
                <span class="badge" title="阅读量"><?php $posts->viewsNum(); ?></span>
            </li>
        <?php endwhile; ?>
    </ul>
</article>
<?php if(!$is_ajax):  ?>
    <?php
        echo $main_tail;
        $this->need('footer.php');
    ?>
<?php endif ?>
