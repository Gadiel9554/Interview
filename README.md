# Project Documentation

## Overview
This project contains various components for managing and processing data. In the `PHP/settings/` directory, you can configure system-wide settings, database connections, application functions, and user session information. Additionally, the `config` directory contains settings for the top and main menus.

## Configuration
All system options can be updated in the `PHP/settings/` and `config/` directories. Below are the details on how to modify these configurations.

Make sure that you are loading `interview.sql` before the installtioon of the system.


### Directory Structure

```
./
├── PHP/  
│     └── Settings/  
│         ├── config.php  
│         ├── connection.php  
│         ├── functions.php  
│         └── user.php  
└── config/  
│   ├── menu-top.php  
│   └── menu-main.php
|
└── interview.sql
```
### Configuration Files

1. **`config.php`** (System Information)
   - **Purpose:** Contains system-wide configuration settings.
   - **Modifications:** Update global parameters such as default settings, application environment, and other system-wide options.
   - **Example:**
     ```php
     <?php
     // System configuration settings
     define('NAME_SYSTEM', "Interview"); // System Name
     define('ECRYPTION_KEY', '*:bRuD5WYw5wd0rdHR9yLlM6w/t2vte-uiniQBqE70nAuhU=//**'); // Encryption password
     ?>
     ```

2. **`connection.php`** (Database Connection)
   - **Purpose:** Contains database connection details.
   - **Modifications:** Update database connection settings such as hostname, username, password, and database name.
   - **Example:**
     ```php
     <?php
     // Database connection settings
     $link = mysqli_connect('localhost', 'inter_usr', 'J*qM@YFj[uf7xCds', 'interview');
     ?>
     ```

3. **`functions.php`** (Application Functions)
   - **Purpose:** Contains functions used throughout the application.
   - **Modifications:** Define or modify application-wide functions, helpers, or utilities.
   - **Example:**
     ```php
     <?php
     // Example application functions
     function encrypt($input) {
         // Encryption logic here
     }
     ?>
     ```

4. **`user.php`** (Session User Information)
   - **Purpose:** Contains session-related user information.
   - **Modifications:** Manage user session settings and related information.
   - **Example:**
     ```php
     <?php
     // Example session user settings
     $Usr = $_SESSION['INTERVIEW_2024'];
     ?>
     ```

5. **`menu-top.php`** (Top Menu Configuration)
   - **Purpose:** Configures the top menu of the application.
   - **Modifications:** Customize the items and structure of the top menu.

6. **`menu-main.php`** (Main Menu Configuration)
   - **Purpose:** Configures the main menu of the application.
   - **Modifications:** Customize the items and structure of the main menu.

## Updating Configuration
To update any configuration settings:
1. Navigate to the `PHP/settings` or `config` directory.
2. Open the relevant configuration file in a text editor.
3. Modify the settings as needed.
4. Save the changes and ensure to test the system to verify that the new settings are applied correctly.

## Important Notes
- Always backup configuration files before making changes.
- Review the documentation for each file to understand the impact of the changes.
- After updating the configurations, restart the server if required to apply the changes.

## Contact
For further assistance, please contact me at gadiel9554@gmail.com.
