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
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="collapse-list-recent-comments-heading">
                <h3 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-list-recent-comments" aria-expanded="true" aria-controls="collapse-list-recent-comments">
                        <?php _e('最近回复'); ?>
                    </a>
                </h3>
            </div>
            <div id="collapse-list-recent-comments" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapse-list-recent-comments-heading" aria-expanded="false" style="height:0px;">
                <?php $this->widget('Widget_Comments_Recent','ignoreAuthor=true')->to($comments); ?>
                <ul class="list-group">
                    <?php while($comments->next()): ?>
                        <li class="list-group-item"><a class="post-url" href="<?php $comments->permalink(); ?>"><?php $comments->author(false); ?></a>: <?php $comments->excerpt(35, '...'); ?></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php if (!empty($this->options->secondbarPage) && in_array('ShowCategory', $this->options->secondbarPage)): ?>
    <section class="widget">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="collapse-list-category-heading">
                <h3 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-list-category" aria-expanded="false" aria-controls="collapse-list-category">
                        <?php _e('分类'); ?>
                    </a>
                </h3>
            </div>
            <div id="collapse-list-category" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapse-list-category-heading" aria-expanded="false" style="height:0px;">
                <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
                <ul class="list-group">
                    <?php while($category->next()): ?>
                        <li class="list-group-item"><a class="post-url" href="<?php $category->permalink(); ?>"><?php $category->name(); ?></a><span class="badge"><?php $category->count(); ?></span></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
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
