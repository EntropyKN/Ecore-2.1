# Ecore-2.1
2D Serius Game Editor and Player whith moodle LTI interface

####### INSTALLATION:
- import the mysql DB using the file else.sql
- open the file /config/config.inc.php
	in this file set:
	- $serverRoot and $serverDir
	- database access

- Upload the files

- The following directories have to be WRITABLE (chmode 777):
	/data/audio/
	/data/attachments/

###### FIRST TEST:	
to test the platform log in as:
user:general1
password: general1

You could be able to play the the game "OTHERS"

#### USERS Hierarchy
*users, Hierarchy and privileges
in the db, table "user" the field "user_level"
is used to set Hierarchy and privileges:

0  simple user, 
1 Editor, 
2 Administrator, 
3 Super User

Note
the Access via #moodle will create itself the user in this table,
anyway you can create direct access new user using the same table

#### LANGUAGES
english, italian
the db table for languages is PLANG

##### Legal stuff
Please, find the file /informativaTEMPLATE.docx (in italian), 
customize it with your company data
and overwrite the file /informativa.pdf

--
Entropy Knowledge Network srl
www.entropykn.net





