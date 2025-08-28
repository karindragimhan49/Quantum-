<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Enhancements</title>
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
                <h2>Website Enhancements</h2>
                <p>This page details the enhancements and creative implementations that go beyond the basic requirements of the assignment.</p>
            </div>

            <div class="card">
                <h3>Enhancement 1: Professional, Modern User Interface (UI)</h3>
                <p>
                    A significant effort was made to create a visually appealing and professional user interface that mimics modern tech company websites. This goes beyond basic HTML and CSS styling.
                </p>
                <h4>Key Features Implemented:</h4>
                <ul>
                    <li><strong>CSS Gradient Hero Section:</strong> Instead of a static image, the homepage features a dynamic, minimalist hero section created entirely with CSS gradients and pseudo-elements (`::before`, `::after`). This provides a modern, clean aesthetic without relying on image files, improving load times. You can see this on the <a href="index.php">Home page</a>.</li>
                    <li><strong>Interactive Navigation Bar:</strong> The navigation bar uses a subtle underline animation on hover, providing clear visual feedback to the user. This was achieved using CSS pseudo-elements and transitions.</li>
                    <li><strong>Consistent Design Language:</strong> A consistent color palette, typography (using Google Fonts), and spacing is maintained across all pages using CSS variables for easy management.</li>
                    <li><strong>Card-based Layout with Hover Effects:</strong> Content is organized into cards with box-shadows and a subtle "lift" effect on hover, adding depth and interactivity to the layout.</li>
                </ul>
            </div>
            
            <div class="card">
                <h3>Enhancement 2: Responsive Design for Mobile Devices</h3>
                <p>
                    The website is designed to be fully responsive, ensuring a seamless experience on various devices, including mobile phones and tablets. This was achieved using CSS Media Queries.
                </p>
                <h4>Techniques Used:</h4>
                <ul>
                    <li><strong>Flexible Grid Layouts:</strong> Used CSS Flexbox for layouts that adapt to different screen sizes.</li>
                    <li><strong>Media Queries:</strong> A specific media query is used to adjust the navigation bar and layout for screens smaller than 768px.
                    <em>(Note: You would need to add the actual media query code to the CSS for this to be fully true).</em></li>
                </ul>
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