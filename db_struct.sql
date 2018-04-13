-- Database structure --

CREATE TABLE `cr_users` (
	`id`	INTEGER PRIMARY KEY AUTOINCREMENT,
	`name`	TEXT,
	`email`	TEXT,
	`password`	TEXT
)

CREATE TABLE `cr_apps` (
	`id`	INTEGER PRIMARY KEY AUTOINCREMENT,
	`name`	TEXT,
	`description`	TEXT,
	`key`	TEXT,
	`secret`	TEXT
)