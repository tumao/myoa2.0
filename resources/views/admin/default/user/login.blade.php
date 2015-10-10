@include('default._shared.header')
<script src="/default/app/js/login.js"></script>
<div class="ch-container">
    <div class="row">

        <div class="row">
            <div class="col-md-12 center login-header">
                <!-- <h2>登录后台</h2> -->
            </div>
            <!--/span-->
        </div><!--/row-->

        <div class="row">
            <div class="well col-md-5 center login-box" style="width:500px;">
                <div class="alert alert-info">
                    请输入用户名密码
                </div>
                <!-- <form class="form-horizontal" action="index.html" method="post"> -->
                    <fieldset>
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                            <input id="username" type="text" class="form-control" placeholder="用户名">
                        </div>
                        <div class="clearfix"></div><br/>

                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                            <input id="password" type="password" class="form-control" placeholder="密码">
                        </div>
                        <div class="clearfix"></div><br/>

                         <div class="input-group input-group-lg captcha" style="width:50%; float:left;">
                            <span class="input-group-addon"><i class="red"></i>验证码</span>
                            <input id="captcha" type="text" class="form-control">
                        </div>
                        <div class="captcha" style="line-height:54px;" onclick="updateCaptcha()">
                            <img id="captchaImg" src="/captcha/1" alt="验证码"> <a href="#" title="刷新验证码">更换验证码</a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="input-prepend">
                            <label class="remember" for="remember"><input type="checkbox" id="remember"> 记住密码</label>
                        </div>
                        <div class="clearfix"></div>

                        <p class="center col-md-5">
                            <button type="submit" class="btn btn-primary" onclick="userlogin()">登陆</button>
                        </p>
                    </fieldset>
                <!-- </form> -->
            </div>
            <!--/span-->
        </div><!--/row-->
    </div><!--/fluid-row-->

</div><!--/.fluid-container-->
@include('default._shared.footer')