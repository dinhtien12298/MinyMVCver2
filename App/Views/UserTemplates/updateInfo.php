 <form id="user-infomation" method="POST" action="index.php?controller=userHome&action=postUpdateInfo">
    <div class="user-infomation-content">
        <div class="info-element d-flex">
            <div class="info-name">Tên tài khoản</div>
            <input class="info-content" value="<?php echo $user->username ?>" readonly>
        </div>
        <div class="info-element d-flex">
            <div class="info-name">Mật khẩu</div>
            <input type="password" name="password" class="info-content password-input-update" value="<?php echo $user->password ?>" required>
        </div>
        <div class="info-element d-flex">
            <div class="info-name">Tên đầy đủ</div>
            <input class="info-content fullname-input-update" value="<?php echo $user->fullname ?>" readonly>
        </div>
        <div class="info-element d-flex">
            <div class="info-name">Ngày sinh</div>
            <input class="info-content" value="<?php echo $user->birth ?>" readonly>
        </div>
        <div class="info-element d-flex">
            <div class="info-name">Số điện thoại</div>
            <input type="number" class="info-content phone-input-update" name="phone" value="<?php echo $user->phone ?>" required>
        </div>
        <div class="info-element d-flex">
            <div class="info-name">Email</div>
            <input type="email" class="info-content email-input-update" name="email" value="<?php echo $user->email ?>" required>
        </div>
        <div class="info-element d-flex">
            <div class="info-name">Cơ quan/Trường học</div>
            <input type="text" class="info-content working-input-update" name="working" value="<?php echo $user->working ?>" required>
        </div>
        <div class="info-element d-flex">
            <div class="info-name">Vai trò</div>
            <input class="info-content" value="Người dùng" readonly>
        </div>
    </div>
    <div class="error-messages f-regular-17"><?php if (isset($error)) { echo $error; } ?></div>
    <div class="update-button""><button id="update-userInfo-button" name="submit" type="submit" class="f-medium-17">Cập nhật thông tin</button></form>
</form>