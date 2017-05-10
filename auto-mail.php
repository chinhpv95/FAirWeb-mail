<?php

    include('phpmailer/class.smtp.php');
    include "phpmailer/class.phpmailer.php"; 
    include "phpmail.php";

	$conn = mysqli_connect('localhost', 'root', '', 'user');

	function getData($id){
    	$json = file_get_contents("http://118.70.72.15:8080/sos-bundle/api/v1/timeseries/$id");
    	$data = json_decode($json, true);
    	return $data;
	}

    function comparePm25($value) {
        if ((0<$value) && (35>$value)) {
            return 1;
        }
        else if ((36<$value) && (75>$value)) {
            return 2;
        }
        else if ((76<$value) && (115>$value)) {
            return 3;
        }
        else if ((116<$value) && (150>$value)) {
            return 4;
        }
        else if ((151<$value) && (250>$value)) {
            return 5;
        }
        else if ((251<$value) && (350>$value)) {
            return 6;
        }
        else if (351>$value) {
            return 7;
        }
    }

    function compareCmt($level) {
        if ($level == 1) {
            return "Chất lượng không khí trong lành, tốt cho sức khỏe.";
        }
        else if ($level == 2) {
            return "Chất lượng không khí bình thường, không xấu.";
        }
        else if ($level == 3) {
            return "Chất lượng không khí chưa sạch, ở mức độ cảnh báo.";
        }
        else if ($level == 4) {
            return "Chất lượng không khí ô nhiễm vừa phải, lời khuyên nên lọc không khí.";
        }
        else if ($level == 5) {
            return "Chất lượng không khí ô nhiễm nhiều, cần thiết phải lọc không khí.";
        }
        else if ($level == 6) {
            return "Chất lượng không khí ô nhiễm nghiêm trọng, nên có biện pháp bảo vệ đường hô hấp.";
        }
        else if ($level == 7) {
            return "Chất lượng không khí ô nhiễm vô cùng nghiêm trọng, không thích hợp cho hít thở và sự sống.";
        }

    }

    $sql = "SELECT * FROM user";

    $querry = mysqli_query($conn, $sql);
    if (!$querry){
        die ('Câu truy vấn bị sai');
    }   

    while ($row = mysqli_fetch_assoc($querry)) {

        $title = $content = $nTo = $mTo = " ";
        //lấy dữ liệu từ api
        $obser = getData($row['id_station']);
        
        $pm25 = $obser['lastValue']['value'];
        $uom = $obser['uom'];
        $station_label = $obser['station']['properties']['label'];
        $last_time_from_api_unix = substr($obser['lastValue']['timestamp'], 0, 10);
        $last_time_from_api_unix += 25200; //đổi múi giờ sang +7
        $last_time_from_api_unix = gmdate("d-m-Y H:i",substr($obser['lastValue']['timestamp'], 0, 10));


        $pm25_current_level = comparePm25($pm25);

        //lấy thời gian hiện tại ở dạng UNIX time
        $time_now=time();

        if (($time_now - $last_time_from_api_unix < 3600) && ($pm25 != 0) && ($pm25_current_level >= $row['level'])) {
            $title = 'Chỉ số không khí trạm '.$station_label;
            $content = 'Chỉ số PM2.5 ở trạm '.$station_label.' lúc '.$last_time_from_api_unix.' là '.$pm25.' μg/m3. '.compareCmt($pm25_current_level);
            $nTo = 'Chinh';
            $mTo = $row['mail'];
            echo $mTo;

        }
        $title = 'Chỉ số không khí trạm '.$station_label;
        $content = 'Chỉ số PM2.5 ở trạm '.$station_label.' lúc '.$last_time_from_api_unix.' là '.$pm25.' μg/m3. '.compareCmt($pm25_current_level);
        $nTo = 'Chinh';
        $mTo = $row['mail'];
        echo $mTo;

        $mail = sendMail($title, $content, $nTo, $mTo,$diachicc='');
        if($mail==1) {
            echo "OK <br>";
        } else {
            echo "Fail <br>";
        }

        //trừ số lần cảnh báo trong db
        $id = $row['id'];
        $duration = $row['duration'];
        $duration--;
        $sql_update = "UPDATE user SET duration=$duration WHERE id=$id";
        $conn->query($sql_update);

    }

    //xóa các trường hết hạn cảnh báo
    $sql_delete = "DELETE FROM user WHERE duration=0";
    $conn->query($sql_delete); 
	
 ?>