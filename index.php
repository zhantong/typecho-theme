<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php include('common.php'); ?>
<?php if(isset($_GET['load_type']) and $_GET['load_type'] == 'ajax'):  ?>
    <?php if($this->getCurrentPage()==0): ?>
        <a id="content-title" style="display:none"><?php $this->archiveTitle('','',' - '); ?><?php $this->options->title(); ?></a>
    <?php endif ?>
    <?php while($this->next()): ?>
        <article class="post-brif">
            <h4 class="post-title"><u><a class="post-url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></u></h4>
            <div class="post-excerpt hidden-xs">
                <p><small><?php $this->excerpt(); ?></small></p>
            </div>
            <ul class="post-meta list-inline clearfix hidden-xs">
                <li><small><span class="glyphicon glyphicon-calendar"><?php $this->date('Y-m-d'); ?></span></small></li>
                <li><small><span class="glyphicon glyphicon-tag"><?php $this->category(', '); ?></span></small></li>
                <li class="pull-right"><a href="<?php $this->permalink() ?>#comments"><span class="glyphicon glyphicon-comment"></span> <small><span class="badge"><?php $this->commentsNum(); ?></span></a></small></li>
            </ul>
        </article>
    <?php endwhile; ?>
    <?php return; //完成ajax方式返回，退出此页面?>
<?php endif ?>
<?php $this->need('header.php'); ?>
<?php
    echo $m_nav_head;
    echo $main_head;
    echo $main_tail;
?>
<?php $this->need('footer.php'); ?>
