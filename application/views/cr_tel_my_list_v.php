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
    <div class="position"><span><?php $menu = $this->acl->current_location();
echo $menu[1]; ?></span>
        <span>></span><span><?php echo $menu[2]; ?></span>
        <span>></span><span><?php echo $menu[3]?$menu[3]:''; ?></span>
        <span>></span><span>列表</span>
    </div>
    <div class="operating">
        <a class="hack_ie" href="<?php echo site_url('cr/add_customer'); ?>"><button class="operating_btn" type="button"><span class="addition">录入新客户资源</span></button></a>
        <div class="search f_r">
            <select class="normal" id="province" style="width:auto" name="province_id" onchange="location='<?php echo site_url('cr_tel/my') . '?province='; ?>'+this.value;">
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
                <td  onclick="get_customer_detail(<?php echo $v->customer_id; ?>)" style="width: 1%"></td>
                <td  onclick="get_customer_detail(<?php echo $v->customer_id; ?>)" style="width:8%;"><?php echo $v->customer_name; ?></td>
                <td  onclick="get_customer_detail(<?php echo $v->customer_id; ?>)" style="width:8%;"><?php echo $v->tel; ?></td>
                <td  onclick="get_customer_detail(<?php echo $v->customer_id; ?>)" style="width:18%;"><?php echo $v->address; ?></td>
                <td  onclick="get_customer_detail(<?php echo $v->customer_id; ?>)" style="width:6%;"><?php echo $v->from_name; ?></td>
                <td  onclick="get_customer_detail(<?php echo $v->customer_id; ?>)" style="width:9%;"><?php echo $v->status_name; ?></td>
                <td  onclick="get_customer_detail(<?php echo $v->customer_id; ?>)" style="width:7%;"><?php echo $v->channel ? $v->channel : '[暂无]'; ?></td>
                <td  onclick="get_customer_detail(<?php echo $v->customer_id; ?>)" style="width:8%;"><?php echo $v->brand ? $v->brand : '[暂无]'; ?></td>
                <td  onclick="get_customer_detail(<?php echo $v->customer_id; ?>)" style="width:22%;"><?php echo $v->intention ? $v->intention : '[暂无]'; ?></td>
                <td style="width:9%;">
                    <a href="<?php echo site_url('cr_tel/visit/' . $v->customer_id); ?>"><img class="operator" src="theme/images/icon_refresh.gif" alt="回访" title="回访"></a>
                    <a href="<?php echo site_url('em/edit/' . $v->customer_id); ?>"><img class="operator" src="theme/images/icon_edit.gif" alt="修改" title="修改"></a>
                    <a class="confirm_delete" href="<?php echo site_url('em/del/' . $v->customer_id); ?>"><img class="operator" src="theme/images/icon_del.gif" alt="删除" title="删除"></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="pages_bar pagination"><?php echo $pagination; ?></div>
<script language="javascript">
    $('a.confirm_delete').click(function(){
        return confirm('是否要删除所选信息？');
    });
</script>