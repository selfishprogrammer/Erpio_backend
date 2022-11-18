<?php
$conn = mysqli_connect("localhost", "root", "", "erpio");
if ($conn) {
    echo "Connected";
} else {
    echo "Failed";
}
