<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="pageContent">
    <form method="post" action="<?php echo site_url('ss/company/submit'); ?>" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
        <div class="pageFormContent nowrap" layoutH="56">
            <dl>
                <dt>企业名称：</dt>
                <dd><input name="company_name" class="textInput required" type="text" style="width:188px" value="<?php echo $info->company_name; ?>" /></dd>
            </dl>
            <dl>
                <dt>企业地址：</dt>
                <dd><input name="company_address" class="required textInput" type="text" style="width:188px" value="<?php echo $info->company_address; ?>" /></dd>
            </dl>
            <dl>
                <dt>企业网址：</dt>
                <dd><input name="company_site" class="textInput required url" type="text" style="width:188px" value="<?php echo $info->company_site; ?>" alt="请输入网址"/></dd>
            </dl>
            <dl>
                <dt>企业微博：</dt>
                <dd><input name="company_weibo" class="textInput required url" type="text" style="width:188px" value="<?php echo $info->company_weibo; ?>" alt="请输入网址"/></dd>
            </dl>
            <dl>
                <dt>企业电话：</dt>
                <dd><textarea  name="company_tel" class="textArea required" style="height:70px; width:188px; overflow-y:hidden"><?php echo $info->company_tel; ?></textarea>
            </dl>
        </div>
        <div class="formBar">
            <ul>
                <li>
                    <div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div>
                </li>
                <li>
                    <div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
                </li>
            </ul>
        </div>
    </form>
</div>
