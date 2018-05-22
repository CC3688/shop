use shop;
set names utf8;

create table if not exists shop_goods
(
    id mediumint unsigned not null auto_increment,
    goods_name varchar (45) not null comment '商品名称',
    logo varchar (150) not null default '' comment '商品logo',
    sm_logo varchar(150) not null default '' comment '商品缩略图logo',
    price decimal (10,2) not null default '0.00' comment '商品价格',
    goods_desc longtext comment '商品描述',
    is_on_sale tinyint unsigned not null default '1' comment '是否上架:1:上架,0:下架',
    is_delete tinyint unsigned not null default '0' comment '是否已经删除:1:已经删除 0:未删除',
    addtime int unsigned not null comment '添加时间',
    primary key (id),
    key price (price),
    key is_on_sale (is_on_sale),
    key is_delete (is_delete),
    key addtime(addtime)
    
)engine=MyISAM default charset=utf8;

drop table if exists shop_admin;
create table shop_admin
(
    id tinyint unsigned not null auto_increment,
    username varchar(30) not null comment '账号',
    password char(32) not null comment  '密码',
    is_use tinyint unsigned not null default '1' comment '是否启用 1:启用;0:禁用',
    primary key (id)
)engine=MyISAM default charset=utf8;
insert into shop_admin values (1,'root','7b286ad332652d303d60752b23ceace0',1);
-- 建表时就初始化超级管理员id  md5 要加盐