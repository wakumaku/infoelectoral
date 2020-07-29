<?php
/**
 * toCSV
 * 
 * Espera recibir un array de objetos serializado a través del STDIN y lo convierte a CSV
 * La salida se puede redirigir a un archivo o a otro proceso
 */


// Lee un string en el standard input
$in = fgets(STDIN);

// Handler del standard output
$out = STDOUT;

// Se espera que el string de entrada sea un array serializado
$records = unserialize($in);

if (!is_array($records)) {
    echo "ERROR: STDIN object no es un array\n";
    exit(1);
}

// Control de cabeceras
$headersPrinted = false;

foreach ($records as $record) {
    if (!$headersPrinted) {
        fputcsv($out, array_keys($record)); 
        $headersPrinted = true;
    }
    fputcsv($out, array_values($record)); 
}

fclose($out);
