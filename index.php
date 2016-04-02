<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php include('common.php'); ?>
<?php if(isset($_GET['load_type']) and $_GET['load_type'] == 'ajax'):  ?>
    <?php if($this->getCurrentPage()==1): ?>
        <a id="content-title" style="display:none"><?php $this->archiveTitle('','',' - '); ?><?php $this->options->title(); ?></a>
        <?php $this->need('crumbpatch.php'); ?>
    <?php endif ?>
    <div class="articles">
        <?php while($this->next()): ?>
            <article class="post-brif">
                <h4 class="post-title"><u><a class="post-url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></u></h4>
                <div class="post-excerpt hidden-xs">
                    <p><small><?php $this->excerpt(); ?></small></p>
                </div>
                <ul class="post-meta list-inline clearfix hidden-xs">
                    <li><span class="glyphicon glyphicon-calendar" title="发表时间"><?php $this->date('Y-m-d'); ?></span></li>
                    <li><span class="glyphicon glyphicon-fire" title="阅读量"></span> <span class="badge"><?php $this->viewsNum(); ?></span></li>
                    <li><span class="glyphicon glyphicon-bookmark" title="分类"><?php $this->category(', '); ?></span></li>
                    <li><a href="#comments" title="评论数"><span class="glyphicon glyphicon-comment"></span> <span class="badge"><?php $this->commentsNum(); ?></span></a></li>
                </ul>
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
