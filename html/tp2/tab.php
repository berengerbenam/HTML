<?php
$ages = ['Macky' => 62, 'Sonko' => 45, 'Seck' => 63];
$mails['Macky'] = 'macky@gouv.sn';
$mails['Sonko'] = 'sonko@gmail.com';
$mails['Seck'] = 'seck@thies.sn';
$chaine="<html><head></head><body><table border='1px'>";

foreach ($ages as $nom => $age) {
$chaine=$chaine."<tr><td>$nom</td><td>$mails[$nom]</td><td>$age</td></tr>";
}
$chaine=$chaine."</table></body></html>";

echo "$chaine";

?>

