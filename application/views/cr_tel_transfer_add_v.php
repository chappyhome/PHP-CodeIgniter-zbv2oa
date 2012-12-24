<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="headbar">
    <div class="position"><span><?php $menu = $this->acl->current_location();echo $menu[1]; ?></span>
        <span>></span><span><?php echo $menu[2]; ?></span>
        <span>></span><span><?php echo $menu[3]; ?></span>
        <span>></span><span>申请</span>
    </div>
</div>
<div class="content_box">
    <div class="content form_content">
        <form action="<?php echo site_url('cr_tel/transfer').'/'.$customer['customer_id']; ?>"  method="post">
            <table class="form_table">
                <col width="150px" />
                <col />
                <tr>
                    <th> 被转移客户：</th>
                    <td><input type="text" readonly="readonly" name="customer" value="<?php echo $customer['customer_name']; ?>" style="width:150px" class="normal readonly"><label>被转移客户的姓名</label>
                    </td>
                </tr>
                <tr>
                    <th> 原负责人：</th>
                    <td><input type="text" readonly="readonly" name="old_user" value="<?php echo $customer['user_detail']; ?>" style="width:150px" class="normal readonly"><label>原负责人姓名与电话</label>
                    </td>
                </tr>
                <tr>
                    <th> 新负责人：</th>
                    <td>
                        <select class="normal" id="from" style="width:auto" name="new_user">
                            <option selected="selected" value="">请选择员工</option>
                            <?php foreach ($user_list as $key): ?>
                                <option value="<?php echo $key->user_id.':'.$key->fullname; ?>"><?php echo $key->fullname; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label><span style="color:red">*</span> 新负责人.</label>
                        <b style="color:red"><?php echo form_error('new_user'); ?></b>
                    </td>
                </tr>
                <tr>
                    <th> 备注信息：</th>
                    <td><textarea name="transfer_message" class="normal"></textarea><label><span style="color:red">*</span> 转移备注.</label>
                        <b style="color:red"><?php echo form_error('transfer_message'); ?></b></td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button class="submit" type='submit'><span>申请转移</span></button>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
