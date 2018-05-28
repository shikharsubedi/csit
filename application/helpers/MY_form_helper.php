<?php  use Doctrine\ORM\Query;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function render_custom_field( $field ){
	
	$method = 'form_'.$field['type'];
	
	$out = '';
	if(function_exists($method)){
		$out = '<tr valign="top">
		<th scope="row"><label for="'.$field['id'].'">'.$field['label'];
		
		//if($field['required'] === TRUE){
			//$out .= '<span class="asterisk">*</span>';
		//}
		
		$out .= '</label></th><td>'.$method($field).'</td></tr>';
		
		if($field['type'] == 'upload'  && $field['value'] != '')
		{
			$out .='
			<tr valign="top">
				<th>&nbsp;</th>
				<td>
					<img src="'.site_url().'assets/upload/images/'.$field['value'].'" style="max-width:500px;max-height:100px;" />
				</td>
			</tr>';
		}
	}
	
	if($field['type'] == 'content_slider_dropdown'){
		$ci = get_instance();
		
		$repo = $ci->doctrine->em->getRepository('contentsliders\models\Contentslider');
		$sliders = $repo->findAll(Query::HYDRATE_ARRAY);
		
		if(count($sliders)){
			$out .= '<tr valign="top">
		<th scope="row"><label for="'.$field['id'].'">'.$field['label'];
			
			$out .= '</label></th><td>
			<select name="'.$field['name'].'" id="'.$field['id'].'">
			<option value="0">SELECT CONTENT SLIDER</option>
			<option value="0">None</option>';

			
			
			foreach($sliders as $slider){
				
				if($field['selected'] == $slider->id()){
					$sel = 'selected="selected"';
				}else{
					$sel = '';
				}
				
				$out .= '<option value="'.$slider->id().'" '.$sel.'>'.$slider->getName().'</option>';
			}
			
			$out .= '</select></td></tr>';	
		}
	}
	
	echo $out;
}
?>
