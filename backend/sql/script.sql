-- Active: 1769609459616@@127.0.0.1@3306@cinema
create DATABASE cinema;
use cinema;


create TABLE movies (
    id int  AUTO_INCREMENT PRIMARY KEY,
    title varchar(300) not null,
    description text,
    duration int,
    release_year int not null,
    genre varchar(100),
    director varchar(100),
    create_at datetime,
    update_at datetime
);

create TABLE rooms (
    id int AUTO_INCREMENT PRIMARY KEY,
    name varchar(200) not null,
    capacity int not null,
    type varchar(100),
  active boolean DEFAULT true,
  created_at datetime,
  updated_at datetime
);

CREATE TABLE screenings (
  id int AUTO_INCREMENT PRIMARY KEY,
  movie_id int not null,
  room_id int not null,
  start_time datetime not null,
  active boolean DEFAULT true,
  created_at datetime,
   FOREIGN KEY(room_id) REFERENCES rooms(id),
    FOREIGN KEY(movie_id) REFERENCES movies(id)
);
