
create table cms_menu(
    id int not null primary key auto_increment,
    name varchar(32) not null default '' comment '菜单名称',
    pinyin varchar(64) not null default '' comment '拼音说明',
    parent_id tinyint not null default '0' comment '父级ID',
    is_bottom enum('Y', 'N') not null default 'N' comment '是否底部导航，Y是',
    position tinyint not null default '1' comment '排序',
    enabled enum('Y', 'N') not null default 'Y' comment '是否显示，Y是',
    create_time int unsigned not null default '0' comment '创建时间',
    update_time int unsigned not null default '0' comment '修改时间'
)engine = innodb default charset=utf8 comment = '菜单表';


create table cms_banner(
    id int not null primary key auto_increment,
    title varchar(64) not null default '' comment '名称',
    image varchar(512) not null default '' comment '图片地址',
    position tinyint not null default '1' comment '排序',
    enabled enum('Y', 'N') not null default 'Y' comment '是否显示，Y是',
    create_time int unsigned not null default '0' comment '创建时间',
    update_time int unsigned not null default '0' comment '修改时间'
)engine = innodb default charset=utf8 comment = '轮播表';

create table cms_config(
    id int not null primary key auto_increment,
    title varchar(128) not null default '' comment '网站名称',
    keyword varchar(256) not null default '' comment '关键字',
    logo varchar(512) not null default '' comment 'logo',
    top_image varchar(512) not null default '' comment '顶部图片',
    mobile_image varchar(512) not null default '' comment '电话图片',
    footer_logo varchar(512) not null default '' comment '底部logo',
    footer_mobile varchar(512) not null default '' comment '底部电话',
    qrcode varchar(512) not null default '' comment '底部二维码',
    company varchar(512) not null default '' comment '公司名称',
    icp varchar(512) not null default '' comment 'ICP备案',
    mobile char(11) not null default '' comment '电话',
    postal varchar(12) not null default '' comment '邮政编码',
    address varchar(512) not null default '' comment '地址',
    position tinyint not null default '1' comment '排序',
    enabled enum('Y', 'N') not null default 'Y' comment '是否显示，Y是',
    create_time int unsigned not null default '0' comment '创建时间',
    update_time int unsigned not null default '0' comment '修改时间'
)engine = innodb default charset=utf8 comment = '配置表';

create table cms_news(
    id int not null primary key auto_increment,
    category_id int not null default '0' comment '分类ID，即菜单ID',
    title varchar(64) not null default '' comment '名称',
    author varchar(32) not null default '' comment '来源',
    image varchar(512) not null default '' comment '图片地址',
    content text not null comment '内容',
    position tinyint not null default '1' comment '排序',
    enabled enum('Y', 'N') not null default 'Y' comment '是否显示，Y是',
    create_time int unsigned not null default '0' comment '创建时间',
    update_time int unsigned not null default '0' comment '修改时间'
)engine = innodb default charset=utf8 comment = '企业新闻表';


create table cms_product(
    id int not null primary key auto_increment,
    category_id int not null default '0' comment '分类ID，即产品分类ID',
    title varchar(64) not null default '' comment '名称',
    image varchar(512) not null default '' comment '图片地址',
    content text not null comment '内容',
    is_hot enum('Y', 'N') not null default 'N' comment '是否爆款，Y是',
    is_new enum('Y', 'N') not null default 'N' comment '是否新品，Y是',
    position tinyint not null default '1' comment '排序',
    enabled enum('Y', 'N') not null default 'Y' comment '是否显示，Y是',
    create_time int unsigned not null default '0' comment '创建时间',
    update_time int unsigned not null default '0' comment '修改时间'
)engine = innodb default charset=utf8 comment = '产品表';


create table cms_product_category(
    id int not null primary key auto_increment,
    title varchar(64) not null default '' comment '名称',
    pinyin varchar(128) not null default '' comment '拼音',
    position tinyint not null default '1' comment '排序',
    enabled enum('Y', 'N') not null default 'Y' comment '是否显示，Y是',
    create_time int unsigned not null default '0' comment '创建时间',
    update_time int unsigned not null default '0' comment '修改时间'
)engine = innodb default charset=utf8 comment = '产品分类表';

create table cms_product_banner(
    id int not null primary key auto_increment,
    title varchar(64) not null default '' comment '名称',
    image varchar(512) not null default '' comment '图片地址',
    position tinyint not null default '1' comment '排序',
    enabled enum('Y', 'N') not null default 'Y' comment '是否显示，Y是',
    create_time int unsigned not null default '0' comment '创建时间',
    update_time int unsigned not null default '0' comment '修改时间'
)engine = innodb default charset=utf8 comment = '产品轮播表';


create table cms_join_news(
    id int not null primary key auto_increment,
    category_id int not null default '0' comment '分类ID，即菜单ID',
    author varchar(64) not null default '' comment '来源',
    title varchar(64) not null default '' comment '标题',
    image varchar(512) not null default '' comment '图片',
    content text not null comment '内容',
    position tinyint not null default '1' comment '排序',
    enabled enum('Y', 'N') not null default 'Y' comment '是否显示，Y是',
    create_time int unsigned not null default '0' comment '创建时间',
    update_time int unsigned not null default '0' comment '修改时间'
)engine = innodb default charset=utf8 comment = '加盟商风采表';


create table cms_invest_news(
    id int not null primary key auto_increment,
    category_id int not null default '0' comment '分类ID，即菜单ID',
    author varchar(64) not null default '' comment '来源',
    title varchar(64) not null default '' comment '标题',
    image varchar(512) not null default '' comment '图片',
    content text not null comment '内容',
    position tinyint not null default '1' comment '排序',
    enabled enum('Y', 'N') not null default 'Y' comment '是否显示，Y是',
    create_time int unsigned not null default '0' comment '创建时间',
    update_time int unsigned not null default '0' comment '修改时间'
)engine = innodb default charset=utf8 comment = '投资开店表';

create table cms_question(
    id int not null primary key auto_increment,
    article_id int not null default '0' comment '管理文章ID',
    question varchar(512) not null default '' comment '问题',
    position tinyint not null default '1' comment '排序',
    enabled enum('Y', 'N') not null default 'Y' comment '是否显示，Y是',
    create_time int unsigned not null default '0' comment '创建时间',
    update_time int unsigned not null default '0' comment '修改时间'
)engine = innodb default charset=utf8 comment = '问答表';

