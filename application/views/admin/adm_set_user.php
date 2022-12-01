<?php
# fungsi ranking
function ranking($ranking){
    $ordered_values = $ranking;
    rsort($ordered_values);
    echo '<tr><th>Rangking</th>';
    foreach ($ranking as $key => $value) {
    foreach ($ordered_values as $ordered_key => $ordered_value) {
    if ($value === $ordered_value) {
    $key = $ordered_key;
    break;
    }
    }
    echo '<td>' . ((int) $key + 1) . '</td>';
    }
    echo '</tr>';
}

echo ranking(array(20,10,30,50));
?>