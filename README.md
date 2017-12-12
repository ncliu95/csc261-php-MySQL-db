# csc261-php-MySQL-db
A mock database and interface using MySQL and PHP to save, search, and display data.

phpMyAdmin MUST be installed to access database admin functionality.
Since AJAX is not used, a page refresh may often be required to display changes made.

Login accounts:

Admin - 
  PID:        576
  Password:   wpMj5Oy

Regular Account -
  PID:        473
  Password:   jYETCUZsv
  
To display personnel list, search one of the following ranks:
  Captain
  Corporal
  Sergeant
  Patrol Man

Other searches will also work, if given the right query.

When creating a new citation, a PID associated with the station must be used in order to display the new citation.
This is due to the citation section displaying only citations associated with PID's that work at the select Station.

When preforming modifications to records, empty fields will preserve previous values.

For insertion, all fields must be provided.
