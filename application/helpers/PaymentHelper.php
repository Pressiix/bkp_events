<?php
/**
 *	PHP version 5
 * 
 *	@category   Helper
 *	@author	Nuttawat Pattanatragool <nuttawatp@bangkokpost.co.th>
 *	@author Watcharaphon Piamphuetna <watcharaphonp@bangkokpost.co.th>
 *	@copyright copyright (c) 1996 - 2020 Bangkok Post Public Company Limited.
 */

namespace helpers;

Class PaymentHelper
{
	/**
	 * Undocumented function
	 *
	 * @param [type] $order_id
	 * @param string $prefix
	 * @return void
	 */
    public static function payment_id($order_id,$prefix='712'){
		$payment_id = $prefix;
		$num = strlen($order_id);
		for($i=$num;$i<9;$i++){
			$payment_id.='0';
		}
		$payment_id.=$order_id;
		return $payment_id;	
	}
	
	/**
	 * Undocumented function
	 *
	 * @param string $id
	 * @return void
	 */
	public static function payment_status($id=''){
		//0=NotPay,1=Wait,2=Complete,3=Fail
		if($id==0){
			return 'No Pay';	
		}else if($id==1){
			return 'Wait';	
		}else if($id==2){
			return 'Complete';	
		}else if($id==3){
			return 'Fail';	
		}else if($id==4){
			return 'Cancel';	
		}
	}
}