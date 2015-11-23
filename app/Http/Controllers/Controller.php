<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Picture;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	// 获取图片的url
	public function getPicUrl($id)
	{
		$pic = Picture::find($id);
		return $pic['path'];
	}

	// 上传图片
	public function addPic($file)
	{
		$pub_dir = public_path();
		$path = '/default/app/img/';
		$date = date('Y-m-d');
		$path = $path.$date.'/';
		$upload_dir = $pub_dir.$path;
		if(!is_dir($upload_dir))
		{
			$result = mkdir($upload_dir, 0777);
			if(!$result)
			{
				throw new Exception("目录权限问题，请检查", 1);
			}
		}
		$user = \Session::get('currentUser');

		$name = time().$user['id'];
		$ext = $file->guessClientExtension();
		$name = md5($name).'.'.$ext;
		if($file->isValid())
		{
			$file->move($upload_dir, $name);
		}
		$pic = Picture::create(array('path'=>$path.$name, 'status'=>'1'));
		return $pic;
	}

	// 获取图片的扩展名
	private function get_pic_ext($picname)
	{
		$ext = substr($picname, strpos($picname, '.')+1);
		return $ext;
	}

	// 获取所有的省份
	public function getAllProvinces()
	{
		$province = \DB::select("SELECT * FROM `province`");
		return $province;
	}

	// 获取省份对应的所有城市
	public function getAllCities($province_id)
	{
		$cities = \DB::select("SELECT * FROM `city` WHERE `father` = $province_id ");
		return $cities;
	}

	// 获取 城市对应的 所有的地区
	public function getAllAreas($city_id)
	{
		$areas = \DB::select("SELECT * FROM `area` WHERE `father` = $city_id");
		return $areas;
	}

	// 获取地区
	public function getArea($id)
	{
		$area = \DB::select('SELECT * FROM `area` WHERE `areaID` = :areaID LIMIT 1', ['areaID'=>$id]);
		return $area[0];
	}

	// 获取城市
	public function getCity($id)
	{
		$city = \DB::select('SELECT * FROM `city` WHERE `cityID` = :cityID ', ['cityID'=> $id]);
		return $city[0];
	}

	// 获取省份
	public function getProvince($id)
	{
		$province = \DB::select('SELECT * FROM `province` WHERE `provinceID`=:provinceID', ['provinceID'=> $id]);
		return $province[0];
	}

	// 根据areaID 获取 详细的地址 ： 省份-城市-地区
	public function getDetailAreaName($areaID)
	{
		$area = $this->getArea($areaID);
		$city = $this->getCity($area->father);
		$province = $this->getProvince($city->father);

		$location = $province->province .'-'. $city->city. '-' . $area->area;
		return $location;
	}

	// 获取商品类型
	public function getMerchandiseType($id)
	{
		$type = \DB::select('SELECT * FROM `merchandise_type` WHERE `id`=:id', ['id'=> $id]);
		return $type['0'];
	}

	// 获取 货物 当前的状态
	public function getMerchandiseStatus($id)
	{
		$status = \DB::select('SELECT * FROM `merchandise_status` WHERE `id` =:id', ['id'=>$id]);
		return $status['0'];
	}

	// 获取 货物的 运输方式
	public function getMerchandiseShippiingMethod($id)
	{
		$shipping_method = \DB::select('SELECT * FROM `merchandise_shipping_method` WHERE `id`=:id', ['id'=>$id]);
		return $shipping_method[0];
	}

	// 获取所有的货物类型
	public function getAllMerchandiseType()
	{
		$merchandise_type = \DB::select('SELECT * FROM `merchandise_type`');
		return $merchandise_type;
	}

	// 获取所有的 货物运输方式
	public function getAllMerchandiseSM()
	{
		$m_shipping_method = \DB::select('SELECT * FROM `merchandise_shipping_method`');
		return $m_shipping_method;
	}

	// 车体状况
	public function getVehicleBodyType($id)
	{
		$type = \DB::select('SELECT * FROM `vehicle_body_type` WHERE `id` =:id', ['id'=> $id]);
		return $type['0'];
	}

	// 车身类型
	public function getVehicleType($id)
	{
		$type = \DB::select('SELECT * FROM `vehicle_type` WHERE `id` =:id', ['id'=>$id]);
		return $type['0'];
	}

	// 获取所有的车身类型
	public function getAllVehicleType()
	{
		$vehicleType = \DB::select('SELECT * FROM `vehicle_type` ORDER BY id ASC');
		return $vehicleType;
	}

	// 获取所有的称体状况
	public function getAllVehicleBodyType()
	{
		$vbodyType = \DB::select('SELECT * FROM `vehicle_body_type` ORDER BY id ASC');
		return $vbodyType;
	}

	// 地址级联选选项
	public function areaSelectPlugin($default_provinceID = '', $default_cityID = '')
	{
		$province = $this->getAllProvinces();
		if($default_provinceID != '')	// 默认的省份
		{
			foreach($province as $item)
			{
				// echo $item->provinceID, $default_provinceID;
				if($item->provinceID == $default_provinceID)
				{
					$default_pro = $item;
				}
			}
		}
		else
		{
			$default_pro = $province['0'];
		}
		$city = $this->getAllCities($default_pro->provinceID);	// 获取省对应的市

		if($default_cityID != '')
		{
			foreach($city as $item)
			{
				if($item->cityID == $default_cityID)
				{
					$default_city = $item;
				}
			}
		}
		else
		{
			$default_city = $city['0'];
		}
		
		
		
		$area = $this->getAllAreas($default_city->cityID);
		$select['province'] = $province;
		$select['city'] = $city;
		$select['area'] = $area;
		\View::share('area', $select);
	}

	// 地址级联选选项(需要进一步修改的地方)
	public function areaSelectPlugin_2($default_provinceID = '', $default_cityID = '')
	{
		$province = $this->getAllProvinces();
		if($default_provinceID != '')	// 默认的省份
		{
			foreach($province as $item)
			{
				if($item->provinceID == $default_provinceID)
				{
					$default_pro = $item;
				}
			}
		}
		else
		{
			$default_pro = $province['0'];
		}

		$city = $this->getAllCities($default_pro->provinceID);	// 获取省对应的市

		if($default_cityID != '')
		{
			foreach($city as $item)
			{
				if($item->cityID == $default_cityID)
				{
					$default_city = $item;
				}
			}
		}
		else
		{
			$default_city = $city['0'];
		}
		
		
		$area = $this->getAllAreas($default_city->cityID);
		$select['province'] = $province;
		$select['city'] = $city;
		$select['area'] = $area;
		\View::share('area_2', $select);
	}

	// 地址级联选选项(需要进一步修改的地方)
	public function areaSelectPlugin_3($default_provinceID = '', $default_cityID = '')
	{
		$province = $this->getAllProvinces();
		if($default_provinceID != '')	// 默认的省份
		{
			foreach($province as $item)
			{
				if($item->provinceID == $default_provinceID)
				{
					$default_pro = $item;
				}
			}
		}
		else
		{
			$default_pro = $province['0'];
		}

		$city = $this->getAllCities($default_pro->provinceID);	// 获取省对应的市

		if($default_cityID != '')
		{
			foreach($city as $item)
			{
				if($item->cityID == $default_cityID)
				{
					$default_city = $item;
				}
			}
		}
		else
		{
			$default_city = $city['0'];
		}
		
		
		$area = $this->getAllAreas($default_city->cityID);
		$select['province'] = $province;
		$select['city'] = $city;
		$select['area'] = $area;
		\View::share('area_3', $select);
	}

	// 发送电子邮件
	public function sendMail($to, $subject, $message)
	{
		header("content-type:text/html;charset=utf-8"); 
		ini_set("magic_quotes_runtime",0);
		$view = view('efault._shared.mail')->with('link', 'www.socketio.cn');
		try 
		{ 
			$mail = new \PHPMailer(true); 
			$mail->IsSMTP(); 
			$mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码 
			$mail->SMTPAuth = true; //开启认证 
			$mail->Port = 25; 
			$mail->Host = "smtp.163.com"; 
			$mail->Username = "daimawz@163.com"; 
			$mail->Password = "fzpgxletpfhhcfyy"; 
			//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could not execute: /var/qmail/bin/sendmail ”的错误提示 
			$mail->AddReplyTo("daimawz@163.com","mckee");	//回复地址 
			$mail->From = "daimawz@163.com"; 
			$mail->FromName = "shipping_master"; 
			$mail->AddAddress($to); 
			$mail->Subject = $subject; 
			// $mail->Body = "<h1>phpmail演示</h1>这是php点点通（<font color=red>www.socketio.cn</font>）对phpmailer的发布的内容更内容"; 
			$mail->Body = $view;
			$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略 
			$mail->WordWrap = 80; // 设置每行字符串的长度 
			$mail->IsHTML(true); 
			$mail->Send(); 
			echo '邮件已发送'; 
		} 
		catch (\phpmailerException $e) 
		{ 
			echo "邮件发送失败：".$e->errorMessage();
		}
	}




}
