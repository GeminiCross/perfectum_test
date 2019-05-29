<?php


class Currency extends CI_Controller
{
    public function index() {
        $this->load->model('exchange_model', 'exch');
        $this->exch->load_new_exch_rate();
        $exchange = $this->exch->get_last_exch_rate();
        $this->load->view('layouts/header');
        $this->load->view('currency/currency', ['currencies' => $exchange]);
        $this->load->view('layouts/footer');
        $this->output->cache(10);
    }

    public function history() {
        $this->load->model('exchange_model', 'exch');
        $history = $this->exch->get_exch_rate_history();
        $this->load->view('layouts/header');
        $this->load->view('currency/history', ['history' => $history]);
        $this->load->view('layouts/footer');
    }
}