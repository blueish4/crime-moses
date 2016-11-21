<?php
require 'vendor/autoload.php';

use Google\Cloud\BigQuery\BigQueryClient;
putenv('GOOGLE_APPLICATION_CREDENTIALS=vendor/service-account-credentials.json');
function query($query){
    $bigQuery = new BigQueryClient([
        'projectId' => '524602867299'
    ]);

    // Get an instance of a previously created table.
    $dataset = $bigQuery->dataset('crime');
    $table = $dataset->table('upto_now');

    // Run a query and inspect the results.

    $queryResults = $bigQuery->runQuery($query);
    $to_return = [];
    foreach ($queryResults->rows() as $row) {
        $to_return[] = $row;
    }
    return $to_return;
}
