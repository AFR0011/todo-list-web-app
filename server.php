<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading...</title>
</head>

<body>

    <?php

    //Start session if not already active
    session_status() !== PHP_SESSION_ACTIVE ? session_start() : "";

    //Establish database connection
    $db = new mysqli("localhost", "dbuser", "dbpass", "todolist") or die("Something went wrong, please try again...");

    //Identify request
    if (array_key_exists("mdCancel", $_POST)) { //Cancel task modification
    
        //Redirect to main page to show all tasks
        header("location:main.php");
        exit();

    } else if (array_key_exists("create2", $_POST)) { //Task creation
    
        //Define filters
        $filters = [
            'Title' => FILTER_SANITIZE_STRING,
            'Description' => FILTER_SANITIZE_STRING,
            'DueDate' => FILTER_SANITIZE_STRING,
            'TimeEstimate' => FILTER_SANITIZE_NUMBER_INT,
            'Progress' => FILTER_SANITIZE_NUMBER_INT,
            'Status' => FILTER_SANITIZE_NUMBER_INT,
            'Priority' => FILTER_SANITIZE_NUMBER_INT
        ];

        //Get inputs
        $form_data = filter_input_array(INPUT_POST, $filters);

        //Adjust "Progress" if "Status" is set to "Complete" or "Not Started"
        if ($form_data["Progress"] == null) {
            if ($form_data["Status"] == 1) {
                $form_data["Progress"] = 0;
            } else if ($form_data["Status"] == 3) {
                $form_data["Progress"] = 100;
            }
        }

        //Prepare INSERT query
        $qry = "insert into tasks(Title, Description, DueDate, TimeEstimate, Progress, StatusID, PriorityID)
                values(?, ?, ?, ?, ?, ?, ?)";

        //Initialize statement
        $stmt = $db->stmt_init();

        //Prepare statement
        $stmt->prepare($qry);
        $stmt->bind_param("sssiiii", $form_data["Title"], $form_data["Description"], $form_data["DueDate"],
            $form_data["TimeEstimate"], $form_data["Progress"], $form_data["Status"], $form_data["Priority"]);

        //Run statement
        $stmt->execute();

        //Free statement and close database connection
        $stmt->free_result();
        $stmt->close();
        $db->close();

        //Redirect to and reload main page
        header("location:main.php");
        exit();

    } else if (array_key_exists("delete2", $_POST)) { //Task deletion
    
        //Get "TaskId"
        $key = filter_input(INPUT_POST, "delete2", FILTER_SANITIZE_NUMBER_INT);

        //Prepare DELETE query
        $qry = "delete from tasks where TaskID = ?";

        //Initialize statement
        $stmt = $db->stmt_init();

        //Prepare statement
        $stmt->prepare($qry);
        $stmt->bind_param("i", $key);

        //Run statement
        $stmt->execute();

        //Free statement and close database connection
        $stmt->free_result();
        $stmt->close();
        $db->close();

        //Redirect to and reload main page 
        header("location:main.php");
        exit();

    } else if (array_key_exists("modify2", $_POST)) { //Task modification
    
        //Define filters
        $filters = [
            'Title' => FILTER_SANITIZE_STRING,
            'Description' => FILTER_SANITIZE_STRING,
            'DueDate' => FILTER_SANITIZE_STRING,
            'TimeEstimate' => FILTER_SANITIZE_NUMBER_INT,
            'Progress' => FILTER_SANITIZE_NUMBER_INT,
            'Status' => FILTER_SANITIZE_NUMBER_INT,
            'Priority' => FILTER_SANITIZE_NUMBER_INT,
            'modify2' => FILTER_SANITIZE_NUMBER_INT,
        ];

        //Get inputs
        $form_data = filter_input_array(INPUT_POST, $filters);

        //Adjust progress if status is set to "Complete" or "Not Started"
        if ($form_data["Progress"] == null) {
            if ($form_data["Status"] == 1) {
                $form_data["Progress"] = 0;
            } else if ($form_data["Status"] == 3) {
                $form_data["Progress"] = 100;
            }
        }
        //Prepare UPDATE query
        $qry = "update tasks
                set Title = ?, Description = ?, DueDate = ?, TimeEstimate = ?, Progress = ?, StatusID = ?, PriorityID = ?
                where TaskID = ?;";

        //Initialize statement
        $stmt = $db->stmt_init();

        //Prepare statement
        $stmt->prepare($qry);
        $stmt->bind_param("sssiiiii", $form_data["Title"], $form_data["Description"], $form_data["DueDate"],
            $form_data["TimeEstimate"], $form_data["Progress"], $form_data["Status"], $form_data["Priority"],
            $form_data["modify2"]);
        
        //Run statement
        $stmt->execute();

        //Free statement and close database connection
        $stmt->free_result();
        $stmt->close();

        //Redirect to and reload main page
        header("location:main.php");
        exit();


    } else if (array_key_exists("search", $_POST)) { //Search
    
        //Get inputs
        $filters = [
            'searchCriteria' => FILTER_SANITIZE_STRING,
            'searchType' => FILTER_SANITIZE_STRING,
        ];

        //Get inputs
        $form_data = filter_input_array(INPUT_POST, $filters);

        //Define session variables to be used in "main.php" for search query
        $_SESSION["searchType"] = $form_data["searchType"];
        $_SESSION["searchCriteria"] = "%" . $form_data["searchCriteria"] . "%";

        //Redirect to and reload main page
        header("location:main.php");
        exit();

    } else if (array_key_exists("refresh", $_POST)) { //Reset session to show all tasks
    
        session_unset();
        session_destroy();

        //Redirect to main page to show all tasks
        header("location:main.php");
        exit();

    }

    //Reset sort buttons if request is "sort"
    unset($_SESSION["sortDe"]);
    unset($_SESSION["sortAs"]);

    //Identify other requests
    if (array_key_exists("sortDe", $_POST)) { //Descending sort
    
        //Get sort by option 
        $sortBy = filter_input(INPUT_POST, "sortDe", FILTER_SANITIZE_STRING);

        //Define session variable to be used in  "main.php" for sorted select query
        $_SESSION["sortDe"] = $sortBy;

        //Redirect to main page to sort
        header("location:main.php");
        exit();
    } else if (array_key_exists("sortAs", $_POST)) { //Ascending sort
    
        //Get sort by option 
        $sortBy = filter_input(INPUT_POST, "sortAs", FILTER_SANITIZE_STRING);

        //Define session variable to be used in  "main.php" for sorted select query
        $_SESSION["sortAs"] = $sortBy;

        //Redirect to main page to sort
        header("location:main.php");
        exit();

    } 
    ?>
</body>

</html>