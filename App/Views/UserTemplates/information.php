<div id="user-infomation">
    <div class="user-infomation-content">
        <?php foreach ($list_info as $key => $value) { ?>
            <div class="info-element d-flex">
                <div class="info-name"><?php echo $key ?></div>
                <div class="info-content"><?php echo $value ?></div>
            </div>
        <?php } ?>
    </div>
    <div class="update-button"><button onclick="directTo('index.php?controller=userHome&action=getUpdateInfo')" class="f-medium-17">Cập nhật thông tin</button></div>
</div>
