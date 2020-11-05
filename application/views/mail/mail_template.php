<link rel="stylesheet" href="<?PHP echo base_url().'resources/css/test.css?'.date('l jS \of F Y h:i:s A'); ?>" type="text/css">
<?php //echo 'Current stylesheet = '.base_url().'resources/css/test.css?'.date('l jS \of F Y h:i:s A'); ?>

<table border="0" cellpadding="0" cellspacing="0" style="width:620px" align="center">

		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
		<!--header-->
		<td style="padding:0;width: 620px;">
				<a style="display:block;border:none;width: 620px" href="https://www.bangkokpost.com">
							<img style="display:block; border:none;" src="https://www.bangkokpost.com/events/bangkokpostforum2019/roadmap-to-success/resources/img/rally/bp-header.jpg" width="620" height="37">
				</a>
		</td>
		</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" style="width:620px" align="center">
	<tr>
		<td style="width: 620px; font-family: Arial;font-size: 12px; color:#666;padding: 20px 0 0; font-weight: bold;">
			Dear <?php echo $data['name']?>
		</td>
	</tr>
	<tr>
		<td style="width: 620px; font-family: Arial;font-size: 12px; line-height: 20px; color:#666;padding: 20px 0 0;">
		Regarding your kind registration to attend the <?PHP echo $this->event['mail_event_label'];?>, we would like to inform you that your registration has been confirmed. Your registration code is <?php echo $data['code'];?> and here is your QR code.
		</td>
	</tr>
	<tr>
		<td style="text-align: center; padding: 20px 0;"><img src='https://chart.googleapis.com/chart?cht=qr&chl=<?php echo $data['code']; ?>&chs=300x300&chld=L|0' /></td>
	</tr>
	<tr>
		<td style="width: 620px; font-family: Arial;font-size: 12px; line-height: 20px; color:#666;">
		Please show this code for your attendance of the event on November 11, 2020. <br>
		We are honored and are looking forward to welcoming you at the event on at Convention A2 , 22nd floor, Centara Grand at CentralWorld, Bangkok.
		</td>
	</tr>
	<tr>
		<td class="br" style="width: 620px; font-family: Arial;font-size: 12px; color:#666;padding: 20px 0 0;">
		Warm regards<br>
		<strong>Bangkok Post Event Team</strong><br>
		Bangkok Post Public Company Limited, Bangkok Post Building, 136 SunthornKosa Road, KlongToey, Bangkok 10110 Thailand
		</td>
	</tr>
	<tr>
		<td style="padding:30px 0 0;">
			<img style="display:block; border:none;" src="https://www.bangkokpost.com/events/bangkokpostforum2019/roadmap-to-success/resources/img/rally/underline2.jpg" width="620" height="3">
		</td>
	</tr>
	


</table>

<table border="0" cellpadding="0" cellspacing="0" style="width:620px" align="center">
	
	<tr>
		<td style="width: 620px; font-family: Arial;font-size: 12px; color:#666;padding: 20px 0 0; font-weight: bold;">
			เรียน คุณ <?php echo $data['name']?>
		</td>
	</tr>
	<tr>
		<td style="width: 620px; font-family: Arial;font-size: 12px; line-height: 20px; color:#666;padding: 20px 0 0;">
		ตามที่ท่านได้ลงทะเบียนเข้าร่วมงาน <?PHP echo $this->event['mail_event_label'];?> บางกอกโพสต์ขอแจ้งยืนยันการลงทะเบียนของท่านโดยรหัสลงทะเบียนของท่าน คือ <?php echo $data['code'];?> หรือ รหัส QR Code ดังต่อไปนี้
		</td>
	</tr>
	<tr>
		<td style="text-align: center; padding: 20px 0;"><img src='https://chart.googleapis.com/chart?cht=qr&chl=<?php echo $data['code']; ?>&chs=300x300&chld=L|0' /></td>
	</tr>
	<tr>
		<td style="width: 620px; font-family: Arial;font-size: 12px; line-height: 20px; color:#666;">
			กรุณานำรหัสลงทะเบียนหรือ QR Code ข้างต้นมาแสดงเพื่อเป็นหลักฐานการเข้าร่วมงานดังกล่าว<br>
			บริษัทมีความยินดีอย่างยิ่งที่จะได้ต้อนรับท่านในงานวันที่ 11 พฤศจิกายน 2563 เวลา 08.30 – 09.00 น. ณ ห้อง Convention A2 ชั้น 22 โรงแรมเซ็นทารา แกรนด์ แอท เซ็นทรัลเวิลด์ กรุงเทพฯ 
		</td>
	</tr>
	<tr>
		<td class="br" style="width: 620px; font-family: Arial;font-size: 12px; color:#666;padding: 20px 0 0;">
		ขอแสดงความนับถือ<br>
		<strong>ทีมงาน Bangkok Post Event Team</strong><br>
		บริษัท บางกอก โพสต์ จำกัด (มหาชน) 136 ถนนสุนทรโกษา แขวงคลองเตย เขตคลองเตย กรุงเทพฯ 10110
		</td>
	</tr>

	<tr>
		<td style="padding:30px 0 0;">
			<img style="display:block; border:none;" src="https://www.bangkokpost.com/events/bangkokpostforum2019/roadmap-to-success/resources/img/rally/underline2.jpg" width="620" height="3">
		</td>
	</tr>

	<tr>
		<td style="width: 620px;font-family: Arial;font-size: 12px; color:#666;padding: 25px 0 0;">&copy; Bangkok Post Plc Bangkok Post building 136 Sunthorn Kosa Road, Klong Toey, Bangkok, 10110</td>
		</tr>
		
		<!-- <tr>
			<td style="width: 620px;font-family: Arial;font-size: 12px; color:#666;padding: 5px 0 0;"><strong>Tel.</strong> +<a href="tel:026164000" style="color:#666;text-decoration:none;font-family: Arial; font-size: 12px;">662-616-4000</a>, <strong>fax.</strong> +<a href="tel:026713134" style="color:#666;text-decoration:none;font-family: Arial; font-size: 12px;">662-671-3134</a></td>
		</tr> -->
		<tr>
			<td style="width: 620px;font-family: Arial;font-size: 12px; color:#666;padding: 5px 0 0;"><strong>Website:</strong> <a href="<?= base_url() ?>" style="color:#213c70;text-decoration:none;font-family: Arial; font-size: 12px;"><?= base_url() ?></a></td>
		</tr>
		<!-- <tr>
			<td style="width: 620px;font-family: Arial;font-size: 12px; color:#666;padding: 5px 0 0;"><strong>Email:</strong>  <a href="mailto:webmaster@bangkokpost.com" style="color:#213c70;text-decoration:none;font-family: Arial; font-size: 12px;">webmaster@bangkokpost.com</a></td>
		</tr> -->
</table>
