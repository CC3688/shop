<?php
namespace Admin\Model;
use Think\Model;

class GoodsModel extends Model
{
   
 
    protected $insertFields = array('goods_name','price','goods_desc','is_on_sale');

    protected $_validate =array(
        array('goods_name','require','商品名称不能为空!',1),
        array('goods_name','1,45','商品名称必须是1-45个字符',1,'length'),
        array('price','currency','价格必须是货币格式',1),
        array('is_on_sale','0,1','是否上架只能是0,1两个值',1,'in')
    );

    protected function _before_insert(&$data, $options)
    {   //获取当前时间   
        $data['addtime']=time(); 
        //上传logo
        if($_FILES['logo']['error']==0)
        {   
            $rootPath = C('IMG_rootPath');
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     (int) C('IMG_maxSize') *1024*1024 ;// 设置附件上传大小
            $upload->exts      =    C('IMG_exts');// 设置附件上传类型
            $upload->rootPath  =     $rootPath; // 设置附件上传根目录
            $upload->savePath  =     'Goods/'; // 设置附件上传（子）目录
            // 上传文件 
            $info   =   $upload->upload();
            
            if(!$info) {
                //先把上传失败的错误信息存到模型中,由控制器最终再获取这个错误信息.
                $this->error = $upload->getError();
                return FALSE; //返回控制器
            }else{// 上传成功
                $logoName=$info['logo']['savepath'].$info['logo']['savename'];
                //拼出缩略图的文件名
                $smLogoName=$info['logo']['savepath'].'thumb_'.$info['logo']['savename'];
                //生成缩略图
                $image = new \Think\Image();
                $image->open($rootPath.$logoName);
                $image->thumb(150,150)->save($rootPath.$smLogoName);
                //把图片的表单放到表单中
                $data['logo'] = $logoName;
                $data['sm_logo'] = $smLogoName;
               
            }
        }

    }

    public function search()
    {   
        /***** 搜索 ***/
        $where =array();
        //商品名称的搜索
        $goodsName = I('get.goods_name');
        if($goodsName){
            $where['goods_name'] =array('like',"%$goodsName%");
        }
        //价格的搜索
        $startPrice = I('get.start_price');
        $endPrice = I('get.end_price');
        if($startPrice && $endPrice){
            $where['price'] = array('between', array($startPrice,$endPrice));
        }elseif($startPrice){
            $where['price'] = array('egt',$startPrice);
        }elseif($endPrice){
            $where['price'] = array('elt',$endPrice);
        }
        //上架的搜索
        $isOnSale = I('get.is_on_sale',-1);
        if($isOnSale != -1){
            $where['is_on_sale'] = array('eq',$isOnSale);
        }
        //是否删除的搜索
        $isDelete = I('get.is_delete',-1);
        if($isDelete != -1){
            $where['is_delete'] = array('eq',$isDelete);
        }
        //时间的搜索
        $startAddtime = I('get.start_addtime');
        $endAddtime = I('get.end_addtime');
        if($startAddtime && $endAddtime){
            $where['addtime'] = array('between', array(strtotime("$startAddtime 00:00:01"),strtotime("$endAddtime 23:59:59")));
        }elseif($startAddtime){
            $where['addtime'] =array('egt',strtotime("$startAddtime 00:00:01"));
        }elseif($endAddtime){
            $where['addtime'] =array('elt',strtotime("$endAddtime 23:59:59"));
        }
        //排序
        $orderBy='id';//默认排序字段
        $orderWay='asc';//默认排序方式 
        $odby =I('get.odby');
        if($odby && in_array($odby,array('id_asc','id_desc','price_asc','price_desc'))){
            if($odby == 'id_desc'){
                $orderWay ='desc';
            }elseif($odby == 'price_asc'){
                $orderBy='price';
               
            }elseif($odby == 'price_desc'){
                $orderBy='price';
                $orderWay='desc';
            }
        }
        
        /***** 翻页 ***/
        //总的记录数
        $count = $this->where($where)->count();
        //生成翻页对象
        $page = new \Think\Page($count,3);
        //获取翻页字符串
        $pageString = $page->show();
        //取出当前页的数据

        $data = $this->where($where)->limit($page->firstRow.','.$page->listRows)->order("$orderBy $orderWay")->select();

        return array(
            'page' => $pageString,
            'data' => $data,
        );
    }
}
