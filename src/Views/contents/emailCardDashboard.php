<header class="header">
    <div class="block_header">
        
    </div>
</header>
<main class="main">
    <div class="block_dashboar">
        <div class="panel_dashboard">
            <select class="sites_option" name="select">
            <option>список сайтов</option>
                <?php
                    foreach ($sites as $site) {
                    echo <<<HTML
                        <option value="$site">$site</option>
                    HTML;
                    }
                ?>
            </select>
            <h1><?=$site?></h1>
            <h2><?=$clientMail?></h2>
        </div>
    </div>
    <div class="block_table">
        <table>
            <thead>
                <tr>
                <th>client_id</th>
                <th>fluid_tag</th>
                <th>client_mail_id</th>
                <th>client_code</th>
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
                    
                    $client_id = $data['client_id'];
                    $fluid_tag = $data['fluid_tag'];
                    $client_mail_id = $data['client_mail_id'];
                    $client_code = $data['client_code'];
                    $invoice_id = $data['invoice_id'];
                    $invoice_status = $data['invoice_status'];
                    $invoice_number = $data['invoice_number'];
                    $invoice_date = $data['invoice_date'];
                    $invoice_price = $data['invoice_price'];

                    echo <<<HTML
                        <tr>
                            <td>$client_id</td>
                            <td>$fluid_tag</td>
                            <td>$client_mail_id</td>
                            <td>$client_code</td>
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