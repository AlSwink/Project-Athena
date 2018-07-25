<?php

class Tools_model extends XPO_Model {

   public function get_tool_info($method)
   {
        $info = $this->db->get_where('tools',array('method_name'=>$method))->row();
        return $info;
   }    

   public function check_804($conts)
   {
   		foreach($conts as $cont){
        $cont_pdf = searchContainerLabel($cont);

   			  $new_conts[] = array(
   							'cont' => $cont,
   							'status' => ($cont_pdf ? 'ok' : 'Not Found'),
                'cont_pdf' => ($cont_pdf ? $cont_pdf : NULL)
   							);
   		}

   		return $new_conts;
   }

   public function get_label_info($cont)
   {
      $wms = $this->load->database('wms',TRUE);
      $query = "SELECT up_f.task, up_f.outermost_cont, up_f.ob_oid, up_f.ob_lno, up_f.sku, up_f.pkg, pm_f.sku_desc, up_f.org_qty, up_f.act_qty, pm_f.upc, up_f.cust_oid, up_f.ship_name, up_f.ship_addr1, up_f.ship_addr2, up_f.ship_city, up_f.ship_state, up_f.ship_zip, up_f.ship_cntry, up_f.dt_ship
                FROM up_f INNER JOIN pm_f ON (up_f.pkg = pm_f.pkg) AND (up_f.sku = pm_f.sku)
                GROUP BY up_f.task, up_f.outermost_cont, up_f.ob_oid, up_f.ob_lno, up_f.sku, up_f.pkg, pm_f.sku_desc, up_f.org_qty, up_f.act_qty, pm_f.upc, up_f.cust_oid, up_f.ship_name, up_f.ship_addr1, up_f.ship_addr2, up_f.ship_city, up_f.ship_state, up_f.ship_zip, up_f.ship_cntry, up_f.dt_ship
                HAVING (((up_f.outermost_cont)='$cont'));";
      $info = $wms->query($query)->row();
      return $info;
   }
}