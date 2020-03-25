##Software Engineer Technical Assesment for SKY

- I have taken a demo symfony application and added my entities and controllers to it as per the requirement
- Used composer for installation process
- Database table added by using .env file
- 'php bin/console doctrine:database:create' command is used to create database and table
- Created Entity and Controller for metrics data.
- Extended twig files for metrics data controller
- Added neccessary bundles to create REST API's
- Created REST API for storing data into database and retrieving data from database 
- Displayed data from database in tabular format in index twig
- Added neccesary bundles for forms
- Created form to get data between time intervals
- Displaying the result using index twig

###Route
- metric : to display all data form database
- metric/create : adds last 5minutes data into database
- metric/create/form : Shows a form to add start and end time. It displays the data between those intervals

###Installation
- Clone the repo from github
- Run composer install
- Open the above links
 
 