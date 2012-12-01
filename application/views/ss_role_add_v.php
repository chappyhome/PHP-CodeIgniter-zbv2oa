<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="headbar">
    <div class="position"><span><?php $menu = $this->acl->current_location();echo $menu[1]; ?></span>
        <span>></span><span><?php echo $menu[2]; ?></span><span>></span>
        <span><?php echo $menu[3]; ?></span></div>
</div>
<div class="content_box">
    <div class="content form_content">
        <form action="<?php echo site_url('ss_role/add'); ?>"  method="post">
            <table class="form_table">
                <col width="150px" />
                <col />
                <tr>
                    <th> 用户组名称：</th>
                    <td><input type="text" value="" autocomplete="off" style="width:150px" id="name" name="name" class="normal"><label>*3-20位用户组标识</label><b style="color:red"><?php echo form_error('name'); ?></b></td>
                </tr>
                <tr>
                    <th> 允许的权限：</th>
                    <td>
                        <ul class="attr_list">
                            <?php foreach ($rights as $key => $v): ?>
                                <li><label class="attr"><input type="checkbox" value="<?php echo $key; ?>" name="right[]"><?php echo $v; ?></label></li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button class="submit" type='submit'><span>添加用户组</span></button>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>