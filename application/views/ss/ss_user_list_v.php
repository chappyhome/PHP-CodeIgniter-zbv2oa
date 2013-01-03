<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<form id="pagerForm" method="post" action="<?php echo site_url('ss_user/view'); ?>">
    <input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo $numPerPage; ?>" />
    <!--<input type="hidden" name="orderField" value="" />-->
    <!--<input type="hidden" name="orderDirection" value="asc" />-->
    <input type="hidden" name="role" value="<?php echo $role; ?>" />
</form>
<div class="pageHeader">
    <form id="role_form" onsubmit="return navTabSearch(this);" action="<?php echo site_url('ss_user/view'); ?>" method="post">
        <div class="searchBar">
            <ul class="searchContent">
                <li>
                    <select class="select" name="role">
                        <option value="0">选择用户组</option>
                        <?php foreach ($roles as $k => $r): ?>
                            <option <?php echo $role == $k ? 'selected="selected"' : '' ?> value="<?php echo $k; ?>">
                                <?php echo $r; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </li>
            </ul>
            <div class="subBar">
                <ul>
                    <li><div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div></li>
                </ul>
            </div>
        </div>
    </form>
</div>
<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" href="<?php echo site_url('ss_user/add_em_user'); ?>" target="navTab"><span>添加</span></a></li>
            <li><a class="edit" href="<?php echo site_url('ss_user/edit') . '/'; ?>{user_id}" target="navTab" mask="true" warn="请选择用户!"><span>修改</span></a></li>
            <li><a class="icon" href="<?php echo site_url('ss_user/stop') . '/'; ?>{user_id}" target="ajaxTodo" mask="true" warn="请选择用户!"><span>冻结</span></a></li>
            <li><a class="delete" href="<?php echo site_url('ss_user/del') . '/'; ?>{user_id}" target="ajaxTodo" mask="true" warn="请选择用户!" title="确定要删除吗?"><span>删除</span></a></li>
            <li class="line">line</li>
            <li><a class="icon" href="#" target="dwzExport" targetType="navTab" title="导出这些记录吗?"><span>导出EXCEL</span></a></li>
        </ul>
    </div>
    <table class="table" width="100%" layoutH="138">
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
                    <td><?php echo $v->fullname ? $v->fullname : '[ 外部用户 ]'; ?></td>
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
