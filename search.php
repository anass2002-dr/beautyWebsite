<?php
include "Config.php";

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $qr = 'SELECT TITLE FROM product where TITLE LIKE "%' . $search . '%" LIMIT 6';
    $result = $conn->query($qr);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $title = $row['TITLE'];
            $title_base = $title;
            if (strlen($title) > 20) {
                $title = substr($title, 0, 20);
                $title = $title . '...';
            }
            echo '<a href="product-shop.php?title=' . $title_base . '"<li class="list-group-item">' . $title . '</li>';
        }
    } else {
        echo '<li class="list-group-item">No Record</li>';
    }
} else {
    echo '<li class="list-group-item">empty value</li>';
}
