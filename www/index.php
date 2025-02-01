<?php
// index.php

include 'db.php'; // Include the database connection file

// Initialize the result variable
$result = null;

// Check if the form is submitted
if (isset($_POST['search'])) {
    $callsign = $_POST['callsign']; // Get the callsign from the form input
    
    // Prepare the query to search for the callsign in the hamdb view
    $sql = "SELECT * FROM hamdb WHERE callsign = :callsign";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':callsign', $callsign, PDO::PARAM_STR);
    $stmt->execute();

    // Fetch the results
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search HamDB</title>
    <!-- Include Bootstrap CSS (CDN version) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Make the results table scrollable while keeping headers fixed */
        .table-container {
            max-height: 400px; /* Adjust as needed */
            overflow-y: auto;
        }
         /* Reduce the font size for the table */
         .table td, .table th {
            font-size: 0.75rem; /* Set the font size to the smallest readable size */
        }       
    </style>
</head>
<body>
    <div class="container mt-5">
        <p class="text-center">HamDB web script.<br><a href="https://github.com/w5rcp-romanparish/hamdb">https://github.com/w5rcp-romanparish/hamdb</a></p>
        <h2 class="text-center">Search for Callsign</h2>

        <!-- Search Form -->
        <form method="POST" action="index.php" class="mb-4 d-flex justify-content-center">
            <div class="form-group mb-0 mr-2">
                <label for="callsign" class="sr-only">Enter Callsign:</label>
                <input type="text" id="callsign" name="callsign" class="form-control form-control-sm" maxlength="6" required placeholder="Enter Callsign">
            </div>
            <button type="submit" name="search" class="btn btn-dark btn-sm">Search</button>
        </form>

        <?php if ($result): ?>
            <!-- Display the result if available -->
            <br>
            <hr>
            <br>
            <h2 class="text-center mb-4">Result for Callsign: <?php echo htmlspecialchars($result['callsign']); ?></h2>
            
            <div class="table-container">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>FCC ID</th>
                            <th>Class</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>ZIP</th>
                            <th>Grant Date</th>
                            <th>Expired Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo htmlspecialchars($result['fccid']); ?></td>
                            <td><?php echo htmlspecialchars($result['class']); ?></td>
                            <td><?php echo htmlspecialchars($result['first']); ?></td>
                            <td><?php echo htmlspecialchars($result['middle']); ?></td>
                            <td><?php echo htmlspecialchars($result['last']); ?></td>
                            <td><?php echo htmlspecialchars($result['address1']); ?></td>
                            <td><?php echo htmlspecialchars($result['city']); ?></td>
                            <td><?php echo htmlspecialchars($result['state']); ?></td>
                            <td><?php echo htmlspecialchars($result['zip']); ?></td>
                            <td><?php echo htmlspecialchars($result['grant_date']); ?></td>
                            <td><?php echo htmlspecialchars($result['expired_data']); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php elseif (isset($_POST['search'])): ?>
            <!-- If no result found -->
            <div class="alert alert-warning" role="alert">
                No results found for the callsign "<strong><?php echo htmlspecialchars($callsign); ?></strong>"
            </div>
        <?php endif; ?>
    </div>

    <!-- Include Bootstrap JS and jQuery (for Bootstrap's interactive components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>


