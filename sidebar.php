<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="col-sm-2 col-md-2 col-lg-2" id="secondary">
    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
    <?php while($pages->next()): ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array($pages->slug, $this->options->sidebarBlock)): ?>
            <section class="widget">
                <?php PageToLinks($pages); ?>
            </section>
        <?php endif; ?>
    <?php endwhile; ?>
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentPosts', $this->options->sidebarBlock)): ?>
        <section class="widget">
            <h3 class="widget-title"><?php _e('最新文章'); ?></h3>
            <ul class="widget-list">
                <?php $this->widget('Widget_Contents_Post_Recent')->parse('<li><a class="post-url" href="{permalink}">{title}</a></li>'); ?>
            </ul>
        </section>
    <?php endif; ?>
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentComments', $this->options->sidebarBlock)): ?>
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
                            <li class="list-group-item">
                                <a class="post-url" href="<?php $comments->permalink(); ?>">
                                    <?php $comments->author(false); ?> (<small><em><?php $comments->title(); ?></em></small>)
                                </a>
                                : <?php $comments->excerpt(35, '...'); ?>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowCategory', $this->options->sidebarBlock)): ?>
        <section class="widget">
            <h3 class="widget-title"><?php _e('分类'); ?></h3>
            <?php $this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list'); ?>
        </section>
    <?php endif; ?>
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowArchive', $this->options->sidebarBlock)): ?>
        <section class="widget">
            <h3 class="widget-title"><?php _e('归档'); ?></h3>
            <ul class="widget-list">
                <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=F Y')->parse('<li><a href="{permalink}">{date}</a></li>'); ?>
            </ul>
        </section>
    <?php endif; ?>
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowOther', $this->options->sidebarBlock)): ?>
        <section class="widget">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="collapse-list-others-heading">
                    <h3 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-list-others" aria-expanded="false" aria-controls="collapse-list-others">
                            <?php _e('其它'); ?>
                        </a>
                    </h3>
                </div>
                <div id="collapse-list-others" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapse-list-others-heading">
                    <ul class="list-group">
                        <?php if($this->user->hasLogin()): ?>
                            <li class="list-group-item"><a href="<?php $this->options->adminUrl(); ?>"><?php _e('进入后台'); ?> (<?php $this->user->screenName(); ?>)</a></li>
                            <li class="list-group-item"><a href="<?php $this->options->logoutUrl(); ?>"><?php _e('退出'); ?></a></li>
                        <?php else: ?>
                            <li class="list-group-item"><a href="<?php $this->options->adminUrl('login.php'); ?>"><?php _e('登录'); ?></a></li>
                        <?php endif; ?>
                        <li class="list-group-item"><a href="<?php $this->options->feedUrl(); ?>"><?php _e('文章 RSS'); ?></a></li>
                        <li class="list-group-item"><a href="<?php $this->options->commentsFeedUrl(); ?>"><?php _e('评论 RSS'); ?></a></li>
                        <li class="list-group-item"><a href="http://www.typecho.org">Typecho</a></li>
                    </ul>
                </div>
            </div>
        </section>
    <?php endif; ?>
</div><!-- end #sidebar -->
