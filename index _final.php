 
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حاسبة المعدل - عائشة دياب</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
<div class="container border p-4 mt-5 bg-white shadow rounded">
    <h1 class="text-center mb-4 text-primary">حاسبة المعدل الأكاديمي</h1>
    
    <div id="result" class="mt-3"></div>

    <form id="gpaForm" class="mt-4">
        <div id="courses">
            <div class="row course-row mb-3">
                <div class="col-md-5">
                    <label>المادة</label>
                    <input type="text" name="course[]" class="form-control" placeholder="اسم المادة" required>
                </div>
                <div class="col-md-3">
                    <label>المعامل</label>
                    <input type="number" name="credits[]" class="form-control" placeholder="المعامل" min="1" step="0.5" required>
                </div>
                <div class="col-md-4">
                    <label>العلامة</label>
                    <select name="grade[]" class="form-control">
                        <option value="4.0">A (ممتاز)</option>
                        <option value="3.0">B (جيد جداً)</option>
                        <option value="2.0">C (جيد)</option>
                        <option value="1.0">D (مقبول)</option>
                        <option value="0.0">F (راسب)</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="mt-4">
            <button type="button" id="addCourse" class="btn btn-outline-secondary btn-block mb-2">+ إضافة مادة أخرى</button>
            <button type="submit" class="btn btn-primary btn-block shadow-sm">حساب المعدل الآن</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="script.js"></script>
</body>
</html>
