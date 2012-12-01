<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="headbar">
    <div class="position"><span><?php $menu = $this->acl->current_location();echo $menu[1]; ?></span>
        <span>></span><span><?php echo $menu[2]; ?></span>
        <span>></span><span><?php echo $menu[3]; ?></span>
        <span>></span><span>添加</span>
    </div>
</div>
<div class="content_box">
    <div class="content form_content">
        <form action="<?php echo site_url('em_dm/add'); ?>"  method="post">
            <table class="form_table">
                <col width="150px" />
                <col />
                <tr>
                    <th> 部门名称：</th>
                    <td><input type="text" value="" name="department_name" style="width:150px" class="normal"><label>*2-10个汉字.</label>
                        <b style="color:red"><?php echo form_error('department_name'); ?></b></td>
                </tr>
                <tr>
                    <th> 部门标语：</th>
                    <td><textarea value="" name="post" class="normal"></textarea><label>50个汉字内.</label>
                        <b style="color: red"><?php echo form_error('post'); ?></b></td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button class="submit" type='submit'><span>添加部门</span></button>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
