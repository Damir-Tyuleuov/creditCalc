<?php

namespace models;

class funCredit
{
    private $sum = 0;
    private $term = 0;
    private $percent = 0;
    private $mounthPayment = 0;
    private $mounthPercent = 0;
    private $totalAmount = 0;
    private $overPayment = 0;
    private $stateCredit = false;
    private $schiduleList = array("credit" => array(), "paymentPercent" => array(), "paymentMain" => array(), "payment" =>array());

    public function __construct($sum = null, $term = 0, $percent = null)
    {
        if (is_numeric($sum)) {
            $this->sum = $sum;
        } else {
            $this->sum = null;
        }


        if (is_numeric($term)) {
            $this->term = $term;
        } else {
            $this->term = null;
        }

        if (is_numeric($percent)) {
            $this->percent = $percent;
        } else {
            $this->percent = null;
        }
    }


    public function getScheduleList()
    {
        if ($this->stateCredit != 0) {
            $credit = round(($this->totalAmount),2);
            $paymentPercent = 0;
            $paymentMain = 0;
            $payment = round($this->getMounthPayment(),2);
            for ($i = 0; $i < $this->term; $i++) {
                $credit = $credit - $payment;
                $paymentPercent = round( ($credit * $this->mounthPercent),2);
                $paymentMain = round(($payment - ($credit * $this->mounthPercent)),2);
                $this->schiduleList["credit"][] = $credit;
                $this->schiduleList["paymentPercent"][] =$paymentPercent;
                $this->schiduleList["paymentMain"][] = $paymentMain;
                $this->schiduleList["payment"][] = $payment;
                
             
            }
            return $this->schiduleList;
        }
    }

    public function setstateCredit()
    {
        if ($this->percent != 0 && $this->term != null && $this->sum > 0) {
            $this->stateCredit = true;
        }
    }

    public function getstateCredit()
    {
        return $this->stateCredit;
    }

    public function getSum()
    {
        return $this->sum;
    }

    public function getTerm()
    {
        return $this->term;
    }

    public function getPercent()
    {
        return $this->percent;
    }

    public function getMounthPayment()
    {
        if ($this->percent != 0) {

            $this->mounthPercent = $this->percent / (100 * 12);
            $this->mounthPayment =  $this->sum * ($this->mounthPercent + ($this->mounthPercent / (pow((1 + $this->mounthPercent),  $this->term) - 1)));
            return $this->mounthPayment;
        } else {
            return 0;
        }
    }

    public function getTotalAmount()
    {
        $this->totalAmount = $this->mounthPayment * $this->term;
        return  $this->totalAmount;
    }

    public function getOverPayment()
    {
        if ($this->percent != 0) {
            $this->overPayment = $this->totalAmount - $this->sum;
            return  $this->overPayment;
        } else {
            return 0;
        }
    }
}
