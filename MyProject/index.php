
<<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "myproject_db"; // اسم قاعدة البيانات الصحيح

// الاتصال بقاعدة البيانات
$conn = new mysqli($host, $user, $pass, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// الاستعلام عن البيانات
$sql = "SELECT id, name, email FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>قائمة المستخدمين</title>
    <style>
        body { font-family: Tahoma, sans-serif; margin: 40px; }
        table { border-collapse: collapse; width: 60%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: right; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <h2>قائمة المستخدمين من قاعدة البيانات</h2>

    <?php if ($result && $result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>لا توجد بيانات للعرض حالياً.</p>
    <?php endif; ?>

    <?php $conn->close(); ?>

</body>
</html>