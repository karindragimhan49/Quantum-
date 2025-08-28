<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage EOIs</title>
    <link rel="stylesheet" href="styles/style.css">
    <!-- Add styles for the manager table -->
    <style>
        .manage-table { width: 100%; border-collapse: collapse; margin-top: 2rem; }
        .manage-table th, .manage-table td { border: 1px solid var(--border-color); padding: 0.8rem; text-align: left; }
        .manage-table th { background-color: var(--heading-color); color: #fff; }
        .manage-table tr:nth-child(even) { background-color: var(--light-gray-color); }
        .manage-table tr:hover { background-color: #e9ecef; }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="container">
            <a href="index.php" class="logo">Quantum®</a>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="jobs.php">Jobs</a></li>
                    <li><a href="apply.php">Apply</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <!-- Add a link to this page -->
                    <li><a href="manage.php" class="active">Manage EOIs</a></li> 
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="card">
                <h2>Manage Expressions of Interest (EOIs)</h2>
                <p>Here you can view all submitted job applications.</p>
                
                <?php
                    // --- PHP SCRIPT TO DISPLAY ALL EOIS ---

                    require_once("settings.php"); // Get database settings
                    $conn = @mysqli_connect($host, $user, $pwd, $sql_db); // Connect to database

                    // Check if connection is successful
                    if (!$conn) {
                        echo "<p>Database connection failure</p>";
                    } else {
                        // Connection successful

                        // 1. Create the SQL query
                        $query = "SELECT EOInumber, JobReferenceNumber, FirstName, LastName, ApplicationStatus FROM eoi ORDER BY EOInumber DESC";

                        // 2. Execute the query
                        $result = mysqli_query($conn, $query);

                        // 3. Check if query was successful
                        if (!$result) {
                            echo "<p>Something is wrong with the query: ", $query, "</p>";
                        } else {
                            // Query was successful, check if there are any records
                            if (mysqli_num_rows($result) > 0) {
                                
                                // 4. Display the records in a table
                                echo "<table class='manage-table'>";
                                echo "<thead><tr>"
                                    . "<th>EOI Number</th>"
                                    . "<th>Job Ref</th>"
                                    . "<th>First Name</th>"
                                    . "<th>Last Name</th>"
                                    . "<th>Status</th>"
                                    . "</tr></thead>";
                                echo "<tbody>";

                                // Loop through each record and display it in a table row
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>", $row["EOInumber"], "</td>";
                                    echo "<td>", $row["JobReferenceNumber"], "</td>";
                                    echo "<td>", $row["FirstName"], "</td>";
                                    echo "<td>", $row["LastName"], "</td>";
                                    echo "<td>", $row["ApplicationStatus"], "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody></table>";

                                // Free the result set from memory
                                mysqli_free_result($result);

                            } else {
                                // No records found
                                echo "<p>No EOIs found in the database.</p>";
                            }
                        }
                        // Close the database connection
                        mysqli_close($conn);
                    }
                ?>
            </div>
        </div>
    </main>

    <footer class="main-footer">
        <div class="container">
            <p>&copy; 2025 Quantum. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>