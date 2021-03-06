<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title>
           商城管理后台
        </title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="/Public/Admin/css/x-admin.css" media="all">
        <script src="/Public/Admin/lib/layui/layui.js" charset="utf-8">
        </script>
        <script src="/Public/Admin/js/x-layui.js" charset="utf-8">
        </script>
    </head>
    <body>
        <div class="x-body">
            <form class="layui-form"  >

                <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />

                <div class="layui-form-item">
                    <label for="role" class="layui-form-label">
                        <span class="x-red">*</span>上级分类
                    </label>
                    <div class="layui-input-inline">
                        <select name="parent_id">
                            <option value="0">顶级分类</option>
                            <?php foreach ($catData as $k => $v): if($v['id'] == $data['id'] || in_array($v['id'], $children)) continue ; if($v['id'] == $data['parent_id']) $select = 'selected="selected"'; else $select = ''; ?>
                            <option <?php echo $select; ?> value="<?php echo $v['id']; ?>"><?php echo str_repeat('-', 8*$v['level']) . $v['cat_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_pass" class="layui-form-label">
                        <span class="x-red">*</span>分类名称
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="pri_name" name="cat_name" value="<?php echo $data['cat_name']; ?>"  required="" lay-verify="required"
                               autocomplete="off" class="layui-input">

                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">推荐楼层</label>
                    <div class="layui-input-block">
                        <input type="radio" name="is_floor" title="是"  value="是"  <?php if($data['is_floor'] == '是') echo 'checked="checked"'; ?>/>
                        <input type="radio" name="is_floor" title="否"  value="否" <?php if($data['is_floor'] == '否') echo 'checked="checked"'; ?> />
                    </div>
                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label">
                        </label>
                        <button  class="layui-btn" lay-filter="save" lay-submit="">
                            修改
                        </button>
                    </div>
            </form>
        </div>
        <script src="/Public/Admin/lib/layui/layui.js" charset="utf-8">
        </script>
        <script src="/Public/Admin/js/x-layui.js" charset="utf-8">
        </script>
        <script>
            layui.use(['form','layer'], function(){
                $ = layui.jquery;
              var form = layui.form()
              ,layer = layui.layer;
            
          

               //监听提交
              form.on('submit(save)', function(data){
                console.log(data.field);
                //发异步，把数据提交给php
                $.ajax({
                    url:"<?php echo U('edit')?>",
                    data:data.field,
                    dataType:'JSON',
                    type:'POST',
                    success:function(ret)
                    {
                        if(ret.status==1)
                        {
                            layer.alert("保存成功", {icon: 6},function () {
                    // 获得frame索引
                    var index = parent.layer.getFrameIndex(window.name);
                    //关闭当前frame
                    parent.layer.close(index);
                     parent.location.reload();
                        }); 
                        }
                        else
                        {
                            layer.msg(ret.info, {icon: 1});
                        }
                    },
                });
                
                
                
               
                return false;
              });
              
              
            });
        </script>
        <script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();
        </script>
    </body>

</html>