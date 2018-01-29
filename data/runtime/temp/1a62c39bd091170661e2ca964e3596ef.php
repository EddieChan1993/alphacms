<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:52:"E:\alphaCMS/app/admin\view\core\admin\home_page.html";i:1516680696;s:46:"E:\alphaCMS\app\admin\view\Public\content.html";i:1516067394;s:46:"E:\alphaCMS\app\admin\view\Public\head_in.html";i:1516067394;s:44:"E:\alphaCMS\app\admin\view\Public\alert.html";i:1516683724;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo \think\Config::get('title'); ?></title>
    <link rel="icon" href="/data/upload/admin/common/logo.png" type="image/x-icon" />
<link rel="stylesheet" type="text/css" id="theme" href="/public/admin/alpha/css/theme-default-in.css"/>
<!-- EOF CSS INCLUDE -->

<!-- START PLUGINS -->
<script type="text/javascript" src="/public/admin/alpha/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/public/admin/alpha/js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="/public/admin/alpha/js/plugins/bootstrap/bootstrap.min.js"></script>
<!-- END PLUGINS -->

<!-- THIS PAGE PLUGINS -->
<script type='text/javascript' src='/public/admin/alpha/js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="/public/admin/alpha/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

<script type="text/javascript" src="/public/admin/alpha/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="/public/admin/alpha/js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="/public/admin/alpha/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="/public/admin/alpha/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="/public/admin/alpha/js/plugins/datatables/jquery.dataTables.min.js"></script>

<!-- END THIS PAGE PLUGINS -->
<script type="text/javascript" src="/public/admin/alpha/js/plugins.js"></script>
<script type="text/javascript" src="/public/admin/alpha/js/actions.js"></script>


<link rel="stylesheet" href="/public/admin/alpha/plugins/message_alert/css/m_css.css">
<script src="/public/admin/alpha/plugins/message_alert/js/m_js.js"></script>
<script src="/public/admin/alpha/plugins/layer-v3.0.1/layer/layer.js"></script>
<script src="/public/admin/alpha/plugins/ajax-form/ajax-form.js"></script>

<!--MY-->
<script src="/public/admin/controller/upload.js"></script>
<script src="/public/admin/controller/controller.js"></script>
<!--前台框架自带的弹出层-->
<div class="message-box animated fadeIn message-box-info" data-sound="alert" id="mb-signout">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-sign-out"></span><strong>退出</strong> ?</div>
            <div class="mb-content">
                <p>你确定要退出?</p>
                <p>如果你想继续操作后台请按‘否’. 按‘是’则回到登录页面.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a href="<?php echo url('admin/core.Index/login_out'); ?>" class="btn btn-success btn-lg">是</a>
                    <button class="btn btn-default btn-lg mb-control-close">否</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--自定义弹出提示-->
<div class="m_tip">
    <div>
        <img class="m_icon m_normal" src="/public/admin/alpha/plugins/message_alert/img/tip.svg">
        <img class="m_icon m_error" src="/public/admin/alpha/plugins/message_alert/img/error.svg">
        <img class="m_icon m_success" src="/public/admin/alpha/plugins/message_alert/img/success.svg">
        <img class="m_icon m_warning" src="/public/admin/alpha/plugins/message_alert/img/warning.svg">
        <img class="m_icon m_loading" src="/public/admin/alpha/plugins/message_alert/img/loading.svg">
        <span>提示内容</span>
    </div>
    <img class="m_icon m_close" src="/public/admin/alpha/plugins/message_alert/img/close.svg" onclick=close_tip(this)>
</div>

</head>
<body>
<!--前台框架自带的弹出层-->
<div class="message-box animated fadeIn message-box-info" data-sound="alert" id="mb-signout">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-sign-out"></span><strong>退出</strong> ?</div>
            <div class="mb-content">
                <p>你确定要退出?</p>
                <p>如果你想继续操作后台请按‘否’. 按‘是’则回到登录页面.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a href="<?php echo url('admin/core.Index/login_out'); ?>" class="btn btn-success btn-lg">是</a>
                    <button class="btn btn-default btn-lg mb-control-close">否</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--自定义弹出提示-->
<div class="m_tip">
    <div>
        <img class="m_icon m_normal" src="/public/admin/alpha/plugins/message_alert/img/tip.svg">
        <img class="m_icon m_error" src="/public/admin/alpha/plugins/message_alert/img/error.svg">
        <img class="m_icon m_success" src="/public/admin/alpha/plugins/message_alert/img/success.svg">
        <img class="m_icon m_warning" src="/public/admin/alpha/plugins/message_alert/img/warning.svg">
        <img class="m_icon m_loading" src="/public/admin/alpha/plugins/message_alert/img/loading.svg">
        <span>提示内容</span>
    </div>
    <img class="m_icon m_close" src="/public/admin/alpha/plugins/message_alert/img/close.svg" onclick=close_tip(this)>
</div>
<div class="page-container">
    <div class="page-content">
        <!-- START BREADCRUMB -->
       <!-- <ul class="breadcrumb push-down-0">
            <li><a href="#">Home</a></li>
            <li><a href="#">Layouts</a></li>
            <li class="active">Frame Right Column</li>
        </ul>-->
        <!-- END BREADCRUMB -->

        <!-- START CONTENT FRAME -->

            <!-- START CONTENT FRAME TOP -->
                <div class="page-title">
                    <h2><span class="fa fa-arrow-circle-o-left"></span><?php echo $title; ?></h2>
                </div>
            <!-- END CONTENT FRAME TOP -->

            <div class="content-frame-body content-frame-body-left">
                
<div class="row animated fadeIn">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#tab-first" role="tab" data-toggle="tab"><?php echo $tab_1; ?>
                        <button class="btn btn-success btn-rounded btn-sm"><?php echo $dataNums; ?></button>
                    </a></li>
                    <li><a href="#tab-second" role="tab" data-toggle="tab"><?php echo $tab_2; ?></a></li>
                </ul>
                <div class="panel-body tab-content">
                    <div class="active tab-pane" id="tab-first">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>登陆名</th>
                                <th>头像</th>
                                <th>登录次数</th>
                                <th>角色</th>
                                <th>注册时间</th>
                                <th>最近登录IP</th>
                                <th>最近登录时间</th>
                                <th>状态</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($dataArr) || $dataArr instanceof \think\Collection || $dataArr instanceof \think\Paginator): $i = 0; $__LIST__ = $dataArr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <tr class="del_tr">
                                <td><?php echo $v['user_login']; ?></td>
                                <td  style="background: url('<?php echo is_img($v['avatar']); ?>');background-size: contain;background-repeat: no-repeat;"></td>
                                <td><span class="label label-danger"><?php echo $v['user_hits']; ?></span></td>
                                <td><span class="label label-info"><?php echo get_role($v['id']); ?></span></td>
                                <td><?php echo tranTime($v['create_time']); ?></td>
                                <td><?php echo $v['last_login_ip']; ?></td>
                                <td><?php echo tranTime($v['last_login_time']); ?></td>
                                <td><?php echo is_stop($v['user_status']); ?></td>
                                <td>
                                    <?php if($v['id'] == 1): if(open_secret(\think\Cookie::get('UID')) != 1): ?>
                                        <a disabled title="<?php echo $v['user_login']; ?>【编辑】"  class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>
                                        <?php else: ?>
                                        <a title="<?php echo $v['user_login']; ?>【编辑】" data-url="<?php echo url('admin/core.Admin/edit_page',['id'=>$v['id']]); ?>" onclick="edit_row(this)"  class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>
                                    <?php endif; ?>
                                      <button disabled class="btn btn-danger btn-rounded btn-sm" ><span class="fa fa-trash-o"></span></button>
                                    <?php else: ?>
                                    <a title="<?php echo $v['user_login']; ?>【编辑】" data-url="<?php echo url('admin/core.Admin/edit_page',['id'=>$v['id']]); ?>" onclick="edit_row(this)"  class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>
                                    <button data-url="<?php echo url('admin/core.Admin/del_think',['id'=>$v['id']]); ?>" onClick="delete_row(this);" class="btn btn-danger btn-rounded btn-sm" ><span class="fa fa-trash-o"></span></button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <?php echo $pages; ?>
                    </div>
                    <div class="tab-pane" id="tab-second">
                        <form id="add_form" action="<?php echo url('admin/core.Admin/add_think'); ?>" method="post" class="form-horizontal">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">头像</label>
                                            <div class="col-md-7">
                                                <div class="gallery">
                                                    <a class="gallery-item"  href="javascript:void('')" title="Space picture 2" data-gallery>
                                                        <div class="image" >
                                                            <input hidden name="avatar" type="text" id="inp">
                                                            <img src="/data/upload/admin/common/upload.svg" alt="Space picture 2"/>
                                                            <ul class="gallery-item-controls">
                                                                <li onclick="upload_single('inp','avatar')"><i class="fa fa-cloud-upload"></i></li>
                                                                <li onclick="del_pic('inp')"><i class="fa fa-times"></i></li>
                                                            </ul>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">登录名</label>
                                            <div class="col-md-9">
                                                <input name="user_login" type="text" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">密码</label>
                                            <div class="col-md-9">
                                                <input name="user_pass" type="password" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">确认密码</label>
                                            <div class="col-md-9">
                                                <input name="confirm_pass" type="password" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">邮箱</label>
                                            <div class="col-md-9">
                                                <input name="user_email" type="text" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">角色</label>
                                            <div class="col-md-9">
                                                <select name="role_id" class="form-control select">
                                                    <?php if(is_array($role_list) || $role_list instanceof \think\Collection || $role_list instanceof \think\Paginator): $i = 0; $__LIST__ = $role_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                                    <option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3  control-label">管理员状态</label>
                                            <div class="col-md-9">
                                                <label class="switch">
                                                    <input name="user_status" type="checkbox" checked value="1"/>
                                                    <span></span>
                                                </label>
                                                <span class="help-block">默认正常</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-info pull-right">保存添加<span class="fa fa-floppy-o fa-right"></span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

</script>

            </div>
            <!-- START CONTENT FRAME BODY -->

            <!-- END CONTENT FRAME BODY -->
        <!-- END CONTENT FRAME -->
    </div>
</div>

</body>
</html>