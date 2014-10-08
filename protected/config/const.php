<?php
define('ERROR_NONE',0); //没有错误
define('ERROR_PARAM', 1); //缺少参数或者参数非法
define('ERROR_PASSWORD',2); //用户名或者密码错误
define('ERROR_EMPTY', 3); //数据为空
define('ERROR_FATAL',4); //致命错误。这一般是由服务器造成的
define('ERROR_SESSION', 5); //会话为空,用户ID获取失败
define('ERROR_EMAIL_HAS',6); //邮箱已经被注册
define('ERROR_BLACK',7); //对方已经将您添加到黑名单
?>