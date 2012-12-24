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
        <form action="<?php echo site_url('cr_tel/add_remind'); ?>"  method="post">
            <table class="form_table">
                <col width="150px" />
                <col />
                <tr>
                    <th> 工作流名称：</th>
                    <td><input type="text" name="defination_name" value="" style="width:150px" class="normal"><label><span style="color:red">*</span> 工作流名称.</label>
                    <b style="color:red"><?php echo form_error('defination_name'); ?></b></td>
                </tr>
                <tr>
                    <th> 工作流备注：</th>
                    <td><input type="text" name="defination_handler" value="" style="width:150px" class="normal"><label><span style="color:red">*</span> 工作流备注.</label>
                    <b style="color:red"><?php echo form_error('defination_handler'); ?></b></td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button class="submit" type='submit'><span>下一步</span></button>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
