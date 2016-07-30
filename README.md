LazyPHP Framework
======================

A dead-simple PHP framework comprised of reused code from a few different projects.

The framework uses Medoo, a database library that doesn't require writing 
SQL code, and therefore doesn't need much sanitization (lazy, remember?).
You should also have MySQL Workbench installed for best results when editing the database.

Users
----------------------
The default configuration has a user dropdown list and a PIN code box.
The first user must be created manually in the database.  Make sure the first 
account has a manager role (ID 1) so other accounts can be created using it.