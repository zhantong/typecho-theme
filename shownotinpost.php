<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
<?php while($pages->next()): ?>
    <?php if (!empty($this->options->secondbarPage) && in_array($pages->slug, $this->options->secondbarPage)): ?>
        <section class="widget">
            <?php PageToLinks($pages); ?>
        </section>
    <?php endif; ?>
<?php endwhile; ?>
<?php if (!empty($this->options->secondbarPage) && in_array('ShowRecentPosts', $this->options->secondbarPage)): ?>
    <section class="widget">
        <h3 class="widget-title"><?php _e('最新文章'); ?></h3>
        <ul class="widget-list">
            <?php $this->widget('Widget_Contents_Post_Recent')->parse('<li><a class="post-url" href="{permalink}">{title}</a></li>'); ?>
        </ul>
    </section>
<?php endif; ?>
<?php if (!empty($this->options->secondbarPage) && in_array('ShowRecentComments', $this->options->secondbarPage)): ?>
    <section class="widget">
        <h3 class="widget-title"><?php _e('最近回复'); ?></h3>
        <ul class="widget-list">
            <?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
            <?php while($comments->next()): ?>
                <li><a class="post-url" href="<?php $comments->permalink(); ?>"><?php $comments->author(false); ?></a>: <?php $comments->excerpt(35, '...'); ?></li>
            <?php endwhile; ?>
        </ul>
    </section>
<?php endif; ?>
<?php if (!empty($this->options->secondbarPage) && in_array('ShowCategory', $this->options->secondbarPage)): ?>
    <section class="widget category">
        <h3 class="widget-title"><?php _e('分类'); ?></h3>
        <?php $this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list'); ?>
    </section>
<?php endif; ?>
<?php if (!empty($this->options->secondbarPage) && in_array('ShowArchive', $this->options->secondbarPage)): ?>
    <section class="widget archive">
        <h3 class="widget-title"><?php _e('归档'); ?></h3>
        <ul class="widget-list">
            <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=F Y')->parse('<li><a href="{permalink}">{date}</a></li>'); ?>
        </ul>
    </section>
<?php endif; ?>
<?php if (!empty($this->options->secondbarPage) && in_array('ShowOther', $this->options->secondbarPage)): ?>
    <section class="widget">
        <h3 class="widget-title"><?php _e('其它'); ?></h3>
        <ul class="widget-list">
            <?php if($this->user->hasLogin()): ?>
                <li class="last"><a href="<?php $this->options->adminUrl(); ?>"><?php _e('进入后台'); ?> (<?php $this->user->screenName(); ?>)</a></li>
                <li><a href="<?php $this->options->logoutUrl(); ?>"><?php _e('退出'); ?></a></li>
            <?php else: ?>
                <li class="last"><a href="<?php $this->options->adminUrl('login.php'); ?>"><?php _e('登录'); ?></a></li>
            <?php endif; ?>
            <li><a href="<?php $this->options->feedUrl(); ?>"><?php _e('文章 RSS'); ?></a></li>
            <li><a href="<?php $this->options->commentsFeedUrl(); ?>"><?php _e('评论 RSS'); ?></a></li>
            <li><a href="http://www.typecho.org">Typecho</a></li>
        </ul>
    </section>
<?php endif; ?>
