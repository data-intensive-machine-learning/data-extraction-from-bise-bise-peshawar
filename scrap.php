<?php
$results = [];
$initial = '31';
for($i=0; $i<100; $i++){

    $rollNo = '1025'.$initial;
    $scrapUrl = 'https://cloud.bisep.edu.pk/ShowResult.php?Search=RollNo&RollNo='.$rollNo;
    $scrapHtml = file_get_contents($scrapUrl);
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($scrapHtml);
    libxml_clear_errors();


    $results[$i]['rollNo'] = $dom->getElementsByTagName('td')->item(2)->nodeValue;
    $results[$i]['name'] = $dom->getElementsByTagName('td')->item(4)->nodeValue;
    $results[$i]['fatherName'] = $dom->getElementsByTagName('td')->item(6)->nodeValue;
    $results[$i]['marks'] = $dom->getElementsByTagName('td')->item(8)->nodeValue;
    $results[$i]['grade'] = $dom->getElementsByTagName('td')->item(10)->nodeValue;

    $results[$i]['english-1'] = $dom->getElementsByTagName('td')->item(22)->nodeValue;
    $results[$i]['english-2'] = $dom->getElementsByTagName('td')->item(26)->nodeValue;
    $results[$i]['urdu-1'] = $dom->getElementsByTagName('td')->item(30)->nodeValue;
    $results[$i]['urdu-2'] = $dom->getElementsByTagName('td')->item(34)->nodeValue;
    $results[$i]['math-1'] = $dom->getElementsByTagName('td')->item(38)->nodeValue;
    $results[$i]['math-2'] = $dom->getElementsByTagName('td')->item(42)->nodeValue;
    $results[$i]['physics-1'] = $dom->getElementsByTagName('td')->item(46)->nodeValue;
    $results[$i]['physics-2'] = $dom->getElementsByTagName('td')->item(50)->nodeValue;
    $results[$i]['chemistry-1'] = $dom->getElementsByTagName('td')->item(54)->nodeValue;
    $results[$i]['chemistry-2'] = $dom->getElementsByTagName('td')->item(58)->nodeValue;
    $results[$i]['biology-1'] = $dom->getElementsByTagName('td')->item(62)->nodeValue;
    $results[$i]['biology-2'] = $dom->getElementsByTagName('td')->item(66)->nodeValue;
    $results[$i]['islamiat-1'] = $dom->getElementsByTagName('td')->item(70)->nodeValue;
    $results[$i]['islamiat-2'] = $dom->getElementsByTagName('td')->item(74)->nodeValue;
    $results[$i]['pakistan-studies-1'] = $dom->getElementsByTagName('td')->item(78)->nodeValue;
    $results[$i]['pakistan-studies-2'] = $dom->getElementsByTagName('td')->item(82)->nodeValue;

    $initial++;
}

$filename = 'result.xls';
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");
$print_header = false;
foreach($results as $row) {
    if(!$print_header) {
        echo implode("\t", array_keys($row)) . "\n";
        $print_header=true;
    }
    echo implode("\t", array_values($row)) . "\n";
}
exit;

?>
