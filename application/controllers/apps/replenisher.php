<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Replenisher extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('applications/replenisher_model');
        $this->page_dir = 'applications/replenisher';
    }

    public function check_wave()
    {
        $wave = $this->input->post('wave');
        $waves = explode(',',$wave);
        $check = $this->replenisher_model->getReplenisherInfo($waves);

        $log = array(
                'for' => $wave,
                'action' => 'Replenish Check',
                'reason' => 'System Log'
                );
        
        $this->Logger_model->create('replenishment_logs',$log);

        echo json_encode($check);
    }

    public function wave_lines()
    {
        $selected = array();
        $created = 0;
        $page = '';

        $this->replenisher_model->wave = $this->input->post('wave');
    	$this->replenisher_model->getWaveLines();

        $lines = $this->replenisher_model->lines;
        $lines_counts = count($lines);
        foreach($lines as $line){
            $locs = array_column($this->replenisher_model->getCrestingLocations(trim($line['tariff_desc'])),'loc');
            $new = array_diff($locs,$selected);

            if($new){
                $loc = array_rand($new);
                array_push($selected,$new[$loc]);
                
                $data = array(
                            'sku' => trim($line['sku']),
                            'pkg' => trim($line['pkg']),
                            'commodity' => trim($line['tariff_desc']),
                            'need' => number_format($line['qty']),
                            'loc' => $new[$loc],
                            'wave' => trim($line['wave'])
                        );
                
                $data['loc_info'] = $this->replenisher_model->buildReplenishment($data);

                $info['line'] = $data;
                $created++;
                $page .= $this->load->view($this->page_dir.'/replenishment_summary',$info,TRUE);
            }
        }

        $counts['created'] = $created;
        $counts['lines'] = $lines_counts;

        if($created < $lines_counts){
            $counts['color'] = 'danger';
            $counts['header'] = 'Attention there are not enough locations';
            $counts['question'] = 'Are you sure you want to build anyway?';
            $counts['insufficient'] = true;
        }elseif($created == $lines_counts){
            $counts['color'] = 'success';
            $counts['header'] = 'Awesome';
            $counts['question'] = NULL;
            $counts['insufficient'] = false;
        }

        $page .= $this->load->view($this->page_dir.'/replenishment_result',$counts,TRUE);
        $page .= $this->load->view($this->page_dir.'/replenishment_confirm',$counts,TRUE);

        $log = array(
                'for' => $this->input->post('wave'),
                'action' => 'Replenish Build Preview '.$created.'/'.$lines_counts,
                'reason' => 'System Log'
                );
        
        $this->Logger_model->create('replenishment_logs',$log);

        echo json_encode($page);
    }

    public function build_replenishment()
    {
        parse_str($this->input->post('post'),$post);
        $this->replenisher_model->updateLocations($post);

        $log = array(
                'for' => $this->input->post('wave'),
                'action' => 'Replenish Built '.count($post['loc']).' locations',
                'reason' => 'System Log'
                );
        
        $this->Logger_model->create('replenishment_logs',$log);
        echo json_encode($log);
    }
}
