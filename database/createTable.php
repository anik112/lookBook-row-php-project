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


// Gallery table
/*
CREATE TABLE IF NOT EXISTS usersGallery (
    id int(11) NOT null AUTO_INCREMENT,
    user_id bigint(20) unsigned,
    images varchar(100),
    PRIMARY KEY (id),
    foreign key(user_id) references users(id) on delete cascade
);
*/