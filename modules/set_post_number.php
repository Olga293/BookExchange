<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();
require_once 'connect.php';

$post_number = $_POST['post_number'];
$sending_id = $_POST['sending_id'];

mysqli_query($connect, "UPDATE `sending` SET `post_number`='$post_number' WHERE `id`= '$sending_id'");


$result = '<div class="d-flex flex-row">
                <div class="d-flex flex-column col-6">
                    <h6>Книга отправлена</h6>';
$result .= '<h6>Код посылки: '.$post_number.'</h6>';
$result .= '</div>
                <div class="d-flex flex-column col-6">
                    
                </div>
            </div>
        </div>';
echo $result;
?>

