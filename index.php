<?php
/**
 * typecho主题 by Penguin
 *
 * @package Typecho Theme Penguin
 * @author zhantong
 * @version 1.0.0
 * @link https://github.com/zhantong/typecho-theme
 */
 ?>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php include('common.php'); ?>
<?php if(isset($_GET['load_type']) and $_GET['load_type'] == 'ajax'):  ?>
    <?php if($this->getCurrentPage()==1): ?>
        <a id="content-title" style="display:none"><?php $this->archiveTitle('','',' - '); ?><?php $this->options->title(); ?></a>
    <?php endif ?>
    <div class="articles">
        <?php while($this->next()): ?>
            <article class="post-brif">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a class="post-url" href="<?php $this->permalink() ?>"><h4><?php $this->title() ?></h4></a>
                    </div>
                    <div class="panel-body">
                        <?php $this->excerpt(200); ?>
                    </div>
                    <div class="panel-footer">
                        <ul class="post-meta list-inline small">
                            <li><span class="glyphicon glyphicon-calendar" title="发表时间"></span><?php $this->date('Y-m-d'); ?></li>
                            <li><span class="glyphicon glyphicon-fire" title="阅读量"></span> <span class="badge"><?php $this->viewsNum(); ?></span></li>
                            <li><span class="glyphicon glyphicon-bookmark" title="分类"><?php $this->category(', '); ?></span></li>
                            <li><a href="<?php $this->permalink() ?>#comments"><span class="glyphicon glyphicon-comment" title="评论"></span> <small><span class="badge"><?php $this->commentsNum(); ?></span></a></small></li>
                        </ul>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
    <?php return; //完成ajax方式返回，退出此页面?>
<?php endif ?>
<?php $this->need('header.php'); ?>
<?php
    echo $main_tail;
?>
<?php $this->need('footer.php'); ?>
