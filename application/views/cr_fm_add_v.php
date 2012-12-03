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
        <form action="<?php echo site_url('cr_fm/add'); ?>"  method="post">
            <table class="form_table">
                <col width="150px" />
                <col />
                <tr>
                    <th> 关联员工所属部门：</th>
                    <td>
                        <select class="normal" style="width:auto" name="role" onchange="location='<?php echo site_url('cr_fm/add'); ?>/'+this.value;">
                            <option value="">选择部门</option>
                            <?php foreach ($departments as $k => $r): ?>
                                <option <?php echo $department_id == $k ? 'selected="selected"' : '' ?> value="<?php echo $k; ?>"><?php echo $r; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label>选择要关联员工所属部门.</label>
                    </td>
                </tr>
                <tr>
                    <th> 关联员工：</th>
                    <td>
                        <?php if(!empty($list)) { ?>
                        <?php foreach($list as $key) { ?>
                        <input type="radio" name="user_id" value="<?php echo $key->user_id; ?>" /><?php echo $key->fullname; ?>&nbsp;&nbsp;
                        <?php } ?>
                        <?php } ?>
                        <label>选择要关联来源的用户.</label>
                        <b style="color:red"><?php echo form_error('user_id'); ?></b></td>
                </tr>
                <tr>
                    <th> 来源名称：</th>
                    <td><input type="text" value="" name="from_name" style="width:150px" class="normal"><label>*2-10个汉字.</label>
                        <b style="color:red"><?php echo form_error('from_name'); ?></b></td>
                </tr>
                <tr>
                    <th> 业务点数：</th>
                    <td><input type="text" value="" name="rate" style="width:150px" class="normal"><label>数字1至99.</label>
                        <b style="color:red"><?php echo form_error('rate'); ?></b></td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button class="submit" type='submit'><span>添加来源</span></button>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
