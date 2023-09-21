<?php

declare(strict_types=1);

function getTransactionFiles(string $dirPath): array
{
    $files = [];
    foreach (scandir($dirPath) as $file) {
        if (is_dir($file)) {
            continue;
        };
        $files[] = $dirPath . $file;
    };
    return $files;
}
function getTransactions(string $fileName): array
{
    if (!file_exists($fileName)) {
        trigger_error('"Dosya ' . $fileName . '"bulunmamaktadır.', E_USER_ERROR);
    }
    $file = fopen($fileName, 'r');
    fgetcsv($file);
    $transactions = [];
    while (($transaction = fgetcsv($file)) !== false) {
        $transactions[] = extractTransaction($transaction);
    }
    return $transactions;
}
function extractTransaction(array $transactionRow)
{
    [$date, $check, $description, $amount] = $transactionRow;

    return [
        'date' => $date,
        'check' => $check,
        'description' => $description,
        'amount' => $amount,
    ];
}

function findTotalAmount(array $transactions)
{
    $totals = ['netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];
    foreach ($transactions as $transaction) {
        $totals['netTotal'] += formatMoney($transaction['amount']);
        if (formatMoney($transaction['amount']) >= 0) {
            $totals['totalIncome'] += formatMoney($transaction['amount']);
        } else {
            $totals['totalExpense'] += formatMoney($transaction['amount']);
        }
    }
    return $totals;
}
