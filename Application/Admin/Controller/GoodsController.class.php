<?php
namespace Admin\Controller;
use Think\Controller;

class GoodsController extends Controller 
{
    public function add(){
        // 2,处理表单
        if(IS_POST)
        {

            $model=D('Goods');

            if($model->create(I('post.'),1))
            {   
                if($model->add())
                {   
                    
                    $this->success('操作成功',U('lst'),TRUE); //第三个参数设为true 返回json数据
                    exit;
                }
            }

            $error=$model->getError();
            $this->error($error,'',True);//第三个参数设为true 返回json数据

        }

        // 1,显示菜单
        $this->display();
    }

    public function edit()
	{
        //处理表单
        if(IS_POST)
        {

            $model=D('Goods');

            if($model->create(I('post.'),2))    //1,代表添加,2代修改,此处可以不加.
            {   
                //save方法的返回值是影响的记录数(mysql_affected_rows),如果你
                //修改时,没有改,会返回0,会提示失败.实际只是什么也没改.如果失败//返回false  ,用恒等于false   不然0也会被当做失败来处理
                //为了防止乱改,可以$model->where(array('admin_id')=>array('eq',session('id')))->save()
                if(FALSE !== $model->save())
                {   
                    
                    $this->success('操作成功',U('lst?p='.I('get.p')),2);
                    exit;
                }
            }
            //如果失败显示错误信息
            $error=$model->getError();
            $this->error($error);

        }

        //接收商品的ID
        $id=I('get.id');
        //先从数据库存中取出要修改的记录的信息
        $model=M('Goods');
        $info=$model->find($id);
        $this->assign('info',$info);


        //显示修改的表单
        $this->display();
	}
	public function delete()
	{
        $model=D('Goods');
        $model->delete(I('get.id'));
        $this->success('操作成功!',U('lst?p='.I('get.p')));
	}
	// 列表
	public function lst()
	{
        $model = D('Goods');
        //获取带翻页的数据
        $data = $model->search();
        $this->assign(array(
            'data' => $data['data'],
            'page' => $data['page'],
        ));

        $this->display();
	}
}