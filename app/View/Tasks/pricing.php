<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pricing extends CI_Controller {
        private $currency_symbols;
	function __construct(){
            parent :: __construct();
            $this->load->helper('my_helper');
            
            $this->currency_symbols = array('AED' => '&#1583;.&#1573;', 'AFN' => '&#65;&#102;', 'ALL' => '&#76;&#101;&#107;', 'ANG' => '&#402;', 'AOA' => '&#75;&#122;','ARS' => 'AR&#36;','AUD' => 'AU&#36;','AWG' => '&#402;','AZN' => '&#1084;&#1072;&#1085;','BAM' => '&#75;&#77;','BBD' => 'BB&#36;','BDT' => '&#2547;', 'BGN' => '&#1083;&#1074;','BHD' => '.&#1583;.&#1576;', 'BIF' => '&#70;&#66;&#117;', 'BMD' => 'BM&#36;','BND' => 'BN&#36;','BOB' => '&#36;&#98;','BRL' => '&#82;&#36;','BSD' => 'BS&#36;','BTN' => '&#78;&#117;&#46;', 'BWP' => '&#80;','BYR' => '&#112;&#46;','BZD' => '&#66;&#90;&#36;','CAD' => 'CA&#36;','CDF' => '&#70;&#67;','CHF' => '&#67;&#72;&#70;','CLP' => 'CL&#36;','CNY' => '&#165;','COP' => 'CO&#36;','CRC' => '&#8353;','CUP' => '&#8396;','CVE' => 'CV&#36;', 'CZK' => '&#75;&#269;','DJF' => '&#70;&#100;&#106;', 'DKK' => '&#107;&#114;','DOP' => '&#82;&#68;&#36;','DZD' => '&#1583;&#1580;', 'EGP' => '&#163;','ETB' => '&#66;&#114;','EUR' => '&#8364;','FJD' => 'FJ&#36;','FKP' => '&#163;','GBP' => '&#163;','GEL' => '&#4314;','GHS' => '&#162;','GIP' => '&#163;','GMD' => '&#68;','GNF' => '&#70;&#71;', 'GTQ' => '&#81;','GYD' => 'GY&#36;','HKD' => 'HK&#36;','HNL' => '&#76;','HRK' => '&#107;&#110;','HTG' => '&#71;', 'HUF' => '&#70;&#116;','IDR' => '&#82;&#112;','ILS' => '&#8362;','INR' => '&#8377;','IQD' => '&#1593;.&#1583;', 'IRR' => '&#65020;','ISK' => '&#107;&#114;','JEP' => '&#163;','JMD' => '&#74;&#36;','JOD' => '&#74;&#68;','JPY' => '&#165;','KES' => '&#75;&#83;&#104;','KGS' => '&#1083;&#1074;','KHR' => '&#6107;','KMF' => '&#67;&#70;', 'KPW' => '&#8361;','KRW' => '&#8361;','KWD' => '&#1583;.&#1603;', 'KYD' => 'KY&#36;','KZT' => '&#1083;&#1074;','LAK' => '&#8365;','LBP' => '&#163;','LKR' => '&#8360;','LRD' => 'LR&#36;','LSL' => '&#76;', 'LTL' => '&#76;&#116;','LVL' => '&#76;&#115;','LYD' => '&#1604;.&#1583;', 'MAD' => '&#1583;.&#1605;.','MDL' => '&#76;','MGA' => '&#65;&#114;', 'MKD' => '&#1076;&#1077;&#1085;','MMK' => '&#75;','MNT' => '&#8366;','MOP' => '&#77;&#79;&#80;&#36;', 'MRO' => '&#85;&#77;', 'MUR' => '&#8360;', 'MVR' => '.&#1923;', 'MWK' => '&#77;&#75;','MXN' => 'MX&#36;','MYR' => '&#82;&#77;','MZN' => '&#77;&#84;','NAD' => 'NA&#36;','NGN' => '&#8358;','NIO' => '&#67;&#36;','NOK' => '&#107;&#114;','NPR' => '&#8360;','NZD' => 'NZ&#36;','OMR' => '&#65020;','PAB' => '&#66;&#47;&#46;','PEN' => '&#83;&#47;&#46;','PGK' => '&#75;', 'PHP' => '&#8369;','PKR' => '&#8360;','PLN' => '&#122;&#322;','PYG' => '&#71;&#115;','QAR' => '&#65020;','RON' => '&#108;&#101;&#105;','RSD' => '&#1044;&#1080;&#1085;&#46;','RUB' => '&#1088;&#1091;&#1073;','RWF' => '&#1585;.&#1587;','SAR' => '&#65020;','SDD' => '&#163;','SEK' => '&#107;&#114;','SGD' => 'SG&#36;','THB' => '&#3647;','TRL' => '&#8356;', 'TTD' => 'TT&#36;','TWD' => '&#78;&#84;&#36;','USD' => 'US&#36;','VEB' => '&#66;&#115;','XCD' => 'XC&#36;','ZAR' => '&#82;','ZMK' => '&#90;&#75;');
	}
    
	var $error = array();
	
	private function redirect($redirect){
		if(!$this->session->userdata("logged_in")){
			redirect("login?redirect=".$redirect);	
		}
	}
	
	public function index($zone_slug, $country_slug, $area_slug, $region_slug, $slug){
		$this->load->library("image");
		$this->load->model("zone_model");
		$this->load->model("country_model");
		$this->load->model("area_model");
		$this->load->model("venue_model");
		$this->load->model("venue_filter_model");
		$this->load->model("favorite_model");
		
		$venue_info = $this->venue_model->getVenue($zone_slug, $country_slug, $area_slug, $region_slug, $slug);
		
		$data_images = $this->venue_model->getImages($venue_info->venue_id);
		$data_services = get_services();
		
		$services = array();
		$venue_purpose=$venue_info->venue_purpose;
                if($venue_purpose==1){
                    $services[] = "Indoor Ceremony";
                    $services[] = "Outdoor Ceremony";
                }elseif($venue_purpose==2){
                    $services[] = "Indoor Reception";
                    $services[] = "Outdoor Reception";
                }elseif($venue_purpose==3){
                    $services[] = "Indoor Ceremony";
                    $services[] = "Outdoor Ceremony";
                    $services[] = "Indoor Reception";
                    $services[] = "Outdoor Reception";
                }
		
		$venues = array();
		$data_venues = $this->venue_model->getVenuesSameLocation($venue_info->region_id, $venue_info->venue_id);
		foreach($data_venues as $dt){
			$purpose = array();
                        if($dt->venue_purpose == 1 || $dt->venue_purpose==3){
                            $purpose[] = "Indoor/Outdoor Ceremony";	
			}
			
			if($dt->venue_purpose==2 || $dt->venue_purpose==3){
                            $purpose[] = "Indoor/Outdoor Reception";	
			}
                        
			$venues[] = array(
				"venue_name"=>$dt->venue_name,
				"image"=>$this->image->cropsize($this->venue_model->getMainImage($dt->venue_id),356,228),
				"purpose"=> implode("<br>",$purpose),
				"region_name"=>$dt->region_name,
				"style"=>$this->venue_filter_model->getVenueStylesString($dt->venue_id),
				"href"=>"Venue/".$dt->zone_slug."/".$dt->country_slug."/".$dt->area_slug."/".$dt->region_slug."/".$dt->slug
			);	
		}
		
		$data_venue = array(
			"zone_slug"=>$zone_slug,
			"country_slug"=>$country_slug,
			"area_slug"=>$area_slug,
			"region_slug"=>$region_slug,
			"slug"=>$venue_info->slug,
			"name"=>$venue_info->name,
			"address"=>$venue_info->address,
			"description"=>$venue_info->description,
			"time_restrictions_description"=>$venue_info->time_restrictions_description,
			"wedding_cost"=>$venue_info->wedding_cost_description,
			"rental_fee"=>$venue_info->rental_fee_description,
			"lat"=>$venue_info->lat,
			"lng"=>$venue_info->lng,
			"style"=>$this->venue_filter_model->getVenueStylesString($venue_info->venue_id),
			"services"=>$services,
			"max_guests"=>max($max_guests),
			"max_guests_string"=>$max_guests_string,
			"amenities_included"=>$amenities_included,
			"special_restrictions"=>$special_restrictions,
			"images"=>$images,
			"venue_id"=>$venue_info->venue_id,
			"video"=>$venue_info->video,
			"indoor_reception"=>($venue_purpose==2 || $venue_purpose==3)?"Yes":"No",
			"outdoor_reception"=>($venue_purpose==2 || $venue_purpose==3)?"Yes":"No",
			"indoor_ceremony"=>($venue_purpose==1 || $venue_purpose==3)?"Yes":"No",
			"outdoor_ceremony"=>($venue_purpose==1 || $venue_purpose==3)?"Yes":"No",
			"venues"=>$venues
		);

		
		if($this->session->userdata("logged_in")){
			$data_venue['is_favorited'] = $this->favorite_model->is_favorited($this->session->userdata("member_id"), $venue_info->venue_id);
		}else{
			$data_venue['is_favorited'] = false;	
		}
		
		$data_header = array(
			"title"=>$venue_info->name
		);
		
		$this->load->view('pricing_estimate', $data_venue);

	}
	
	public function service($venue_slug){
		
		$this->redirect("pricing/service/".$venue_slug);
		
		$this->load->model("venue_model");
		$venue_info = $this->venue_model->getVenueBySlug($venue_slug);
		$breadcrumbs = array();
		$breadcrumbs[] = array(
			"href"=>"home",
			"title"=>'<i class="fa fa-home"></i>'
		);
		
		$breadcrumbs[] = array(
			"href"=>"Venues/".$venue_info->zone_slug."/".$venue_info->country_slug,
			"title"=>$venue_info->country_name
		);
		
		$breadcrumbs[] = array(
			"href"=>"Venues/".$venue_info->zone_slug."/".$venue_info->country_slug."/".$venue_info->area_slug,
			"title"=>$venue_info->area_name
		);
		
		$breadcrumbs[] = array(
			"href"=>"Venue/".$venue_info->zone_slug."/".$venue_info->country_slug."/".$venue_info->area_slug."/".$venue_info->region_slug."/".$venue_info->slug,
			"title"=>$venue_info->name
		);;
		
		$breadcrumbs[] = array(
			"href"=>false,
			"title"=>"Calculate Price"
		);
		
		
		$session = $this->session->userdata('pricing');
		if($venue_info->currency!='' && array_key_exists($venue_info->currency, $this->currency_symbols)) {
                    $CurrencySymbol=$this->currency_symbols[$venue_info->currency];
                }else{
                    $CurrencySymbol='US$';
                }
                // unset array key
                if(isset($session) && !empty($session) && count($session)>0){
                    foreach($session as $key => $val){
                        if(array_key_exists($venue_info->venue_id, $session) === FALSE){
                            unset($session[$key]);
                        }
                    }
                }
		if($this->input->post('submit_form') && $this->serviceValidation()){
			
			if(isset($session) && !empty($session) && count($session)>0 && array_key_exists($venue_info->venue_id, $session)){
				$session[$venue_info->venue_id]['service'] = array(
					"service"=>$this->input->post('service'),
					"season"=>$this->input->post('season'),
					"date1"=>$this->input->post('date1'),
					"guest"=>$this->input->post('guest'),
					"hour"=>''
				);
				$session = array("pricing"=>$session);
                        }else{
				$session['pricing'][$venue_info->venue_id]['service'] = array(
					"service"=>$this->input->post('service'),
					"season"=>$this->input->post('season'),
					"date1"=>$this->input->post('date1'),
					"guest"=>$this->input->post('guest'),
					"hour"=>''
				);
                        }
			
			$this->session->set_userdata($session);	
			redirect("pricing/ceremony/".$venue_slug);
		}
		$global_max_capacity_array = array();
		$global_min_capacity_array = array();
		$services = array();
		$venue_purpose=$venue_info->venue_purpose;
                
		if($venue_purpose==1 || $venue_purpose==3){
                    $indoor_max_capacity = $venue_info->indoor_max_guests;
                    $indoor_min_capacity = $venue_info->indoor_min_guests;
                    $outdoor_max_capacity = $venue_info->outdoor_max_guests;
                    $outdoor_min_capacity = $venue_info->outdoor_min_guests;
                    $indoor_price = ($venue_info->low_indoor_ceremony==0)?'Price included in minimum spend':'Starting at '.$CurrencySymbol.number_format($venue_info->low_indoor_ceremony);
                    $outdoor_price = ($venue_info->low_outdoor_ceremony==0)?'Price included in minimum spend':'Starting at '.$CurrencySymbol.number_format($venue_info->low_outdoor_ceremony);
                   	
                    $global_max_capacity_array[] = $indoor_max_capacity;
                    $global_min_capacity_array[] = $indoor_min_capacity;
                    $global_max_capacity_array[] = $outdoor_max_capacity;
                    $global_min_capacity_array[] = $outdoor_min_capacity;

                    $services[] = array(
                        "title"=>"Indoor Ceremony",
                        "price"=>$indoor_price,
                        "service"=>"ceremony",
                        "service_item"=>"indoor-ceremony",
                        "price_type"=>$venue_info->low_indoor_ceremony,
                        "max_capacity"=>$indoor_max_capacity
                    );
                    
                    $services[] = array(
                        "title"=>"Outdoor Ceremony",
                        "price"=>$outdoor_price,
                        "service"=>"ceremony",
                        "service_item"=>"outdoor-ceremony",
                        "price_type"=>$venue_info->low_outdoor_ceremony,
                        "max_capacity"=>$outdoor_max_capacity
                    );
		}
		
                if($venue_purpose==2 || $venue_purpose==3){
                    $indoor_max_capacity = $venue_info->indoor_max_guests;
                    $indoor_min_capacity = $venue_info->indoor_min_guests;
                    $outdoor_max_capacity = $venue_info->outdoor_max_guests;
                    $outdoor_min_capacity = $venue_info->outdoor_min_guests;
                    $indoor_price = ($venue_info->low_indoor_reception==0)?'Price included in ceremony':'Starting at '.$CurrencySymbol.number_format($venue_info->low_indoor_reception);
                    $outdoor_price = ($venue_info->low_outdoor_reception==0)?'Price included in ceremony':'Starting at '.$CurrencySymbol.number_format($venue_info->low_outdoor_reception);
                    
			
                    $global_max_capacity_array[] = $indoor_max_capacity;
                    $global_min_capacity_array[] = $indoor_min_capacity;
                    $global_max_capacity_array[] = $outdoor_max_capacity;
                    $global_min_capacity_array[] = $outdoor_min_capacity;

                    $services[] = array(
                        "title"=>"Indoor Reception",
                        "price"=>$indoor_price,
                        "service"=>"reception",
                        "service_item"=>"indoor-reception",
                        "price_type"=>$venue_info->low_indoor_reception,
                        "max_capacity"=>$indoor_max_capacity
                    );
                    
                    $services[] = array(
                        "title"=>"Outdoor Reception",
                        "price"=>$outdoor_price,
                        "service"=>"reception",
                        "service_item"=>"outdoor-reception",
                        "price_type"=>$venue_info->low_outdoor_reception,
                        "max_capacity"=>$outdoor_max_capacity
                    );
		}
                if(isset($global_max_capacity_array)){
			$global_max_capacity = max($global_max_capacity_array);
		}
		
		if(isset($global_min_capacity_array)){
			$global_min_capacity = max($global_min_capacity_array);
		}
		
                // get high season and low season based rate 
                $venueSeasonRate_data = $this->venue_model->getVenueSeasonRate($venue_info->venue_id);
		
		$value = array();
		
		$service_value=array();
		if(isset($session[$venue_info->venue_id]['service'])){
			$service_value = $session[$venue_info->venue_id]['service'];
		}
		
		if(isset($_POST['service'])){
			$value["service"]=$this->input->post('service');
		}elseif($service_value){
			$value["service"]=$service_value['service'];
		}else{
			$value["service"]=array();	
		}
		
		if(isset($_POST['date1'])){
			$value["date1"]=$this->input->post('date1');
		}elseif($service_value){
			$value["date1"]=$service_value['date1'];
		}else{
			$value["date1"]="";	
		}
		
		if(isset($_POST['guest'])){
			$value["guest"]=$this->input->post('guest');
		}elseif($service_value){
			$value["guest"]=$service_value['guest'];
		}else{
			$value["guest"]="";	
		}
                
		if(isset($_POST['season'])){
			$value["season"]=$this->input->post('season');
		}elseif($service_value){
			$value["season"]=$service_value['season'];
		}else{
			$value["season"]="on-peak";	
		}
		
		$data_service = array(
			"services"=>$services,
			"global_max_capacity"=>$global_max_capacity,
			"global_min_capacity"=>$global_min_capacity,
			"extra_hour"=>'',
			"option_hours"=>'',
			//"costs"=>$costs,
                        "CurrencySymbol"=>$CurrencySymbol,
			"error"=>$this->error,
			"value"=>$value,
			"href"=>"Venue/".$venue_info->zone_slug."/".$venue_info->country_slug."/".$venue_info->area_slug."/".$venue_info->region_slug."/".$venue_info->slug,
                        "venueSeasonRate_data"=>$venueSeasonRate_data
		);
		
		$this->load->view("header",array("title"=>"Choose Services"));
		$this->load->view("pricing_step",array("current"=>"service", "venue_slug"=>$venue_slug, "breadcrumbs"=>$breadcrumbs));
		$this->load->view("pricing_service",$data_service);
		$this->load->view("footer");	
	}
	
	private function serviceValidation(){
		
		if(!$this->input->post('guest')){
			$this->error['guest'] = "* This field is required.";
		}elseif($this->input->post('guest')<$this->input->post('global_min_capacity') || $this->input->post('guest')>$this->input->post('global_max_capacity')){
			$this->error['guest'] = "* Guest count must between ".$this->input->post('global_min_capacity')." and ".$this->input->post('global_max_capacity');
		}
		
		if(!$this->input->post('service')){
			$this->error['service'] = "* This field is required.";	
		}elseif($this->input->post('service_rule')=="both" && (!isset($_POST['service']['ceremony']) || !isset($_POST['service']['reception']))){
			$this->error['service'] = "* One ceremony and one reception is required for this venue.";	
		}
		
		if(!$this->error){
			return true;	
		}else{
			return false;	
		}	
	}
	
	public function ceremony($venue_slug){
		$this->redirect("pricing/ceremony/".$venue_slug);
		$this->load->model("venue_model");
		$venue_info = $this->venue_model->getVenueBySlug($venue_slug);
		
		$breadcrumbs = array();
		$breadcrumbs[] = array(
			"href"=>"home",
			"title"=>'<i class="fa fa-home"></i>'
		);
		
		$breadcrumbs[] = array(
			"href"=>"Venues/".$venue_info->zone_slug."/".$venue_info->country_slug,
			"title"=>$venue_info->country_name
		);
		
		$breadcrumbs[] = array(
			"href"=>"Venues/".$venue_info->zone_slug."/".$venue_info->country_slug."/".$venue_info->area_slug,
			"title"=>$venue_info->area_name
		);
		
		$breadcrumbs[] = array(
			"href"=>"Venue/".$venue_info->zone_slug."/".$venue_info->country_slug."/".$venue_info->area_slug."/".$venue_info->region_slug."/".$venue_info->slug,
			"title"=>$venue_info->name
		);;
		
		$breadcrumbs[] = array(
			"href"=>false,
			"title"=>"Calculate Price"
		);
		
		$session = $this->session->userdata('pricing');
		// Ceremony Decorations Item
                $ceremony_data=$this->venue_model->getVenueFiltersCost("ceremony-item", $venue_info->venue_id);
                $extra_ceremony_data=$this->venue_model->getVenueFilters("extra-ceremony-item", $venue_info->venue_id);
                // Reception Decorations Item
                $reception_data=$this->venue_model->getVenueFiltersCost("reception-item", $venue_info->venue_id);
                $extra_reception_data=$this->venue_model->getVenueFilters("extra-reception-item", $venue_info->venue_id);
                $SelectedCeremonyArr=array();
                $SelectedReceptionArr=array();
                
		if(!isset($session[$venue_info->venue_id]['service'])){
			redirect("pricing/service/".$venue_slug);	
		}
		if($this->input->post('submit_form')){
                    $SelectedCeremonyItem=($this->input->post('ceremony_items'))?$this->input->post('ceremony_items'):array();
                    if(count($SelectedCeremonyItem)>0){
                        foreach($ceremony_data as $SelCd){
                            $CerHourID=$SelCd->filter_id;
                            $CerHourQty=$SelCd->qty;
                            if($CerHourQty==1 && in_array($CerHourID,$SelectedCeremonyItem)){
                                $SelectedCeremonyArr['ceremony_qty_'.$CerHourID] = $this->input->post('ceremony_qty_'.$CerHourID);
                            }
                        }

                        foreach($extra_ceremony_data as $ExtCer){
                            $ExtCerHourID=$ExtCer->id;
                            $ExtCerHourQty=$ExtCer->qty;
                            if($ExtCerHourQty==1 && in_array($ExtCerHourID,$SelectedCeremonyItem)){
                                $SelectedCeremonyArr['ceremony_qty_'.$ExtCerHourID] = $this->input->post('ceremony_qty_'.$ExtCerHourID);
                            }
                        }
                    }
                    
                    $SelectedReceptionItem=($this->input->post('reception_items'))?$this->input->post('reception_items'):array();
                    if(count($SelectedReceptionItem)>0){
                        foreach($reception_data as $SelRd){
                            $RecHourID=$SelRd->filter_id;
                            $RecHourQty=$SelRd->qty;
                            if($RecHourQty==1 && in_array($RecHourID,$SelectedReceptionItem)){
                                $SelectedReceptionArr['reception_qty_'.$RecHourID] = $this->input->post('reception_qty_'.$RecHourID);
                            }
                        }

                        foreach($extra_reception_data as $ExtRec){
                            $ExtRecHourID=$ExtRec->id;
                            $ExtRecHourQty=$ExtRec->qty;
                            if($ExtRecHourQty==1 && in_array($ExtRecHourID,$SelectedReceptionItem)){
                                $SelectedReceptionArr['reception_qty_'.$ExtRecHourID] = $this->input->post('reception_qty_'.$ExtRecHourID);
                            }
                        }
                    }
                    $session[$venue_info->venue_id]['ceremony'] = array(
                        "ceremony_items"=>$SelectedCeremonyItem,
                        "ceremony_items_qty"=>$SelectedCeremonyArr,
                        "reception_items"=>$SelectedReceptionItem,
                        "reception_items_qty"=>$SelectedReceptionArr
                    );

                    $new_array = array("pricing"=>$session);

                    $this->session->set_userdata($new_array);
                    redirect("pricing/cocktail-hour/".$venue_slug);
	
		}
		
                $ceremony_value = array();
                if(isset($session[$venue_info->venue_id]['ceremony'])){
                    $ceremony_value = $session[$venue_info->venue_id]['ceremony'];
                }
		
		if(isset($_POST['ceremony_items'])){
			$value["ceremony_items"]=$this->input->post('ceremony_items');
		}elseif($ceremony_value){
			$value["ceremony_items"]=$ceremony_value['ceremony_items'];
		}else{
			$value["ceremony_items"]=array();
		}
		
                if(isset($_POST['reception_items'])){
			$value["reception_items"]=$this->input->post('reception_items');
		}elseif($ceremony_value){
			$value["reception_items"]=isset($ceremony_value['reception_items'])?$ceremony_value['reception_items']:array();
		}else{
			$value["reception_items"]=array();
		}
                
		if($ceremony_value){
                    $value["ceremony_items_qty"]=isset($ceremony_value['ceremony_items_qty'])?$ceremony_value['ceremony_items_qty']:array();
                    $value["reception_items_qty"]=isset($ceremony_value['reception_items_qty'])?$ceremony_value['reception_items_qty']:array();
		}else{
                    $value["ceremony_items_qty"]=array();
                    $value["reception_items_qty"]=array();
		}
                
		$this->load->model("filter_model");
		
		$ceremony_items = array();
                $extra_ceremony_items = array();
                $reception_items = array();
                $extra_reception_items = array();
                
		foreach($ceremony_data as $cd){
                    $option_group = "";
		    $ceremony_items[] = array(
                        "name"=>$cd->name,
                        "qty"=>$cd->qty,
                        "required"=>$cd->required,
                        "cost"=>$cd->cost,
                        "filter_id"=>$cd->filter_id,
                        "option_group"=>$option_group
                    );	
		}
                
                foreach($extra_ceremony_data as $ecd){
                    $option_group = "";
		    $extra_ceremony_items[] = array(
                        "name"=>$ecd->extra_value,
                        "qty"=>$ecd->qty,
                        "required"=>$ecd->required,
                        "cost"=>$ecd->cost,
                        "filter_id"=>$ecd->id,
                        "option_group"=>$option_group
                    );	
		}
		
                foreach($reception_data as $rd){
                    $option_group = "";
		    $reception_items[] = array(
                        "name"=>$rd->name,
                        "qty"=>$rd->qty,
                        "required"=>$rd->required,
                        "cost"=>$rd->cost,
                        "filter_id"=>$rd->filter_id,
                        "option_group"=>$option_group
                    );	
		}
                
                foreach($extra_reception_data as $erd){
                    $option_group = "";
		    $extra_reception_items[] = array(
                        "name"=>$erd->extra_value,
                        "qty"=>$erd->qty,
                        "required"=>$erd->required,
                        "cost"=>$erd->cost,
                        "filter_id"=>$erd->id,
                        "option_group"=>$option_group
                    );	
		}
                
                if($venue_info->currency!='' && array_key_exists($venue_info->currency, $this->currency_symbols)) {
                    $CurrencySymbol=$this->currency_symbols[$venue_info->currency];
                }else{
                    $CurrencySymbol='US$';
                }
                
		$data_ceremony = array(
                    "link_back"=>"pricing/service/".$venue_slug,
                    "ceremony_items"=>$ceremony_items,
                    "extra_ceremony_items"=>$extra_ceremony_items,
                    "reception_items"=>$reception_items,
                    "extra_reception_items"=>$extra_reception_items,
                    "CurrencySymbol"=>$CurrencySymbol,
                    "value"=>$value
		);
		$this->load->view("header",array("title"=>"Decoration Items"));
		$this->load->view("pricing_step",array("current"=>"ceremony", "venue_slug"=>$venue_slug, 'breadcrumbs'=>$breadcrumbs));
		$this->load->view("pricing_ceremony", $data_ceremony);
		$this->load->view("footer");
	}
	
	public function cocktail_hour($venue_slug){
		$this->redirect("pricing/cocktail-hour/".$venue_slug);
		$this->load->model("venue_model");
		$venue_info = $this->venue_model->getVenueBySlug($venue_slug);
		
		$breadcrumbs = array();
		$breadcrumbs[] = array(
			"href"=>"home",
			"title"=>'<i class="fa fa-home"></i>'
		);
		
		$breadcrumbs[] = array(
			"href"=>"Venues/".$venue_info->zone_slug."/".$venue_info->country_slug,
			"title"=>$venue_info->country_name
		);
		
		$breadcrumbs[] = array(
			"href"=>"Venues/".$venue_info->zone_slug."/".$venue_info->country_slug."/".$venue_info->area_slug,
			"title"=>$venue_info->area_name
		);
		
		$breadcrumbs[] = array(
			"href"=>"Venue/".$venue_info->zone_slug."/".$venue_info->country_slug."/".$venue_info->area_slug."/".$venue_info->region_slug."/".$venue_info->slug,
			"title"=>$venue_info->name
		);;
		
		$breadcrumbs[] = array(
			"href"=>false,
			"title"=>"Calculate Price"
		);
		
		$session = $this->session->userdata('pricing');	
		
		$Catering_arr = array();
                $ExtCatering_arr = array();
                $Beverage_arr = array();
                $ExtBeverage_arr = array();
                $Cocktail_arr = array();
                $ExtCocktail_arr = array();
		$SelectedBevHourArr=array();
                $SelectedCockTailHourArr=array();
                // Catering Packages Item
                $Catering_data=$this->venue_model->getVenueFiltersCost("catering-packages", $venue_info->venue_id);
                $extra_Catering_data=$this->venue_model->getVenueFilters("extra-catering-packages", $venue_info->venue_id);
                // Beverage Packages Item
                $Beverage_data=$this->venue_model->getVenueFiltersCost("beverage-packages", $venue_info->venue_id);
                $extra_Beverage_data=$this->venue_model->getVenueFilters("extra-beverage-packages", $venue_info->venue_id);
                // Canape & Cocktail Item
                $Cocktail_data=$this->venue_model->getVenueFiltersCost("canape-cocktail", $venue_info->venue_id);
                $extra_Cocktail_data=$this->venue_model->getVenueFilters("extra-canape-cocktail", $venue_info->venue_id);
		if(isset($session[$venue_info->venue_id]['service']['guest'])){
                    
                    foreach($Catering_data as $rd){
                        $Catering_arr[] = array(
                            "name"=>$rd->name,
                            "qty"=>$rd->qty,
                            "required"=>$rd->required,
                            "cost"=>$rd->cost,
                            "filter_id"=>$rd->filter_id
                        );	
                    }
                    
                    foreach($extra_Catering_data as $ExtCat){
                        $ExtCatering_arr[] = array(
                            "name"=>$ExtCat->extra_value,
                            "qty"=>$ExtCat->qty,
                            "required"=>$ExtCat->required,
                            "cost"=>$ExtCat->cost,
                            "filter_id"=>$ExtCat->id
                        );	
                    }
                    
                    foreach($Beverage_data as $bd){
                        $Beverage_arr[] = array(
                            "name"=>$bd->name,
                            "qty"=>$bd->qty,
                            "required"=>$bd->required,
                            "cost"=>$bd->cost,
                            "filter_id"=>$bd->filter_id
                        );	
                    }
                    
                    foreach($extra_Beverage_data as $ExtBev){
                        $ExtBeverage_arr[] = array(
                            "name"=>$ExtBev->extra_value,
                            "qty"=>$ExtBev->qty,
                            "required"=>$ExtBev->required,
                            "cost"=>$ExtBev->cost,
                            "filter_id"=>$ExtBev->id
                        );	
                    }
                    
                    foreach($Cocktail_data as $cd){
                        $Cocktail_arr[] = array(
                            "name"=>$cd->name,
                            "qty"=>$cd->qty,
                            "required"=>$cd->required,
                            "cost"=>$cd->cost,
                            "filter_id"=>$cd->filter_id
                        );	
                    }
                    
                    foreach($extra_Cocktail_data as $ExtCock){
                        $ExtCocktail_arr[] = array(
                            "name"=>$ExtCock->extra_value,
                            "qty"=>$ExtCock->qty,
                            "required"=>$ExtCock->required,
                            "cost"=>$ExtCock->cost,
                            "filter_id"=>$ExtCock->id
                        );	
                    }
                }
		
		if(!isset($session[$venue_info->venue_id]['ceremony'])){
			redirect("pricing/ceremony/".$venue_slug);	
		}
		if($this->input->post('submit_form')){
                    $SelectedBevItem=($this->input->post('beverage_items'))?$this->input->post('beverage_items'):array();
                    $SelectedCocktailItem=($this->input->post('cocktail_items'))?$this->input->post('cocktail_items'):array();
                    if(count($SelectedBevItem)>0 && !empty($SelectedBevItem)){
                        foreach($Beverage_data as $bd){
                            $BevHourID=$bd->filter_id;
                            $BevHourQty=$bd->qty;
                            if($BevHourQty==1 && in_array($BevHourID,$SelectedBevItem)){
                                $SelectedBevHourArr['beverage_hour_'.$BevHourID] = $this->input->post('beverage_hour_'.$BevHourID);
                            }
                        }

                        foreach($extra_Beverage_data as $ExtBev){
                            $ExtBevHourID=$ExtBev->id;
                            $ExtBevHourQty=$ExtBev->qty;
                            if($ExtBevHourQty==1 && in_array($ExtBevHourID,$SelectedBevItem)){
                                $SelectedBevHourArr['beverage_hour_'.$ExtBevHourID] = $this->input->post('beverage_hour_'.$ExtBevHourID);
                            }

                        }
                    }
                    if(count($SelectedCocktailItem)>0 && !empty($SelectedCocktailItem)){
                        foreach($Cocktail_data as $cd){
                            $CockHourID=$cd->filter_id;
                            $CockHourQty=$cd->qty;
                            if($CockHourQty==1 && in_array($CockHourID,$SelectedCocktailItem)){
                                $SelectedCockTailHourArr['cocktail_hour_'.$CockHourID] = $this->input->post('cocktail_hour_'.$CockHourID);
                            }
                        }

                        foreach($extra_Cocktail_data as $ExtCock){
                            $ExtCockHourID=$ExtCock->id;
                            $ExtCockHourQty=$ExtCock->qty;
                            if($ExtCockHourQty==1 && in_array($ExtCockHourID,$SelectedBevItem)){
                                $SelectedCockTailHourArr['cocktail_hour_'.$ExtCockHourID] = $this->input->post('cocktail_hour_'.$ExtCockHourID);
                            }

                        }
                    }
                    $session[$venue_info->venue_id]['cocktail_hour'] = array(
                        "catering_items"=>$this->input->post('catering_items'),
                        "beverage_items"=>$this->input->post('beverage_items'),
                        "beverage_items_hour"=>$SelectedBevHourArr,
                        "cocktail_items_hour"=>$SelectedCockTailHourArr,
                        "cocktail_items"=>$this->input->post('cocktail_items')
                    );
                    $new_array = array("pricing"=>$session);
                    $this->session->set_userdata($new_array);
                    redirect("pricing/reception/".$venue_slug);
		}
		$cocktail_hour = array();
		if(isset($session[$venue_info->venue_id]['cocktail_hour'])){
			$cocktail_hour = $session[$venue_info->venue_id]['cocktail_hour'];
		}
		
		if(isset($_POST['catering_items'])){
                    $value["catering_items"]=$this->input->post('catering_items');
		}elseif($cocktail_hour){
                    $value["catering_items"]=isset($cocktail_hour['catering_items'])?$cocktail_hour['catering_items']:array();
		}else{
                    $value["catering_items"]=array();
		}
                
                
                if(isset($_POST['beverage_items'])){
                    $value["beverage_items"]=$this->input->post('beverage_items');
		}elseif($cocktail_hour){
                    $value["beverage_items"]=isset($cocktail_hour['beverage_items'])?$cocktail_hour['beverage_items']:array();
		}else{
                    $value["beverage_items"]=array();
		}
                
                if(isset($_POST['cocktail_items'])){
                    $value["cocktail_items"]=$this->input->post('cocktail_items');
		}elseif($cocktail_hour){
                    $value["cocktail_items"]=isset($cocktail_hour['cocktail_items'])?$cocktail_hour['cocktail_items']:array();
		}else{
                    $value["cocktail_items"]=array();
		}
                
                if($cocktail_hour){
                    $value["beverage_items_hour"]=isset($cocktail_hour['beverage_items_hour'])?$cocktail_hour['beverage_items_hour']:array();
                    $value["cocktail_items_hour"]=isset($cocktail_hour['cocktail_items_hour'])?$cocktail_hour['cocktail_items_hour']:array();
		}else{
                    $value["cocktail_items_hour"]=array();
                    $value["beverage_items_hour"]=array();
		}
                
                if($venue_info->currency!='' && array_key_exists($venue_info->currency, $this->currency_symbols)) {
                    $CurrencySymbol=$this->currency_symbols[$venue_info->currency];
                }else{
                    $CurrencySymbol='US$';
                }
		
		$data = array(
                    "link_back"=>"pricing/ceremony/".$venue_slug,
                    "Catering_item"=>$Catering_arr,
                    "ExtCatering_item"=>$ExtCatering_arr,
                    "Beverage_item"=>$Beverage_arr,
                    "ExtBeverage_item"=>$ExtBeverage_arr,
                    "Cocktail_item"=>$Cocktail_arr,
                    "ExtCocktail_item"=>$ExtCocktail_arr,
                    "CurrencySymbol"=>$CurrencySymbol,
                    "error"=>$this->error,
                    "value"=>$value
		);
		$this->load->view("header",array("title"=>"Catering Services"));
		$this->load->view("pricing_step",array("current"=>"cocktail_hour", "venue_slug"=>$venue_slug, 'breadcrumbs'=>$breadcrumbs));
		$this->load->view("pricing_cocktail_hour", $data);
		$this->load->view("footer");
	}
	
	private function cocktailHourValidation(){
		if($this->input->post('cocktail_hour_status')=="yes" && !$this->input->post('cocktail_hour_items')){
			$this->error['cocktail_hour_items'] = "* This field is required.";
		}
		
		if(!$this->error){
			return true;	
		}else{
			return false;	
		}	
	}
        
        
	public function reception($venue_slug){
		$this->redirect("pricing/reception/".$venue_slug);
		$this->load->model("venue_model");
		$venue_info = $this->venue_model->getVenueBySlug($venue_slug);
		
		$breadcrumbs = array();
		$breadcrumbs[] = array(
			"href"=>"home",
			"title"=>'<i class="fa fa-home"></i>'
		);
		
		$breadcrumbs[] = array(
			"href"=>"Venues/".$venue_info->zone_slug."/".$venue_info->country_slug,
			"title"=>$venue_info->country_name
		);
		
		$breadcrumbs[] = array(
			"href"=>"Venues/".$venue_info->zone_slug."/".$venue_info->country_slug."/".$venue_info->area_slug,
			"title"=>$venue_info->area_name
		);
		
		$breadcrumbs[] = array(
			"href"=>"Venue/".$venue_info->zone_slug."/".$venue_info->country_slug."/".$venue_info->area_slug."/".$venue_info->region_slug."/".$venue_info->slug,
			"title"=>$venue_info->name
		);;
		
		$breadcrumbs[] = array(
			"href"=>false,
			"title"=>"Calculate Price"
		);
		
		$session = $this->session->userdata('pricing');
		if($venue_info->currency!='' && array_key_exists($venue_info->currency, $this->currency_symbols)) {
                    $CurrencySymbol=$this->currency_symbols[$venue_info->currency];
                }else{
                    $CurrencySymbol='US$';
                }
                
                // Additional Services Item
                $Additional_data=$this->venue_model->getVenueFiltersCost("additional-services", $venue_info->venue_id);
                $extra_Additional_data=$this->venue_model->getVenueFilters("extra-additional-services", $venue_info->venue_id);
		$Additional_items = array();
                $ExtAdditional_items = array();
                $SelectedAddHourArr=array();
                if(!isset($session[$venue_info->venue_id]['cocktail_hour'])){
			redirect("pricing/cocktail-hour/".$venue_slug);	
		}
		if($this->input->post('submit_form')){	
                    $SelectedAdditionalItem=($this->input->post('additional_items'))?$this->input->post('additional_items'):array();
                    if(count($SelectedAdditionalItem)>0 && !empty($SelectedAdditionalItem)){
                        foreach($Additional_data as $ad){
                            $AddHourID=$ad->filter_id;
                            $AddHourQty=$ad->qty;
                            if($AddHourQty==1 && in_array($AddHourID,$SelectedAdditionalItem)){
                                $SelectedAddHourArr['additional_hour_'.$AddHourID] = $this->input->post('additional_hour_'.$AddHourID);
                            }
                        }

                        foreach($extra_Additional_data as $ExtAddData){
                            $ExtAddHourID=$ExtAddData->id;
                            $ExtAddHourQty=$ExtAddData->qty;
                            if($ExtAddHourQty==1 && in_array($ExtAddHourID,$SelectedAdditionalItem)){
                                $SelectedAddHourArr['additional_hour_'.$ExtAddHourID] = $this->input->post('additional_hour_'.$ExtAddHourID);
                            }

                        }
                    }
                    $session[$venue_info->venue_id]['reception'] = array(
                        "additional_items"=>$SelectedAdditionalItem,
                        "additional_items_hour"=>$SelectedAddHourArr
                    );
                    $new_array = array("pricing"=>$session);
                    $this->session->set_userdata($new_array);
                    redirect("pricing/estimate/".$venue_slug);
		}
		$this->load->model("filter_model");
                
                foreach($Additional_data as $bd){
                    $Additional_items[] = array(
                        "name"=>$bd->name,
                        "qty"=>$bd->qty,
                        "required"=>$bd->required,
                        "cost"=>$bd->cost,
                        "filter_id"=>$bd->filter_id
                    );	
                }

                foreach($extra_Additional_data as $ExtBev){
                    $ExtAdditional_items[] = array(
                        "name"=>$ExtBev->extra_value,
                        "qty"=>$ExtBev->qty,
                        "required"=>$ExtBev->required,
                        "cost"=>$ExtBev->cost,
                        "filter_id"=>$ExtBev->id
                    );	
                }
                
		$Additional_value = array();
		if(isset($session[$venue_info->venue_id]['reception'])){
                    $Additional_value = $session[$venue_info->venue_id]['reception'];
		}
		
		if(isset($_POST['additional_items'])){
			$value["additional_items"]=$this->input->post('additional_items');
		}elseif($Additional_value){
			$value["additional_items"]=isset($Additional_value['additional_items'])?$Additional_value['additional_items']:array();
		}else{
			$value["additional_items"]=array();	
		}
		
                if($Additional_value){
                    $value["additional_items_hour"]=isset($Additional_value['additional_items_hour'])?$Additional_value['additional_items_hour']:array();
		}else{
                    $value["additional_items_hour"]=array();
		}
		
		
		$data = array(
                    "link_back"=>"pricing/cocktail-hour/".$venue_slug,
                    "additional_items"=>$Additional_items,
                    "Ext_additional_items"=>$ExtAdditional_items,
                    "CurrencySymbol"=>$CurrencySymbol,
                    "error"=>$this->error,
                    "value"=>$value,
		);
		$this->load->view("header",array("title"=>"Additional Services"));
		$this->load->view("pricing_step",array("current"=>"reception", "venue_slug"=>$venue_slug, 'breadcrumbs'=>$breadcrumbs));
		$this->load->view("pricing_reception", $data);
		$this->load->view("footer");		
	}
	
	private function receptionValidation(){
		
		if(!$this->input->post('type_of_menu')){
			$this->error['type_of_menu'] = "* This field is required.";
		}
		
		if(!$this->input->post('type_of_beverage')){
			$this->error['type_of_beverage'] = "* This field is required.";
		}elseif($this->input->post('type_of_beverage')=="hosted-bar-by-hour" && !$this->input->post('hosted_bar_by_hour')){
			$this->error['hosted_bar_by_hour'] = "* This field is required.";
		}
		
		if(!$this->input->post('byo')){
			$this->error['byo'] = "* This field is required.";
		}
		
		
		if(!$this->error){
			return true;	
		}else{
			return false;
		}	
	}
	
	public function estimate($venue_slug){
		$this->redirect("pricing/estimate/".$venue_slug);
		$this->load->model("venue_model");
		$this->load->model("filter_model");
		$venue_info = $this->venue_model->getVenueBySlug($venue_slug);
		
		$breadcrumbs = array();
		$breadcrumbs[] = array(
			"href"=>"home",
			"title"=>'<i class="fa fa-home"></i>'
		);
		
		$breadcrumbs[] = array(
			"href"=>"Venues/".$venue_info->zone_slug."/".$venue_info->country_slug,
			"title"=>$venue_info->country_name
		);
		
		$breadcrumbs[] = array(
			"href"=>"Venues/".$venue_info->zone_slug."/".$venue_info->country_slug."/".$venue_info->area_slug,
			"title"=>$venue_info->area_name
		);
		
		$breadcrumbs[] = array(
			"href"=>"Venue/".$venue_info->zone_slug."/".$venue_info->country_slug."/".$venue_info->area_slug."/".$venue_info->region_slug."/".$venue_info->slug,
			"title"=>$venue_info->name
		);;
		
		$breadcrumbs[] = array(
			"href"=>false,
			"title"=>"Calculate Price"
		);
                // currency symbol
                if($venue_info->currency!='' && array_key_exists($venue_info->currency, $this->currency_symbols)) {
                    $CurrencySymbol=$this->currency_symbols[$venue_info->currency];
                }else{
                    $CurrencySymbol='US$';
                }
		
		$session = $this->session->userdata('pricing');
		if(!isset($session[$venue_info->venue_id]['reception'])){
                    redirect("pricing/reception/".$venue_slug);	
		}
		
		$pricing = $this->session->userdata("pricing");
		$estimate = $pricing[$venue_info->venue_id];
		
		$event_days = $this->config->item("event_days");
		$seasons = $this->config->item("seasons");
		$TotGuestNo=($estimate['service']['guest']>0)?$estimate['service']['guest']:1;
                
		$ceremony_options = array();
		$ceremony_cost = 0;
		if(isset($estimate['ceremony']['ceremony_items']) && $estimate['ceremony']['ceremony_items']){
                    foreach($estimate['ceremony']['ceremony_items'] as $filter_id){
                        $data_cost = $this->venue_model->getVenueFilterPrice($venue_info->venue_id, $filter_id);
                        if(count($data_cost)>0){
                            if($data_cost->cost == 0){
                                $cost = "Included";	
                            }else{
                                if($data_cost->qty== 1){
                                    $ceremony_itemsQtyArr=isset($estimate['ceremony']['ceremony_items_qty'])?$estimate['ceremony']['ceremony_items_qty']:array();
                                    //ceremony_items_qty
                                    if (array_key_exists('ceremony_qty_'.$filter_id, $ceremony_itemsQtyArr)) {
                                        $Ceremony_pcs=$ceremony_itemsQtyArr['ceremony_qty_'.$filter_id];
                                        if($Ceremony_pcs!=''){
                                            $NewDecCost=($data_cost->cost)*$Ceremony_pcs;
                                        }else{
                                            $NewDecCost=$data_cost->cost;
                                        }
                                    }else{
                                        $NewDecCost=$data_cost->cost;
                                    }
                                    
                                }else{
                                    $NewDecCost=$data_cost->cost;
                                }
                                $cost = $CurrencySymbol.number_format(round($NewDecCost));	
                                $ceremony_cost += round($NewDecCost);
                            }
                            
                            $ceremony_options[] = array(
                                    "name"=>(isset($data_cost->name) && $data_cost->name !='')?$data_cost->name:$data_cost->extra_value,
                                    "cost"=>$cost
                            );
                        }
                    }
		}
		
		$reception_options = array();
		$reception_cost = 0;
                
                if(isset($estimate['ceremony']['reception_items']) && $estimate['ceremony']['reception_items']){
                    foreach($estimate['ceremony']['reception_items'] as $Reception_filter_id){
                        $data_cost = $this->venue_model->getVenueFilterPrice($venue_info->venue_id, $Reception_filter_id);
                        if(count($data_cost)>0){
                            if($data_cost->cost == 0){
                                $cost = "Included";	
                            }else{
                                if($data_cost->qty== 1){
                                    $ceremony_itemsQtyArr=isset($estimate['ceremony']['reception_items_qty'])?$estimate['ceremony']['reception_items_qty']:array();
                                    //ceremony_items_qty
                                    if (array_key_exists('reception_qty_'.$Reception_filter_id, $ceremony_itemsQtyArr)) {
                                        $Ceremony_pcs=$ceremony_itemsQtyArr['reception_qty_'.$Reception_filter_id];
                                        if($Ceremony_pcs!=''){
                                            $NewDecCost=($data_cost->cost)*$Ceremony_pcs;
                                        }else{
                                            $NewDecCost=$data_cost->cost;
                                        }
                                    }else{
                                        $NewDecCost=$data_cost->cost;
                                    }
                                    
                                }else{
                                    $NewDecCost=$data_cost->cost;
                                }
                                $cost = $CurrencySymbol.number_format(round($NewDecCost));	
                                $reception_cost += round($NewDecCost);
                            }
                            
                            $reception_options[] = array(
                                "name"=>(isset($data_cost->name) && $data_cost->name !='')?$data_cost->name:$data_cost->extra_value,
                                "cost"=>$cost
                            );
                        }
                    }
		}
                
                $catering_options = array();
		$catering_cost = 0;
                
                if(isset($estimate['cocktail_hour']['catering_items']) && $estimate['cocktail_hour']['catering_items']){
                    $NoOfGuest=($estimate['service']['guest']!='')?$estimate['service']['guest']:0;
                    foreach($estimate['cocktail_hour']['catering_items'] as $Cat_filter_id){
                        $data_cost = $this->venue_model->getVenueFilterPrice($venue_info->venue_id, $Cat_filter_id);
                        if(count($data_cost)>0){
                            if($data_cost->cost == 0){
                                $cost = "Included";	
                            }else{
                                $NewDecCost=($data_cost->cost * $NoOfGuest);
                                $cost = $CurrencySymbol.number_format(round($NewDecCost));	
                                $catering_cost += round($NewDecCost);
                                
                            }
                            
                            $catering_options[] = array(
                                "name"=>(isset($data_cost->name) && $data_cost->name !='')?$data_cost->name:$data_cost->extra_value,
                                "cost"=>$cost
                            );
                        }
                    }
		}
                
                $beverage_options = array();
		$beverage_cost = 0;
                
                if(isset($estimate['cocktail_hour']['beverage_items']) && $estimate['cocktail_hour']['beverage_items']){
                    foreach($estimate['cocktail_hour']['beverage_items'] as $Bev_filter_id){
                        $data_cost = $this->venue_model->getVenueFilterPrice($venue_info->venue_id, $Bev_filter_id);
                        if(count($data_cost)>0){
                            if($data_cost->cost == 0){
                                $cost = "Included";	
                            }else{
                                if($data_cost->qty== 1){
                                    $ceremony_itemsQtyArr=isset($estimate['cocktail_hour']['beverage_items_hour'])?$estimate['cocktail_hour']['beverage_items_hour']:array();
                                    //ceremony_items_qty
                                    if (array_key_exists('beverage_hour_'.$Bev_filter_id, $ceremony_itemsQtyArr)) {
                                        $BeverageHour=$ceremony_itemsQtyArr['beverage_hour_'.$Bev_filter_id];
                                        if($BeverageHour!=''){
                                            $NewDecCost=(($data_cost->cost)*$TotGuestNo)*$BeverageHour;
                                        }else{
                                            $NewDecCost=($data_cost->cost)*$TotGuestNo;
                                        }
                                    }else{
                                        $NewDecCost=($data_cost->cost)*$TotGuestNo;
                                    }
                                    
                                }else{
                                    $NewDecCost=($data_cost->cost)*$TotGuestNo;
                                }
                                $cost = $CurrencySymbol.number_format(round($NewDecCost));	
                                $beverage_cost += round($NewDecCost);
                            }
                            
                            $beverage_options[] = array(
                                "name"=>(isset($data_cost->name) && $data_cost->name !='')?$data_cost->name:$data_cost->extra_value,
                                "cost"=>$cost
                            );
                        }
                    }
		}
                
                $cocktail_options = array();
		$cocktail_cost = 0;
                
                if(isset($estimate['cocktail_hour']['cocktail_items']) && $estimate['cocktail_hour']['cocktail_items']){
                    foreach($estimate['cocktail_hour']['cocktail_items'] as $Cock_filter_id){
                        $data_cost = $this->venue_model->getVenueFilterPrice($venue_info->venue_id, $Cock_filter_id);
                        if(count($data_cost)>0){
                            if($data_cost->cost == 0){
                                $cost = "Included";	
                            }else{
                                if($data_cost->qty== 1){
                                    $ceremony_itemsQtyArr=isset($estimate['cocktail_hour']['cocktail_items_hour'])?$estimate['cocktail_hour']['cocktail_items_hour']:array();
                                    //ceremony_items_qty
                                    if (array_key_exists('cocktail_hour_'.$Cock_filter_id, $ceremony_itemsQtyArr)) {
                                        $CocktailHour=$ceremony_itemsQtyArr['cocktail_hour_'.$Cock_filter_id];
                                        if($CocktailHour!=''){
                                            $NewDecCost=(($data_cost->cost)*$TotGuestNo)*$CocktailHour;
                                        }else{
                                            $NewDecCost=($data_cost->cost)*$TotGuestNo;
                                        }
                                    }else{
                                        $NewDecCost=($data_cost->cost)*$TotGuestNo;
                                    }
                                    
                                }else{
                                    $NewDecCost=($data_cost->cost)*$TotGuestNo;
                                }
                                $cost = $CurrencySymbol.number_format(round($NewDecCost));	
                                $cocktail_cost += round($NewDecCost);
                            }
                            
                            $cocktail_options[] = array(
                                "name"=>(isset($data_cost->name) && $data_cost->name !='')?$data_cost->name:$data_cost->extra_value,
                                "cost"=>$cost
                            );
                        }
                    }
		}
                
                $additional_options = array();
		$additional_cost = 0;
                
                if(isset($estimate['reception']['additional_items']) && $estimate['reception']['additional_items']){
                    foreach($estimate['reception']['additional_items'] as $Add_filter_id){
                        $data_cost = $this->venue_model->getVenueFilterPrice($venue_info->venue_id, $Add_filter_id);
                        if(count($data_cost)>0){
                            if($data_cost->cost == 0){
                                $cost = "Included";	
                            }else{
                                if($data_cost->qty== 1){
                                    $additional_itemsQtyArr=isset($estimate['reception']['additional_items_hour'])?$estimate['reception']['additional_items_hour']:array();
                                    //ceremony_items_qty
                                    if (array_key_exists('additional_hour_'.$Add_filter_id, $additional_itemsQtyArr)) {
                                        $AdditionalHour=$additional_itemsQtyArr['additional_hour_'.$Add_filter_id];
                                        if($AdditionalHour!=''){
                                            $NewDecCost=($data_cost->cost)*$AdditionalHour;
                                        }else{
                                            $NewDecCost=$data_cost->cost;
                                        }
                                    }else{
                                        $NewDecCost=$data_cost->cost;
                                    }
                                    
                                }else{
                                    $NewDecCost=$data_cost->cost;
                                }
                                $cost = $CurrencySymbol.number_format(round($NewDecCost));	
                                $additional_cost += round($NewDecCost);
                            }
                            
                            $additional_options[] = array(
                                "name"=>(isset($data_cost->name) && $data_cost->name !='')?$data_cost->name:$data_cost->extra_value,
                                "cost"=>$cost
                            );
                        }
                    }
		}
                
                // Ext additional cost item
                $additionalCost_options = array();
		$ExtAdditional_cost = 0;
                
                $AdditionalData_cost = $this->venue_model->getVenueExtAdditionalPrice($venue_info->venue_id, 'extra-additional-services-cost');
                foreach($AdditionalData_cost as $AddCost){
                    if($AddCost->cost == 0){
                        $cost = "Included";	
                    }else{
                        $NewDecCost=$AddCost->cost;
                        $cost = $CurrencySymbol.number_format(round($NewDecCost));	
                        $ExtAdditional_cost += round($NewDecCost);
                    }

                    $additionalCost_options[] = array(
                        "name"=>(isset($AddCost->name) && $AddCost->name !='')?$AddCost->name:$AddCost->extra_value,
                        "cost"=>$cost
                    );

                }
		
		$data_service = $estimate['service']['service'];
                
		$services = array();
		$SelectSeason=$estimate['service']['season'];
                $venue_type=$venue_info->venue_type;
                $rental_fee=0;
                $villa_fee=0;
                $villa_min_stay=0;
                //print_r($estimate);
		if($SelectSeason == 'on-peak'){
                    if($venue_type==1){
                        $villa_min_stay=$venue_info->villa_hi_min_stay;
                        $villa_fee=$venue_info->villa_hi_price*$villa_min_stay;
                    }
                    $highReception=isset($venue_info->highReception)?$venue_info->highReception:0;
                    $RentalReceptionArr=isset($data_service['reception'])?$data_service['reception']:array();
                    if(array_key_exists('indoor-reception', $RentalReceptionArr) && $highReception==0) {
                        $rental_fee += isset($venue_info->high_indoor_reception)?$venue_info->high_indoor_reception:0;
                    }elseif(array_key_exists('outdoor-reception', $RentalReceptionArr) && $highReception==0){
                        $rental_fee += isset($venue_info->high_outdoor_reception)?$venue_info->high_outdoor_reception:0;
                    }
                    $RentalCeremonyArr=isset($data_service['ceremony'])?$data_service['ceremony']:array();
                    if(array_key_exists('indoor-ceremony', $RentalCeremonyArr)){
                        $rental_fee += isset($venue_info->high_indoor_ceremony)?$venue_info->high_indoor_ceremony:0;
                    }elseif(array_key_exists('outdoor-ceremony', $RentalCeremonyArr)){
                        $rental_fee += isset($venue_info->high_outdoor_ceremony)?$venue_info->high_outdoor_ceremony:0;
                    }
                }else{
                    if($venue_type==1){
                        $villa_min_stay=$venue_info->villa_low_min_stay;
                        $villa_fee=$venue_info->villa_low_price*$villa_min_stay;
                    }
                    $lowReception=isset($venue_info->lowReception)?$venue_info->lowReception:0;
                    $RentalReceptionArr=isset($data_service['reception'])?$data_service['reception']:array();
                    if(array_key_exists('indoor-reception', $RentalReceptionArr) && $lowReception==0) {
                        $rental_fee += isset($venue_info->low_indoor_reception)?$venue_info->low_indoor_reception:0;
                    }elseif(array_key_exists('outdoor-reception', $RentalReceptionArr) && $lowReception==0){
                        $rental_fee += isset($venue_info->low_outdoor_reception)?$venue_info->low_outdoor_reception:0;
                    }
                    $RentalCeremonyArr=isset($data_service['ceremony'])?$data_service['ceremony']:array();
                    if(array_key_exists('indoor-ceremony', $RentalCeremonyArr)){
                        $rental_fee += isset($venue_info->low_indoor_ceremony)?$venue_info->low_indoor_ceremony:0;
                    }elseif(array_key_exists('outdoor-ceremony', $RentalCeremonyArr)){
                        $rental_fee += isset($venue_info->low_outdoor_ceremony)?$venue_info->low_outdoor_ceremony:0;
                    }
                }
		
                if(isset($estimate['service']['hour'])){
                    $hour = $estimate['service']['hour'];
		}else{
                    $hour = 1;
		}
                $total = 0;
		$total += round($rental_fee);
		$total += round($villa_fee);
		
		$total += $ceremony_cost;
                $total += $reception_cost;
		$total += $catering_cost;
                $total += $beverage_cost;
		$total += $cocktail_cost;
		$total += $additional_cost;
                $total += $ExtAdditional_cost;
		
		$tax = $total*($venue_info->tax/100);
		$total = $total+$tax;
		
		$per_person = $total/$estimate['service']['guest'];
                $date1_covert= isset($estimate['service']['date1'])?explode('/', $estimate['service']['date1']):array();
                if(count($date1_covert)>0){
                    $NewSelectDateOne=$date1_covert[2].'-'.$date1_covert[1].'-'.$date1_covert[0];
                }else{
                    $NewSelectDateOne='0000-00-00';
                }
                $data_service_Str='';
                if(count($data_service)>0){
                    foreach($data_service as $Val_res){
                        if(count($Val_res)>0){
                            foreach($Val_res as $Val_StrKey => $StrRes){
                                if($Val_StrKey!=''){
                                    $NewStrKey = str_replace("-", " ", $Val_StrKey);
                                    $data_service_Str.=ucwords($NewStrKey).'<br />';
                                }
                            }
                        }
                    }
                }
                
		$data_estimate = array(
                    "ceremony_options"=>$ceremony_options,
                    "reception_options"=>$reception_options,
                    "catering_options"=>$catering_options,
                    "beverage_options"=>$beverage_options,
                    "cocktail_options"=>$cocktail_options,
                    "additional_options"=>$additional_options,
                    "additionalCost_options"=>$additionalCost_options,
                    "rental_fee"=>$rental_fee,
                    "villa_fee"=>$villa_fee,
                    "hour"=>$hour,
                    "villa_min_stay"=>$villa_min_stay,
                    "event_day"=>date("l, dS F Y",strtotime($NewSelectDateOne)),
                    "season"=>($estimate['service']['season']=='on-peak')?'On peak':'Off peak',
                    "service"=>$data_service_Str,
                    "guest_count"=>$estimate['service']['guest'],
                    "admin_fee"=>$venue_info->admin_fee,
                    "tax"=>$venue_info->tax,
                    "venue_currency_symbol"=>$CurrencySymbol,
                    "venue_currency"=>isset($venue_info->currency)?$venue_info->currency:'USD',
                    "total"=>round($total),
                    "per_person"=>round($per_person),
                    "venue_id"=>$venue_info->venue_id,
                    "slug"=>$venue_info->slug,
                    "venue_name"=>$venue_info->name,
                    "redirect"=>"pricing/estimate/".$venue_info->slug
		);
		
		
		$this->load->view("header",array("title"=>"Estimate"));
		$this->load->view("pricing_step",array("current"=>"estimate", "venue_slug"=>$venue_slug, 'breadcrumbs'=>$breadcrumbs));
		$this->load->view("pricing_estimate", $data_estimate);
		$this->load->view("footer");
	}
        
        public function UserConvertCurrency($TotPrice, $PerPerson, $From, $to){
            if($to!='' && array_key_exists($to, $this->currency_symbols)) {
                $CurrencySymbol=$this->currency_symbols[$to];
            }else{
                $CurrencySymbol='US$';
            }
            $this->session->set_userdata('UserSelectCur', $to);	
            
            $TotalCurCon=convertCurrency($TotPrice, $to, $From);
            $PerPersonCurCon=convertCurrency($PerPerson, $to, $From);
            echo $CurrencySymbol.$TotalCurCon.':'.$CurrencySymbol.$PerPersonCurCon;
        }		
}