create table users (
    user_id int auto_increment,
    user_login varchar(30) NOT NULL ,
    user_password mediumtext NOT NULL,
    constraint uploaded_pk
    primary key (user_id)
)engine = INNODB
 character set utf8
 collate utf8_general_ci;

 create table images (
    img_id int auto_increment NOT NULL,
    img_name varchar(255) NOT NULL ,
    uploaded_user_id int,
    views float,
    constraint images_pk
    primary key (img_id)
)engine = INNODB
 character set utf8
 collate utf8_general_ci;
