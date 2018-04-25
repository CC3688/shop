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
                    
                    $this->success('操作成功',U('add'),2);
                    exit;
                }
            }

            $error=$model->getError();
            $this->error($error);

        }

        // 1,显示菜单
        $this->display();
    }

    public function edit()
	{
		
	}
	public function delete()
	{
		
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