<?php

function addAuditLog($conn, $userId, $activity)
{
    $sql = "
    INSERT INTO audit_logs
    (
        user_id,
        activity
    )
    VALUES
    (
        '$userId',
        '$activity'
    )
    ";

    mysqli_query($conn, $sql);
}
?>