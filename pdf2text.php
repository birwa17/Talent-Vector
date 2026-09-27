<?php
function pdf2text($filename) {
    $content = shell_exec("pdftotext $filename -");
    return $content;
}
?>
