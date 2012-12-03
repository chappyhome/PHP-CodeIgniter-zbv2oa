<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="headbar">
    <div class="position"><span><?php $menu = $this->acl->current_location();echo $menu[1]; ?></span>
        <span>></span><span><?php echo $menu[2]; ?></span>
        <span>></span><span><?php echo $menu[3]; ?></span>
        <span>></span><span><?php echo $is_add?'添加':'编辑';?></span>
    </div>
</div>
<div class="content_box">
    <div class="content form_content">
        <form action="<?php $oprate = $is_add?'add':'edit';$id = $level?$level->level_id:''; echo site_url("cr_lm/$oprate/".$id); ?>"  method="post">
            <table class="form_table">
                <col width="150px" />
                <col />
                <tr>
                    <th> 级别名称：</th>
                    <td><input type="text" value="<?php echo $level?$level->level_name:''; ?>" name="level_name" style="width:150px" class="normal"><label>*2-10个汉字.</label>
                        <b style="color:red"><?php echo form_error('level_name'); ?></b></td>
                </tr>
                <tr>
                    <th> 级别介绍：</th>
                    <td><textarea name="level_post" class="normal"><?php echo $level?$level->level_post:''; ?></textarea><label>50个汉字内.</label>
                        <b style="color: red"><?php echo form_error('level_post'); ?></b></td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button class="submit" type='submit'><span><?php echo $is_add?'添加':'编辑';?>客户级别信息</span></button>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
