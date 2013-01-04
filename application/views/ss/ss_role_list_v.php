<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<form id="pagerForm" method="post" action="<?php echo site_url('ss_role/view'); ?>">
    <input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo $numPerPage; ?>" />
    <!--<input type="hidden" name="orderField" value="" />-->
    <!--<input type="hidden" name="orderDirection" value="asc" />-->
</form>
<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" href="<?php echo site_url('ss_role/add'); ?>" target="dialog"><span>添加</span></a></li>
            <li><a class="edit" href="<?php echo site_url('ss_role/edit') . '/'; ?>{user_id}" target="dialog" mask="true" warn="请选择用户组!"><span>修改</span></a></li>
            <li><a class="delete" href="<?php echo site_url('ss_role/del') . '/'; ?>{user_id}" target="ajaxTodo" mask="true" warn="请选择用户组!" title="确定要删除吗?"><span>删除</span></a></li>
            <li class="line">line</li>
            <li><a class="icon" href="#" target="dwzExport" targetType="navTab" title="导出这些记录吗?"><span>导出EXCEL</span></a></li>
        </ul>
    </div>
    <table class="table" width="100%" layoutH="76">
        <thead>
            <tr>
                <th width="120">用户组名称</th>
                <th>用户组描述</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $v) : ?>
                <tr target="user_id" rel="<?php echo $v->role_id; ?>">
                    <td><?php echo $v->role_name; ?></td>
                    <td><?php echo $v->role_desc; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="panelBar">
        <div class="pages">
            <span>每页显示</span>
            <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
                <option value="1" <?php echo $numPerPage == 1 ? 'selected="selected"' : '' ?> >1</option>
                <option value="10" <?php echo $numPerPage == 10 ? 'selected="selected"' : '' ?> >10</option>
                <option value="30" <?php echo $numPerPage == 30 ? 'selected="selected"' : '' ?> >30</option>
                <option value="50" <?php echo $numPerPage == 50 ? 'selected="selected"' : '' ?> >50</option>
            </select>
            <span>条 共<?php echo $total_rows; ?>条</span>
        </div>
        <div class="pagination" targetType="navTab" totalCount="<?php echo $total_rows; ?>" numPerPage="<?php echo $numPerPage; ?>" pageNumShown="10" currentPage="<?php echo $pageNum; ?>"></div>
    </div>
</div>
