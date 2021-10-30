# tasks

Test task
For setting up you need to create DataBase, open 'inc/functions.php' and change database credentials
Then open phpMyAdmin, find created DataBase and import 'database.sql' file - this will create tables, 1 super_admin, 2 admins and some basic users.
Also it will create 4 basic tasks just for view purpose
No composer requires
No packages installations
That's it

For loggining as SuperAdmin:
log: nababurbd@gmail.com
pass: An123456

Project description:

SuperAdmin can give admin rights, block admins and upload files only in TXT format
SuperAdmin and Admins can block users
Admins cannot block general admins and, obviously, SuperAdmin
Users can see tasks but change their status only if they are no banned
If file contains task lines with the same title AND category it will save only the first line and skip others


P.s.
Unfortunatelly I haven't done search options and substituted them with table arrangment
