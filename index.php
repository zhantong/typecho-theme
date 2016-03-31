<?php if(isset($_GET['load_type']) and $_GET['load_type'] == 'ajax'):  ?>
    <a id="content-title" style="display:none"><?php $this->archiveTitle('','',' - '); ?><?php $this->options->title(); ?></a>
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
<?php
/**
 * 这是 Typecho 0.9 系统的一套默认皮肤
 *
 * @package Typecho Replica Theme
 * @author Typecho Team
 * @version 1.2
 * @link http://typecho.org
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>
<div class="column col-sm-6 col-md-6 col-lg-6 fill" id="m-nav">
    <div id="main"></div>

<?php $this->need('footer.php'); ?>
