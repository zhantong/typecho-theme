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
                            <li><i class="fa fa-calendar fa-fw" aria-hidden="true" title="发表时间"></i><?php $this->date('Y-m-d'); ?></li>
                            <li><i class="fa fa-heart fa-fw" aria-hidden="true" title="阅读量"></i><span class="badge"><?php $this->viewsNum(); ?></span></li>
                            <li><i class="fa fa-bookmark fa-fw" aria-hidden="true" title="分类"></i><?php $this->category(', '); ?></li>
                            <li><i class="fa fa-comments fa-fw" aria-hidden="true" title="评论"></i><a href="<?php $this->permalink() ?>#comments"><span class="badge"><?php $this->commentsNum(); ?></span></a></li>
                        </ul>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
    <?php return; //完成ajax方式返回，退出此页面?>
<?php endif ?>
<?php $this->need('header.php'); ?>
</div>
<?php $this->need('footer.php'); ?>
