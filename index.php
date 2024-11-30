<?php
// Define the API endpoint URL
$URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Fetch data from the API
$response = file_get_contents($URL);

// Check if the request was successful
if ($response === FALSE) {
    die('Error occurred while fetching data');
}

// Decode JSON response
$result = json_decode($response, true);

// Check if decoding was successful
if ($result === NULL) {
    die('Error decoding JSON: ' . json_last_error_msg());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UOB Student Nationality Data</title>
    <link rel="stylesheet" href="https://unpkg.com/picocss@1.5.0/dist/pico.min.css">
    <style>
        .responsive-table {
            width: 100%;
            border-collapse: collapse;
            overflow-x: auto;
            display: block;
        }
        .responsive-table th, .responsive-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .responsive-table th {
            background-color: #f4f4f4;
        }
        @media screen and (max-width: 600px) {
            .responsive-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>
    <h1>UOB Student Nationality Data</h1>
    <table class="responsive-table">
        <thead>
            <tr>
                <th>Year</th>
                <th>Semester</th>
                <th>The Programs</th>
                <th>Nationality</th>
                <th>Colleges</th>
                <th>Number of Students</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through the data and display each record in the table
            if (isset($result['results']) && is_array($result['results'])) {
                foreach ($result['results'] as $record) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($record['year'] ?? 'N/A') . '</td>';
                    echo '<td>' . htmlspecialchars($record['semester'] ?? 'N/A') . '</td>';
                    echo '<td>' . htmlspecialchars($record['the_programs'] ?? 'N/A') . '</td>';
                    echo '<td>' . htmlspecialchars($record['nationality'] ?? 'N/A') . '</td>';
                    echo '<td>' . htmlspecialchars($record['colleges'] ?? 'N/A') . '</td>';
                    echo '<td>' . htmlspecialchars($record['number_of_students'] ?? 'N/A') . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="4">No data available</td></tr>';
            }
            ?>
        </tbody>
    </table>
</body>
</html>
