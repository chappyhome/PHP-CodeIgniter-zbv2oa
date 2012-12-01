<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
 <script language="javascript" src="theme/js/DatePicker/WdatePicker.js"></script>
<div class="headbar">
    <div class="position"><span><?php $menu = $this->acl->current_location();echo $menu[1]; ?></span>
        <span>></span><span><?php echo $menu[2]; ?></span>
        <span>></span><span><?php echo $menu[3]; ?></span>
        <span>></span><span>添加</span>
    </div>
</div>
<div class="content_box">
    <div class="content form_content">
        <form action="<?php echo site_url('em/add'); ?>"  method="post">
            <table class="form_table">
                <col width="150px" />
                <col />
                <tr>
                    <th> 姓名：</th>
                    <td><input type="text" value="" name="fullname" style="width:150px" class="normal"><label>*身份证姓名</label>
                        <b style="color:red"><?php echo form_error('fullname'); ?></b></td>
                </tr>
                <tr>
                    <th> 手机号码：</th>
                    <td><input type="text" value="" name="tel" style="width:150px" class="normal"><label>*11位手机号码.</label>
                        <b style="color:red"><?php echo form_error('tel'); ?></b></td>
                </tr>
                <tr>
                    <th> 常用邮箱：</th>
                    <td><input type="text" value="" name="email" style="width:150px" class="normal"><label>*有效的EMAIL地址.</label>
                        <b style="color:red"><?php echo form_error('email'); ?></b></td>
                </tr>
                <tr>
                    <th> 紧急联系人手机号码：</th>
                    <td><input type="text" value="" name="emergency_tel" style="width:150px" class="normal"><label>*11位手机号码.</label>
                        <b style="color:red"><?php echo form_error('emergency_tel'); ?></b></td>
                </tr>
                <tr>
                    <th> 现居地址：</th>
                    <td><input type="text" value="" name="address" style="width:150px" class="normal"><label>*目前居住地详细地址.</label>
                        <b style="color:red"><?php echo form_error('address'); ?></b></td>
                </tr>
                <tr>
                    <th> 身份证号码：</th>
                    <td><input type="text" value="" name="id_cart" style="width:150px" class="normal"><label>*18位身份证号码.</label>
                        <b style="color:red"><?php echo form_error('id_cart'); ?></b></td>
                </tr>
                <tr>
                    <th> 部门：</th>
                    <td>
                        <select class="normal" style="width:auto" name="department_id">
                            <?php foreach ($departments as $k => $r): ?>
                                <option value="<?php echo $k; ?>"><?php echo $r; ?></option><?php endforeach; ?>
                        </select><label>*选择所属部门.</label>
                        <b style="color:red"><?php echo form_error('department_id'); ?></b></td>
                </tr>
                <tr>
                    <th> 职位：</th>
                    <td><input type="text" value="" name="post" style="width:150px" class="normal"><label>*员工职位.</label>
                        <b style="color:red"><?php echo form_error('post'); ?></b></td>
                </tr>
                <tr>
                    <th> 入职时间：</th>
                    <td><input class="Wdate" style="width:150px;" type="text" name="entry_time"
                  onFocus="WdatePicker({isShowClear:false,readOnly:true})" ><label>*员工入职时间.</label>
                        <b style="color:red"><?php echo form_error('entry_time'); ?></b></td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button class="submit" type='submit'><span>录入员工</span></button>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
