<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<?php if ($this->have()): ?>
    <?php
        if($this->is('search')){
            $this->widget('Widget_Archive@'.$this->getArchiveType(), 'pageSize=10000&type='.$this->getArchiveType(),'keywords='.$this->getKeywords())->to($posts);
        }
        else{
            $this->widget('Widget_Archive@'.$this->getArchiveType(), 'pageSize=10000&type='.$this->getArchiveType(),'slug='.$this->getArchiveSlug())->to($posts);
        }
    ?>
    <article>
        <h1 class="archive-title"><?php $this->archiveTitle(array(
            'category' => _t('分类 %s 下的文章'),
            'search' => _t('包含关键字 %s 的文章'),
            'tag' => _t('标签 %s 下的文章'),
            'author' => _t('%s 发布的文章'),
        ), '', ''); ?></h1>
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
<?php else: ?>
    <article class="post">
        <h2 class="post-title"><?php _e('没有找到内容'); ?></h2>
    </article>
<?php endif; ?>
</div>
<?php $this->need('footer.php'); ?>
