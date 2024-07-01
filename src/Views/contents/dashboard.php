<header class="header">
    <div class="block_header">
        
    </div>
</header>
<main class="main">
    <?=$modal?>
    <div class="block_dashboar">
        <div class="panel_dashboard">
            <h1 class="header_title"></h1>
            <select class="sites_option" name="sites">
            <option>сайты</option>
                <?php
                    foreach ($sites as $site) {
                    echo <<<HTML
                        <option value="$site">$site</option>
                    HTML;
                    }
                ?>
            </select>
            <select class="type_option" name="select">
                <option selected value="">Email</option>
                <option value="sateli">Phone</option>
            </select>
        </div>
    </div>
    <div class="block_table">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Email</th>
                    <th>счет создан</th>
                    <th>выставлен клиенту на оплату</th>
                    <th>пришла оплата</th>
                    <th>сумма созданных счетов</th>
                    <th>выставленная сумма на оплату</th>
                    <th>сума оплаченных счетов</th>
                </tr>
            </thead>
            <tbody class="email_tbody">
                <div class="loader_block">
                    <span class="loader">
                    </span>
                </div>
            </tbody>
        </table>
    </div>
</main>
<footer class="footer">
    <div class="block_footer">

    </div>
</footer>