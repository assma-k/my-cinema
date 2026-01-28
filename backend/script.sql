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
  active boolean ,
  created_at datetime,
  updated_at datetime
);

CREATE TABLE screenings (
  id int AUTO_INCREMENT PRIMARY KEY,
  movie_id int not null REFERENCES movies(id),
  room_id int not null REFERENCES rooms(id),
  start_time datetime not null,
  created_at datetime
);
