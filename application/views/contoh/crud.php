<div id="firstz" style="display:none;">
	<div id="pesan_loading">
		<h1>Mohon Tunggu..</h1>
		<div class="progress progress-sm active" id="loading_progress" style="display:none;">
			<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" id="progress_bar" style="width:0%;">
				<span class="sr-only">100% Complete</span>
			</div>
		</div>
	</div>
</div>


<div class="col-md-4"  >
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div>
            <!-- /.box-header -->
			<div class="alert alert-danger alert-dismissable" id="error_simpan_contoh" style="display:none;">
			<p id="pesan_error_simpan_contoh"></p>
			</div>
			<div class="alert alert-success alert-dismissable" id="sukses_simpan_contoh" style="display:none;">
			<p id="pesan_sukses_simpan_contoh"></p>
			</div>
			<div style="clear:both;"></div>			
            <!-- form start -->
            <form role="form" id="form_contoh" method="post" action="<?php echo base_url(); ?>attachment/upload/?table_name=contoh" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
				<input class="form-control" id="temp" name="temp" value="" type="hidden">
				<input class="form-control" id="id_contoh" value="baru" type="hidden">

                </div>
				<div class="form-group">
				<label for="urut">urut</label>
				<input class="form-control" id="urut" placeholder="urut" type="text">
				</div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Contoh</label>
              <input id = "nama_contoh" class="form-control" type="text" placeholder="Nama Contoh">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Kode Contoh</label>
              <input id ="kode_contoh" class="form-control" type="text" placeholder="Kode Contoh">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Keterangan</label>
              <input id ="keterangan" class="form-control" type="text" placeholder="Keterangan">
                </div>

								<div class="box-footer">
									<button type="submit" class="btn btn-primary" id="simpan_contoh">
                  <i class="fa fa-refresh fa-spin" id="spin_simpan_contoh" style="display:none;"></i> SIMPAN
                  </button>
								</div>
            </form>
          </div>
</div>
</div>
<div class="col-md-4">
		<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Tampil Contoh</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: block;">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>No urut</th>
                    <th>Nama_contoh</th>
                    <th>Kode_contoh</th>
                    <th>Keterangan</th>
                  </tr>
                  </thead>

                  <tbody id="id01" >
               
                  </tbody>
                </table>
              </div>
			  
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix" style="display: block;">
              <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div>
            <!-- /.box-footer -->
          </div>
</div>
<div class="col-md-4">
				<div class="row">
					<div class="box-body">
						<table class="table table-bordered">
							<tr>
								<th>No</th><th>Kode</th><th>Contoh</th><th>Keterangan</th><th>Proses</th> 
							</tr>
							<tbody id="tbl_utama_contoh">
							</tbody>
						</table>
						<div class="box-footer clearfix">
							<div id="total_data"></div>
							<ul class="pagination pagination-sm no-margin pull-right" id="next_page_contoh">
							</ul>
						</div>
					</div>
				</div>
				</div>
<script>
function start() {
	return 0;
}

function limit() {
	return 6;
}
</script>

<script>
var xmlhttp = new XMLHttpRequest();
var url = "<?php echo base_url()?>/contoh/show_all";

xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        myFunction(xmlhttp.responseText);
    }
}
xmlhttp.open("GET", url, true);
xmlhttp.send();

function myFunction(response) {
    var arr = JSON.parse(response);
    var i;
    var out = "";

    for(i = 0; i < arr.length; i++) {
        out += "<tr><td>" + 
        arr[i].id_contoh +
        "</td><td>" +
        arr[i].nama_contoh +
        "</td><td>" +
        arr[i].kode_contoh +
        "</td><td>" +
        arr[i].keterangan +
        "</td></tr>";
    }
    out += "";
    document.getElementById("id01").innerHTML = out;
}
</script>
<script type="text/javascript">
$(document).ready(function() {
	$('#firstz').show();
	$('#loading_progress').show();
	$("#progress_bar").css({
		"width": "0%"
	});
	$.ajax({
		dataType: "json",
		url: '<?php echo base_url(); ?>contoh/json_all_contoh/?start='+start()+'&limit='+limit()+'',
		success: function(json) {
			var tr = '';
			for (var i = 0; i < json.length; i++) {
				tr += '<tr id_contoh_ajax="'+json[i].id_contoh+'" id="'+json[i].id_contoh+'" >';
				tr += '<td valign="top">'+(i + 1)+'</td>';
				tr += '<td valign="top">'+json[i].kode_contoh+'</td>';
				tr += '<td valign="top">'+json[i].nama_contoh+'</td>';
				tr += '<td valign="top">'+json[i].keterangan+'</td>';
				tr += '<td valign="top"><a href="#tab_1" data-toggle="tab" class="update_id" ><i class="fa fa-pencil-square-o"></i></a> <a href="#" id="del_ajax"><i class="fa fa-cut"></i></a> </td>';
				tr += '</tr>';          
				$("#progress_bar").css({
					"width": "" +(((i + 1) / json.length) * 100) + "%"
				});
			}
			$('#urut').val(i);
			$('#tbl_utama_contoh').append(tr);
			$('#firstz').fadeOut("slow");
			$('#loading_progress').hide();
		}
	});
	$('#total_data').html('');
	$.ajax({
		dataType: "json",
		url: '<?php echo base_url(); ?>contoh/count_all_contoh/?start='+start()+'&limit='+limit()+'',
		success: function(json) {
			for (var i = 0; i < json.length; i++) {
				var jumlah = json[i].jumlah;
				var halaman = json[i].halaman;
				$('#next_page_contoh').html('');
				var ajax_pagination = '';
				for (var a = 0; a < halaman; a++) {
					ajax_pagination += '<li id="'+a+'" page="'+a+'"><a id="next" href="#">'+(a + 1)+'</a></li>';
				}
				$('#total_data').append('Total Data : '+jumlah+', Jumlah Halaman : '+halaman+'');
				$('#next_page_contoh').append(ajax_pagination);
			}
		}
	});
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$("#simpan_contoh").on("click", function(e) {
		e.preventDefault();
		$('#simpan_contoh').attr("disabled", 'disabled');
		$('#firstz').show();
		var urut = $("#urut").val();
		var id_contoh = $("#id_contoh").val(); 
		var kode_contoh = $("#kode_contoh").val(); 
		var nama_contoh = $("#nama_contoh").val();
		var temp = $("#temp").val();
		var keterangan = CKEDITOR.instances.keterangan.getData();
		if(id_contoh == ''){ 
			$('#id_contoh').css('background-color','#DFB5B4'); 
			} 
		else { 
			$('#id_contoh').removeAttr( 'style' ); 
			}
		
		if(kode_contoh == ''){ 
			$('#kode_contoh').css('background-color','#DFB5B4'); 
			} 
		else { 
			$('#kode_contoh').removeAttr( 'style' ); 
			}

		if(nama_contoh == ''){ 
			$('#nama_contoh').css('background-color','#DFB5B4'); 
			} 
		else { 
			$('#nama_contoh').removeAttr( 'style' ); 
			}
		
		if(keterangan == ''){ 
			$('#error_keterangan').css('background-color','#DFB5B4'); 
			} 
		else { 
			$('#error_keterangan').removeAttr( 'style' ); 
			}
		$.ajax({
			type: "POST",
			async: true,
			data: {
				id_contoh:id_contoh, 
				kode_contoh:kode_contoh, 
				nama_contoh:nama_contoh, 
				keterangan:keterangan,
				temp:temp
			},
			dataType: "text",
			url: '<?php echo base_url(); ?>contoh/simpan_contoh/?start='+start()+'&limit='+limit()+'',
			success: function(json) {
				if(json == '0'){
					$('#error_simpan_contoh').show();
					$('#loading_simpan_contoh').fadeOut("slow");
					$('#pesan_error_simpan_contoh').html('Mohon data di isi');
					$("#simpan_contoh").removeAttr("disabled", "disabled");
					$('#firstz').fadeOut();
					}
				else{
					var tr = '';
					tr += '<tr id_contoh_ajax="'+json+'" id="'+json+'" >';
					tr += '<td valign="top">'+urut+'</td>';
					tr += '<td valign="top">'+kode_contoh+'</td>';
					tr += '<td valign="top">'+nama_contoh+'</td>';
					tr += '<td valign="top">'+keterangan+'</td>';
					tr += '<td valign="top"><a href="#tab_1" data-toggle="tab" class="update_id" ><i class="fa fa-pencil-square-o"></i></a> <a href="#" id="del_ajax"><i class="fa fa-cut"></i></a> </td>';
					tr += '</tr>';
					$('#tbl_utama_contoh').append(tr);
					CKEDITOR.instances.keterangan.setData('');
					$('#tbl_attacment_contoh').html('');
					$('#message_progress_upload_lampiran_contoh').html('');
					
					var aaa = Math.random();
					$('#temp').val(aaa);
					$('#pesan_sukses_simpan_contoh').html('Data berhasil disimpan');
					$('#loading_simpan_contoh').fadeOut("slow");
					$('#error_simpan_contoh').hide();
					$("#load_simpan_contoh").fadeOut('slow');
					$("#div_simpan_contoh form").trigger("reset");
					$("#simpan_contoh").removeAttr("disabled", "disabled");
					$("#firstz").fadeOut();
					}
			}
		});
		
	});
});
</script>
<script>
function reset() {
	$("#toggleCSS").attr("href", "<?php echo base_url(); ?>css/alertify/alertify.default.css");
	alertify.set({
		labels: {
			ok: "OK",
			cancel: "Cancel"
		},
		delay: 5000,
		buttonReverse: false,
		buttonFocus: "ok"
	});
}
//===============HAPUS Contoh
$('#tbl_utama_contoh, #tbl_cari_contoh').on('click', '#del_ajax', function() {
	reset();
	var id = $(this).closest('tr').attr('id_contoh_ajax');
	alertify.confirm("Anda yakin data akan dihapus?", function(e) {
		if (e) {
			$.ajax({
				dataType: "json",
				url: '<?php echo base_url(); ?>contoh/hapus_contoh/?id='+id+'',
				success: function(response) {
					if (response.errors == 'Yes') {
						alertify.alert("Maaf data tidak bisa dihapus, Anda tidak berhak melakukannya");
					} else {
						$('[id_contoh_ajax='+id+']').remove();
						alertify.alert("Data berhasil dihapus");
					}
				}
			});
		} else {
			alertify.alert("Hapus data dibatalkan");
		}
	});
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$("#e_simpan_contoh").on("click", function(e) {
		e.preventDefault();
		$('#e_simpan_contoh').attr("disabled", 'disabled');
		$('#e_spin_simpan_contoh').show();
		$('#e_loading_simpan_contoh').show();
		$('#e_error_simpan_contoh').hide();
		$("#e_load_simpan_contoh").show();
		$("#e_the_loading_simpan_contoh").css({
			"width": "0%"
		});
		var id_contoh = $("#e_id_contoh").val(); 
		var kode_contoh = $("#e_kode_contoh").val(); 
		var nama_contoh = $("#e_nama_contoh").val();
		var keterangan = CKEDITOR.instances.e_keterangan.getData();
		$.ajax({
			type: "POST",
			async: true,
			data: {
				id_contoh:id_contoh, 
				kode_contoh:kode_contoh, 
				nama_contoh:nama_contoh, 
				keterangan:keterangan,           
				status: status
			},
			dataType: "json",
			url: '<?php echo base_url(); ?>contoh/e_simpan_contoh/?start='+start()+'&limit='+limit()+'',
			success: function(json) {
				if (json.length == 0) {            
						if(id_contoh == ''){ 
							$('#e_id_contoh').css('background-color','#DFB5B4'); 
							} 
						else { 
							$('#e_id_contoh').removeAttr( 'style' ); 
							}
						if(kode_contoh == ''){ 
							$('#e_kode_contoh').css('background-color','#DFB5B4'); 
							} 
						else { 
							$('#e_kode_contoh').removeAttr( 'style' ); 
							}
						if(nama_contoh == ''){ 
							$('#e_nama_contoh').css('background-color','#DFB5B4'); 
							} 
						else { 
							$('#e_nama_contoh').removeAttr( 'style' ); 
							}
						if(keterangan == ''){ 
							//$('#e_keterangan').css('background-color','#DFB5B4'); 
							} 
						else { 
							//$('#e_keterangan').removeAttr( 'style' ); 
							}
						$('#e_error_simpan_contoh').show();
						$('#e_loading_simpan_contoh').fadeOut("slow");
						$('#e_pesan_error_simpan_contoh').html('Mohon data di isi');
						$("#e_simpan_contoh").removeAttr("disabled", "disabled");
						$('#e_spin_simpan_contoh').fadeOut();
						$('#e_load_simpan_contoh').fadeOut();
						$('#e_the_loading_simpan_contoh').fadeOut();
					} 
				else {
					$('#tbl_utama_contoh').html('');
					$('#e_id_contoh').removeAttr( 'style' );
					$('#e_kode_contoh').removeAttr( 'style' );
					$('#e_nama_contoh').removeAttr( 'style' );
					//$('#e_keterangan').removeAttr( 'style' );            
					var tr = '';
					for (var i = 0; i < json.length; i++) {
							if( json[i].id_contoh == id_contoh){
								tr += '<tr style="background:#D2D6DE;" id_contoh_ajax="'+json[i].id_contoh+'" id="'+json[i].id_contoh+'" >';
								}
							else{
								tr += '<tr id_contoh_ajax="'+json[i].id_contoh+'" id="'+json[i].id_contoh+'" >';
								}
							tr += '<td valign="top">'+(i + 1)+'</td>';
							tr += '<td valign="top">'+json[i].kode_contoh+'</td>';
							tr += '<td valign="top">'+json[i].nama_contoh+'</td>';
							tr += '<td valign="top">'+json[i].keterangan+'</td>';
							tr += '<td valign="top"><a href="#tab_1" data-toggle="tab" class="update_id" ><i class="fa fa-pencil-square-o"></i></a> <a href="#" id="del_ajax"><i class="fa fa-cut"></i></a> </td>';
							tr += '</tr>';              
							$("#e_the_loading_simpan_contoh").css({
								"width": "" +(((i + 1) / json.length) * 100) + "%"
							});
						}
						$('#div_sukses_edit').fadeIn();
						$('#e_error_input').hide();
						$('#tbl_utama_contoh').append(tr);
						$("#load_simpan_contoh").fadeOut('slow');
						$("#div_edit_contoh form").trigger("reset");
						$("#e_simpan_contoh").removeAttr("disabled", "disabled");
						$('#e_spin_simpan_contoh').fadeOut();
						$("#div_sukses_edit").fadeIn();
						$("#div_sukses_edit").fadeOut(2000);
						$('#div_edit_contoh').fadeOut(2000);
						$('#e_loading_simpan_contoh').fadeOut("slow");
						$('#e_load_simpan_contoh').fadeOut();
					}
			}
		});
	});
});
</script>

<script type="text/javascript">
$(function() {
	// Replace the <textarea id="editor1"> with a CKEditor
	// instance, using default configuration.
	CKEDITOR.replace('keterangan');
	CKEDITOR.replace('e_keterangan');
	CKEDITOR.replace('ag_keterangan');
	//bootstrap WYSIHTML5 - text editor
	$(".textarea").wysihtml5();
});
</script>