<?php 

require_once 'config.php';
require_once 'fpdf/fpdf.php';

if($_SERVER['REQUEST_METHOD']=='POST')
{
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phone_number'];
    $trainingPlanId = $_POST['training_plan_id'];
    $photoPath = $_POST['photo_path'];
    $trainerId = 0;
    $accessCardPdf = "";

$sql = "INSERT INTO members (first_name, last_name, email, phone_number, photo_path, training_plan_id, trainer_id, access_card_pdf_path)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$run = $conn -> prepare($sql);

$run -> bind_param("sssssiis", $firstName, $lastName, $email, $phoneNumber, $photoPath, $trainingPlanId, $trainerId, $accessCardPdf);

$run -> execute();

$_SESSION['success_message'] = "Member successfully added!";

$member_id = $conn->insert_id;

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

$pdf->Cell(40, 10, 'Access Card');
$pdf->Ln();
$pdf->Cell(40,10,'Member ID: ' . $member_id);
$pdf->Ln();
$pdf->Cell(40,10,'Name: ' . $firstName . $lastName);
$pdf->Ln();
$pdf->Cell(40,10,'Email: ' . $email);
$pdf->Ln();

$filename = 'access_cards/access_card_' . $member_id . '.pdf';
$pdf->Output('F',$filename);

$sql = "UPDATE members SET access_card_pdf_path = ? WHERE member_id = ?";

$run = $conn -> prepare($sql);

$run -> bind_param("si", $filename, $member_id);

$run -> execute();

header("Location: admin_dashboard.php");
exit();

}


