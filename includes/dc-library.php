<?php

function dc_section($title) {
	echo '<h3 style="margin-top:30px">'.$title.'</h3><hr>';
}
function dc_text($title, $args, $val) {
	echo '<p><strong>'.$title.':</strong><br/><input type="text" size="50" name="'.$args['name'].'" value="'.$val.'"></p>';
}

function dc_textarea($title, $args, $val) {
	echo '<p><strong>'.$title.':</strong><br/><textarea name="'.$args['name'].'" cols="50" rows="10">'.$val.'</textarea></p>';
}

function dc_number($title, $args, $val, $arr = null) {
	$hint = (isset($args['hint']) ? '<br/>'.$args['hint'] : '');
	$min = (isset($args['min']) ? 'min="'.$args['min'].'"' : '');
	$max = (isset($args['max']) ? 'max="'.$args['max'].'"' : '');
	echo '<p><strong>'.$title.':</strong><br/><input type="number" name="'.$args['name'].'" '.$min.' '.$max.' value="'.$val.'">'.$hint.'</p>';
}

function dc_upload($title, $args, $val, $arr = null) {
	echo '<p><strong>'.$title.'</strong><br/><input type="text" id="'.$args['id'].'" size="50" value="'.$val.'" name="'.$args['name'].'"><a data-multiple="false" data-target="#'.$args['id'].'" data-type="'.$arr['type'].'" href="#" class="button upload-btn">Select</a></p>';
}

function dc_color($title,$args, $val) {
	echo '<p><strong>'.$title.'</strong><br/>
                <input type="text" value="'.$val.'" class="my-color-field" name="'.$args['name'].'" data-default-color="'.($args['color'] != '' ? $args['color'] : '' ).'" />
            </p>';
}

function dc_checkbox($title, $args, $val) {
	echo '<p><strong>'.$title.':</strong> <input type="checkbox" name="'.$args['name'].'" '.$args['checked'].' value="'.$val.'"></p>';
}

function dc_radio($title, $args, $opt, $val) {
	echo '<p><strong>'.$title.':</strong>';
	foreach ($opt as $key) {
		echo ' <input type="radio" name="'.$args['name'].'" '.($key==$val ? 'checked' : '').' value="'.$key.'">'.ucfirst($key);
	}
	echo '<br/>'.$args['hint'].'</p>';
	
}

function dc_m_upload($title, $args, $val, $arr) {
echo '<p><input type="hidden" name="'.$args['name'].'" id="'.$args['id'].'" value="'.$val.'"><label><strong>'.$title.'</strong></label><br/><a href="#" class="button upload-btn" data-target="#'.$args['id'].'" data-multiple="true" data-images="#'.$arr['images_cont'].'">Select Images</a></p>';
    echo'<div id="'.$arr['images_cont'].'" class="sortable-images" input-target="#'.$args['id'].'">';
    
    if ( $val != '') {
	    $ids = explode(',', $val );
	    for ($i=0; $i < count($ids); $i++) {
	        echo '<span rel="'.$ids[$i].'"><a href="'.$ids[$i].'">X</a>'.wp_get_attachment_image($ids[$i], array(145,145)).'</span>';
	    	}
	}
	echo '</div>';
}