<?php
foreach(glob('*.zip') as $zip) {
	unlink($zip);
}

$zip = new ZipArchive();
$filename = 'mail_template' . time() . '.zip';

if ($zip->open($filename, ZipArchive::CREATE) !== true) {
    exit('cannot open ' . $filename);
}

$newStylesCss = 'styles_' . time() . '.css';
$newResponsiveCss = 'responsive_' . time() . '.css';

$html = file_get_contents('single-column.html');
$html = str_replace('styles.css', $newStylesCss, $html);
$html = str_replace('responsive.css', $newResponsiveCss, $html);

$zip->addFromString('index.html', $html);
$zip->addFromString($newStylesCss, file_get_contents('styles.css'));
$zip->addFromString($newResponsiveCss, file_get_contents('responsive.css'));

echo "numfiles: " . $zip->numFiles . "\n";
echo "status:" . $zip->status . "\n";
$zip->close();