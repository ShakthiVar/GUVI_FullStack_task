**User Registration and Profile Management System**

**Overview**

Create a user authentication system with a signup, login, and profile page. Successful login should redirect to a profile page with additional user details such as age, date of birth, contact, etc. Users should be able to update their profiles.

**Flow**

Register: Users can sign up by providing necessary details.

Login: Users can log in with the details provided during registration.

Profile: Successful login redirects to a profile page containing additional user details. Users can update their profiles.

**Folder Structure**

CSS: Contains stylesheets.

JS: Contains JavaScript files.

PHP: Contains PHP scripts.

Vendor: Manually download vendor dependencies (Bootstrap, jQuery) as they are not included in the repository.

**Tech Stack**

1)HTML

2)CSS

3)JS

4)PHP

5)MySQL: Utilized via PHPMyAdmin for storing registered data.

6)MongoDB: Used for storing details of user profiles.

7)Redis: Utilized for session information storage.

**How to Connect php application with Mongodb?**

1)Obtain the latest stable version of MongoDB from the PHP PECL website.

2)Copy the php.dll file from the downloaded MongoDB version to the Composer Folder/php/ext/ directory.

3)Update the php.ini file by adding the extension configuration for MongoDB (extension=mongodb).

4)Once the MongoDB extension is installed, proceed to install the MongoDB library using Composer:

      composer require mongodb/mongodb
      
5)To install vendor modules use the command:

      composer install
      
      
**How to store session Information in Redis?**

1)Install the Redis Extension

2)Check PHP Configuration:

Open your php.ini file and verify that the Redis extension is correctly configured.Add 

      extension=redis

3)Restart the Web Server.


**Project Structure:**

![Screenshot (325)](https://github.com/ShakthiVar/GUVI_FullStack_task/assets/92375087/5f10b0a8-0873-4364-a2dd-00f43959deb7)
![Screenshot (324)](https://github.com/ShakthiVar/GUVI_FullStack_task/assets/92375087/18c1b94a-2aeb-4377-b869-be551c412b74)

**How to clone this Project?**

1)Clone the repository.

2)Manually download vendor dependencies (Bootstrap, jQuery) and place them in the 'vendor' directory.

3)Set up a MySQL database using PHPMyAdmin for storing registered data.

4)Ensure MongoDB is running for storing user profiles.

5)Run Redis for session information storage.

6)Open HTML files in a browser.

Project Demo Video:


https://github.com/ShakthiVar/GUVI_FullStack_task/assets/92375087/52f5dc2d-36db-43a1-9fc3-0607dbca9ab9


