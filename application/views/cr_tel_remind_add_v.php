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
        <form action="<?php echo site_url('cr_tel/add_remind').'/'.$customer['customer_id']; ?>"  method="post">
            <table class="form_table">
                <col width="150px" />
                <col />
                <tr>
                    <th> 客户：</th>
                    <td><input type="text" readonly="readonly" value="<?php echo $customer['customer_name']; ?>" style="width:150px" class="normal readonly"><label>客户姓名</label>
                    </td>
                </tr>
                <tr>
                    <th> 备忘：</th>
                    <td><textarea name="remind_content" class="normal"></textarea><label><span style="color:red">*</span> 回访备忘记录.</label>
                        <b style="color:red"><?php echo form_error('remind_content'); ?></b></td>
                </tr>
                <tr>
                    <th> 提醒日期：</th>
                    <td><input class="Wdate" style="width:150px;" type="text" name="remind_date"
                  onFocus="WdatePicker({dateFmt:'yyyy-MM-dd',isShowClear:false,readOnly:true})" ><label><span style="color:red">*</span> 要回访的日期.</label>
                        <b style="color:red"><?php echo form_error('remind_date'); ?></b></td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button class="submit" type='submit'><span>添加回访提醒</span></button>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
