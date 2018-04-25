<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>

    <title>Document</title>
</head>
<body>
    <form method="POST" action="/index.php/Admin/Goods/Add" enctype="multipart/form-data">
        商品名称:<input type="text" name="goods_name" /><br />
        商品价格:<input type="text" name="price" /><br />
        商品logo: <input type="file" name="logo"><br />
        商品描述:
        <textarea id='goods_desc' name="goods_desc"></textarea><br />
        是否上架:
        <input type="radio" name="is_on_sale" value="1" checked="checked" />上架
        <input type="radio" name="is_on_sale" value="0" />下架
        <br />
        <input type="submit" value="提交" />
    </form>
    <script>
    UE.getEditor('goods_desc', {
	"initialFrameWidth" : "100%",
	"initialFrameHeight" : 80,
	"maximumWords" : 50000
});
    </script>
</body>
</html>