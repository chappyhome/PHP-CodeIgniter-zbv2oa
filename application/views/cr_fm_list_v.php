<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="headbar">
    <div class="position"><span><?php $menu = $this->acl->current_location();
echo $menu[1]; ?></span>
        <span>></span><span><?php echo $menu[2]; ?></span>
        <span>></span><span><?php echo $menu[3]; ?></span>
        <span>></span><span>列表</span>
    </div>
    <div class="operating">
        <a class="hack_ie" href="<?php echo site_url('cr_fm/add'); ?>"><button class="operating_btn" type="button"><span class="addition">添加客户来源</span></button></a>
    </div>
    <div class="field">
        <table class="list_table">
            <col width="40px" />
            <col />
            <thead>
                <tr>
                    <th></th>
                    <th>来源名称</th>
                    <th>客户数量</th>
                    <th>关联员工</th>
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
                <tr>
                    <td></td>
                    <td><?php echo $v->from_name; ?></td>
                    <td><?php echo $this->customer_from_m->get_from_user_num($v->from_id) ?></td>
                    <td><?php echo $v->fullname ? $v->fullname : '[无关联员工]'; ?></td>
                    <td>
                        <a href="<?php echo site_url('cr_fm/edit/' . $v->from_id . '?department_id=' . $v->department_id); ?>"><img class="operator" src="theme/images/icon_edit.gif" alt="修改" title="修改"></a>
                        <a class="confirm_delete" href="<?php echo site_url('cr_fm/del/' . $v->from_id); ?>"><img class="operator" src="theme/images/icon_del.gif" alt="删除" title="删除"></a>
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