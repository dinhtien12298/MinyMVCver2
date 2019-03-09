<div class="login-container">
    <div class="login-form">
        <div class="close-form" onclick="directTo('/index.php')"><i class="fas fa-times"></i></div>
        <form method="post" action="index.php?controller=userAction&action=postLogin">
            <p class="form-title f-regular-25">Đăng nhập</p>
            <div class="main-form">
                <input class="username-input-login" type="text" name="username" placeholder="Tên đăng nhập" required>
                <input class="password-input-login" type="password" name="password" placeholder="Mật khẩu" required>
                <div class="login-messages f-regular-17"><?php if (isset($error)) { echo $error; } ?></div>
                <button class="f-bold-15 login-user" type="submit" name="submit">Đăng nhập</button>
            </div>
            <div class="footer-form f-regular-14">
                <p>
                    Bạn chưa có tài khoản?
                    <a href="/index.php?controller=userAction&action=getSignup">Đăng ký</a>
                </p>
            </div>
        </form>
    </div>
</div>