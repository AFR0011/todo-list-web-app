# To-Do List Web Application

Welcome to the To-Do List web application! This project aims to provide users with a simple and efficient tool for managing their tasks effectively. Below is a breakdown of the main components and functionalities of the application:

## **Main Page (main.php)**

### **Overview**
The main page serves as the user interface for interacting with the To-Do List application. Users can view, create, modify, and delete tasks directly from this page.

### **Features**
- **Task Display**: Displays all tasks stored in the database.
- **Search Functionality**: Allows users to search for tasks based on various criteria such as title, description, due date, etc.
- **Sorting**: Enables sorting of tasks based on different attributes (e.g., title, description, due date, etc.).
- **Task Manipulation**: Provides options to create, modify, and delete tasks.

### **Implementation**
- **Dynamic Behavior**: Utilizes jQuery for dynamic behavior such as creating, modifying, and deleting tasks without page reloads.
- **Backend Interaction**: Communicates with the server-side script (server.php) for handling CRUD operations and database interactions.
- **Database Connectivity**: Establishes a connection to the MySQL database to fetch and manipulate task data.
- **Session Management**: Utilizes PHP sessions for maintaining user data and state across requests.

## **Server-side Script (server.php)**

### **Overview**
The server-side script handles various requests initiated by the main page, such as task creation, modification, deletion, searching, sorting, etc.

### **Features**
- **Task Creation**: Processes requests to create new tasks and inserts them into the database.
- **Task Modification**: Handles requests to modify existing tasks and updates the corresponding records in the database.
- **Task Deletion**: Manages requests to delete tasks and removes them from the database.
- **Search and Sorting**: Implements functionality for searching tasks based on user-defined criteria and sorting tasks based on different attributes.

### **Implementation**
- **Request Handling**: Identifies and processes different types of requests (e.g., create, modify, delete, search, sort, etc.).
- **Database Operations**: Executes SQL queries to perform CRUD operations on the tasks table in the MySQL database.
- **Data Validation**: Sanitizes and validates user input to prevent security vulnerabilities such as SQL injection and XSS attacks.
- **Session Handling**: Manages PHP sessions to maintain user state and session data across requests.

## **Getting Started**
1. Clone the repository to your local machine.
2. Set up a MySQL database and import the provided schema (todolist.sql) to create the necessary tables.
3. Configure the database connection settings in the server.php file.
4. Ensure that your web server environment supports PHP.
5. Access the main.php file through your web browser to start using the To-Do List application.
