# Entities

## User

* __id__: primary key, unique, ulid;
* __name__: varchar(127), not null;
* __email__: varchar(127), unique, not null;
* __username__: varchar(127), unique, not null;
* __password__: varchar(255), not null;

## Repository

* __id__: primary key, unique, ulid;
* __name__: varchar(127), not null;
* __description__: varchar(511);
* __owner_id__: foreign key, __User__, not null;
* __project_id__: foreign key, __Project__;

## Project

* __id__: primary key, unique, ulid;
* __name__: varhcar(127), not null;
* __description__: varchar(511);
* __owner_id__: foreign key, __User__, not null;
