<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage EOIs - Quantum</title>
    <link rel="stylesheet" href="styles/style.css">
    <!-- Custom styles for the management dashboard -->
    <style>
        /* Grid layout for the management forms */
        .management-grid {
            display: grid;
            grid-template-columns: 2fr 1fr; /* 2 parts for Search, 1 part for Actions */
            gap: 2.5rem;
            align-items: flex-start;
        }
        .actions-group {
            display: grid;
            gap: 1.5rem;
        }

        /* Styling for form sections */
        .form-section {
            border: 1px solid var(--border-color);
            padding: 1.5rem;
            border-radius: 8px;
            background-color: #fdfdfd;
        }
        .form-section h4 {
            margin-top: 0;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 0.8rem;
        }
        
        /* Button colors */
        .btn-delete { background-color: #dc3545; }
        .btn-delete:hover { background-color: #c82333; }
        .btn-update { background-color: #28a745; }
        .btn-update:hover { background-color: #218838; }
        .btn-secondary { background-color: #6c757d; }
        .btn-secondary:hover { background-color: #5a6268; }

        /* Modern Table Styles */
        .manage-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .manage-table th, .manage-table td {
            border-bottom: 1px solid var(--border-color);
            padding: 1rem;
            text-align: left;
            vertical-align: middle;
        }
        .manage-table th {
            background-color: var(--light-gray-color);
            font-family: var(--header-font);
            font-weight: 600;
            color: var(--heading-color);
        }
        .manage-table tbody tr:hover {
            background-color: #e9ecef;
        }
        .action-message {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 5px;
            background-color: #e2e3e5;
            border: 1px solid #d6d8db;
        }
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
                    <li><a href="manage.php" class="active">Manage EOIs</a></li> 
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="card">
                <h2>EOI Management Dashboard</h2>
                
                <div class="management-grid">
                    <!-- Left Column: Search Forms -->
                    <div class="form-section">
                        <h4>List & Search Applications</h4>
                        <form action="manage.php" method="post">
                            <div class="form-group">
                                <label for="search_ref">Search by Job Reference:</label>
                                <input type="text" id="search_ref" name="search_ref" placeholder="e.g., SE001">
                            </div>
                            <div class="form-group">
                                <label for="search_name">Search by Applicant Name:</label>
                                <input type="text" id="search_name" name="search_name" placeholder="First or Last Name">
                            </div>
                            <button type="submit" name="action" value="search" class="btn">Search</button>
                            <button type="submit" name="action" value="list_all" class="btn btn-secondary">List All</button>
                        </form>
                    </div>

                    <!-- Right Column: Action Forms -->
                    <div class="actions-group">
                        <div class="form-section">
                            <h4>Update Status</h4>
                            <form action="manage.php" method="post">
                                <div class="form-group">
                                    <label for="update_eoi">EOI Number:</label>
                                    <input type="text" id="update_eoi" name="update_eoi" required placeholder="e.g., 3">
                                </div>
                                <div class="form-group">
                                    <label for="new_status">Set New Status:</label>
                                    <select id="new_status" name="new_status">
                                        <option value="New">New</option>
                                        <option value="Current">Current</option>
                                        <option value="Final">Final</option>
                                    </select>
                                </div>
                                <button type="submit" name="action" value="update" class="btn btn-update">Update Status</button>
                            </form>
                        </div>
                        <div class="form-section">
                            <h4>Delete by Job Reference</h4>
                            <form action="manage.php" method="post">
                                <div class="form-group">
                                    <label for="delete_ref">Job Reference:</label>
                                    <input type="text" id="delete_ref" name="delete_ref" required placeholder="e.g., SE001">
                                </div>
                                <button type="submit" name="action" value="delete" class="btn btn-delete" onclick="return confirm('Are you sure? This will delete ALL applications with this job reference.');">Delete All</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <h3>EOI Listings</h3>
                <?php
                    require_once("settings.php");
                    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

                    if (!$conn) {
                        echo "<p>Database connection failure</p>";
                    } else {
                        // Display action messages first
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
                            echo "<div class='action-message'>";
                            $action = $_POST['action'];
                            if ($action == 'delete' && !empty($_POST['delete_ref'])) {
                                echo "<strong>Result:</strong> Attempted to delete applications with Job Reference '{$_POST['delete_ref']}'.";
                            }
                            if ($action == 'update' && !empty($_POST['update_eoi'])) {
                                echo "<strong>Result:</strong> Attempted to update EOI number '{$_POST['update_eoi']}' to '{$_POST['new_status']}'.";
                            }
                             if ($action == 'search') {
                                echo "<strong>Displaying search results.</strong>";
                            }
                            echo "</div>";
                        }
                        
                        $query = "SELECT EOInumber, JobReferenceNumber, FirstName, LastName, ApplicationStatus FROM eoi ORDER BY EOInumber DESC";

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $action = isset($_POST['action']) ? $_POST['action'] : '';

                            if ($action == 'delete' && !empty($_POST['delete_ref'])) {
                                $delete_ref = mysqli_real_escape_string($conn, $_POST['delete_ref']);
                                mysqli_query($conn, "DELETE FROM eoi WHERE JobReferenceNumber = '$delete_ref'");
                            }

                            if ($action == 'update' && !empty($_POST['update_eoi']) && !empty($_POST['new_status'])) {
                                $update_eoi = mysqli_real_escape_string($conn, $_POST['update_eoi']);
                                $new_status = mysqli_real_escape_string($conn, $_POST['new_status']);
                                mysqli_query($conn, "UPDATE eoi SET ApplicationStatus = '$new_status' WHERE EOInumber = '$update_eoi'");
                            }

                            if ($action == 'search') {
                                $search_ref = mysqli_real_escape_string($conn, $_POST['search_ref']);
                                $search_name = mysqli_real_escape_string($conn, $_POST['search_name']);
                                $conditions = [];
                                if (!empty($search_ref)) { $conditions[] = "JobReferenceNumber = '$search_ref'"; }
                                if (!empty($search_name)) { $conditions[] = "(FirstName LIKE '%$search_name%' OR LastName LIKE '%$search_name%')"; }
                                if (!empty($conditions)) { $query = "SELECT * FROM eoi WHERE " . implode(' AND ', $conditions); }
                            }
                        }

                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            echo "<p>Something is wrong with the query.</p>";
                        } else {
                            if (mysqli_num_rows($result) > 0) {
                                echo "<table class='manage-table'>
                                        <thead><tr>
                                            <th>EOI #</th>
                                            <th>Job Ref</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Status</th>
                                        </tr></thead>
                                        <tbody>";
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                            <td>{$row['EOInumber']}</td>
                                            <td>{$row['JobReferenceNumber']}</td>
                                            <td>{$row['FirstName']}</td>
                                            <td>{$row['LastName']}</td>
                                            <td>{$row['ApplicationStatus']}</td>
                                          </tr>";
                                }
                                echo "</tbody></table>";
                                mysqli_free_result($result);
                            } else {
                                echo "<p>No matching EOIs found in the database.</p>";
                            }
                        }
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