<?php

class Productivity extends XPO_Model {

     public $opr;
     public $from;
     public $dtfrom;
     public $to;
     public $dtto;
     private $query;

     public function getPickingProductivity()
     {
          
     }

     public function settHourlyPickingQuery()
     {
          $query = "SELECT opr,
                         SUM(c.17) as h1,
                         SUM(c.18) as h2,
                         SUM(c.19) as h3,
                         SUM(c.20) as h4,
                         SUM(c.21) as h5,
                         SUM(c.22) as h6,
                         SUM(c.23) as h7,
                         SUM(c.00) as h8,
                         SUM(c.01) as h9,
                         SUM(c.02) as h10,
                         SUM(c.03) as h11,
                         SUM(c.04) as h12,
                         SUM(c.05) as h13,
                         (SELECT COUNT(*) 
                         FROM mwlkntappdb.acpk_at_f_error as b
                         WHERE b.dtimecre BETWEEN '$this->dtfrom' AND '$this->dtto' 
                         AND b.transact = 'AIVF' 
                         AND b.sku_usr_err IN  ('200','201','300','301','400','401')  
                         AND b.ser_usr_err = c.opr ) as error
                         FROM productivity.packing_containers as c 
                         WHERE date BETWEEN '$this->from' AND '$this->to'
                         GROUP BY opr
                         HAVING (h1+h2+h3+h4+h5+h6+h7+h8+h9+h10+h11+h12+h13) > 0
                         ORDER BY opr";

          $this->query = $query;
     }
}  