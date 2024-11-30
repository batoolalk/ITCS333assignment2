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
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-color: #f9f9f9; /* Optional light background */
            font-family: 'Inter', Arial, sans-serif;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.5em;
        }
        .responsive-table {
            width: 90%;
            max-width: 1200px; /* Restrict maximum table width */
            margin: 0 auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional shadow */
            background-color: #fff; /* White table background */
            border-radius: 8px; /* Rounded corners */
            overflow: hidden;
            font-size: 0.85em;
        }
        .responsive-table thead {
            background-color: #f8f9fa;
            text-align: left;
            font-weight: bold;
            border-bottom: 2px solid #dee2e6;
        }
        .responsive-table th, .responsive-table td {
            padding: 12px 20px;
            border-bottom: 1px solid #dee2e6;
        }
        .responsive-table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
        .responsive-table tbody tr:nth-child(even) {
            background-color: #ffffff;
        }
        .responsive-table tbody tr:hover {
            background-color: #e9ecef;
        }
        @media screen and (max-width: 768px) {
            .responsive-table th, .responsive-table td {
                padding: 10px;
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
                echo '<tr><td colspan="6">No data available</td></tr>';
            }
            ?>
        </tbody>
    </table>
</body>
</html>
