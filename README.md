# To-Do List Web Application

This project is a **To-Do List Web Application** designed to help users efficiently manage their tasks. It uses PHP for the backend, MySQL for data storage, and jQuery for dynamic behavior. The application allows users to create, view, modify, and delete tasks.

## Acknowledgements

This project was developed in **October, 2023** to learn more about PHP as a backend language, as well as MySQL for data persistence. It showcases how to build an interactive web application with PHP and MySQL.

---

## Features
- **Task Management**: Add, view, update, and delete tasks.
- **Search Functionality**: Search tasks by title, description, due date, etc.
- **Sorting**: Sort tasks by different attributes like title, description, and due date.
- **User Session Management**: Maintain user data and session state across requests.
- **Dynamic Behavior**: Use of jQuery to create, modify, and delete tasks without page reloads.

---

## Directory Structure

```
to-do-list-web-app/
├── main.php                  # Main page for interacting with the To-Do list
├── server.php                # Backend script for handling CRUD operations
├── todolist.sql              # Database schema for creating necessary tables
├── README.md                 # Project documentation
|── style.css                 # Basic styling using CSS
└── .*.js                     # jQuery script for dynamic behavior
```

---

## Getting Started

### Prerequisites
- **PHP**: Ensure you have PHP installed (version 7 or above).
- **MySQL**: A MySQL database should be set up. The provided `todolist.sql` script will create the necessary database and tables.
- **Web Server**: Set up a local web server environment (e.g., XAMPP, WAMP) to run the application.

### How to Run
1. Clone or download the repository:
    ```
    git clone https://github.com/your-username/to-do-list-web-application.git
    ```
2. Set up the MySQL database:
    - Open MySQL and run the provided `todolist.sql` script to create the required database and tables.
3. Configure the database connection in `server.php`.
4. Ensure your web server supports PHP.
5. Open `main.php` in your browser to start using the application.

---

## Usage
This project can be used to:
- Manage your personal tasks, including setting due dates, descriptions, and priorities.
- Learn how to build a simple CRUD-based web application using PHP and MySQL.
- Understand how to use jQuery for dynamic content updates without reloading the page.

---

## Possible Improvements
- Implement user authentication for securing personal task lists.
- Add advanced search options and task filters.
- Enhance the user interface with modern UI frameworks like Bootstrap or TailwindCSS.
- Implement task prioritization and deadlines with notifications.

---
