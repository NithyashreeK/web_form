# web_form

FORM PAGE (index.php – This is the main page.)
A simple web form collecting the following information about a user:
•	First name
•	Last name
•	Email address
•	Mailing address
All fields are required (except address line 2 and zipcode 4).
RADIO BUTTONS:
The user has an option to choose between the entered address and the validated address. Initially these radio buttons are disabled. 
Both the buttons are enabled if a validated/standardized address is obtained for the corresponding entered address. 
Once the user chooses one of the options, the field below the radio buttons indicates the address that is going to be stored.
If the entered address cannot be validated, then an alert pops up showing the corresponding error description, prompting the user to correct his address.
SUBMIT BUTTON:
Submit button is disabled until the user enters all the information and chooses one of the options.
VALIDATE BUTTON:
If the entered address can be validated to return a standardized address, the result shows up in the space below validate button.

RECORD PAGE (record.php)
This page contains a table of submitted information stored in the database. The table has the following columns:
•	ID (Primary key)
•	First name
•	Last name
•	Email
•	Address

LIST.PHP
This page contains the query that inserts the data into the database by grabbing the user information after the user clicks submit.
Table name used here is formdata with the columns for ID, first name, last name, email, address and timestamp.
After a successful entry into the database, index.php page reloads with submit=success.

CONNECT.PHP
This page establishes the connection to the MySQL server by using the server name, user name, password and the database name.
For this project, the server name is localhost, user name is root, password is blank (no password used) and database name used is userinformation.

Tools and functionalities:
I used XAMPP for testing the application locally and storing data in phpMyAdmin.
Address validation is done using USPS address validate API. I registered to obtain the user ID and password for accessing the APIs. I used the user ID to send the address validate request along with the necessary values. The API returns a valid response (standardized address) if the values sent are correct. The API returns an error document if the values sent cannot be standardized or the values sent are invalid. If more information is needed to validate the entered address, default address is returned. The user can choose to provide more information or submit one of the addresses.
