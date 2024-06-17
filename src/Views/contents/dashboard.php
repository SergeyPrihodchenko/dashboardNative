<header class="header">
    <div class="block_header">
        
    </div>
</header>
<main class="main">
    <div class="block_dashboar">
        <div class="panel_dashboard">
        <select name="select">
            <option value="value1">Значение 1</option>
            <option value="value2">Значение 2</option>
            <option value="value3">Значение 3</option>
        </select>
        <select name="select">
            <option value="value1">Значение 1</option>
            <option value="value2">Значение 2</option>
        </select>
        </div>
    </div>
    <div class="block_table">
        <table>
            <thead>
                <tr>
                <th></th>
                <th>Место</th>
                <th>Оценка</th>
                <th>Название фильма</th>
                <th>Год выхода</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($data as $client) {
                        $client_id = $client['client_id'];
                        $client_mail = $client['client_mail'];
                        $client_mail_id = $client['client_mail_id'];
                        $client_code = $client['client_code'];

                        echo <<<HTML
                            <tr>
                                <td>&#11162</td>
                                <td>$client_id </td>
                                <td>$client_mail</td>
                                <td>$client_mail_id</td>
                                <td>$client_code</td>
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