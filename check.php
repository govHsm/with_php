<?php 
include "db_conn.php";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" user-scalable=no>
    <meta name="format-detection" content="telephone=no">
    <meta name="description" content="GEOView"/>
    <meta name="keywords" content="GEOView">
    <meta property="og:type" content="website">
    <meta property="og:title" content="GEOView">
	<meta property="og:keywords" content="GEOView">
	<meta property="og:description" content="GEOView">
	<link rel="shortcut icon" href="css/favicon.ico"/>
	<link rel="icon" href="css/favicon.ico"/>

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>출퇴근 시간 조회</title>
    <style>
        /* CSS 스타일링 */
        .container {
            width: 60%;
            margin: 50px auto;
            text-align: center;
            border: 1px solid #ccc;
            padding: 20px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- 상단 메뉴 -->
    <div style="text-align: left;">
    <p class="stit bullet-circle" style="font-size:10pt;">
        <a href="logout.php" >º 로그아웃</a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="home.php" >º 이전 페이지로</a>
    </p>
    </div>
    <?php
        $emp_id = $_SESSION['id'];
        $now_day = date('Y-m-d');
        if (isset($_POST['date']));
        else  $_POST['date'] = $now_day;
        $sql = "SELECT ATT_INDATE,ATT_INTIME,ATT_OUTDATE,ATT_OUTTIME FROM AT_ATTENDANCE WHERE ATT_INDATE = '$_POST[date]' AND EMP_ID = '$emp_id'";
        $result = mysqli_query($conn, $sql);
        $work = $result -> fetch_assoc();
        $work_start_day = $work["ATT_INDATE"];
        $work_start_time = $work["ATT_INTIME"];
        $work_end_day = $work["ATT_OUTDATE"];
        $work_end_time = $work["ATT_OUTTIME"];
    ?>
    <!-- 출퇴근 현황 조회 폼 -->
    <div class="container">
        <h2>출퇴근 현황</h2>
        <form method="post">
            <label for="date">날짜 선택:</label>
            <input type="date" id="date" name="date" value="<?php echo $_POST['date'];?>" required>
            <br><br>
            <div>출근 시간: <?=$work_start_day?> <?=$work_start_time?></div>
            <br><br>
            <div>퇴근 시간: <?=$work_end_day?> <?=$work_end_time?></div>
            <br><br>
            <input type="submit" class="btn" value="조회"></input>
        </form>
    </div>
</body>
</html>
