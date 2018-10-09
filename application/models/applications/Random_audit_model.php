<?php

class Random_audit_model extends XPO_Model {

	public function getEmployeesReport()
	{
		$employees = array(
						'users' => array(
									0 => array(
										'user' => 'Sample User',
										'dates' => array(
														'3/5',
														'0/5',
														'1/5'
													)
										)
								),
						'dates' => array(
								'10-08-2018',
								'10-09-2018',
								'10-10-2018'
								)
						);

		return $employees;
	}

	public function getDatesReport()
	{
		$dates = array(
						["date"=>"10-08-2018","counted"=>3,"generated"=>3,"error"=>"5%"],
						["date"=>"10-09-2018","counted"=>0,"generated"=>3,"error"=>"3%"],
						["date"=>"10-10-2018","counted"=>1,"generated"=>3,"error"=>"4%"]
					);

		return $dates;
	}

	public function getLocationList()
	{
		$locations = array(
						["user"=>"Samantha Brown","location"=>"SB-01234","skupkg"=>"SKU-PKG","input"=>NULL,"status"=>"0"],
						["user"=>"Samantha Brown","location"=>"SB-56789","skupkg"=>"SKU-PKG","input"=>NULL,"status"=>"0"],
						["user"=>"Samantha Brown","location"=>"SB-10111","skupkg"=>"SKU-PKG","input"=>NULL,"status"=>"0"],
						["user"=>"Samantha Brown","location"=>"SB-21314","skupkg"=>"SKU-PKG","input"=>NULL,"status"=>"0"],
						["user"=>"Samantha Brown","location"=>"SB-15161","skupkg"=>"SKU-PKG","input"=>NULL,"status"=>"0"]
					);

		return $locations;
	}
}