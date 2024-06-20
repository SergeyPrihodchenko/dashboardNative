<header class="header">
    <div class="block_header">
        
    </div>
</header>
<main class="main">
    <?=$modal?>
    <div class="block_dashboar">
        <div class="panel_dashboard">
        <select class="type_option" name="select">
            <option value="">Email</option>
            <option selected value="value2">Phone</option>
        </select>
        </div>
    </div>
    <div class="block_table">
        <table>
            <thead>
                <tr>
                <th></th>
                <th>Phone</th>
                <th>количество созданных счетов</th>
                <th>сумма созданных счетов</th>
                <th>количество выставленных счетов</th>
                <th>сумма выставленных счетов</th>
                <th>количество оплаченных счетов</th>
                <th>сума оплаченных счетов</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($clients as $client) {
                        $client_phone = $client['client_phone'];
                        $countCreatedBill = $client['countCreatedBill'];
                        $createdBill = $client['createdBill'];
                        $outputBill = $client['outputBill'];
                        $CountOutputBill = $client['countOutputBill'];
                        $closeBill = $client['closeBill'];
                        $countCloseBill = $client['countCloseBill'];

                        echo <<<HTML
                            <tr>
                                <td><a href="/phoneClientCard?phone=$client_phone">&#11162</a></td>
                                <td>$client_phone</td>
                                <td>$countCreatedBill</td>
                                <td>$createdBill</td>
                                <td>$CountOutputBill</td>
                                <td>$outputBill</td>
                                <td>$countCloseBill</td>
                                <td>$closeBill</td>
                            </tr>
                        HTML;
                    }
                ?>
            </tbody>
        </table>
    </div>
</main>
<footer class="footer">
    <div class="block_footer">

    </div>
</footer>