<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script type="text/javascript">
    function get_customer_detail(customer_id){
        $.get('<?php echo site_url('cr_tel/ajax'); ?>',{'customer_id':customer_id},function(data){
             $("#qqq").html(data.tel);
        
        },'json');
    }
</script>
<div class="headbar">
    <div class="position"><span><?php $menu = $this->acl->current_location();echo $menu[1]; ?></span>
        <span>></span><span><?php echo $menu[2]; ?></span>
        <span>></span><span><?php echo $menu[3]; ?></span>
        <span>></span><span>列表</span>
    </div>
    <div class="operating">
        <a class="hack_ie" href="<?php echo site_url('cr/add_customer'); ?>"><button class="operating_btn" type="button"><span class="addition">录入新客户资源</span></button></a>
        <div class="search f_r">
                <select class="normal" id="province" style="width:auto" name="province_id" onchange="location='<?php echo site_url('cr_tel/my').'?province='; ?>'+this.value;">
                    <option selected="selected" value="">请选择省份</option>
                            <?php foreach ($province as $key): ?>
                                <option <?php echo $province_now == $key->name ? 'selected="selected"' : '' ?> value="<?php echo $key->name; ?>"><?php echo $key->name; ?></option>
                            <?php endforeach; ?>
                </select>
                <span class="_city"></span>
        </div>
    </div>
    <div class="field">
        <table class="list_table">
            <col width="40px" />
            <col />
            <thead>
                <tr>
                    <th></th>
                    <th>姓名 <span style="color: #999;font-weight:normal">[点击查看详细]</span></th>
                    <th>电话</th>
                    <th>地址</th>
                    <th>来源</th>
                    <th>状态</th>
                    <th>渠道</th>
                    <th>代理品牌</th>
                    <th>意向</th>
                    <th>操作选项</th>
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
            <?php foreach ($list as $v) : ?>
                <div id="qqq" ></div>
                <tr>
                    <td></td>
                    <td onclick="get_customer_detail(<?php echo $v->customer_id; ?>)"><?php echo $v->customer_name; ?></td>
                    <td><?php echo $v->tel; ?></td>
                    <td><?php echo $v->address; ?></td>
                    <td><?php echo $v->from_name; ?></td>
                    <td><?php echo $v->status_name; ?></td>
                    <td><?php echo $v->channel?$v->channel:'[暂无]'; ?></td>
                    <td><?php echo $v->brand?$v->brand:'[暂无]'; ?></td>
                    <td><?php echo $v->intention?$v->intention:'[暂无]'; ?></td>
                    <td>
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