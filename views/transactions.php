<!DOCTYPE html>
<html>

<head>
    <title>Hareketler</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th,
        table tr td {
            padding: 5px;
            border: 1px #eee solid;
        }

        tfoot tr th,
        tfoot tr td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Tarih</th>
                <th>Kontrol</th>
                <th>Açıklama</th>
                <th>Tutar</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($transactions)) : ?>
                <?php foreach ($transactions as $transaction) : ?>
                    <tr>
                        <td><?= formatDate($transaction['date']) ?></td>
                        <td><?= $transaction['check'] ?></td>
                        <td><?= $transaction['description'] ?></td>
                        <td>
                            <?php if (formatMoney($transaction['amount']) < 0) : ?>
                                <span style="color:red;">
                                    <?= formatDolarAmount(formatMoney($transaction['amount'])) ?>
                                </span>
                            <?php elseif (formatMoney($transaction['amount']) > 0) : ?>
                                <span style="color:green;">
                                    <?= formatDolarAmount(formatMoney($transaction['amount'])) ?>
                                </span>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>

        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Toplam Gelir:</th>
                <td><?= formatDolarAmount($totals['totalIncome']) ?? 0 ?></td>
            </tr>
            <tr>
                <th colspan="3">Toplam Gider:</th>
                <td><?= formatDolarAmount($totals['totalExpense']) ?? 0 ?></td>
            </tr>
            <tr>
                <th colspan="3">Toplam Net:</th>
                <td><?= formatDolarAmount($totals['netTotal']) ?? 0 ?></td>
            </tr>
        </tfoot>
    </table>
    <?php if (($totals['netTotal']) < 0) : ?>
        <span style="color:red; margin: auto; width: 100%;">
            <p>Hareketleriniz sonucunda borcunuz bulunmaktadır.</p>
        </span>
    <?php elseif (($totals['netTotal']) > 0) : ?>
        <span style="color:green; margin:auto;width: 100%;">
            <p>Hareketleriniz sonucunda fazla geliriniz bulunmaktadır.</p>
        </span>
    <?php else : ?>
        <span style="margin: auto;width: 100%;">
            <p>Hareketleriniz sonucunda dengedesiniz, ne borcunuz ne fazla geliriniz bulunmamaktadır.</p>
        </span>
    <?php endif ?>
</body>

</html>