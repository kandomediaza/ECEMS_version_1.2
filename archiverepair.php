<?php

require_once "connection.php";

  $job_number = $_REQUEST['archive_id']; 
 $archive_stmt = $db->prepare("INSERT INTO archived_repairs (
    job_number,
    date,
    client_full_name,
    client_email,
    client_phone,
    item_for_repair,
    repair_description,
    hardware_details,
    diagnostic_fee,
    tech_assigned,
    current_status,
    technician_notes,
    admin_notes,
    invoice_status,
    invoice_number
) (
    SELECT
        job_number,
        date,
        client_full_name,
        client_email,
        client_phone,
        item_for_repair,
        repair_description,
        hardware_details,
        diagnostic_fee,
        tech_assigned,
        current_status,
        technician_notes,
        admin_notes,
        invoice_status,
        invoice_number 
    FROM
        repairs 
    WHERE
    job_number =:job_number )");
$archive_stmt->bindParam(':job_number', $job_number);

if ($archive_stmt->execute())
{
    $delete_stmt = $db->prepare('DELETE FROM repairs WHERE job_number =:job_number');
    $delete_stmt->bindParam(':job_number', $job_number);
    $delete_stmt->execute();
    header("refresh:1;repairs.php");
}

?>