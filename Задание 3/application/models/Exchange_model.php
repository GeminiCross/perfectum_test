<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Exchange_model extends CI_Model
{
    public $base_c = 'UAH';
    public $exchange_c;
    public $ask;
    public $bid;
    public $timestamp;

    public function __construct()
    {
        parent::__construct();
    }

    public function get_last_exch_rate () {
        $exchange['eur'] = $this->db->query('
            SELECT *
            FROM `exchange`
            WHERE exchange_c = \'EUR\'
            ORDER BY `timestamp` DESC
            LIMIT 1;')->result()[0];
        $exchange['usd'] = $this->db->query('
            SELECT *
            FROM `exchange`
            WHERE exchange_c = \'USD\'
            ORDER BY `timestamp` DESC
            LIMIT 1;')->result()[0];
        $exchange = static::timestamp_to_homan($exchange);
        return $exchange;
    }

    public function load_new_exch_rate () {
        $ch = curl_init('http://resources.finance.ua/ru/public/currency-cash.json');
        ob_start();
        curl_exec($ch);
        curl_close($ch);
        $exchange = json_decode(ob_get_clean());
//        date_default_timezone_set('Europe/Kiev');
        $time = new DateTime($exchange->date, new DateTimeZone('Europe/Kiev'));
        $this->timestamp = $time->getTimestamp();
        $this->exchange_c = 'EUR';
        $this->ask = $exchange->organizations[0]->currencies->EUR->ask;
        $this->bid = $exchange->organizations[0]->currencies->EUR->bid;
        $this->db->insert('exchange', $this);
        $this->exchange_c = 'USD';
        $this->ask = $exchange->organizations[0]->currencies->USD->ask;
        $this->bid = $exchange->organizations[0]->currencies->USD->bid;
        $this->db->insert('exchange', $this);
    }

    public function get_exch_rate_history () {
        return static::timestamp_to_homan($this->db->query('SELECT * FROM `exchange` ORDER BY `timestamp` DESC')->result());
    }

    private function timestamp_to_homan($rates) {
        $this->load->helper('date');
        date_default_timezone_set('Europe/Kiev');
        foreach ($rates as $item => $value) {
            $rates[$item]->timestamp = unix_to_human($value->timestamp, FALSE, 'eu');
        }
        return $rates;
    }
}