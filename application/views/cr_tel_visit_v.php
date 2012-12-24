<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="headbar">
    <div class="position"><span><?php $menu = $this->acl->current_location();
echo $menu[1]; ?></span>
        <span>></span><span><?php echo $menu[2]; ?></span>
        <?php if($menu[3]){?><span>></span><span><?php echo $menu[3]; ?></span><?php } ?>
        <span>></span><span>添加回访记录</span>
    </div>
    <div class="operating">
        <form action="<?php echo site_url('cr_tel/visit/'.$customer['customer_id']); ?>"  method="post">
        <a class="hack_ie"><button class="operating_btn" type='submit'><span class="addition">录入回访记录</span></button></a>
        <div class="f_l">
            <textarea class="topbar" name="visit_message"></textarea>
            <label> 60个汉字内.</label>
            <b class="f_r" style="color: red;padding:26px 0 0 5px;"><?php echo form_error('visit_message'); ?></b>
            
        </div>
        </form>
    </div>
    <div class="">
        <table class="list_table">
            <col width="15px" />
            <col />
            <thead id="customer_detail" style="width:100%;" class="t_l">
                <tr>
                    <td></td>
                    <td style="width: 70px;"> 客户姓名：</td><td style="width:15%;">
                        <?php echo $customer['customer_name']; ?>
                    </td>
                    <td style="width: 70px;"> 客户电话：</td><td style="width:15%;">
                        <?php echo $customer['tel']; ?>
                    </td>
                    <td style="width: 70px;"> 客户来源：</td><td>
                        <?php echo $customer['from_name']; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 70px;"> 客户状态：</td><td style="width:15%;">
                        <?php echo $customer['status_name']; ?>
                    </td>
                    <td style="width: 70px;"> 客户渠道：</td><td style="width:15%;">
                        <?php echo $customer['channel']?$customer['channel']:'[暂无]'; ?>
                    </td>
                    <td style="width: 70px;"> 代理品牌：</td><td style="width:100%;">
                        <?php echo $customer['brand']?$customer['brand']:'[暂无]'; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 70px;">客户地址：</td>
                    <td colspan="5"><?php echo $customer['address']?$customer['address']:'[暂无]'; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 70px;">意向备注：</td>
                    <td colspan="5"><?php echo $customer['intention']?$customer['intention']:'[暂无]'; ?><td>
                </tr>
            </thead>
        </table>
    </div>
    <div class="field">
        <table class="list_table">
            <col width="40px" />
            <col />
            <thead>
                <tr>
                    <th style="width:15%;">时间</th>
                    <th style="width:10%;">回访人</th>
                    <th style="width:65%;">回访记录</th>
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
            
            <?php foreach ($list as $v) : ?>
            <tr>
                <td class="t_c" style="width:4%; white-space: normal;"><?php echo $v->create_time; ?></td>
                <td class="t_c" style="width:10%;" title="<?php $user_detail = explode(':', $v->user_detail);echo $user_detail[1]; ?>">
                    <?php $user_detail = explode(':', $v->user_detail);echo $user_detail[0]; ?>
                </td>
                <td class="t_c" style="width:64%; white-space: normal;"><?php echo $v->visit_message; ?></td>
                <td class="t_c" style="width:10%;">
                    <a class="confirm_delete" href="<?php echo site_url('cr_tel/del_visit/'.$customer['customer_id'].'/'.$v->visit_id); ?>"><img class="operator" src="theme/images/icon_del.gif" alt="删除" title="删除"></a>
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