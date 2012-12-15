<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#customer_detail").dblclick(
            function(){$("#customer_detail").hide('slow');}
        )
    })
    function get_customer_detail(customer_id){
        $("#customer_detail").show('slow');
        $.get('<?php echo site_url('cr_tel/ajax'); ?>',{'customer_id':customer_id},function(data){
            $("#customer_name").html(data.customer_name);
            $("#tel").html(data.tel);
            $("#address").html(data.address);
            $("#channel").html(data.channel);
            $("#brand").html(data.brand);
            $("#intention").html(data.intention);
        },'json');
    }
</script>
<div class="headbar">
    <div class="position"><span><?php
$menu = $this->acl->current_location();
echo $menu[1];
?></span>
        <span>></span><span><?php echo $menu[2]; ?></span>
        <span>></span><span><?php echo $menu[3]; ?></span>
        <span>></span><span>添加</span>
    </div>
    <div class="operating">
        <a href="javascript:void(0)" onclick="selectAll('customer_id[]');"><button class="operating_btn" type="button"><span class="sel_all">全选</span></button></a>
        <a href="javascript:;" onclick="$('#cache_form').submit();"><button class="operating_btn" type="button"><span class="remove">更新</span></button></a>
        <div class="search f_r">
            <select class="normal" id="from" style="width:auto" name="from_id" onchange="location='<?php echo current_url() . '?from_id='; ?>'+this.value+'&province='+$('#province').val()">
                <option selected="selected" value="">请选择来源</option>
                <?php foreach ($from as $key): ?>
                    <option <?php echo $from_now == $key->from_id ? 'selected="selected"' : '' ?> value="<?php echo $key->from_id; ?>"><?php echo $key->from_name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="search f_r">
            <select class="normal" id="province" style="width:auto" name="province_id" onchange="location='<?php echo current_url() . '?province='; ?>'+this.value+'&from_id='+$('#from').val()">
                <option selected="selected" value="">请选择省份</option>
                <?php foreach ($province as $key): ?>
                    <option <?php echo $province_now == $key->name ? 'selected="selected"' : '' ?> value="<?php echo $key->name; ?>"><?php echo $key->name; ?></option>
<?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="field">
        <table class="list_table">
            <col width="40px" />
            <col />
            <thead>
                <tr>
                    <th style="width:7%;">选择</th>
                    <th style="width:7%;">姓名</th>
                    <th style="width:8%;">电话</th>
                    <th style="width:20%;">地址</th>
                    <th style="width:5%;">来源</th>
                    <th style="width:10%;">状态</th>
                    <th style="width:5%;">渠道</th>
                    <th style="width:10%;">代理品牌</th>
                    <th style="width:23%;">意向</th>
                    <th style="width:10%;">操作选项</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="content">
    <form name='cache_form' id="cache_form" method='post' action='<?php echo site_url('ss_cache/cache'); ?>'>
        <table id="list_table" class="list_table">
            <col width="40px" />
            <col />
            <tbody>
                <tr id="customer_detail" style="background-color:#ffc;width:100%;display:none;">
                    <td colspan="10">
                        <div>
                            <ul>
                                <li><b>客户姓名</b>：</li>
                                <li id="customer_name"></li>
                            </ul>
                            <ul>
                                <li><b>代理品牌</b>：</li>
                                <li id="brand"></li>
                            </ul>
                            <ul>
                                <li><b>客户地址</b>：</li>
                                <li id="address"></li>
                            </ul>
                            <ul>
                                <li><b>意向备注</b>：</li>
                                <li id="intention"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
<?php foreach ($list as $v) : ?>
                    <tr>
                        <td><input type="checkbox" value="<?php echo $v->customer_id; ?>" name="customer_id[]" /></td>
                        <td  onclick="get_customer_detail(<?php echo $v->customer_id; ?>)" style="width:8%;"><?php echo $v->customer_name; ?></td>
                        <td  onclick="get_customer_detail(<?php echo $v->customer_id; ?>)" style="width:8%;"><?php echo $v->tel; ?></td>
                        <td  onclick="get_customer_detail(<?php echo $v->customer_id; ?>)" style="width:17%;"><?php echo $v->address; ?></td>
                        <td  onclick="get_customer_detail(<?php echo $v->customer_id; ?>)" style="width:6%;"><?php echo $v->from_name; ?></td>
                        <td  onclick="get_customer_detail(<?php echo $v->customer_id; ?>)" style="width:9%;"><?php echo $v->status_name; ?></td>
                        <td  onclick="get_customer_detail(<?php echo $v->customer_id; ?>)" style="width:7%;"><?php echo $v->channel ? $v->channel : '[暂无]'; ?></td>
                        <td  onclick="get_customer_detail(<?php echo $v->customer_id; ?>)" style="width:8%;"><?php echo $v->brand ? $v->brand : '[暂无]'; ?></td>
                        <td  onclick="get_customer_detail(<?php echo $v->customer_id; ?>)" style="width:20%;"><?php echo $v->intention ? $v->intention : '[暂无]'; ?></td>
                        <td style="width:9%;">
                            <a href="<?php echo site_url('em/edit/' . $v->customer_id); ?>"><img class="operator" src="theme/images/icon_edit.gif" alt="修改" title="修改"></a>
                            <a class="confirm_delete" href="<?php echo site_url('em/del/' . $v->customer_id); ?>"><img class="operator" src="theme/images/icon_del.gif" alt="删除" title="删除"></a>
                        </td>
                    </tr>
<?php endforeach; ?>
            </tbody>
        </table>
    </form>
</div>