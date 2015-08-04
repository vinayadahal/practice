<?php

if (!empty($_GET['target'])) {
    if ($_GET['target'] == 'sendReview') {
        require '../init.php';
        $name = $_POST['name'];
        $email = $_POST['email'];
        $country = $_POST['country'];
        $review = $_POST['desc'];
        $type = $_POST['reviewMail'];
        if ($type == "Recommend Trip") {
            $date = $_POST['visited'];
            $col = array('name', 'email', 'country', 'visited', 'description', 'addedOn');
            $info = array($name, $email, $country, $date, $review, date('Y:m:d'));
            if ($obj_query->insert($col, $info, 'review')) {
                echo 'success';
            } else {
                echo 'failure';
            }
        } else {
            $to = 'info@evergreentrekking.com';
            $subject = 'Feedback/Suggestion';
            $message = '<div class="trekDetails" >
                <div class="trekText" style="width: 658px;margin:0px;padding: 10px 10px 10px 10px;">
                    <br><p>' . $review . '</p><br>
                <span style="color: #e00;">' . ucfirst($name) . '</span> | <span style="color: #0a0;">' . $email . '</span> | ' . ucfirst($country) . '
                </div>
            </div>';
            $headers = 'From: Ever Green Trekking' . "\r\n" . "Content-type: text/html; charset=iso-8859-1\r\n";
            if (mail($to, $subject, $message, $headers)) {
                echo 'success';
            } else {
                echo 'failure';
            }
        }
    }
}