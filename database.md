[TOC]
###用户表user
字段|类型|描述|约束
---|---|---|---
user_id|int(11)|自增ID|自动增长，非空，主键
username|varchar(100)|用户昵称|
password|char(256)|用户密码
salt|char(64)|随机字符串
truename|char(50)|真实姓名
email|char(256)|电子邮件地址|唯一
email_is_active|int(1)|邮箱是否激活（1：未激活，2：已激活）|默认：1
mobile|char(20)|手机号码|唯一
mobile_is_active|int(1)|手机是否激活（1：没激活，2：激活）|默认：1
telephone|char(20)|固定电话
logo|varchar(255)|用户头像的URL地址
qq|char(12)|QQ号码
age|tinyint|年龄
sex|tinyint(1)|性别
company_id|varchar(100)|用户所属的公司
address|varchar(200)|用户居住地址
type|int(3)|用户类型
score|int(10)|用户积分
token|char(256)|用户登陆token
created_at|bigint|用户创建的时间
last_login_time|bigint|用户最后一次登陆的时间
###用户积分表user_score
字段|类型|描述|约束|
---|---|---|---
us_id|int(11)|自增ID|主键
us_kuaibi|float|积分数值
score_name|积分名称
score_remark|积分备注
created_at|创建时间

###用户公司信息表user_company
字段|类型|描述|约束
---|---|---|---|
id|
company_name|公司名称
company_short_name|公司简称
company_description|公司描述
city|所属于的城市
zone|城市的下一级
detailed_address|详细的地址信息
company_phone|公司电话|
company_fax|公司传真
company_contact|公司联系人
person_telephone|公司联系人的联系方式
certificate_img1|公司证件照1
certificate_img2|公司证件照2
certificate_img3|公司证件照3
certificate_img4|公司证件照4


###产品表product
字段|类型|描述|约束
---|---|---|---
product_id|int(11)|自增ID|主键
product_name|varchar(100)|商品名称|
product_quantity|float|库存数量|
product_unit_price|float|单个的价格|
product_material|varchar(50)|材质的描述|
product_specifications|varchar(100)|商品的规格
product_category_id|int(11)|所属的类别
is_promotional |int(1)|促销标识（1：正常，2：促销）|默认1
product_storehouse_id|varchar(255)|所属的仓库(多个仓库用逗号隔开)|
product_factory_id|varchar(255)|所属的工厂（多个工厂用逗号隔开）
说明|product_factory_id:1,2,3说明工厂1，2，3都提供了相同的这个产品
###类别表category
字段|类型|描述|约束
---|---|---|---|
category_id|自增的ID|主键
category_name|类别的名称 
parent_id|所属的父类的名称
暂时有以下这五种类别|
category_id:1|优特钢
category_id:2|优特板带
category_id:3|无缝钢管
category_id:4|不锈钢
category_id:5|优线
###仓库表storehouse
字段|类型|描述|约束|
---|---|---|---|
storehouse_id|int(11)|自增ID|主键
storehouse_name|varchar(100)|仓库名称
storehouse_address|varchar(200)|仓库地址
###工厂表factory
字段|类型|描述|约束|
---|---|---|---|
factory_id|int(11)|自增ID|主键
factory_name|varchar(100)|工厂名称
factory_product_id|int(11)|工厂主营品类|category表中category_id
factory_city|char(20)|所在的城市|
factory_logo|varchar(255)|工厂logo所在的路径|
factory_zone|char(20)|所在城市的下一级行政区



###订单表order
字段|类型|描述|约束|
---|---|---|----|
order_id|int(11)|自增ID|主键
order_no|char(50)|订单编号|唯一
order_seller|int(11)|卖方|关联user中的user_id
order_buyer|int(11)|买方|关联user中的user_id
order_product_id|int(11)|产品|关联product中的product_id
order_unit_price|float|单价|
order_amount|int(11)|数量|
order_total_price|float|总价|单价乘以数量，这里为冗余字段
order_status|int(2)|订单状态（1，刚刚生成，2：在购物车中。3：已付款，4：在订单回收车中）|
order_type|int(2)|订单的类型（1：采购、2：销售）|
order_created_at|timestamp|订单生成时间
###资源单resource
字段|类型|描述|约束
---|---|---|---|
resourceid|int(11)|自增ID|主键
resource_company_name|varchar(200)|上传资源单的公司名称
resource_main_class|主营品种
resource_main_factory_name|主营的工厂
resource_remark|资源单说明
resource_upprice|今日调价
resource_down_count|下载数量
resource_file_name|资源文件名称
resource_file_url|资源文件的地址
resource_created_at|上传的时间
resource_user_id|int(11)|资源的上传者|关联user中的user_id
resource_category_id|int(11)|所属的类别|关联category的category_id
这里的类别有：|
![这里写图片描述](http://img.blog.csdn.net/20151022225721578)
###资源单和关注的人的关联表resource_user
字段|类型|描述|约束
---|---|---|---|
ru_id|int(11)|自增ID|主键
ru_resource_id|int(11)|资源单ID
ru_user_id|int(11)|用户ID
ru_created_time|timestamp|创建时间
###采购报价表purchase 用于采购报价模块
字段|类型|描述|约束
---|---|---|---|
purchase_id|int(11)|自增ID|主键
purchase_product_id|int(11)|商品ID|关联product中的product_id
purchase_contact_user|int(11)|联系人|关联user中的user_id
purchase_connect_phone|char(20)|联系方式
purchase_status|int(2)|采购报价的状态（1：待审核，2：已报价，3：卖家比价中，4：已结束）|
created_at|timestamp|创建时间

###发票记录表receipt 用于发票查询
字段|类型|描述|约束
---|---|---|---|
receipt_id|int(11)|自增ID|主键
receipt_order_no|char(100)|订单号|关联order中的order_no
receipt_title|varchar(100)|发票抬头
receipt_total_money|float|发票总金额
receipt_status|int(2)|发票状态（1：未开，2：已开）
created_at
###方块公告存储表news 用于主页的方块公告
字段|类型|描述|约束
---|---|---|---|
id|int(11)|自增ID|主键
from|varchar(100)|新闻来源|
title|varchar(50)|新闻标题|非空
content|text|内容|
type|int(2)|消息类型（1：公告，2：新闻）|默认1
is_released|int(2)|是否发布(1:未发布，2：已发布)|默认1
released_time|timestamp|status变为2的时间
created_at|timestamp|消息的创建时间

###短信验证表sms
字段|类型|描述|约束
---|---|---|---|
sms_id|int(11)|自增ID|主键
sms_phone|int(20)|手机号码
sms_code|char(10)|验证码
status|int(2)|状态（1：未激活，2：已激活，3：已失效）|默认：1
created_time|timestamp|记录的创建时间



###求购商品报价表 fk_goods_quotation
字段|类型|描述|约束
---|---|---|---
gq|int(11)|自增ID|自动增长，非空，主键
gtb_id|int(11)||求购记录主键
user_id|char(256)|用户_id
unit_price|float|单价
is_tax_inclusive|bit|是否含税
expired_time|timestamp|到期时间|唯一
manufacturer|nvarchar(50)|厂家产地|默认：1
shipping_address|nvarchar(100)|交货地址|唯一
shipping_fee|float|运输费|
invoice_option|bit|是否开增值税发票
pay_type|tinyint|交易方式
total_price|char(12)|总价钱
remark|tinytext|说明
created_at|timestamp|创建时间




新增 并修改三个数据表
fk_goods_to_buy  求购信息记录表
fk_promotional_goods_record  促销信息记录表

fk_spot_goods_record 发布现货信息记录表


请执行以下语句 创建


CREATE TABLE IF NOT EXISTS `fk_goods_to_buy` (
  `gtb_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) DEFAULT NULL,
  `product_material` varchar(50) DEFAULT NULL,
  `product_specifications` varchar(100) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `shipping_address` varchar(200) DEFAULT NULL,
  `price_conditions` varchar(50) DEFAULT NULL,
  `linkman` varchar(50) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `approval_status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`gtb_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;



CREATE TABLE IF NOT EXISTS `fk_promotional_goods_record` (
  `pgr_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) DEFAULT NULL,
  `product_specification` varchar(50) DEFAULT NULL,
  `product_material` varchar(50) DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `linkman` varchar(20) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `approval_status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pgr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;



CREATE TABLE IF NOT EXISTS `fk_spot_goods_record` (
  `sgr_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `product_material` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `product_specifications` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `product_width` int(11) DEFAULT NULL,
  `product_length` int(11) DEFAULT NULL,
  `product_height` int(11) DEFAULT NULL,
  `manufacturer` varchar(100) CHARACTER SET big5 DEFAULT NULL,
  `area` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `storehouse` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `weighing_type` tinyint(4) DEFAULT '1',
  `price` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `remark` tinytext CHARACTER SET latin1,
  `approval_status` tinyint(4) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sgr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;


