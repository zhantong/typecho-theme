<?php
/**
 * 自定义页面模板
 *
 * @package custom
 */
?>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php $this->widget('Widget_Archive@index', 'pageSize=10000&type=index')->to($posts); ?>
<article>
    <h1 class="archive-title"><?php $this->archiveTitle('','',''); ?></h1>
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr class="small">
                <th>发表时间<i class="fa fa-sort fa-fw" aria-hidden="true"></i></th>
                <th>标题</th>
                <th>评论<i class="fa fa-sort fa-fw" aria-hidden="true"></i></th>
                <th>阅读<i class="fa fa-sort fa-fw" aria-hidden="true"></i></th>
            </tr>
        </thead>
        <?php while($posts->next()): ?>
            <tr>
                <td><span class="small" title="发表时间"><?php $posts->date('Y/m/d'); ?><span></td>
                <td><a class="post-url" href="<?php $posts->permalink() ?>" title="<?php $posts->title() ?>"><?php $posts->title() ?></a></td>
                <td><span class="badge" title="评论量"><?php $posts->commentsNum(); ?></span></td>
                <td><span class="badge" title="阅读量"><?php $posts->viewsNum(); ?></span></td>
            </tr>
        <?php endwhile; ?>
    </table>
</article>
    </div>
    <?php $this->need('footer.php'); ?>
