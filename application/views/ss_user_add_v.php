<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $current_tab = $this->input->get('tab') ? $this->input->get('tab') : 'add_em_user'; ?>
<div class="headbar">
    <div class="position"><span><?php $menu = $this->acl->current_location();
echo $menu[1]; ?></span>
        <span>></span><span><?php echo $menu[2]; ?></span>
        <span>></span><span><?php echo $menu[3]; ?></span>
        <span>></span><span>添加</span>
    </div>
    <ul class='tab' name='conf_menu'>
        <li <?php echo $current_tab == 'add_em_user' ? 'class="selected"' : ''; ?>><a href="javascript:void(0);" onclick="select_tab('add_em_user',this);">员工用户</a></li>
        <li <?php echo $current_tab == 'user_add' ? 'class="selected"' : ''; ?>><a href="javascript:void(0);" onclick="select_tab('user_add',this);">外部用户</a></li>
    </ul>
</div>
<div class="content_box">
    <div class="content form_content">
        <form action="<?php echo site_url('ss_user/add_em_user').'?tab=add_em_user'; ?>"  method="post">
            <table class="form_table _tabs" id="add_em_user"  style="<?php echo $current_tab == 'add_em_user' ? '' : 'display:none'; ?>" >
                <col width="150px" />
                <col />
                <tr>
                    <th> 所属部门：</th>
                    <td>
                        <select class="normal" style="width:auto" name="role" onchange="location='<?php echo site_url('ss_user/add_em_user'); ?>/'+this.value;">
                            <option value="">选择部门</option>
                            <?php foreach ($departments as $k => $r): ?>
                                <option <?php echo $department_id == $k ? 'selected="selected"' : '' ?> value="<?php echo $k; ?>"><?php echo $r; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label>*选择员工所属部门.</label>
                    </td>
                </tr>
                <tr>
                    <th> 员工：</th>
                    <td>
                        <?php if(!empty($list)) { ?>
                        <?php foreach($list as $key) { ?>
                        <input type="radio" name="user_id" value="<?php echo $key->user_id; ?>" /><?php echo $key->fullname; ?>&nbsp;&nbsp;
                        <?php } ?>
                        <?php } ?>   
                        <label>*选择要设置账号的用户.</label>
                        <b style="color:red"><?php echo form_error('user_id'); ?></b></td>
                </tr>
                <tr>
                    <th> 用户名：</th>
                    <td><input type="text" value="" name="user_name" style="width:150px" class="normal"><label>*4-20位用户名.</label>
                        <b style="color:red"><?php echo form_error('user_name'); ?></b></td>
                </tr>
                <tr>
                    <th> 用户密码：</th>
                    <td><input type="password" value="" name="password" style="width:150px" class="normal"><label>*6-16位用户密码.</label>
                        <b style="color:red"><?php echo form_error('password'); ?></b></td>
                </tr>
                <tr>
                    <th> 重复用户密码：</th>
                    <td><input type="password" value="" name="confirm_password" style="width:150px" class="normal"><label>*6-16位用户密码.</label>
                        <b style="color:red"><?php echo form_error('confirm_password'); ?></b></td>
                </tr>
                <tr>
                    <th> 用户组：</th>
                    <td>
                    <select class="normal" style="width:auto" name="role_id" >
                    <?php foreach ($roles as $k => $r): ?>
                        <option value="<?php echo $k; ?>"><?php echo $r; ?></option>
                    <?php endforeach; ?>
                    </select>
                        <label>*选择所属用户权限组.</label>
                        <b style="color:red"><?php echo form_error('role_id'); ?></b></td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <?php if(!empty($list)) { ?>
                        <button class="submit" type='submit'><span>添加用户</span></button>
                        <?php } ?>
                    </td>
                </tr>
                
            </table>
        </form>
        <form action="<?php echo site_url('ss_user/add_user').'?tab=user_add'; ?>"  method="post">
            <table class="form_table _tabs" id="user_add" style="<?php echo $current_tab == 'user_add' ? '' : 'display:none'; ?>" >
                <col width="150px" />
                <col />
                <tr>
                    <th> 用户名：</th>
                    <td><input type="text" value="" name="user_name" style="width:150px" class="normal"><label>*4-20位用户名.</label>
                        <b style="color:red"><?php echo form_error('user_name'); ?></b></td>
                </tr>
                <tr>
                    <th> 用户密码：</th>
                    <td><input type="password" value="" name="password" style="width:150px" class="normal"><label>*6-16位用户密码.</label>
                        <b style="color:red"><?php echo form_error('password'); ?></b></td>
                </tr>
                <tr>
                    <th> 重复用户密码：</th>
                    <td><input type="password" value="" name="confirm_password" style="width:150px" class="normal"><label>*6-16位用户密码.</label>
                        <b style="color:red"><?php echo form_error('confirm_password'); ?></b></td>
                </tr>
                <tr>
                    <th> 用户组：</th>
                    <td>
                    <select class="normal" style="width:auto" name="role_id" >
                    <?php foreach ($roles as $k => $r): ?>
                        <option value="<?php echo $k; ?>"><?php echo $r; ?></option>
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
