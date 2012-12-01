<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="headbar">
    <div class="position"><span><?php $menu = $this->acl->current_location();echo $menu[1]; ?></span>
        <span>></span><span><?php echo $menu[2]; ?></span><span>></span>
        <span><?php echo $menu[3]; ?></span></div>
</div>
<div class="content_box">
    <div class="content form_content">
        <form action="<?php echo site_url('ss_role/edit/' . $role->role_id); ?>"  method="post">
            <table class="form_table">
                <col width="150px" />
                <col />
                <tr>
                    <th> 用户组名称：</th>
                    <td><input type="text" value="<?php echo $role->role_name ?>" autocomplete="off" style="width:150px" id="name" name="name" class="normal"><label>*3-20位用户组标识</label><b style="color:red"><?php echo form_error('name'); ?></b></td>
                </tr>
                <tr>
                    <th> 允许的权限：</th>
                    <td>
                        <ul class="attr_list">
                            <?php
                            $role->rights = explode(',', $role->rights);
                            foreach ($rights as $key => $v){
                            ?>
                                <li><label class="attr"><input type="checkbox" <?php echo in_array($key, $role->rights) ? 'checked="checked"' : ''; ?> value="<?php echo $key; ?>" name="right[]"><?php echo $v; ?></label></li>
                            <?php } ?>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button class="submit" type='submit'><span>修改用户组</span></button>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>