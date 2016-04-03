<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">
    <head>
        <meta charset="<?php $this->options->charset(); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="renderer" content="webkit">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php $this->archiveTitle(array(
                'category'  =>  _t('分类 %s 下的文章'),
                'search'    =>  _t('包含关键字 %s 的文章'),
                'tag'       =>  _t('标签 %s 下的文章'),
                'author'    =>  _t('%s 发布的文章')
            ), '', ' - '); ?><?php $this->options->title(); ?></title>

        <!-- 使用url函数转换相关路径 -->
        <link rel="stylesheet" href="<?php $this->options->themeUrl('bootstrap/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php $this->options->themeUrl('test.css'); ?>">
        <script src="<?php $this->options->themeUrl('jquery/jquery-2.2.2.js'); ?>"></script>
        <script src="<?php $this->options->themeUrl('bootstrap/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php $this->options->themeUrl('toc.js'); ?>"></script>
        <script src="<?php $this->options->themeUrl('test.js'); ?>"></script>

        <!--[if lt IE 9]>
        <script src="//cdnjscn.b0.upaiyun.com/libs/html5shiv/r29/html5.min.js"></script>
        <script src="//cdnjscn.b0.upaiyun.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <!-- 通过自有函数输出HTML头部信息 -->
        <?php $this->header(); ?>
    </head>
    <body>
    <!--[if lt IE 8]>
        <div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>'); ?>.</div>
    <![endif]-->
        <div id="body">
            <div class="row-fluid">
                <div id="test-parent" class="col-xs-12 col-sm-2 col-md-3 col-lg-3">
                    <div class="row" id="test">
                        <div id="navi" class="col-sm-12 col-md-4">
                            <div class="dropdown">
                                <div id="site-intro-mobile">
                                    <a class="btn btn-lg dropdown-toggle glyphicon glyphicon-home" id="dropdownMenu1" href="<?php $this->options->siteUrl(); ?>" data-toggle="dropdown">
                                        <?php $this->options->title() ?>
                                    </a>
                                    <span><small><em><?php $this->options->description() ?></em></small></span>
                                </div>
                                <div id="site-intro">
                                    <a id="logo" class="main-page" href="<?php $this->options->siteUrl(); ?>"><p class="text-center"><strong class="lead"><?php $this->options->title() ?></strong></p></a>
                                    <p class="text-center"><small><em><?php $this->options->description() ?></em></small></p>
                                </div>
                                <div id="sidebar" class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="<?php $this->options->siteUrl(); ?>" id="mian-page-url" class="main-page text-center">文章列表</a></li>
                                    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                                    <?php while($pages->next()): ?>
                                        <?php if (!empty($this->options->showPages) && in_array($pages->slug, $this->options->showPages)): ?>
                                            <li>
                                                <a class="page-url text-center" href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                    <li class="dropdown-submenu text-center">
                                        <a class="glyphicon glyphicon-search" href="#"></a>
                                        <ul class="dropdown-menu" style="padding:0;border:0;">
                                            <div class="input-group" id="search">
                                                <input type="text" class="form-control" placeholder="输入关键字搜索">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default">搜索</button>
                                                </span>
                                            </div>
                                        </ul>
                                    </li>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 hidden-xs hidden-sm">
                            <div id="toc-bar">
                                <div id="show-in-post">
                                    <div class="panel-group" role="tablist">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="collapse-list-toc-heading">
                                                <h3 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-toc-page" aria-expanded="true" aria-controls="collapse-list-toc">
                                                        文章目录
                                                    </a>
                                                </h3>
                                            </div>
                                            <div id="collapse-toc-page" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapse-list-toc-heading">
                                                <div id="toc"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $this->need('showinpost.php'); ?>
                                </div>
                                <div id="show-not-in-post">
                                    <?php $this->need('shownotinpost.php'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6" id="m-nav">
                    <div id="content">
                        <div id="main">
