<?php
// post
$_POST = stripslashes_deep($_POST);
// int
$list = array();
// loop
foreach ($data['downloads'] as $obj):
	$list[$obj->id] = $obj->title;
endforeach;
// url
// $url = MGM_ASSETS_URL.'js/editor/plugins/downloads/php/main.php';
$main = MGM_CORE_DIR . 'assets/js/editor/plugins/downloads/php/main.php';
// html	
$html = '';

// list
if( !empty($list) ):
	$html .= '
	<fieldset>
		<legend>' . __('From Downloads', 'mgm') . '</legend>
		<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td>' . __('Select','mgm') . ':</td>
				<td>
					<select name="download_link" id="download_link" class="width130px;">' . mgm_make_combo_options($list,'',2) . '</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="hidden" name="download_hook" value="' . $data['download_hook'] . '" id="download_hook" />
				</td>
			</tr>
			<tr>
				<td>
					<input type="radio" name="download_option" value="link" id="link" checked="true" />
				</td>
				<td>' . __('Download link','mgm') . '</td>
			</tr>
			<tr>
				<td>
					<input type="radio" name="download_option" value="link" id="image" />
				</td>
				<td>' . __('Image Download link','mgm') . '</td>
			</tr>
			<tr>
				<td>
					<input type="radio" name="download_option" value="button" id="button" />
				</td>
				<td>' . __('Button Download link','mgm') . '</td>
			</tr>
			<tr>
				<td>
					<input type="radio" name="download_option" value="size" id="size" />
				</td>
				<td>' . __('Download link with filesize','mgm') . '</td>
			</tr>
			<tr>
				<td>
					<input type="radio" name="download_option" value="url" id="url" />
				</td>
				<td>' . __('Download url only','mgm') . '</td>
			</tr>
		</table>
	</fieldset>
	<br/>
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td>&nbsp;</td>
			<td><input class="button" type="button" id="insert" name="insert" value="' . __('Insert','mgm') . '" /></td>
		</tr>
	</table> 
	<br/>';
endif;

$html .= '
	<div id="download_manage"><br/>
		<fieldset>
			<legend>' . __('From Computer','mgm') . '</legend>	
			<form name="frmdwnadd" id="frmdwnadd" action="'.admin_url('admin-ajax.php?action=mgm_admin_ajax_action&page=mgm.admin.downloads&method=add').'" method="post" enctype="multipart/form-data">	
				<input type="hidden" id="submitUrlID" name="sub_URL" value="'.admin_url('admin-ajax.php?action=mgm_admin_ajax_action&page=mgm.admin.downloads&method=add').'"/>
				<table cellpadding="0" cellspacing="0" border="0">	
					<tr>
						<td>&nbsp;</td>
						<td>' . __('Title','mgm') . ': <input name="title" id="title" type="text" value="" /></td>
					</tr>	
					<tr>
						<td>&nbsp;</td>
						<td>
							' . __('Upload File','mgm') . ' : <input name="download_file" id="download_file" type="file"/><br /> 
							' . __('Direct url','mgm') . ' : <input name="direct_url" id="direct_url" type="text" value="" maxlength="255"/>
						</td>
					</tr>	
					<tr>
						<td>&nbsp;</td>
						<td>
							<i>' . sprintf(__('Note : Maximum upload file size: %s','mgm'), @ini_get('upload_max_filesize')) . '.</i>
							<!--' . __('Expire date','mgm') . ' :--> <input name="expire_dt" id="expire_dt" type="hidden" value="" />
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>
							<input class="button" type="button" id="submit_download" name="btn" value="' . __('Upload','mgm') . '"/>
							<input type="hidden" name="submit_download" value="1"/>
						</td>
					</tr>
				</table> <br/>
			</form>
		</fieldset><br/>
	</div>';

	// set
	$mgm_assets_url = MGM_ASSETS_URL;
	$includes_url = includes_url();
	$admin_url = admin_url();
	$blog_version = get_bloginfo('version');
	$downloads = $html;
	// include
	include_once($main);

