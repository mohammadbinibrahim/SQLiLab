<?php    
    // Database connection
    $host = 'localhost';
    $username = ''; // your mysqli's username
    $passwd = ''; // your mysqli's password
    $db = ''; // your db's name
    $conn = new mysqli($host, $username, $passwd, $db);
    
    // Check for database connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
    
    <!DOCTYPE HTML>
    <html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>SQL Injection</title>
        <link rel='stylesheet' href='styles.css'>
    </head>
    <body>
        <div id='mainsearch'>
            <p class='main'>Search for people!</p>
            <form action='index.php' method='GET'>
                <input type='text' id='inputfield' name='searchedperson'>
                <br>
                <input type='submit' id='submitbutton' value='Search!'>
            </form>
            <br>
            <br>
        </div>
    </body>
    </html>
    
    <?php
    // Get the user input from the URL
    $name = $_GET['searchedperson'];
    
    
    // Use the injected query to retrieve results
    $sql = "SELECT * FROM people WHERE name LIKE '%$name%';"; // Vulnerable query
    echo "<br><br><br><br><br><br><br><br><br><br>";
    $result = $conn->query($sql);
    echo "<br><br>";
    
    // Check for errors in the query
    if (!$result) {
        die("Error in query: " . $conn->error); // Show error message if query fails
    }
    
    // Check if any rows are returned
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p id='output'>";
            foreach ($row as $column_name => $value) {
                echo $column_name . ": " . $value . " | "; // Print column name and value
            }
            echo "<br></p>";
        }
    } else {
        echo "<p id='output'>"."0 results found"."</p>";
    }
    
    // Close the database connection
    $conn->close();
?>
