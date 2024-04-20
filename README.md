Project Structure (For developer reference only)

/public_html (or /public or /web)
This directory serves as the root directory for your web server. It contains all files that are publicly accessible via the web browser. Here's what it typically includes and why it's important:

Function:
It is the document root directory where you place all public-facing files.
Only the contents of this directory are accessible to the public over the internet, which means any sensitive files outside this directory are protected from direct access.
Contents:
index.php: The main entry point of your application. This file often initializes application settings and routes requests.
Static files: Includes images, JavaScript files, and CSS stylesheets that need to be loaded by client browsers.
Other publicly accessible PHP scripts.
Purpose:
Enhancing security by limiting access to all other parts of your application.
Serving as the gateway through which all requests are processed and routed to the appropriate parts of your application.
/src
This directory contains the core PHP source code of your application. It is not publicly accessible and typically includes:

Function:
Storing application-specific PHP classes, libraries, and scripts.
Organizing application logic that should not be exposed directly to the web.
Contents:
PHP classes: Your domain models, controllers, and utilities.
Libraries: Any additional libraries that are used internally by your application.
Purpose:
Keeping your application's internal logic separate from public files, enhancing both security and cleanliness of code.
Making it easier to navigate and manage your application's backend logic.
/includes
This directory is used to store PHP files that are included in other PHP scripts, such as configuration files, function files, or scripts that define constants:

Function:
Holding PHP files that are meant to be included or required by other PHP scripts.
Commonly contains files that initialize settings or provide utility functions that are used across the site.
Contents:
config.php: A configuration file that might include database connection settings, API keys, and other sensitive information.
Utility scripts: PHP files containing common functions or classes that are used by multiple scripts throughout the application.
Purpose:
Centralizing commonly used code to avoid duplication and promote reusability.
Protecting sensitive configuration details that should not be accessible from the outside world.
