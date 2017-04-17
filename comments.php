<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
} ?>

<?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';  //如果是文章作者的评论添加 .comment-by-author 样式
        } else {
            $commentClass .= ' comment-by-user';  //如果是评论作者的添加 .comment-by-user 样式
        }
    }

    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';  //评论层数大于0为子级，否则是父级
?>

    <li id="li-<?php $comments->theId(); ?>" class="comment-body
        <?php
            if ($comments->levels > 0) {
                echo ' comment-child';
                $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
            } else {
                echo ' comment-parent';
            }
            $comments->alt(' comment-odd', ' comment-even');
            echo $commentClass;
        ?>
        ">
        <div id="<?php $comments->theId(); ?>">
            <div class="comment-author">
                <?php $comments->gravatar('40', ''); ?>
                <span class="fn lead"><strong><?php $comments->author(); ?></strong></span>
            </div>
            <div class="comment-meta">
                <small><i class="fa fa-calendar fa-fw" aria-hidden="true" title="发表时间"></i><a class="text-muted" href="<?php $comments->permalink(); ?>"><?php $comments->date('Y-m-d H:i'); ?></a></small>
            </div>
            <div class="comment-content">
                <?php $comments->content(); ?>
            </div>
            <div class="comment-reply text-right">
                <?php $comments->reply(); ?>
            </div>
        </div>
        <?php if ($comments->children) { ?>
            <div class="comment-children">
                <?php $comments->threadedComments($options); ?>
            </div>
        <?php } ?>
    </li>
<?php } ?>


<div id="comments">
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
        <h3><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h3>
        <?php $comments->listComments(); ?>
        <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    <?php endif; ?>
    <?php if ($this->allow('comment')): ?>
        <div id="<?php $this->respondId(); ?>" class="respond">
            <div class="cancel-comment-reply">
                <?php $comments->cancelReply(); ?>
            </div>
            <h3 id="response"><?php _e('添加新评论'); ?></h3>
            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form" class="form-horizontal">
                <?php if ($this->user->hasLogin()): ?>
                    <p>
                        <?php _e('登录身份: '); ?>
                        <a href="<?php $this->options->profileUrl(); ?>">
                            <?php $this->user->screenName(); ?>
                        </a>
                        .
                        <a href="<?php $this->options->logoutUrl(); ?>" title="Logout">
                            <?php _e('退出'); ?> &raquo;
                        </a>
                    </p>
                <?php else: ?>
                    <div class="form-group has-feedback">
                        <label for="author" class=" col-sm-2 control-label"><?php _e('称呼'); ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="author" id="author" class="form-control" required value="<?php $this->remember('author'); ?>" />
                            <i class="form-control-feedback fa fa-asterisk"></i>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="mail" class="col-sm-2 control-label"><?php _e('Email'); ?></label>
                        <div class="col-sm-10">
                            <input type="email" name="mail" id="mail" <?php if ($this->options->commentsRequireMail): ?>required <?php endif; ?>class="form-control" value="<?php $this->remember('mail'); ?>" placeholder="填写Email以便有新的回复时能够及时通知您，您的Email不会被公开"/>
                            <?php if ($this->options->commentsRequireMail): ?>
                                <i class="form-control-feedback fa fa-asterisk"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="url" class="col-sm-2 control-label"><?php _e('网站'); ?></label>
                        <div class="col-sm-10">
                            <input type="url" name="url" id="url" class="form-control" <?php if ($this->options->commentsRequireURL): ?>required <?php endif; ?>placeholder="<?php _e('http://'); ?>" value="<?php $this->remember('url'); ?>" />
                            <?php if ($this->options->commentsRequireURL): ?>
                                <i class="form-control-feedback fa fa-asterisk"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-group has-feedback">
                    <label for="textarea" class="required col-sm-2 control-label"><?php _e('内容'); ?></label>
                    <div class="col-sm-10">
                        <textarea rows="8" name="text" id="textarea" class="form-control" required><?php $this->remember('text'); ?></textarea>
                        <i class="form-control-feedback fa fa-asterisk"></i>
                    </div>
                </div>
                <?php if(false): ?>
                <div class="form-group has-feedback">
                    <div>
                        <img class="col-sm-offset-2" src="<?php echo Typecho_Common::url('/action/captcha', Helper::options()->index); ?>" alt="captcha" onclick="this.src = this.src + '?' + Math.random()" style="cursor: pointer" title="点击图片刷新验证码"/>
                    </div>
                    <label for="captcha" class="col-sm-2 control-label"><?php _e('验证码'); ?></label>
                    <div class="col-sm-10">
                        <input type="text" name="captcha" class="form-control" required />
                        <i class="form-control-feedback fa fa-asterisk"></i>
                    </div>
                </div>
              <?php endif; ?>
                <input name="parent" value="" style="display:none;"/>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default"><?php _e('提交评论'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    <?php else: ?>
        <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
</div>
