<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="headbar">
    <div class="position"><span><?php $menu = $this->acl->current_location();echo $menu[1]; ?></span>
        <span>></span><span><?php echo $menu[2]; ?></span>
        <span>></span><span><?php echo $menu[3]; ?></span>
        <span>></span><span>列表</span>
    </div>
    <div class="operating">
        <a class="hack_ie" href="<?php echo site_url('em/add'); ?>"><button class="operating_btn" type="button"><span class="addition">录入员工信息</span></button></a>
        <div class="search f_r">
            <form name="serachuser" action="<?php echo site_url('em/view'); ?>" method="get">
                <select class="normal" style="width:auto" name="role" onchange="location='<?php echo site_url('em/view'); ?>/'+this.value;">
                    <option value="">选择部门</option>
                    <?php foreach ($departments as $k => $r): ?>
                        <option <?php echo $department_id == $k ? 'selected="selected"' : '' ?> value="<?php echo $k; ?>"><?php echo $r; ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
    </div>
    <div class="field">
        <table class="list_table">
            <col width="40px" />
            <col />
            <thead>
                <tr>
                    <th></th>
                    <th>姓名</th>
                    <th>用户名称</th>
                    <th>电话</th>
                    <th>职位</th>
                    <th>入职时间</th>
                    <th>状态</th>
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
                    <td><?php echo $v->fullname; ?></td>
                    <td><?php echo $v->user_name?$v->user_name:'[ 暂无 ]'; ?></td>
                    <td><?php echo $v->tel; ?></td>
                    <td><?php echo $v->post; ?></td>
                    <td><?php echo $v->entry_time; ?></td>
                    <td><?php echo $v->is_leave?'<b style="color:red">离职</b>':'正常'; ?></td>
                    <td>
                        <a href="<?php echo site_url('em/edit/' . $v->user_id); ?>"><img class="operator" src="theme/images/icon_edit.gif" alt="修改" title="修改"></a>
                        <a class="confirm_delete" href="<?php echo site_url('em/del/' . $v->user_id); ?>"><img class="operator" src="theme/images/icon_del.gif" alt="删除" title="删除"></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="pages_bar pagination"><?php echo $pagination; ?></div>
<script language="javascript">
    $('a.confirm_delete').click(function(){
        return confirm('是否要删除所选用户？');
    });
</script>