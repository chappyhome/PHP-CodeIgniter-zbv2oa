<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="headbar">
    <div class="position">
        <span><?php $menu = $this->acl->current_location();echo $menu[1]; ?></span>
        <span>></span><span><?php echo $menu[2]; ?></span>
        <span>></span><span><?php echo $menu[3]; ?></span>
        <span>></span><span><?php echo $is_add ? '添加' : '编辑'; ?></span>
    </div>
</div>
<div class="content_box">
    <div class="content form_content">
        <form action="<?php $oprate = $is_add ? 'add' : 'edit';$id = $status ? $status->status_id : '';echo site_url("cr_sm/$oprate/" . $id); ?>"  method="post">
            <table class="form_table">
                <col width="150px" />
                <col />
                <tr>
                    <th> 所属阶段：</th>
                    <td><select class="normal" style="width:auto" name="status_stage" >
                            <option value="0" <?php echo $status_stage == 0 ? 'selected="selected"' : '' ?>>未分配</option>
                            <option value="1" <?php echo $status_stage == 1 ? 'selected="selected"' : '' ?>>未处理</option>
                            <option value="2" <?php echo $status_stage == 2 ? 'selected="selected"' : '' ?>>跟进中</option>
                            <option value="3" <?php echo $status_stage == 3 ? 'selected="selected"' : '' ?>>有效客户</option>
                        </select>
                        <label>*选择客户状态所属的阶段.</label>
                        <b style="color:red"><?php echo form_error('status_stage'); ?></b></td>
                </tr>
                <tr>
                    <th> 状态名称：</th>
                    <td><input type="text" value="<?php echo $status ? $status->status_name : ''; ?>" name="status_name" style="width:150px" class="normal"><label>*2-10个汉字.</label>
                        <b style="color:red"><?php echo form_error('status_name'); ?></b></td>
                </tr>
                <tr>
                    <th> 状态介绍：</th>
                    <td><textarea name="status_post" class="normal"><?php echo $status ? $status->status_post : ''; ?></textarea><label>50个汉字内.</label>
                        <b style="color: red"><?php echo form_error('status_post'); ?></b></td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button class="submit" type='submit'><span><?php echo $is_add ? '添加' : '编辑'; ?>客户状态信息</span></button>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
