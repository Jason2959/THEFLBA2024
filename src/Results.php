<!DOCTYPE=html>
    <html>

    <meta charset=" UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" type="image/x-icon" href="./Images/favicon.ico">
    <link rel="stylesheet" href="Stylation.css" />
    <div class="container-fluid">

        <head>
            <title>GPA Calculator</title>

        <body>
            <div class="topnav">
                <a href="index.html">Home</a>
                <a class="active" href="Calculator.php">Calculator</a>
                <a href="FAQ.html">FAQ</a>
            </div>
        </body>
        </head>

        <body>
            <div class="CalcText">
                <h1>About Your results:</h1>
                <p> GPA or grade point average, is the cumulative score of a person's grades throughout their high
                    school years. GPA is calculated by class weight and grade. The class weight is dropped down by 1
                    point for every 10 points the final is missing from a 100. After summating all the classes after
                    taking into account the grade and weights you will then divide by the total amount of classes to get
                    your grade point average. </p>
                <?php

                function calculateGPA($classNames, $classWeights, $finalGrades)
                {
                    $totalWeightedPoints = 0;
                    $totalCredits = 0;

                    for ($i = 0; $i < count($classNames); $i++) {
                        $grade = $finalGrades[$i];
                        $classWeight = $classWeights[$i];

                        if ($grade >= 90) {
                            $weightedPoints = $classWeight;
                        } elseif ($grade >= 80) {
                            $weightedPoints = $classWeight - 1;
                        } elseif ($grade >= 70) {
                            $weightedPoints = $classWeight - 2;
                        } elseif ($grade >= 60) {
                            $weightedPoints = $classWeight - 3;
                        } else {
                            $weightedPoints = 0;
                        }

                        $totalWeightedPoints += $weightedPoints;
                        $totalCredits += $classWeight;
                    }

                    // Avoid division by zero
                    $gpa = ($totalCredits > 0) ? $totalWeightedPoints / count($classNames) : 0;

                    return round($gpa, 2); // Round GPA to two decimal places
                }

                function test_input($data)
                {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }

                function checkHonorsClass($classNames, $classWeights)
                {
                    for ($i = 0; $i < count($classNames); $i++) {
                        // Check if the class name contains "Honors" (case-insensitive)
                        if (stripos($classNames[$i], 'honors') !== false && $classWeights[$i] < 4.5) {
                            return true;
                        }
                    }
                    return false;
                }
                function checkAPClass($classNames, $classWeights)
                {
                    for ($i = 0; $i < count($classNames); $i++) {
                        // Check if the class name contains "AP" (case-insensitive)
                        if (stripos($classNames[$i], 'AP') !== false && $classWeights[$i] < 5) {
                            return true;
                        }
                    }
                    return false;
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Retrieve and sanitize form data
                    $classNames = isset($_POST["ClassName"]) ? (array) $_POST["ClassName"] : [];
                    $classWeights = isset($_POST["ClassWeight"]) ? (array) $_POST["ClassWeight"] : [];
                    $finalGrades = isset($_POST["FinalGrade"]) ? array_map("floatval", (array) $_POST["FinalGrade"]) : [];

                    // Apply test_input function only if the array is not empty
                    // Apply test_input function only if the array is not empty
                    $classNames = !empty($classNames) ? array_map("test_input", $classNames) : [];
                    $classWeights = !empty($classWeights) ? array_map("floatval", $classWeights) : [];
                    $finalGrades = !empty($finalGrades) ? array_map("floatval", $finalGrades) : [];


                    $finalGPA = calculateGPA($classNames, $classWeights, $finalGrades);

                    // Display the form data
                    echo "<h2>Form Data:</h2>";

                    // Determine the maximum number of entries
                    $maxEntries = max(count($classNames), count($classWeights), count($finalGrades));
                    echo "<ol>";
                    // Display all submitted fields (loop through the maximum number of entries)
                    for ($i = 0; $i  < $maxEntries; $i++) {  
                        //echo "<p>Class " . ($i + 1) . ":</p>";
                        //echo "<p>Class Name: " . ($i < count($classNames) ? $classNames[$i] : "") . "</p>";
                        //echo "<p>Class Weight: " . ($i < count($classWeights) ? $classWeights[$i] : "") . "</p>";
                        //echo "<p>Final Grade: " . ($i < count($finalGrades) ? $finalGrades[$i] : "") . "</p>";
                        echo "<li><p> " . ($i < count($classNames) ? $classNames[$i] : "") . ", is weighed at  " . ($i < count($classWeights) ? $classWeights[$i] : "") . " and had a final grade of " . ($i < count($finalGrades) ? $finalGrades[$i] : "") . "%.</p></li>";
                    }
                    echo "</ol>";
                    echo "<h1>Results</h1>";
                    echo "<p>Thus your final GPA summates to: <strong>" . $finalGPA . "</strong></p>";
                    // Check if there's an Honors class with weight less than 4.5
                    if (checkHonorsClass($classNames, $classWeights)) {
                        echo '<p style="color: red; font-weight: bold;">WARNING: You have a class with "Honors" in the name and a weight less than 4.5.</p>';

                        // Here, you can prompt the user or take any other necessary action.
                    }

                    if (checkAPClass($classNames, $classWeights)) {
                        echo '<p style="color: red; font-weight: bold;">WARNING: You have a class with "AP" or "Advanced Placement" in the name and a weight less than 5.</p>';

                
                                   }
                }
                ?>
            </div>
            <script src="Code.js"></script>
        </body>
    </div>

    </html>