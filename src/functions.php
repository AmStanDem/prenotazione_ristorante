<?php

function getPrenotazioni($conn)
{
    $sql = "SELECT * FROM prenotazione";
    $query = $conn->prepare($sql);;
    $query->execute();
    return $query->get_result();
}
function insertPrenotazione($nome, $num_persone, $dt_prenotazione,$conn)
{
    $capienza_corrente = getCapienzaCorrente($dt_prenotazione,$conn);

    $nuova_capienza = $capienza_corrente - $num_persone;
    if (!checkCapienza($nuova_capienza))
        return false;


    $conn->autocommit(false);

    $sql = "INSERT INTO prenotazione (nome,num_persone,dt_prenotazione) 
            values ('$nome','$num_persone','$dt_prenotazione')";

    if ($conn->query($sql) === FALSE)
    {
        $conn->autocommit(true);
        return false;
    }
    if (!updateCapienzaCorrente($dt_prenotazione,$nuova_capienza,$conn))
    {
        $conn->autocommit(true);
        return false;
    }
    $conn->autocommit(true);
    return true;
}
function getCapienzaCorrente($dt_prenotazione,$conn):int
{
    $sql = "SELECT * FROM posto WHERE data = ?";
    $query = $conn->prepare($sql);
    $query->bind_param("s", $dt_prenotazione);
    $query->execute();
    $result = $query->get_result();
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $row['capienza_corrente'];
}
function updateCapienzaCorrente($dt_prenotazione,$capienza_corrente,$conn): bool
{
    $sql = "UPDATE  posto 
            set capienza_corrente = '$capienza_corrente'
            where data = '$dt_prenotazione'";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

function checkCapienza(int $nuova_capienza):bool
{
    if ($nuova_capienza < 0)
    {
        return false;
    }
    return true;
}
