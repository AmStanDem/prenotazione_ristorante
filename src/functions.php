<?php

function getPrenotazioni($conn)
{
    $sql = "SELECT * FROM prenotazione";
    $query = $conn->prepare($sql);;
    $query->execute();
    return $query->get_result();
}
