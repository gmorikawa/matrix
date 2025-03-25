# Requirements

## Authentication and Authorization

* There are two types of users: the _root_ and the _member_ users;
* The _root_ is unique in the system and cannot be deleted;
* Only registered users can access the repositories;
* The _root_ user can see all the repositories, but a _member_ user may only see their own repositories and projects;
* After login, the user will receive a JWT authentication token to authorize access to contents of the application;
* A new user may only be created by a _root_ user;
* Users can modify their own information;

## Projects and Repository Management

* Every project and repository can have one and only one owner;
* A project is not required to create a repository;
* Repositories can be moved to existent projects or reassigned to other project;
* Deleting a project means to delete all the repositories linked to the project altogether;
* The name of a project should be unique between projects of a single user;
* The name of a repository should be unique between repositories of a single user;
* Projects can act like a namespace, thereby, two repositories may have the same name if they are in different projects;
