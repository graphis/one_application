<?php defined('SYSPATH') or die('No direct script access.');

$title = 'Sándor Zsolt | tervezőgrafikus';
$keywords = 'grafikus, tipográfus, tervezőgrafikus, tervezés, grafikai tervezés, reklámgrafika, arculat, arculattervezés, logó, embélma, kiavány, plakát, kiadványszerkesztés, hirdetés, 3D, 3d látványtervek, magazin,  könyv, prospektus, plakát, szórólap, névjegykártya, könyvtervezés, szórólap, hirdetés, brossúra, web, weblap, weboldal, internetoldal, php, css, xhtml, xml, seo, kereső optimalizáció, pécsett, pécsen, pécs, baranya';
$description = 'Sándor Zsolt pécsi tervezőgrafikus internetoldala';
$revised = date("Y-m-d H:i:s");


// Data for SQLite databases
return array
(
	///////////////////////////////////
	// meta -- site specific data
	"DROP TABLE IF EXISTS meta;",
	"CREATE TABLE meta (
		id INTEGER PRIMARY KEY AUTOINCREMENT,
		title VARCHAR,
		keywords VARCHAR,
		description VARCHAR,
		revised VARCHAR
	);",

	///////////////////////////////////
	// page
	"DROP TABLE IF EXISTS page;",
	"CREATE TABLE page (
		id INTEGER PRIMARY KEY AUTOINCREMENT,
		published BOOLEAN NOT NULL DEFAULT 0,
		title VARCHAR,
		slug VARCHAR UNIQUE,
		meta VARCHAR
	);",

	///////////////////////////////////
	// project
	///////////////////////////////////
	// id
	// published
	// created
	// for // client
	// slug //
	// title
	// description
	// images
	// page_slug // belongs to page where page.slug = page_slug
	// 
	"DROP TABLE IF EXISTS project;",
	"CREATE TABLE project (
		id INTEGER PRIMARY KEY AUTOINCREMENT,
		published BOOLEAN NOT NULL DEFAULT 0,
		created INTEGER,
		for VARCHAR,		
		slug VARCHAR UNIQUE,
		title VARCHAR,
		description VARCHAR,
		images INTEGER,
		page_slug VARCHAR,
			FOREIGN KEY(page_slug) REFERENCES page(slug)
	);",

	///////////////////////////////////
	// image table
	"DROP TABLE IF EXISTS image;",
	"CREATE TABLE image (
		id INTEGER PRIMARY KEY AUTOINCREMENT,
		filename VARCHAR,
		title VARCHAR,
		description VARCHAR,
		project_id INTEGER NOT NULL,
			FOREIGN KEY(project_id) REFERENCES project(id)
	);",

	///////////////////////////////////
	///////////////////////////////////
	///////////////////////////////////
	// populate db

	///////////////////////////////////
	// metadata
	"INSERT INTO meta (title, keywords, description, revised)
		VALUES ('$title', '$keywords', '$description', '$revised');",


	///////////////////////////////////
	// PAGES
	
	// LATEST
	"INSERT INTO page (title, meta, published, slug)
		VALUES ('Title', 'page metadata', 1, 'latest');",

	// ARCHIVED
	"INSERT INTO page (title, meta, published, slug)
		VALUES ('Title', 'page metadata', 1, 'archive');",

	// PERSONAL
	"INSERT INTO page (title, meta, published, slug)
		VALUES ('Title', 'page metadata', 1, 'personal');",








	///////////////////////////////////
	// PROJECT



	// project 01
	// ecoc text
	"INSERT INTO project (published, title, description, slug, for, page_slug)
		VALUES (1, 'Pécs2010 – Európa Kulturális Fővárosa', 'Projekt rövid leírás ide jön…', 'european-capitol-of-culture-2010-pecs', 'EKF', 'latest');",
	// pictures
	"INSERT INTO image (title, description, filename, project_id)
		VALUES ('cim 1', 'leiras 1', '01.jpg', 1);",
	"INSERT INTO image (title, description, filename, project_id)
		VALUES ('cim 2', 'leiras 2', '02.jpg', 1);",
	"INSERT INTO image (title, description, filename, project_id)
		VALUES ('cim 3', 'leiras 3', '/03.jpg', 1);",
	"INSERT INTO image (title, description, filename, project_id)
		VALUES ('cim 4', 'leiras 4', '04.jpg', 1);",

	// project 02
	// amsterdam text
	"INSERT INTO project (published, title, description, slug, page_slug)
		VALUES (1, 'MediaMensen – Amsterdam', 'Projekt rövid leírás ide jön…', 'mediamensen-amsterdam', 'archive');",
	// pictures
	"INSERT INTO image (title, description, filename, project_id)
		VALUES ('cim 1', 'leiras 1', '01.png', 2);",
	"INSERT INTO image (title, description, filename, project_id)
		VALUES ('cim 1', 'leiras 1', '02.png', 2);",
	"INSERT INTO image (title, description, filename, project_id)
		VALUES ('cim 1', 'leiras 1', '03.jpg', 2);",

	// project 03
	// lost & found // personal
	"INSERT INTO project (published, title, description, slug, for, page_slug)
		VALUES (1, 'Lost & Found', 'Projekt rövid leírás ide jön…', 'lost-and-found', 'myself', 'personal');",
	// pictures
	"INSERT INTO image (title, description, filename, project_id)
		VALUES ('cim 1', 'leiras 1', '01.jpg', 3);",
	"INSERT INTO image (title, description, filename, project_id)
		VALUES ('cim 1', 'leiras 1', '02.jpg', 3);",
	"INSERT INTO image (title, description, filename, project_id)
		VALUES ('cim 1', 'leiras 1', '03.jpg', 3);",

	// project 04
	// lost & found & lost // personal
	"INSERT INTO project (published, title, description, slug, for, page_slug)
		VALUES (1, 'Me', 'Projekt rövid leírás ide jön…', 'personal', 'myself', 'personal');",
	// pictures
	"INSERT INTO image (title, description, filename, project_id)
		VALUES ('cim 1', 'leiras 1', '02.jpg', 4);",
	"INSERT INTO image (title, description, filename, project_id)
		VALUES ('cim 1', 'leiras 1', '03.jpg', 4);",

	// project 05
	// lost & found & lost // personal
	"INSERT INTO project (published, title, description, slug, for, page_slug)
		VALUES (1, 'Grmbl', 'GRRRRR Projekt rövid leírás ide jön…', 'prev-next-test', 'myself', 'personal');",
	// pictures
	"INSERT INTO image (title, description, filename, project_id)
		VALUES ('prev 1', 'prev leiras 1', '01.png', 5);",
	"INSERT INTO image (title, description, filename, project_id)
		VALUES ('prev 1', 'prev leiras 1', '02.png', 5);",
	"INSERT INTO image (title, description, filename, project_id)
		VALUES ('prev 1', 'prev leiras 1', '03.png', 5);",
	"INSERT INTO image (title, description, filename, project_id)
		VALUES ('prev 1', 'prev leiras 1', '04.png', 5);",






			
// exp user table

//	"DROP TABLE IF EXISTS user;",
//	"CREATE TABLE user (Id INTEGER PRIMARY KEY, email TEXT, username TEXT, password TEXT, token TEXT, tags TEXT, logins TEXT, last_login TEXT );",
//	"INSERT INTO user (username, email, password) VALUES ('admin', 'ezsolt@gmail.com', 'cd9272ff68d23f1296c722b51a3f6758eca7766a37ab5bf2d3');", // silencio
//
//	"DROP TABLE IF EXISTS sessions;",
//	"CREATE TABLE sessions (session_id INTEGER PRIMARY KEY);",

// exp
	
	// end

);

