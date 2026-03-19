<?php
// 1. الجزء الخاص بمعالجة البيانات (Logic)
$gpaResult = "";
$detailsTable = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['course'])) {
    $courses = $_POST['course'];
    $credits = $_POST['credits'];
    $grades = $_POST['grade'];
    
    $totalPoints = 0;
    $totalCredits = 0;

    for ($i = 0; $i < count($courses); $i++) {
        $cName = htmlspecialchars($courses[$i]);
        $cr = floatval($credits[$i]);
        $g = floatval($grades[$i]);

        if ($cr > 0) {
            $points = $cr * $g;
            $totalPoints += $points;
            $totalCredits += $cr;
            $detailsTable .= "<tr><td>$cName</td><td>$cr</td><td>$g</td><td>$points</td></tr>";
        }
    }

    if ($totalCredits > 0) {
        $gpa = $totalPoints / $totalCredits;
        $gpaResult = number_format($gpa, 2);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GPA Calculator - Step 2</title>
    <link rel="stylesheet" href="style.css"> <script src="script.js"></script> </head>
<body>
    <div class="container">
        <h1>GPA Calculator (Step 2: Merged)</h1>

        <?php if ($gpaResult != ""): ?>
            <div style="background: #f0fdf4; border: 1px solid #16a34a; padding: 15px; margin-bottom: 20px;">
                <h3>Calculation Result:</h3>
                <p>Your GPA is: <strong><?php echo $gpaResult; ?></strong></p>
                <table border="1" style="width:100%; border-collapse: collapse;">
                    <tr style="background: #eee;">
                        <th>Course</th><th>Credits</th><th>Grade</th><th>Points</th>
                    </tr>
                    <?php echo $detailsTable; ?>
                </table>
            </div>
        <?php endif; ?>

        <form method="post" action="index_step2.php" onsubmit="return validateForm()">
            <div id="courses">
                <div class="course-row">
                    <input type="text" name="course[]" placeholder="Course Name" required>
                    <input type="number" name="credits[]" placeholder="Credits" min="1" required>
                    <select name="grade[]">
                        <option value="4.0">A</option>
                        <option value="3.0">B</option>
                        <option value="2.0">C</option>
                        <option value="1.0">D</option>
                        <option value="0.0">F</option>
                    </select>
                </div>
            </div>
            <br>
            <button type="button" onclick="addCourse()">+ Add Course</button>
            <input type="submit" value="Calculate GPA">
        </form>
    </div>
</body>
</html>
