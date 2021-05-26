<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>



<div class="wsm_map_offices_block">



	<div class="ymap"> 

		<div id="WSM_MapOffice_YMAP"></div>

	</div>

	

	<div class="map_control">

		<div class="geo_info">

			<?if($arResult["CALULATED"]["OTHER_CITY"] && $arParams["CITY"] == "Y"): // ˜˜˜˜ ˜˜˜˜˜˜˜˜˜˜˜˜ ˜˜˜˜˜ ˜˜˜˜˜˜˜˜˜˜˜˜ ˜˜ ˜˜˜˜˜˜ ˜ ˜˜˜ ˜˜˜˜˜˜ ˜˜˜˜˜˜˜?>

				<?=GetMessage("WSM_OFFICEMAP_YOUR_CITY")?>: 

				<?=$arResult["CITY"][$arResult["CALULATED"]["CITY_ID"]]['NAME'];?>

			<?elseif($arResult["CALULATED"]["POINT_ID"] > 0 && $arParams["CITY"] != "Y"):?>

				<?=GetMessage("WSM_OFFICEMAP_YOUR_OFFICE")?>: 

				<?=$arResult["ITEMS"][$arResult["CALULATED"]["POINT_ID"]]['NAME'];?>

			<?endif;?>

		</div>

		<div class="links">

			<span style="cursor:pointer" map-action="map.setDefault"><?=GetMessage("WSM_SHOW_MAP_CENTER")?></span>

			<?if($arParams["SHOW_TRAFFIC"] == 'Y'):?>

			<span style="cursor:pointer" map-action="traffic.toggle"><?=GetMessage("WSM_SHOW_TRAFFIC")?></span>

			<?endif;?>

		</div>

	</div>



	<?if(count($arResult["CITY"]) && $arParams["CITY"] == "Y" && $arParams["CITY_SELECTOR"] != "SELECT"):?>

		

		<div class="wsm_office_city_celector">

			<?foreach($arResult["CITY"] as $arCity):?>

			<span style="cursor:pointer" map-action="map.setCity" data-id="<?=$arCity['ID'];?>"><?=$arCity['NAME'];?></span>

			<?endforeach;?>

		</div>

		

	<?elseif(count($arResult["CITY"]) && $arParams["CITY"] == "Y"):?>

	

		<div class="wsm_office_city_celector">

			<span><?=GetMessage("WSM_MAPOFFICES_CITY")?>:</span>

			<select map-action="map.setCity">

			<?foreach($arResult["CITY"] as $arCity):?>

				<option value="<?=$arCity['ID'];?>"><?=$arCity['NAME'];?></option>

			<?endforeach;?>

			</select>

		</div>

		

	<?endif;?>



</div>



<?

$data = "";

foreach($arResult["ITEMS"] as $arItem)

{

	$prop_data = "";

	foreach($arItem["DISPLAY_BALOON_PROPERTIES"] as $code => $prop)

		$prop_data .= '<b>'.$prop['NAME'].'</b>: '.$prop['VALUE'].'</br>';



	$data .= $arItem['ID'].":{".

		'name: '.CUtil::PhpToJSObject($arItem['NAME'], false, true).','.

		'city: '.$arItem["IBLOCK_SECTION_ID"].','.

		'desc: '.CUtil::PhpToJSObject($arItem['PREVIEW_TEXT'], false, true).','.

		'prop: '.CUtil::PhpToJSObject($prop_data, false, true).','.   

		'center: ['.$arItem["PROPERTIES"][$arParams['POINT_POSITION']]['VALUE'].'],'.

		'url: "'.($arItem['DETAIL_PAGE_URL'] ? '<a href="'.$arItem['DETAIL_PAGE_URL'].'">'.GetMessage("WSM_OFFICEMAP_PODROBNEE").'</a>' : '').'",'.

		'},';

}

$data = rtrim($data,',');

?>
<script> 

// var i = 0;
// window.onscroll = function() {

  // if(pageYOffset > 300 && i == 0){
	var data = {<?=$data?>};

	var config = {


		debug		: false,

		map			: 'WSM_MapOffice_YMAP',

		map_center	: [<?=$arResult["MAP_CENTER"]?>],

		map_zoom	: 12,

		//auto_zoom_correct: -2,

		city_id: <?=$arResult["CALULATED"]["CITY_ID"]?>,

		selector_office_block : "selector-office",

		ymap_api_error: '<?=GetMessage("WSM_YMAP_ERROR")?>',

		ymaps_ready: function(YMap, Collection, data){ 


			},

		create_placemark: function(data){			

			var point_data = {

				<?if($arParams["MAP_POINT_PRESET_TYPE"] == 'Stretchy'):?> 

				iconContent: data['name'],

				<?endif;?>

				balloonContentHeader: data['name'],

				balloonContentBody: data['desc'] + '<br/> ' + data['prop'],

				balloonContentFooter: data['url']

				};

			var point_opt = {

				preset: '<?=$arParams["MAP_POINT_PRESET"]?>'

				};

			//please return objects data and options

			return {data: point_data, options: point_opt};

			

			},

		action_traffic: function(action, traffic_status, controls){

			//callback, when the display state changes traffic

			//example: change text on controls



			for(i in controls) {



				if(controls[i].getAttribute("map-action") != "traffic.toggle")

					continue;



				if(traffic_status)

					controls[i].innerHTML = "<?=GetMessage("WSM_HIDE_TRAFFIC")?>"; 

				else

					controls[i].innerHTML = "<?=GetMessage("WSM_SHOW_TRAFFIC")?>";

				}



			},

		action_map: function(action, traffic_status, controls){

		

			},

		select_city: function(el, city_id, location, zoom, data){

			//callback, when city selected

			},

		select_point: function(index, data){

			//callback, when click "show on map"

			//for example: scroll to map

			BX.scrollToNode('WSM_MapOffice_YMAP');

			}	

		};

var YMapController;

BX.ready(function(){

	YMapController = new BX.WSMMapOfficesMap(data, config);	

	//YMapController.ready(function(controller){

	//	controller.Action('traffic.show');

	//	});

	});

//   	i = 1;
//   }
// }
</script>



