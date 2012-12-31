<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<form id="pagerForm" method="post" action="demo_page1.html">
    <input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="${model.numPerPage}" />
    <input type="hidden" name="orderField" value="${param.orderField}" />
    <input type="hidden" name="orderDirection" value="asc" />
    <input type="hidden" name="role" value="${param.role}">
</form>
<div class="pageHeader">
    <form onsubmit="return navTabSearch(this);" action="demo_page1.html" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>
                        <select class="combox" name="role">
                            <option value="">选择用户组</option>
                            <?php foreach ($roles as $k => $r): ?>
                            <option <?php echo $role == $k ? 'selected="selected"' : '' ?> value="<?php echo $k; ?>"><?php echo $r; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>
<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" href="<?php echo site_url('ss_user/add_em_user'); ?>" target="navTab"><span>添加</span></a></li>
            <li><a class="edit" href="<?php echo site_url('ss_user/edit/'); ?>{user_id}" target="navTab"><span>修改</span></a></li>
            <li><a class="icon" href="<?php echo site_url('ss_user/stop/'); ?>{user_id}" target="ajaxTodo"><span>冻结</span></a></li>
            <li><a class="delete" href="<?php echo site_url('ss_user/del/'); ?>{user_id}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
            <li class="line">line</li>
            <li><a class="icon" href="#" target="dwzExport" targetType="navTab" title="导出这些记录吗?"><span>导出EXCEL</span></a></li>
        </ul>
    </div>
    <table class="table" width="100%" layoutH="112">
        <thead>
            <tr>
                <th width="80">用户名</th>
                <th width="120">员工姓名</th>
                <th>用户组</th>
                <th width="80" align="center">用户状态</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $v) : ?>
            <tr target="user_id" rel="<?php echo $v->user_id; ?>">
                <td><?php echo $v->user_name; ?></td>
                <td><?php echo $v->fullname?$v->fullname:'[ 外部用户 ]'; ?></td>
                <td><?php echo $v->role_name; ?></td>
                <td><?php echo $v->is_admin == 1 ? '正常' : '<b style="color:red">冻结</span>'; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="panelBar">
        <div class="pages">
            <span>每页显示</span>
            <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <span>条，共<?php echo $total_rows; ?>条</span>
        </div>
        <div class="pagination" targetType="navTab" totalCount="<?php echo $total_rows; ?>" numPerPage="2" pageNumShown="10" currentPage="1"></div>
    </div>
</div>
