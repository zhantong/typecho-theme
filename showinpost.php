<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
<?php if (!empty($this->options->secondbarPost) && in_array('ShowRelatedPosts', $this->options->secondbarPost)): ?>
    <section id="related-posts">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="collapse-list-related-posts-heading">
                <h3 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-list-related-posts" aria-expanded="true" aria-controls="collapse-list-related-posts">
                        <?php _e('相关文章'); ?>
                    </a>
                </h3>
            </div>
            <div id="collapse-list-related-posts" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapse-list-related-posts-heading">
                <?php $this->related(5)->to($relatedPosts); ?>
                <ul class="list-group">
                    <?php while($relatedPosts->next()): ?>
                        <li class="list-group-item"><a class="post-url" href="<?php $relatedPosts->permalink(); ?>"><?php $relatedPosts->title(); ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (!empty($this->options->secondbarPost) && in_array('ShowPrevNextPosts', $this->options->secondbarPost)): ?>
    <section id="prev-next-posts">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="collapse-list-prev-next-posts-heading">
                <h3 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-list-prev-next-posts" aria-expanded="true" aria-controls="collapse-list-prev-next-posts">
                        <?php _e('上一篇/下一篇'); ?>
                    </a>
                </h3>
            </div>
            <div id="collapse-list-prev-next-posts" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapse-list-prev-next-posts-heading">
                <ul class="list-group">
                    <li class="list-group-item"><?php $this->thePrev('%s','没有了'); ?></li>
                    <li class="list-group-item"><?php $this->theNext('%s','没有了'); ?></li>
                </ul>
            </div>
        </div>
    </section>
<?php endif; ?>
