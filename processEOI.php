<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Processing</title>
    <!-- We link the same CSS file to keep the style consistent -->
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <a href="index.php" class="logo">Quantum®</a>
            <nav class="main-nav">
                <!-- You can keep the nav here or remove it on the processing page -->
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="card">
                <?php
                // Function to sanitize input data
                function sanitise_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }

                // Check if the form was submitted using POST method
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    require_once("settings.php"); // Get database settings
                    $conn = @mysqli_connect($host, $user, $pwd, $sql_db); // Connect to database

                    if (!$conn) {
                        die("Database connection failed: " . mysqli_connect_error());
                        echo "<h2>Database Connection Error</h2>";
                        echo "<p>We are unable to process your application at this time. Please try again later.</p>";
                    } else {
                        // --- 1. GET & SANITISE DATA ---
                        $job_ref = sanitise_input($_POST["job_ref"]);
                        $first_name = sanitise_input($_POST["first_name"]);
                        $last_name = sanitise_input($_POST["last_name"]);
                        // ... (get all other form fields similarly) ...
                        $dob = sanitise_input($_POST["dob"]);
                        $gender = isset($_POST["gender"]) ? sanitise_input($_POST["gender"]) : "";
                        $address = sanitise_input($_POST["address"]);
                        $suburb = sanitise_input($_POST["suburb"]);
                        $state = sanitise_input($_POST["state"]);
                        $postcode = sanitise_input($_POST["postcode"]);
                        $email = sanitise_input($_POST["email"]);
                        $phone = sanitise_input($_POST["phone"]);
                        $other_skills = sanitise_input($_POST["other_skills"]);
                        $skills_array = isset($_POST["skills"]) ? $_POST["skills"] : [];
                        $skills_string = implode(", ", $skills_array);

                        // --- 2. VALIDATE DATA ---
                        $errors = [];
                        if (!preg_match("/^[a-zA-Z0-9]{5}$/", $job_ref)) { $errors[] = "Job Reference must be 5 alphanumeric characters."; }
                        if (!preg_match("/^[a-zA-Z\s]{1,20}$/", $first_name)) { $errors[] = "First Name must be up to 20 alpha characters."; }
                        // ... (add all other validation rules here) ...

                        // --- 3. PROCESS ---
                        if (!empty($errors)) {
                            echo "<h2>Error! Please fix the following:</h2>";
                            echo "<ul>";
                            foreach ($errors as $error) { echo "<li>$error</li>"; }
                            echo "</ul>";
                            echo "<a href='apply.php' class='btn'>Go Back and Correct</a>";
                        } else {
                            // --- 4. INSERT DATA ---
                            $query = "INSERT INTO eoi (JobReferenceNumber, FirstName, LastName, DateOfBirth, Gender, StreetAddress, SuburbTown, State, Postcode, Email, PhoneNumber, Skills, OtherSkills) 
                                      VALUES ('$job_ref', '$first_name', '$last_name', '$dob', '$gender', '$address', '$suburb', '$state', '$postcode', '$email', '$phone', '$skills_string', '$other_skills')";
                            
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                $eoi_number = mysqli_insert_id($conn);
                                echo "<h2>Application Submitted Successfully!</h2>";
                                echo "<p>Thank you, $first_name. Your EOI number is <strong>$eoi_number</strong>.</p>";
                                echo "<a href='index.php' class='btn'>Return to Home</a>";
                            } else {
                                echo "<h2>Error!</h2>";
                                echo "<p>An error occurred while saving your application.</p>";
                            }
                        }
                        mysqli_close($conn); // Close connection

                    }
                } else {
                    // Redirect if accessed directly
                    header("Location: index.php");
                    exit();
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