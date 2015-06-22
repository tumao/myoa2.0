<?php namespace App\Http\Controllers;
use App\Http\Controllers\Admin\ABaseController;

use App\Http\Requests;
use Gregwar\Captcha\CaptchaBuilder;
use Session;

class CaptchaController extends ABaseController{

	public function captcha($tmp)
    {
                //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session::put('captchaCode', $phrase);
        // //生成图片
        return response($builder->output())->header('Content-type', 'image/jpeg');
    }

    public function captchaCheck($code)
    {
        if(Session::has('captchaCode'))
        {
            if(Session::pull('captchaCode') == $code)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

}