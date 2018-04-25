<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/Public/datepicker/jquery-ui-1.9.2.custom.min.css">
    <script src="/Public/datepicker/jquery-1.7.2.min.js"></script>
    <script src="/Public/datepicker/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="/Public/datepicker/datepicker_zh-cn.js"></script>
    <title>Document</title>
</head>
<body>
    <form action="">
        商品名称: <input type="text" name="goods_name" value="<?php echo I('get.goods_name') ;?>"/><br><br>
        价   格: <input type="text" name="start_price" value="<?php echo I('get.start_price') ;?>"> - <input type="text" name="end_price" value="<?php echo I('get.end_price') ;?>"><br><br>

        添加时间: <input type="text" id="start_addtime" name="start_addtime" value="<?php echo I('get.start_addtime') ;?>">--
                 <input type="text" id="end_addtime" name="end_addtime" value="<?php echo I('get.end_addtime') ;?>"> <br><br>
        是否上架: <input type="radio" name="is_on_sale" value="-1"  <?php if(I('get.is_on_sale', -1)==-1) echo 'checked="checked"'; ?>>全部  
                 <input type="radio" name="is_on_sale" value="1" <?php if(I('get.is_on_sale', -1)==1) echo 'checked="checked"' ;?>>是  
                <input type="radio" name="is_on_sale" value="0" <?php if(I('get.is_on_sale', -1)==0) echo 'checked="checked"' ;?>>否<br><br>
        是否删除: <input type="radio" name="is_delete" value="-1"  <?php if(I('get.is_delete', -1)==-1) echo 'checked="checked"' ;?>>全部  
                 <input type="radio" name="is_delete" value="1" <?php if(I('get.is_delete', -1)==1) echo 'checked="checked"' ;?>>是 
                 <input type="radio" name="is_delete" value="0" <?php if(I('get.is_delete', -1)==0) echo 'checked="checked"' ;?>>否<br><br>
        <input type="submit" value="搜索">
        <br><br>
        排序方式: 
                 <input type="radio" name="odby" value="id_asc" <?php if(I('get.odby',"id_asc")=="id_asc") echo 'checked="checked"' ;?>>根据添加时间升序
                 <input type="radio" name="odby" value="id_desc" <?php if(I('get.odby')=="id_desc") echo 'checked="checked"' ;?>>根据添加时间降序
                 <input type="radio" name="odby" value="price_asc" <?php if(I('get.odby')=="price_asc") echo 'checked="checked"' ;?>>根据价格升序
                <input type="radio" name="odby" value="price_desc" <?php if(I('get.odby')=="price_desc") echo 'checked="checked"' ;?>>根据价格降序<br><br>
        <input type="hidden" name="p" value="1">
        



    </form>
    <table width="100%" border="1" cellpadding="5" cellspacing="5">
        <tr>
            <td>id</td>
            <td>商品名称</td>
            <td>logo</td>
            <td>价格</td>
            <td>描述</td>
            <td>是否上架</td>
            <td>是否删除</td>
            <td>操作</td>
        </tr>
        <?php foreach ($data as $k =>$v) :?>
        <tr>
            <td><?php echo ($v["id"]); ?></td>
            <td><?php echo ($v["goods_name"]); ?></td>
            <td><img src="/Uploads/<?php echo ($v["sm_logo"]); ?>"></td>
            <td><?php echo ($v["price"]); ?></td>
            <td><?php echo ($v["goods_desc"]); ?></td>
            <td><?php echo $v['is_on_sale'] == 1 ?'上架':'下架';?></td>
            <td><?php echo $v['is_delete'] == 1 ?'已经删除':'未删除';?></td>
            <td>修改  删除</td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="9">
                <?php echo $page; ?>
            </td>
        </tr>
    </table>
    <script>
    $("#start_addtime").datepicker({dateFormate:"yy-mm-dd"});
    $("#end_addtime").datepicker({dateFormate:"yy-mm-dd"});
    </script>
</body>
</html>