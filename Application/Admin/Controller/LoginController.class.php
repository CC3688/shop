<?php
namespace Admin\Controller;
use Think\Controller;


class LoginController extends Controller 
{
    public function login()
    {
        if(IS_POST){

            $model = D('Admin');
            //使用validate方法来指定使用模型中的哪个数组做为验证规则,默认是使用$_validate
            //这里把登录的规则和添加修改管理员的规则分为两个
            if($model->validate($model->_login_validate)->create()){
                if(TRUE === $model->login()){
                    redirect(U('Admin/Index/index'));//直接跳转
                }
            }
            $this->error($model->getError());
        }
        
        
        
        //显示表单
        $this->display();
    }

    //生成验证码
    public function chkcode()
    {
        $Verify = new \Think\Verify(array(
            'length'=>4,
            'useNoise' =>FALSE
        ));
        $Verify->entry();
    }
}