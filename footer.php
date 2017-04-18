<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

</div><!-- end #content -->
        <footer id="footer" class="text-center">
            &copy; <?php echo date('Y'); ?>
            <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
            |
            <?php _e('由 <a href="http://www.typecho.org">Typecho</a> 强力驱动'); ?>
            |
            <?php if ($this->options->icpNum): ?>
                <a href="http://www.miitbeian.gov.cn/" target="blank" rel="nofollow"><?php $this->options->icpNum(); ?></a>
            <?php endif; ?>
        </footer>
    </div> <!-- end #middle -->
    <?php $this->need('sidebar.php'); ?>
</div><!-- end div .row-fluid -->
</div><!-- end #body -->
<script src="
    <?php
        if ($this->options->jQueryUrl){
            $this->options->jQueryUrl();
        }
        else{
            $this->options->themeUrl('res/jquery/jquery-2.2.3.min.js');
        }
    ?>
"></script>
<script src="
    <?php
        if($this->options->bootstrapJsUrl){
            $this->options->bootstrapJsUrl();
        }
        else{
            $this->options->themeUrl('res/bootstrap-3.3.6/js/bootstrap.min.js');
        }
    ?>
"></script>
<script src="<?php $this->options->themeUrl('res/js/alone.js'); ?>"></script>
<?php $this->footer(); ?>
    </body>
</html>
