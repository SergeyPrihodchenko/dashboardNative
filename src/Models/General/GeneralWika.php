<?php

namespace S\P\Models\General;

use S\P\Http\Api\Yandex;
use S\P\Models\InvoiceMail\Wika;
use S\P\Models\Visitors\WikaVisitors;

class GeneralWika {

    private Yandex $yandex;
    private Wika $wika;
    private WikaVisitors $visitors;

    public function __construct(  
    )
    {
        $this->yandex = new Yandex($_SERVER['AUTH_TOKEN'], $_SERVER['COUNTER_ID']);
        $this->wika = new Wika;
        $this->visitors = new WikaVisitors;
    }

    public function buildData(string $id)
    {
        $this->wika->setId($id);
        $data1C = $this->wika->destinctFind(['client_id', 'client_code', 'client_mail', 'invoice_status', 'invoice_price', 'invoice_date']);

        $sumInvoces = 0;

        foreach($data1C as $key => $value) {

            $sumInvoces += $value['invoice_status'] == 2 ? ($value['invoice_price'] * 100) : 0;

            $status = $value['invoice_status'];

            switch ($status) {
                case '0':
                    $data1C[$key]['invoice_status'] = 'счет создан';
                    break;
                case '1':
                    $data1C[$key]['invoice_status'] = 'выставлен клиенту на оплату';
                    break;
                case '2':
                    $data1C[$key]['invoice_status'] = 'выставлен клиенту на оплату';
                    break;
            }

        }

        $sumInvoces = number_format(($sumInvoces / 100), 2, '.', '');

        $data['invoice_sum'] = $sumInvoces;

        $client_id = $data1C[0]['client_id'];

        $this->visitors->setId($client_id);
        $ymId = $this->visitors->ymUid();

        if(empty($ymId)) {

            foreach ($data1C as $el) {
                $data[date("Y-m-d", strtotime($el['invoice_date']))][] = ['1C' => $el];
            }

            return $data;

        }

        $dataMetric = $this->yandex->metricById($ymId)['data'];

        foreach ($data1C as $el) {
            $data[date("Y-m-d", strtotime($el['invoice_date']))][] = ['1C' => $el];
        }
        
        foreach ($dataMetric as $value) {
            $data[date("Y-m-d", strtotime($value['dimensions'][1]['name']))][] = ['yandex' => $value];
        }

        return $data;
    }
}