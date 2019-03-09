<div class="login-container signup-container">
    <div class="login-form">
        <div class="close-form" onclick="directTo('/index.php')"><i class="fas fa-times"></i></div>
        <form method="post" action="index.php?controller=userAction&action=postSignup">
            <p class="form-title f-regular-25">Đăng ký tài khoản</p>
            <div class="main-form">
                <div class="input-container">
                    <input class="username-input" type="text" name="username" placeholder="Tên đăng nhập" required>
                    <input class="fullname-input" type="text" name="fullname" placeholder="Tên đầy đủ" required>
                    <input class="password-input" type="password" name="password" placeholder="Mật khẩu" required>
                    <input class="confirm-password-input" type="password" name="confirm_password" placeholder="Nhập lại mật khảu" required>
                    <input class="birth-input" type="date" name="birth" required>
                    <input class="phone-input" type="number" name="phone" placeholder="Số điện thoại" required>
                    <input class="email-input" type="email" name="email" placeholder="Email" required>
                    <input class="working-input" type="text" name="working" placeholder="Cơ quan/Trường học" required>
                </div>
                <div class="signup-messages f-regular-17"><?php if (isset($error)) { echo $error; } ?></div>
                <button class="f-bold-15 signup-user" type="submit" name="submit">Đăng ký</button>
            </div>
            <div class="footer-form f-regular-14">
                <p>
                    Bạn đã có tài khoản?
                    <a href="/index.php?controller=userAction&action=getLogin">Đăng nhập</a>
                </p>
            </div>
        </form>
    </div>
</div>