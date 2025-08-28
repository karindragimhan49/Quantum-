<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Apply for a Position</title>
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
                    <li><a href="about.php" class="active">About Us</a></li>
                    <li><a href="enhancements.php">Enhancements</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="card">
                <h2>Job Application Form</h2>
                <p>Please fill out the form below to apply for a position at Quantum IT Solutions. Fields marked with an asterisk (*) are required.</p>
                
                <form id="apply-form" action="processEOI.php" method="post" novalidate="novalidate">
                    <div class="form-group">
                        <label for="job-ref">Job Reference Number *</label>
                        <input type="text" id="job-ref" name="job_ref" required pattern="[a-zA-Z0-9]{5}" title="Must be exactly 5 alphanumeric characters.">
                    </div>
                    
                    <div class="form-group">
                        <label for="first-name">First Name *</label>
                        <input type="text" id="first-name" name="first_name" required maxlength="20">
                    </div>

                    <div class="form-group">
                        <label for="last-name">Last Name *</label>
                        <input type="text" id="last-name" name="last_name" required maxlength="20">
                    </div>
                    
                    <div class="form-group">
                        <label for="dob">Date of Birth *</label>
                        <input type="date" id="dob" name="dob" required>
                    </div>

                    <fieldset>
                        <legend>Gender *</legend>
                        <div class="radio-group">
                            <input type="radio" id="gender-male" name="gender" value="male" required><label for="gender-male">Male</label>
                            <input type="radio" id="gender-female" name="gender" value="female"><label for="gender-female">Female</label>
                            <input type="radio" id="gender-other" name="gender" value="other"><label for="gender-other">Other</label>
                        </div>
                    </fieldset>

                    <div class="form-group">
                        <label for="address">Street Address *</label>
                        <input type="text" id="address" name="address" required maxlength="40">
                    </div>

                    <div class="form-group">
                        <label for="suburb">Suburb/Town *</label>
                        <input type="text" id="suburb" name="suburb" required maxlength="40">
                    </div>

                    <div class="form-group">
                        <label for="state">State *</label>
                        <select id="state" name="state" required>
                            <option value="">Please Select</option>
                            <option value="VIC">VIC</option>
                            <option value="NSW">NSW</option>
                            <option value="QLD">QLD</option>
                            <option value="NT">NT</option>
                            <option value="WA">WA</option>
                            <option value="SA">SA</option>
                            <option value="TAS">TAS</option>
                            <option value="ACT">ACT</option>
                        </select>
                    </div>

                     <div class="form-group">
                        <label for="postcode">Postcode *</label>
                        <input type="text" id="postcode" name="postcode" required pattern="\d{4}" title="Must be exactly 4 digits.">
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                     <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" required pattern="[0-9\s]{8,12}" title="Must be between 8 and 12 digits.">
                    </div>

                    <fieldset>
                        <legend>Skills</legend>
                         <div class="checkbox-group">
                             <input type="checkbox" id="skill1" name="skills[]" value="JavaScript"><label for="skill1">JavaScript</label>
                             <input type="checkbox" id="skill2" name="skills[]" value="Python"><label for="skill2">Python</label>
                             <input type="checkbox" id="skill3" name="skills[]" value="Cloud Computing"><label for="skill3">Cloud Computing</label>
                             <input type="checkbox" id="skill4" name="skills[]" value="Agile Methodologies"><label for="skill4">Agile Methodologies</label>
                        </div>
                    </fieldset>

                    <div class="form-group">
                        <label for="other-skills">Other Skills</label>
                        <textarea id="other-skills" name="other_skills" rows="5"></textarea>
                    </div>

                    <div class="form-actions">
                         <button type="submit" class="btn">Apply Now</button>
                    </div>
                </form>
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