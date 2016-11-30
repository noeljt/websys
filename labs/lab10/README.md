=============================================
Joseph Noel - noelj
=============================================
Lab 10
=============================================
Part 0:

My installation came with a GUI similar to phpMyAdmin called pgAdmin.
Definitely less user friendly than phpMyAdmin but it made some things easier than using the terminal.

=============================================
Part 1:

Pretty straightforward, very similar to lab9 installer but with no CREATE DATABASE and pgsql instead of mysql to use PDO.
Figuring out that the table syntax was different was a minor pain...
As far as I could tell you can't specify integer size in PostgreSQL, unlike lab9 when we had to make small ints and specify lengths sometimes.
Very easy to add constraints though, especially foreign keys.

=============================================
Part 2:

Once again, functionally similar to lab9 index page.

Migrate was pretty simple, just connect to both, and dump each table into the PGSQL database.
For the sake of avoiding repeated migrations, my migrate.php erases any current content before migrating new data. Not very efficient, but it works.

Select was the real challenge, I was lucky to find this Stackoverflow article:

http://stackoverflow.com/questions/12446368/sql-returning-the-most-common-value-for-each-person

Which faces a similar problem just with different values. I essentially swapped the personID for first and last name, and the rating for the class.
This query did leave me with multiple results for a person if they had ties (ie. 4 classes with an A in each), so in my code to print the results I just don't print duplicate names (it checked the previous name for a match).

=============================================
Extra:

The reset button was for debugging, just empties the tables in the PostgreSQL database if they contain anything. Figured it wouldn't matter to have something extra there.