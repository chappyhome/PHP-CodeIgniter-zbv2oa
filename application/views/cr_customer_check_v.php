<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script type="text/javascript">
    function district(level){
        if(level == 0){
            $("#district").hide();$("#district_tg").show('slow');
        }
        if(level == 1){
            $("#district_tg").hide();$("#district").show('slow');
        }
        if(level == 2){
            $("#district_tg").hide();$("#district").show('slow');
        }
        if(level == 3){
            $("#district_tg").hide();$("#district").show('slow');
        }
    }
    function queryCity(province){
        $.get('<?php echo site_url('cr/ajax'); ?>',{'province':province},function(data){$("._city").replaceWith(data);},'html');
    }
    function queryCity_address(province){
        $.get('<?php echo site_url('cr/ajax/1'); ?>',{'province':province},function(data){$("._city_address").replaceWith(data);},'html');
    }
    function queryArea(city){
        $.get('<?php echo site_url('cr/ajax'); ?>',{'city':city},function(data){$("._area").replaceWith(data);},'html');
    }
    function queryArea_address(city){
        $.get('<?php echo site_url('cr/ajax/1'); ?>',{'city':city},function(data){$("._area_address").replaceWith(data);},'html');
    }
</script>
<?php $current_tab = $this->input->get('tab') ? $this->input->get('tab') : 'check_customer'; ?>
<div class="headbar">
    <div class="position"><span><?php $menu = $this->acl->current_location();
echo $menu[1]; ?></span>
        <span>></span><span><?php echo $menu[2]; ?></span>
        <span>></span><span><?php echo $menu[3]; ?></span>
        <span>></span><span>查询</span>
    </div>
    <ul class='tab' name='conf_menu'>
        <li <?php echo $current_tab == 'check_customer' ? 'class="selected"' : ''; ?>><a href="javascript:void(0);" onclick="select_tab('check_customer',this);">查询客户</a></li>
        <li <?php echo $current_tab == 'result_customer' ? 'class="selected"' : ''; ?>><a href="javascript:void(0);" onclick="select_tab('result_customer',this);">客户列表</a></li>
    </ul>
</div>
<div class="content_box">
    <div class="content form_content">
        <form action="<?php echo site_url('cr/check_customer') . '?tab=check_customer'; ?>"  method="post">
            <table class="form_table _tabs" id="check_customer" style="<?php echo $current_tab == 'check_customer' ? '' : 'display:none'; ?>" >
                <col width="150px" />
                <col />
                
                <tr id="district">
                    <th> 代理地区：</th>
                    <td>
                        <select class="normal" style="width:auto" id="province" name="province_id" onchange="queryCity(this.options[this.selectedIndex].value)">
                            <option selected="selected" value="">选择省份</option>
                            <?php foreach ($province as $key): ?>
                                <option value="<?php echo $key->id.':'.$key->name; ?>"><?php echo $key->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="_city"></span>
                        <span class="_area"></span>
                        <label> 选择代理地区.</label>
                    </td>
                </tr>
                <tr>
                    <th> 客户负责人：</th>
                    <td>
                        <select class="normal" style="width:auto" name="user_id" >
                            <option value="">选择负责人</option>
                            <?php foreach ($em_user as $key): ?>
                                <option value="<?php echo $key->user_id; ?>"><?php echo $key->fullname; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label> 选择客户负责人.</label>
                        <b style="color:red"><?php echo form_error('user_id'); ?></b>
                    </td>
                </tr>
                <tr>
                    <th> 客户来源：</th>
                    <td>
                        <select class="normal" style="width:auto" name="from_id" >
                            <option value="">选择来源</option>
                            <?php foreach ($from as $key): ?>
                                <option value="<?php echo $key->from_id; ?>"><?php echo $key->from_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label> 选择来源.</label>
                        <b style="color:red"><?php echo form_error('from_id'); ?></b>
                    </td>
                </tr>
                <tr>
                    <th> 客户状态：</th>
                    <td>
                        <select class="normal" style="width:auto" name="status_id" >
                            <option value="">选择状态</option>
                            <?php foreach ($status as $key): ?>
                                <option value="<?php echo $key->status_id; ?>"><?php echo $key->status_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label> 选择客户状态.</label>
                        <b style="color:red"><?php echo form_error('status_id'); ?></b></td>
                </tr>
                <tr>
                    <th> 客户分组：</th>
                    <td>
                        <select class="normal" style="width:auto" name="class_id" >
                            <option value="">选择分组</option>
                            <?php foreach ($class as $key): ?>
                                <option value="<?php echo $key->class_id; ?>"><?php echo $key->class_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label> 选择客户分组.</label>
                        <b style="color:red"><?php echo form_error('class_id'); ?></b></td>
                </tr>
                <tr>
                    <th> 客户级别：</th>
                    <td>
                        <select class="normal" style="width:auto" name="level_id" >
                            <option value="">选择级别</option>
                            <?php foreach ($level as $key): ?>
                                <option value="<?php echo $key->level_id; ?>"><?php echo $key->level_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label> 选择客户级别.</label>
                        <b style="color:red"><?php echo form_error('level_id'); ?></b></td>
                </tr>
                <tr>
                    <th> 代理级别：</th>
                    <td>
                        <input type="radio" name="district_level" value="1"/> 省级 &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="district_level" value="2"/> 市级 &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="district_level" value="3"/> 市区级 &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="district_level" value="4"/> 县级 &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="district_level" value="5"/> 团购 &nbsp;&nbsp;&nbsp;
                        <label> 选择代理级别.</label>
                        <b style="color:red"><?php echo form_error('district_level'); ?></b>
                    </td>
                </tr>

                
                <tr id="district_tg" style="display:none;">
                    <th> 团购单位：</th>
                    <td><input type="text" value="" name="group_buy" style="width:150px" class="normal"><label> 团购单位或公司.</label>
                        <b style="color:red"><?php echo form_error('group_buy'); ?></b></td>
                </tr>
                <tr>
                    <th> 姓名：</th>
                    <td><input type="text" value="" name="customer_name" style="width:150px" class="normal"><label> 客户姓名或称呼.</label>
                        <b style="color:red"><?php echo form_error('customer_name'); ?></b></td>
                </tr>
                <tr>
                    <th> 电话：</th>
                    <td><input type="text" value="" name="tel" style="width:150px" class="normal"><label> 客户电话.</label>
                        <b style="color:red"><?php echo form_error('tel'); ?></b></td>
                </tr>
                 <tr>
                     <th> 地址：</th>
                     <td>
                        <input type="text" value="" name="address" style="width:150px" class="normal">
                        <label>客户所在地区.</label>
                        <b style="color:red"><?php echo form_error('address'); ?></b></td>
                </tr>
                <tr>
                    <th> 渠道：</th>
                    <td><input type="text" value="" name="channel" style="width:150px" class="normal"><label>客户渠道.</label>
                        <b style="color:red"><?php echo form_error('channel'); ?></b></td>
                </tr>
                <tr>
                    <th> 代理品牌：</th>
                    <td><input type="text" value="" name="brand" style="width:150px" class="normal"><label>客户目前代理品牌.</label>
                        <b style="color:red"><?php echo form_error('brand'); ?></b></td>
                </tr>
                <tr>
                    <th> 公司或行业：</th>
                    <td><input type="text" value="" name="company" style="width:150px" class="normal"><label>客户公司或者从事行业.</label>
                        <b style="color:red"><?php echo form_error('company'); ?></b></td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button class="submit" type='submit'><span> 搜索指定条件客户 </span></button>
                    </td>
                </tr>
            </table>
        </form>
        <form action="<?php echo site_url('cr/check_customer') . '?tab=result_customer'; ?>"  method="post">
            <table class="form_table _tabs" id="result_customer" style="<?php echo $current_tab == 'result_customer' ? '' : 'display:none'; ?>" >
                <col width="150px" />
                <col />
                
                
                
            </table>
        </form>
    </div>
</div>
