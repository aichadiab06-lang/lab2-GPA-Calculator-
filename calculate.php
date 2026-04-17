
<?php
header('Content-Type: application/json');

if (isset($_POST['course'], $_POST['credits'], $_POST['grade'])) {
    $courses      = $_POST['course'];
    $credits      = $_POST['credits'];
    $grades       = $_POST['grade'];
    $totalPoints  = 0;
    $totalCredits = 0;

    $tableHtml = '<table class="table table-bordered mt-3 text-center">';
    $tableHtml .= '<thead class="table-dark">
                    <tr>
                        <th>المادة</th><th>المعامل</th>
                        <th>النقطة</th><th>النقاط المكتسبة</th>
                    </tr>
                   </thead><tbody>';

    for ($i = 0; $i < count($courses); $i++) {
        $course = htmlspecialchars($courses[$i]);
        $cr     = floatval($credits[$i]);
        $sg     = floatval($grades[$i]);
        
        if ($cr <= 0) continue;
        
        $pts           = $cr * $sg;
        $totalPoints  += $pts;
        $totalCredits += $cr;
        
        $tableHtml .= "<tr>
                        <td>$course</td><td>$cr</td>
                        <td>$sg</td><td>$pts</td>
                       </tr>";
    }
    $tableHtml .= '</tbody></table>';

    if ($totalCredits > 0) {
        $gpa = $totalPoints / $totalCredits;
        
        if ($gpa >= 3.7) {
            $interpretation = "ممتاز (Distinction)";
        } elseif ($gpa >= 3.0) {
            $interpretation = "جيد جداً (Merit)";
        } elseif ($gpa >= 2.0) {
            $interpretation = "قريب من الجيد (Pass)";
        } else {
            $interpretation = "راسب (Fail)";
        }

        $message = "معدلك الفصلي هو " . number_format($gpa, 2) . " ($interpretation).";

        echo json_encode([
            'success'   => true,
            'gpa'       => number_format($gpa, 2),
            'message'   => $message,
            'tableHtml' => $tableHtml,
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'الرجاء إدخال مواد ومعاملات صحيحة.',
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'لم يتم استقبال أي بيانات.',
    ]);
}
exit;
?>
