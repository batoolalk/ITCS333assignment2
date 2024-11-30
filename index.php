<!DOCTYPE html>
<html>
    <head>
        <title>UOB Student Nationality Data</title>
    </head>
    <body>
        <main>
            <h1>UOB Student Nationality Data</h1>
            <?php
            $url = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";
            $response = file_get_contents($url);
            $result = json_decode($response, true);
            ?>
            <table>
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Semester</th>
                        <th>Program</th>
                        <th>Nationality</th>
                        <th>Number of Students</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result['results'] as $row) { ?>
                        <tr>
                            <td><?php echo $row['year']; ?></td>
                            <td><?php echo $row['semester']; ?></td>
                            <td><?php echo $row['the_programs']; ?></td>
                            <td><?php echo $row['nationality']; ?></td>
                            <td><?php echo $row['number_of_students']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </main>
    </body>
</html>
