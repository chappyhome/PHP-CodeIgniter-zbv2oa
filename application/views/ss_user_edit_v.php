<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="headbar">
    <div class="position"><span><?php $menu = $this->acl->current_location();
echo $menu[1]; ?></span>
        <span>></span><span><?php echo $menu[2]; ?></span>
        <span>></span><span><?php echo $menu[3]; ?></span>
        <span>></span><span>修改</span>
    </div>
</div>
<div class="content_box">
    <div class="content form_content">
        <form action="<?php echo site_url('ss_user/edit/' . $user->user_id); ?>"  method="post">
            <table class="form_table _tabs" id="user_add">
                <col width="150px" />
                <col />
                <tr>
                    <th> 用户名：</th>
                    <td><input type="text" value="<?php echo $user->user_name; ?>" name="user_name" style="width:150px" class="normal"><label>*4-20位用户名.</label>
                        <b style="color:red"><?php echo form_error('user_name'); ?></b></td>
                </tr>
                <tr>
                    <th>修改密码？</th>
                    <td>
                        <button onclick="$('.pw').toggle('slow');" hidefocus="true" type="button" class="btn">
                            <span class="sel">修改</span>
                        </button>
                        <b style="color:red"><?php echo form_error('password'); ?></b>
                        <b style="color:red"><?php echo form_error('confirm_password'); ?></b>
                    </td>
                </tr>
                <tr class="pw" style="display:none;">
                    <th> 用户密码：</th>
                    <td><input type="password" value="" name="password" style="width:150px" class="normal"><label>*6-16位用户密码.</label>
                        <b style="color:red"><?php echo form_error('password'); ?></b></td>
                </tr>
                <tr class="pw" style="display:none;">
                    <th> 重复用户密码：</th>
                    <td><input type="password" value="" name="confirm_password" style="width:150px" class="normal"><label>*6-16位用户密码.</label>
                        <b style="color:red"><?php echo form_error('confirm_password'); ?></b></td>
                </tr>
                <tr>
                    <th> 用户组：</th>
                    <td>
                    <select class="normal" style="width:auto" name="role_id" >
                    <?php foreach ($roles as $k => $r): ?>
                        <option <?php echo $user->role_id == $k ? 'selected="selected"' : '' ?> value="<?php echo $k; ?>"><?php echo $r; ?></option>
                    <?php endforeach; ?>
                    </select>
                        <label>*选择所属用户权限组.</label>
                        <b style="color:red"><?php echo form_error('role_id'); ?></b></td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button class="submit" type='submit'><span>添加用户</span></button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
