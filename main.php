<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">

    <!--jQuery import-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!--jQuery dynamic behaviour-->
    <script src="create.js"></script>
    <script src="delete.js"></script>
    <script src="modify.js"></script>
    <script src="sort.js"></script>

</head>

<body>
    <form action="server.php" method="POST">

        <!--Search-->
        <label for="searchType">Search By:</label>
        <select id="searchType" name="searchType">
            <option value="Title">Title</option>
            <option value="Description">Description</option>
            <option value="DueDate">Due Date</option>
            <option value="TimeEstimate">Time Estimate</option>
            <option value="Progress">Progress</option>
            <option value="StatusName">Status</option>
            <option value="PriorityName">Priority</option>
        </select>
        <label for="search">Search:</label>
        <input type="text" name="searchCriteria" placeholder="Enter search criteria">
        <button type="submit" id="search" name="search">Search</button>
        <button type="submit" id="refresh" name="refresh">Show All</button>

        <!--Tasks-->
        <table id="main">

            <!--Table headers-->
            <tr>
                <th>Title<button type="submit" class="sort" name="sortDe" value="Title"></button><button type="submit"
                        class="sort" name="sortAs" value="Title"></button></th>
                <th>Description<button type="submit" class="sort" name="sortDe" value="Description"></button><button
                        type="submit" class="sort" name="sortAs" value="Description"></button></th>
                <th>Due Date<button type="submit" class="sort" name="sortDe" value="DueDate"></button><button
                        type="submit" class="sort" name="sortAs" value="DueDate"></button></th>
                <th>Time Estimate<button type="submit" class="sort" name="sortDe" value="TimeEstimate"></button><button
                        type="submit" class="sort" name="sortAs" value="TimeEstimate"></button></th>
                <th>Progress<button type="submit" class="sort" name="sortDe" value="Progress"></button><button
                        type="submit" class="sort" name="sortAs" value="Progress"></button></th>
                <th>Status<button type="submit" class="sort" name="sortDe" value="StatusID"></button><button
                        type="submit" class="sort" name="sortAs" value="StatusID"></button></th>
                <th>Priority<button type="submit" class="sort" name="sortDe" value="PriorityID"></button><button
                        type="submit" class="sort" name="sortAs" value="PriorityID"></button></th>
                <th>Action</th>
            </tr>

            <!--Tasks from database-->
            <?php
            //Start session if not already active 
            session_status() !== PHP_SESSION_ACTIVE? session_start() : "";

            //Construct database connection and initialize statement
            $db = new mysqli("localhost", "dbuser", "dbpass", "todolist");
            $stmt = $db->stmt_init();

            //Initial query
            $qry = "select t.TaskID, t.Title, t.Description, t.DueDate, t.TimeEstimate, t.Progress, s.StatusName, p.PriorityName
            from tasks t natural join status s natural join priorities p";

            if (isset($_SESSION["searchCriteria"])) { //Search
                //Get search parameters
                $searchType = $_SESSION["searchType"];
                $searchCriteria = $_SESSION["searchCriteria"];

                //Modify query
                $qry .= " where $searchType like ?";

                if (isset($_SESSION["sortDe"])) { //Descending sort
                    //Get sort parameter
                    $sortBy = $_SESSION["sortDe"];

                    //Modify query
                    $qry .= " order by $sortBy desc";

                    ?>
                    
                    <script>
                        //Add "active" class to the button that was clicked
                        $("button[name='sortDe'][value=<?php echo $sortBy ?>]").addClass("active");
                    </script>
                    
                    <?php

                } else if (isset($_SESSION["sortAs"])) { //Ascending sort
                    //Get sort parameter
                    $sortBy = $_SESSION["sortAs"];

                    //Modify query
                    $qry .= " order by $sortBy asc";

                    ?>
                    
                    <script>
                        //Add "active" class to the button that was clicked
                        $("button[name='sortAs'][value=<?php echo $sortBy ?>]").addClass("active");
                    </script>

                    <?php
                }

                //Prepare statement            
                $stmt->prepare($qry);
                $stmt->bind_param("s", $searchCriteria);


            } else {
                if (isset($_SESSION["sortDe"])) { //Ascending sort
                    //Get sort parameter
                    $sortBy = $_SESSION["sortDe"];

                    //Modify query
                    $qry .= " order by $sortBy desc";

                    ?>

                    <script>
                        //Add "active" class to the button that was clicked
                        $("button[name='sortDe'][value=<?php echo $sortBy ?>]").addClass("active");
                    </script>

                    <?php

                } else if (isset($_SESSION["sortAs"])) { //Descending sort
                    //Get sort parameter
                    $sortBy = $_SESSION["sortAs"];

                    //Modify query
                    $qry .= " order by $sortBy asc";

                    ?>

                    <script>
                        //Add "active" class to button that was clicked 
                        $("button[name='sortAs'][value=<?php echo $sortBy ?>]").addClass("active");
                    </script>

                    <?php
                }

                //Prepare statement
                $stmt->prepare($qry);
            }

            //Execute statement and bind results
            $stmt->execute();
            $stmt->bind_result($i, $Title, $Description, $DueDate, $TimeEstimate, $Progress, $Status, $Priority);
            
            //Create HTML structure and display tasks
            while ($stmt->fetch()) {
                echo "<tr><td class='title'>$Title</td>
                      <td class='description'>$Description</td>
                      <td class='dueDate'>$DueDate</td> 
                      <td class='timeEstimate'>$TimeEstimate</td>
                      <td class='progress'>$Progress%</td>
                      <td class='status'>$Status</td>
                      <td class='priority'>$Priority</td>
                      <td>
                      <button type='submit' class='delete2' name='delete2' value='$i' style='display:none;'>Confirm?</button>
                      <button type='button' class='delete'>Delete</button>
                      <button type='submit' class='modify2' name='modify2' value='$i' style='display:none;'>Confirm</button>
                      <button type='submit' class='mdCancel' name='mdCancel' style='display:none;'>Cancel</button>
                      <button type='button' class='modify'>Modify</button>
                      </td>
                      </tr>";
            }

            //Free statement and close database connection
            $stmt->free_result();
            $stmt->close();
            $db->close();

            ?>
        </table>

        <!--Task creation buttons-->
        <button type='button' id="create">Create Task</button>
        <button type="submit" id="create2" name="create2" style="display:none;">Confirm</button>
        <button type="button" id="crCancel" style="display:none;">Cancel</button>
    </form>

</body>

</html>