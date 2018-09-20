<?php
// call database connacton for create all tables
require'dbConnect.php';


// first delete all tables
$deleteFriendsList=$connect->prepare('drop table if exists frendsList');
$deleteFriendsList->execute();

$deletePosts=$connect->prepare('drop table if exists posts');
$deletePosts->execute();

$deleteUsearTable = $connect->prepare('drop table if exists users');
$deleteUsearTable->execute();

$deleteFriendListTable = $connect->prepare('drop table if exists frendsList');
$deleteFriendListTable->execute();

$deleteUaerGalleryTable = $connect->prepare('drop table if exists usersGallery');
$deleteUaerGalleryTable->execute();

$deleteCommentTable = $connect->prepare('drop table if exists comments');
$deleteCommentTable->execute();

$deleteLikeTable = $connect->prepare('drop table if exists likes');
$deleteLikeTable->execute();

$deleteNotificationTable = $connect->prepare('drop table if exists notification');
$deleteNotificationTable->execute();

$deleteActiveStatus = $connect->prepare('drop table if exists active_status');
$deleteActiveStatus->execute();


// create user table
$createUserTable= $connect->prepare('create table users(
    id serial,
    sur_name varchar(30) not null,
    nick_name varchar(30) not null,
    mobile varchar(12) unique not null,
    email varchar(30) unique,
    birthday varchar(20) not null,
    gender varchar(10) not null,
    current_city varchar(30) not null,
    home_town varchar(30),
    interested_in varchar(10),
    languages varchar(10) not null,
    relationship varchar(10) not null,
    about_you varchaR(200),
    image blob not null,
    user_name varchar(30) unique not null,
    password varchar(30) unique not null,
    primary key(id)
);');
$createUserTable->execute();

// create post table
$createPosts=$connect->prepare('create table posts(
    id serial,
    user_id bigint(20) unsigned,
    user_name varchar(30) not null,
    title varchar(100) not null,
    content varchar(200) not null,
    likes int(11) not null,
    comment varchar(100) not null,
    primary key(id),
    foreign key(user_id) references users(id) on delete cascade
);');
$createPosts->execute();

// create friends list table
$createFriendsList=$connect->prepare('create table frendsList(
    id serial,
    user_id bigint(20) unsigned,
    friends_id bigint(20) unsigned,
    primary key(id),
    foreign key(user_id) references users(id) on delete cascade
);');
$createFriendsList->execute();



$createUserGallery=$connect->prepare('CREATE TABLE IF NOT EXISTS usersGallery (
    id int(11) NOT null AUTO_INCREMENT,
    user_id bigint(20) unsigned,
    images varchar(100),
    PRIMARY KEY (id),
    foreign key(user_id) references users(id) on delete cascade
);');
$createUserGallery->execute();




$createComment=$connect->prepare('CREATE TABLE IF NOT EXISTS comments(
    id serial,
    post_id bigint(20) unsigned,
    user_id bigint(20) unsigned,
    user_name varchar(50),
    content varchar(200),
    PRIMARY KEY (`id`),
    FOREIGN KEY(`post_id`) REFERENCES `posts`(`id`) ON DELETE CASCADE,
    FOREIGN KEY(`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);');
$createComment->execute();


$createLikes=$connect->prepare('CREATE TABLE IF NOT EXISTS likes(
    id serial,
    post_id bigint(20) unsigned,
    user_id bigint(20) unsigned,
    user_name varchar(50),
    PRIMARY KEY (`id`),
    FOREIGN KEY(`post_id`) REFERENCES `posts`(`id`) ON DELETE CASCADE,
    FOREIGN KEY(`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);');
$createLikes->execute();



$createLoginStatus=$connect->prepare('CREATE TABLE IF NOT EXISTS active_status(
    id serial,
    user_id bigint(20) unsigned,
    last_activity_date date NOT null,
    last_activity_time time not null,
    login_status boolean not null,
    PRIMARY KEY (`id`),
    FOREIGN KEY(`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);');
$createLoginStatus->execute();






// Gallery table
/*
CREATE TABLE IF NOT EXISTS massage(
    id serial,
    user_id bigint(20) unsigned,
    friends_id bigint(20) unsigned,
    friends_name VARCHAR(50) NOT NULL,
    massage_date date NOT null,
    massage_time time not null,
    massage varchar(200),
    PRIMARY KEY (`id`),
    FOREIGN KEY(`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);




INSERT INTO `active_status`(`user_id`, `last_activity_date`, `last_activity_time`, `login_status`) VALUES (13,CURDATE(),CURTIME(),false);

*/