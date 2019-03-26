#### 在配置文件中配置config.php
```
'exception_handle'       => '\app\api\common\lib\exception\ApiHandleException',
'app_debug'              => false, //控制是系统的异常显示还是封装的
```
#### 图片用到的是千牛云

通过composer 去下载扩展

#### 短信是用的阿里大鱼

#### controller文件下的v1只是作为参考的写法，不做任何处理
#### 通用的数据字典
```
//异常表
CREATE TABLE `ayi_api_crash`(
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `app_type` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'ios或android',
  `version_code` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '外部版本号',
  `model` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '设备型号',
  `did` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '识别号',
  `type` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `description` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '错误信息',
  `line` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '影响的行数',
  `create_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updata_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '最后的时间',
  PRIMARY KEY(`id`)
) ENGINE = InnoDB;
//app的升级表
CREATE TABLE `ayi_version` ( 
`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键' ,
`app_type` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'app的类型ios，android' ,
`version` INT(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '内部版本号' , 
`version_code` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '外部版本号' , 
`is_force`TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '1强制更新，0不做处理', 
`apk_url` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '更新的url' , 
`upgrade_point` VARCHAR(500)CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT'更新提示' , 
`status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '状态' ,`create_time` INT(10) NOT NULL DEFAULT '0' COMMENT '创建的时间' ,
`updata_time` INT(10) NOT NULL DEFAULT '0' COMMENT '更新的时间' ,PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT = 'app版本升级表';
//记录用户使用的版本
CREATE TABLE `ayi_version_active` ( 
`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键' , 
`version` INT(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '内部版本号' , 
`app_type` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'app类型',
`version_code` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '外部版本号' , 
`did` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '设备号' ,
`create_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT'创建时间' ,
`updata_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间' ,
`uid` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户的id' , 
PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT = '记录现用的设备号'

//用户表只作为参考
CREATE TABLE `tp2`.`ayi_user`(
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `password` CHAR(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '密码',
  `phone` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '手机号码',
  `token` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'token',
  `time_out` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'token的失效时间',
  `image` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '头像',
  `sex` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0表示女,1表示男',
  `signature` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '个性签名',
  `create_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updata_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `status` TINYINT(1)  NOT NULL DEFAULT '0' COMMENT '-1删除,0限制,1正常',
  PRIMARY KEY(`id`),
  INDEX(`password`),
  INDEX(`token`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT = '用户表';

```

####  在common.php添加显示json数据的逻辑
```
/**
 * 通用化API接口数据输出
 * @param int $status 业务状态码
 * @param string $message 信息提示
 * @param [] $data  数据
 * @param int $httpCode http状态码
 * @return array
 */
function show($status, $message, $data=[], $httpCode=200) {

    $data = [
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ];

    return json($data, $httpCode);
}
```
