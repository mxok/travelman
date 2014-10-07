CREATE TABLE travel_user(
 `userId`      INT UNSIGNED  PRIMARY KEY  NOT NULL  AUTO_INCREMENT COMMENT ' 用户的唯一id,自增长',
 `username`    VARCHAR(255)   NOT NULL   COMMENT ' 用户名',
 `password`    CHAR(128)    NOT NULL  COMMENT ' 用户密码',
 `email`       VARCHAR(128) UNIQUE NOT NULL COMMENT ' 用户邮箱，唯一的。按理说作为手机来说，手机号码才是作为唯一索引的',
 `phoneNumber`  CHAR(18)       DEFAULT '' COMMENT '手机号，如果唯一的话就不能有默认值，只能通过代码来确保了',
 `registerDate` DATE        NOT NULL COMMENT ' 注册日期',
 `iemi`         CHAR(15)    NOT NULL DEFAULT '' COMMENT '用户手机的IEMI号码',
  `gender`      TINYINT(1)    NOT NULL   DEFAULT 1 COMMENT ' 0女1男',
  `session`     CHAR(32)    NOT NULL DEFAULT '' COMMENT 'session此参数将来会被废弃',
  `signText`    VARCHAR(45)   DEFAULT '' COMMENT ' 个性签名',
  `birthday`    DATE NOT NULL,
  `homeland`    VARCHAR(10)   DEFAULT '' COMMENT  '家乡,一旦注册将不会更改',
  `want2Go`     VARCHAR(255)  DEFAULT '' COMMENT  '想去哪 ',
  `school`      VARCHAR(10)   DEFAULT '' COMMENT  '学校',
  `beenThere`   VARCHAR(255)  DEFAULT '' COMMENT  '去过哪',
  `frequency`   TINYINT(1)    DEFAULT 1  COMMENT  '出行的频率,四种情况',
  `magazine`    VARCHAR(255)  DEFAULT '' COMMENT  '喜欢哪些旅行杂志',
  `hobbyText`   VARCHAR(255)  DEFAULT '' COMMENT  '旅行的偏好,或者是爱好',
  `vehicleText` VARCHAR(255)  DEFAULT '' COMMENT  '交通工具',
  `profession`  VARCHAR(20)   DEFAULT '' COMMENT  '职业',
  `company`     VARCHAR(20)   DEFAULT '' COMMENT  '公司',
  `md5`         CHAR(32)      NOT NULL   COMMENT 'md5值.用来判断用户的资料或者Plan等是否有变化',
  `avatar0`     VARCHAR(255)  DEFAULT '',
  `avatar1`     VARCHAR(255)DEFAULT '',
  `avatar2`     VARCHAR(255)DEFAULT '',
  `avatar3`     VARCHAR(255)DEFAULT ''
  );
CREATE TABLE travel_user_state(
  `userId`           INT UNSIGNED  NOT NULL  PRIMARY KEY,
  `geohash`         CHAR(6)    NOT NULL,
  `latitude`        CHAR(20) DEFAULT '0.0' NOT NULL,
  `longitude`       CHAR(20) DEFAULT '0.0' NOT NULL,
  `refreshTime`     INT  UNSIGNED    NOT NULL COMMENT '用户在请求数据的时候刷新的时间',
  `currentCity`     VARCHAR(10) DEFAULT ''    NOT NULL COMMENT '用户当前的所在的城市',
  `status`          TINYINT(1) DEFAULT 0 COMMENT '用户当前的状态,用于捡人',
  `ago`             INT    DEFAULT 0 COMMENT '多少天前来到了这里',
  `type`            TINYINT(1)   DEFAULT 1 COMMENT '1表示ios客户端,0表示Android客户端',
  `residence`       VARCHAR(10)   NOT NULL   COMMENT  '常住地',
  CONSTRAINT `userstate` FOREIGN KEY (`userId`) REFERENCES `travel_user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE  
  );
  CREATE TABLE travel_user_relation(
  `priUserId`        INT UNSIGNED  NOT NULL COMMENT ' 主用户id,凡是我的操作我就是主',
  `subUserId`       INT UNSIGNED  NOT NULL,
  `type`             TINYINT(1) NOT NULL COMMENT '0表示这是被拉黑，1表示是关注',
 ` createTime`       INT UNSIGNED     NOT NULL COMMENT '发生关系的时间',
  PRIMARY KEY (`priUserId`, `subUserId`,`type`)
  );
CREATE TABLE travel_plan(
  `planId`           INT UNSIGNED  PRIMARY KEY   AUTO_INCREMENT,
  `userId`           INT UNSIGNED NOT NULL,
  `createTime`       INT UNSIGNED  NOT NULL,
  `destination`      VARCHAR(45) NOT NULL COMMENT '目的地。由高得地图上传过来',
  `city`            VARCHAR(10)NOT NULL COMMENT '目的地所对应的城市',
  `startCity`        VARCHAR(10)NOT NULL COMMENT '出发城市',
  `latitude`         CHAR(20) DEFAULT '0.0' NOT NULL  COMMENT '目的地的经纬度,这一点将会被显示在客户端的地图上',
  `longitude`        CHAR(20) DEFAULT '0.0' NOT NULL,
  `startDate`        DATE NOT NULL COMMENT '计划的开始日期',
  `endDate`          DATE NOT NULL COMMENT '结束日期',
  `vehicle`         TINYINT(1) DEFAULT 0 NOT NULL COMMENT '交通工具',
  `together`         TINYINT(1) DEFAULT 0  NOT NULL COMMENT '和谁',
  `purpose`          TINYINT(1)  DEFAULT 0  NOT  NULL COMMENT '找人还是提供建议',
  `type`             TINYINT(1)  DEFAULT 0  NOT  NULL COMMENT '度假，游玩，出差，返乡',
  `images`           TEXT   COMMENT ' 计划的图片，采用json直接保存',
  `flight`           VARCHAR(45) NULL COMMENT '航班号或者车次号,如果是本地游则可以不需要',
  `postscript`       VARCHAR(255) NULL COMMENT '补充说明，直接存储文字',
  `validate`         TINYINT(1) DEFAULT 1 NOT  NULL COMMENT '0表示验证，1表示未验证',
  `like`             INT NOT  NULL  DEFAULT 0 COMMENT '多少人喜欢这个计划,点赞',
   CONSTRAINT `plan` FOREIGN KEY (`userId`) REFERENCES `travel_user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE travel_plan_comment(
  `commentId`         INT UNSIGNED  NOT NULL  PRIMARY KEY AUTO_INCREMENT,
  `planId`            INT UNSIGNED  NOT NULL,
  `createTime`        INT  UNSIGNED  NOT   NULL,
   `userId`           INT UNSIGNED  NULL,
  `content`           VARCHAR(255) NULL COMMENT '如果是文字就是文字。如果是语音的话这里就是URL链接',
  `replyId`           INT UNSIGNED  NULL DEFAULT 0 COMMENT '0表示这是新的评论，否则表示的是回复',
  CONSTRAINT `plancommnet` FOREIGN KEY (`planId`) REFERENCES `travel_plan` (`planId`) ON DELETE CASCADE ON UPDATE CASCADE
);
-- CREATE TABLE travel_guide(
--   guideId    INT UNSIGNED NOT NULL  PRIMARY KEY  AUTO_INCREMENT,
--   userId     INT UNSIGNED NOT NULL,
--   scenicId   INT UNSIGNED NOT NULL,
--   city       VARCHAR(20) NOT NULL COMMENT '当前guide所在的城市',
--   createTime INT UNSIGNED  NULL,
--   title      VARCHAR(255) NOT NULL,
--   level      TINYINT(1) NOT  NULL  DEFAULT 0 COMMENT '当前guide的级别',
--   like    INT NOT  NULL   DEFAULT 0 COMMENT '有多少人喜欢这个guide',
--   spot   INT NOT  NULL   DEFAULT 0 COMMENT '照片数减一',
--   review  INT NOT  NULL  DEFAULT 0 COMMENT '查看数,是所有Guide里面的照片之和',
--   cover      VARCHAR(255)  NULL COMMENT 'Guide封面'
--   );
CREATE TABLE travel_photo(
  `photoId`            INT   UNSIGNED NOT NULL  PRIMARY KEY  AUTO_INCREMENT,
 ` guideId`            INT  UNSIGNED  DEFAULT 0 COMMENT 'photo所属的guide',
  `userId`             INT    UNSIGNED NOT NULL,
  `content`            TEXT   COMMENT '文本内容',
  `createTime`         INT UNSIGNED  NULL,
  `tag`                VARCHAR(255)  NULL   COMMENT '标签内容，客户端自定义分隔格式',
  `weixin`             TINYINT(1)     DEFAULT 0    COMMENT  '是否分享到了微信，0表示没有',
  `recommend`          TINYINT(1)     DEFAULT 0    COMMENT  '是否已经推荐到了公共库，0表示未分享的公共库',
  `location`           VARCHAR(45) NOT NULL    COMMENT '拍照片的时的位置，不是当前的位置。参照Gogobot',
  `city`               VARCHAR(10) NOT NULL    COMMENT '拍照片的城市,这是轻攻略需要的,客户端自动获取',
  `score`              FLOAT(2,1)  DEFAULT 0  COMMENT '对这个地点评分',
  `images`             TEXT NULL COMMENT '采用json字符串来存储图片位置。因为只读写一次',
  `like`               INT NOT  NULL  DEFAULT 0 COMMENT '点赞的数量',
  `comment`         INT  NOT NULL DEFAULT 0 COMMENT '评论数',
  CONSTRAINT `photo` FOREIGN KEY (`userId`) REFERENCES `travel_user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
  );
  CREATE TABLE travel_photo_like(
  `photoId`            INT UNSIGNED NOT NULL,
  `userId`             INT UNSIGNED NOT NULL,
  `createTime`         INT UNSIGNED NOT  NULL,
  PRIMARY KEY(`photoId`,`userId`),
  CONSTRAINT `photolike` FOREIGN KEY (`photoId`) REFERENCES `travel_photo` (`photoId`) ON DELETE CASCADE ON UPDATE CASCADE
  );
CREATE TABLE travel_photo_comment(
  `commentId`         INT UNSIGNED  NOT NULL  PRIMARY KEY  AUTO_INCREMENT,
  `photoId`           INT UNSIGNED  NOT NULL,
  `createTime`        INT UNSIGNED   NOT   NULL,
  `userId`            INT UNSIGNED  NULL,
  `content`           VARCHAR(255) NULL COMMENT '如果是文字就是文字。如果是语音的话这里就是URL链接',
  `score`             FLOAT(2,1)  DEFAULT 0  COMMENT '对这个地点评分', 
  `replyId`           INT UNSIGNED  NULL DEFAULT 0 COMMENT '0表示这是新的评论，否则表示的是回复',
  CONSTRAINT `photocomment` FOREIGN KEY (`photoId`) REFERENCES `travel_photo` (`photoId`) ON DELETE CASCADE ON UPDATE CASCADE
);
-- *
--  *
--  *
--  *
--  * 此地点获得了多少个赞。关于对分享点赞的问题。
--  *
--  *
--  * 对这个地点点赞还是对人点赞。点赞功能暂时关闭
-- 有如下的变化：
-- 1.sessionID变成了session
-- 2.flightNumber变成了flight
-- 3.likeNum变成了like
-- 4.commentNum 变成了comment
-- 5.relationType变成了type
-- 6.取消了头像表和extension表，用户修改个人资料和头像设置将会影响到(比如：Avatar['avatar0']将变成User['avatar0']，
-- UserExt['signText']变成了User['signText']
-- )
-- 7.修改经纬度与当前城市变成了StateForm['latitude'],不在是UserStatus['latitude']
-- 注册：avatar 变成了avatar0。
