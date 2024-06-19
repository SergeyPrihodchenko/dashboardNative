<header class="header">
    <div class="block_header">
        
    </div>
</header>
<main class="main">
    <div class="block_dashboar">
        <div class="panel_dashboard">
            <h1><?=$phone?></h1>
        </div>
    </div>
    <div class="block_table">
        <table>
            <thead>
                <tr>
                <th>client_code</th>
                <th>client_phone_id</th>
                <th>client_phone_date</th>
                <th>invoice_id</th>
                <th>invoice_status</th>
                <th>invoice_number</th>
                <th>invoice_date</th>
                <th>invoice_price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($clientData as $data) {
                    
                    $client_code = $data['client_code'];
                    $client_phone_id = $data['client_phone_id'];
                    $client_phone_date = $data['client_phone_date'];
                    $invoice_id = $data['invoice_id'];
                    $invoice_status = $data['invoice_status'];
                    $invoice_number = $data['invoice_number'];
                    $invoice_date = $data['invoice_date'];
                    $invoice_price = $data['invoice_price'];

                    echo <<<HTML
                        <tr>
                            <td>$client_code</td>
                            <td>$client_phone_id</td>
                            <td>$client_phone_date</td>
                            <td>$invoice_id</td>
                            <td>$invoice_status</td>
                            <td>$invoice_number</td>
                            <td>$invoice_date</td>
                            <td>$invoice_price</td>
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