<?php defined('__NAJZMI_PUDINTEA__') OR exit('No direct script access allowed'); ?>
	<script type="text/javascript">
			var table = $('#pdn_mytable');
			$(document).ready( function () {
				var token = "<?=$this->security->get_csrf_hash();?>";
				table.DataTable({
					"processing": true,
					"serverSide": true,
					"order": [],
					"ajax": {
						"url"  : "<?=$pdn_url.'/data_json'?>",
						"type" : "POST",
						"data" : function ( d ) {
									d.<?=$this->security->get_csrf_token_name();?> = token;
								}
					},
					"columnDefs": [
						{
							"targets": [0,4],
							"sClass": "text-center",
							"orderable": false,
						},
					],
				});

				table.on('xhr.dt', function ( e, settings, json, xhr ) {
					token = json.<?=$this->security->get_csrf_token_name();?>;
				});
			});
			
			function reloadTable(){
              table.DataTable().ajax.reload();
            }
	</script>