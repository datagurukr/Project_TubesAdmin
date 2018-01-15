<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group mb-0">
                <form class="card p-4 validation-forme validation-login" method="post" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="auth" value="1">                    
                    <div class="card-body">
                        <h1>Login</h1>
                        <p class="text-muted">Sign In to your account</p>
                        <div class="input-group mb-3">
                            <span class="input-group-addon"><i class="icon-user"></i></span>
                            <input type="text" class="form-control" placeholder="Username" name="user_email">
                        </div>
                        <div class="input-group mb-4">
                            <span class="input-group-addon"><i class="icon-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Password" name="user_password">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary px-4">Login</button>
                            </div>
                            <!--
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-link px-0">Forgot password?</button>
                            </div>
                            -->
                        </div>
                    </div>
                </form>
                <!--
                <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                    <div class="card-body text-center">
                        <div>
                            <h2>Sign up</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <a href="/admin/auth/register" class="btn btn-primary active mt-3">Register Now!</a>
                        </div>
                    </div>
                </div>
                -->
            </div>
        </div>
    </div>
</div>    

<?
if ( isset($_POST['user_email']) && isset($_POST['user_password']) ) {
    ?>
<script type="text/javascript">
alert('이메일주소 또는 비밀번호가 올바르지 않습니다.');
</script>
    <?
}
?>