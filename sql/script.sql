
-- create database
create database ocdb;

-- create users table
create table users(
user_id int primary key auto_increment not null,  
firstname varchar(50) not null,
lastname varchar(50) not null,
email varchar(100) not null,
password varchar(255) not null,
role enum ("admin","student","teacher")

);

-- create categories table
create table categories(
categorie_id int primary key auto_increment not null,
categorie_name varchar(50) not null;
categorie_description varchar(200);
);

-- create courses table

create table courses(
course_id int primary key auto_increment not null,
user_id int,
categorie_id int,
title varchar(200) not null,
content text not null,
pub_date date,
image varchar(100) ,
foreign key (user_id) references users(user_id) on delete cascade on update cascade,
foreign key (categorie_id) references categories(categorie_id) on delete cascade on update cascade
);



-- tags table
create table tags(
  tag_id int primary key auto_increment,
  tag_name varchar(10) not null
);

-- articles_tags associated table
create table courses_tags(
course_id int,
tag_id int,
primary key(course_id,tag_id),
foreign key(course_id) references courses(course_id) on delete cascade on update cascade,
foreign key(tag_id) references tags(tag_id) on delete cascade on update cascade
);

-- joined courses associated table

create table users_courses(
    user_id int,
    course_id int,
    primary key(user_id,course_id),
    foreign key(user_id) references users(user_id) on delete cascade on update cascade,
    foreign key(course_id) references courses(course_id) on delete cascade on update cascade
)





