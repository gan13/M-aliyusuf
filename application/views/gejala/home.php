<style>
#div_data_cari { overflow:hidden;height:whatever px; }
#div_data_cari:hover { overflow-x:scroll; }
</style>
<div class="col-md-6" id="awal">
	<div class="box box-info" id="div_form_input">
		<div class="box-header with-border">
			<h3 class="box-title">Masukan Data Gejala</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		<form class="form-horizontal">
			<div class="box-body" >
        <input id="id_gejala" value="" type="hidden">
				<div class="form-group">
					<label  class="col-sm-3 control-label">Kode </label>
					<div class="col-sm-9">
						<input  class="form-control" id="kode_gejala" placeholder="kode_gejala">
					</div>
				</div>
				<div class="form-group">
					<label  class="col-sm-3 control-label">Nama Gejala</label>
					<div class="col-sm-9">
						<input  class="form-control" id="nama_gejala" placeholder="nama_gejala">
					</div>
				</div>
				<div class="form-group">
					<label  class="col-sm-3 control-label">Bobot</label>
					<div class="col-sm-9">
						<input  class="form-control" id="bobot" placeholder="bobot">
					</div>
				</div>
			<!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" class="btn btn-info pull-right" id="simpan_gejala">Simpan</button>
				</div>
			</div>
      <div class="overlay" id="overlay_form_input" style="display:none;">
        <i class="fa fa-refresh fa-spin"></i>
      </div>
		</form>
	</div>

	<div class="box box-info" id="e_div_form_input" style="display:none;">
		<div class="box-header with-border">
			<h3 class="box-title">Update Data Gejala</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		<form class="form-horizontal">
			<div class="box-body" >
        <input id="e_id_gejala" value="" type="hidden">
				<div class="form-group">
					<label  class="col-sm-3 control-label">Kode </label>
					<div class="col-sm-9">
						<input  class="form-control" id="e_kode_gejala" placeholder="kode_gejala">
					</div>
				</div>
				<div class="form-group">
					<label  class="col-sm-3 control-label">Nama Gejala</label>
					<div class="col-sm-9">
						<input  class="form-control" id="e_nama_gejala" placeholder="nama_gejala">
					</div>
				</div>
				<div class="form-group">
					<label  class="col-sm-3 control-label">Bobot</label>
					<div class="col-sm-9">
						<input  class="form-control" id="e_bobot" placeholder="bobot">
					</div>
				</div>
			<!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" class="btn btn-info pull-right" id="update_data_gejala">Simpan</button>
				</div>
			</div>
			<!-- /.box-footer -->
		</form>
	</div>

</div>

<div class="row" id="list_data" >
  <div class="col-md-6">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Gejala</h3>
        <div class="box-tools">
          <div class="input-group input-group-sm">
            <input name="table_search" class="form-control pull-right" id="key_word" placeholder="Search" type="text">
            <div class="input-group-btn">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding" id="div_data_cari">
        <table class="table table-hover">
          <tbody>
            <tr>
              <th>No</th>
              <th>Kode</th>
              <th>Nama Gejala</th>
              <th>Bobot</th>
              <th>Action</th>
            </tr>
          </tbody>
          <tbody id="tbl_utama_gejala"></tbody>
          <tbody id="tbl_search_gejala"></tbody>
        </table>
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right" id="pagination">
          <?php
          for ($x = 1; $x <= $total; $x++) {
            echo '<li page="'.$x.'" id="'.$x.'"><a class="update_id" href="#">'.$x.'</a></li>';
          }
          ?>
          </ul>
        </div>
      </div>
      <div class="overlay" id="overlay_data_default" style="display:none;">
        <i class="fa fa-refresh fa-spin"></i>
      </div>
      <div class="overlay" id="e_overlay_form_input" style="display:none;">
        <i class="fa fa-refresh fa-spin"></i>
      </div>
      <div class="overlay" id="overlay_data_cari" style="display:none;">
        <i class="fa fa-refresh fa-spin"></i>
      </div>
    </div>
    <!-- /.box -->
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#key_word').on('keyup', function(e) {
      e.preventDefault();
      $('#overlay_data_cari').show();
      var key_word = $('#key_word').val();
      var start = 0;
      $('#tbl_utama_gejala').hide();
      $('#tbl_search_gejala').show();
      $('#tbl_search_gejala').html('');
      $('#total_data_search').html('');
      $.ajax({
        type: 'POST',
        async: true,
        data: {
          key_word: key_word,
          halaman: 1
        },
        dataType: 'json',
        url: '<?php echo base_url(); ?>gejala/search_gejala/',
        success: function(json) {
          if (json.length == 0) {
            if (key_word == '') {
              $('#key_word').css('background-color', '#DFB5B4');
            } else {
              $('#key_word').removeAttr('style');
            }
						$('#overlay_data_cari').fadeOut('slow');
          } else {
            $('#tbl_search_gejala').html('');
            var tr = '';
            for (var i = 0; i < json.length; i++) {
              start = start + 1;
              tr += '<tr id_gejala="' + json[i].id_gejala + '" id="id_gejala' + json[i].id_gejala + '" >';
							tr += '<td valign="top">' + (start) + '</td>';
							tr += '<td valign="top">' + json[i].kode_gejala + '</td>';
							tr += '<td valign="top">' + json[i].nama_gejala + '</td>';
							tr += '<td valign="top">' + json[i].bobot + '</td>';
							tr += '<td valign="top">';
							tr += '<a href="#tab_1" data-toggle="tab" class="update_id" ><i class="fa fa-pencil-square-o"></i></a> ';
							tr += '<a href="#tab_1" data-toggle="tab" id="del_ajax" ><i class="fa fa-cut"></i></a>';
							tr += '</td>';
							tr += '</tr>';
            }
						$('#key_word').removeAttr('style');
            $('#tbl_search_gejala').append(tr);
						$('#overlay_data_cari').fadeOut('slow');
          }
        }
      });
      $('#total_data_search').html('');
      $.ajax({
        dataType: 'text',
        url: '<?php echo base_url(); ?>gejala/count_all_search_gejala/?key_word='+key_word+'',
        success: function(json) {
          var jumlah = json;
          $('#next_page_search').html('');
          var ajax_pagination = '';
          for (var a = 0; a < jumlah; a++) {
            ajax_pagination += '<li id="'+a+'" page="'+a+'" key_word="'+key_word+'" ><a id="next" href="#">'+(a + 1)+'</a></li>';
          }
          $('#next_page_search').append(ajax_pagination);
        }
      });
    });
  });
</script>
<script type="text/javascript">
//===============HAPUS Gejala
$('#tbl_search_gejala, #tbl_utama_gejala').on('click', '#del_ajax', function() {
	reset();
	var id = $(this).closest('tr').attr('id_gejala');
	alertify.confirm('Anda yakin data akan dihapus?', function(e) {
		if (e) {
			$.ajax({
				dataType: 'json',
				url: '<?php echo base_url(); ?>gejala/hapus_gejala/?id='+id+'',
				success: function(response) {
					if (response.errors == 'Yes') {
						alertify.alert('Maaf data tidak bisa dihapus, Anda tidak berhak melakukannya');
					} else {
						$('[id_gejala='+id+']').remove();
						alertify.alert('Data berhasil dihapus');
					}
				}
			});
		} else {
			alertify.alert('Hapus data dibatalkan');
		}
	});
});
//reset ------------------
function reset() {
	$('#toggleCSS').attr('href', '<?php echo base_url(); ?>css/alertify/alertify.default.css');
	alertify.set({
		labels: {
			ok: 'OK',
			cancel: 'Cancel'
		},
		delay: 5000,
		buttonReverse: false,
		buttonFocus: 'ok'
	});
}
//simpan
  $(document).ready(function() {
    $('#simpan_gejala').on('click', function(e) {
      e.preventDefault();
      $('#simpan_gejala').attr('disabled', 'disabled');
      $('#overlay_form_input').show();
			
			var kode_gejala = $("#kode_gejala").val();
			var nama_gejala = $("#nama_gejala").val();
			var bobot = $("#bobot").val();
						
			if (kode_gejala == '') {
					$('#kode_gejala').css('background-color', '#DFB5B4');
				} else {
					$('#kode_gejala').removeAttr('style');
				}
			if (nama_gejala == '') {
					$('#nama_gejala').css('background-color', '#DFB5B4');
				} else {
					$('#nama_gejala').removeAttr('style');
				}
						
			$.ajax({
        type: 'POST',
        async: true,
        data: {
					kode_gejala:kode_gejala,
					nama_gejala:nama_gejala,
					bobot:bobot
					},
        dataType: 'text',
        url: '<?php echo base_url(); ?>gejala/simpan_gejala/',
        success: function(text) {
          if (text == '0') {
            $('#simpan_gejala').removeAttr('disabled', 'disabled');
            $('#overlay_form_input').fadeOut();
            alert('gagal');
						$('html, body').animate({
							scrollTop: $('#awal').offset().top
						}, 1000);
          } else if (text == 'doble') {
            $('#simpan_gejala').removeAttr('disabled', 'disabled');
            $('#overlay_form_input').fadeOut();
            alert('Data Sudah Ada');
						$('html, body').animate({
							scrollTop: $('#awal').offset().top
						}, 1000);
          } else {
						alertify.alert('Data berhasil disimpan');
						$('#tbl_lampiran_gejala').html('');
						$('#message_progress_upload_lampiran_gejala').html('');
            var halaman = 1;
            load_default(halaman);
            $('#div_form_input form').trigger('reset');
            $('#simpan_gejala').removeAttr('disabled', 'disabled');
            $('#overlay_form_input').fadeOut('slow');
          }
        }
      });
    });
  });
</script>
<script type="text/javascript">
$(document).ready(function() {
	$('#update_data_gejala').on('click', function(e) {
		e.preventDefault();
		$('#update_data_gejala').attr('disabled', 'disabled');
		$('#e_overlay_form_input').show();
		var id_gejala = $('#e_id_gejala').val();
		var kode_gejala = $('#e_kode_gejala').val();
		var nama_gejala = $('#e_nama_gejala').val();
		var bobot = $('#e_bobot').val();
						
		if (id_gejala == '') {
				$('#e_id_gejala').css('background-color', '#DFB5B4');
			} else {
				$('#e_id_gejala').removeAttr('style');
			}
		if (kode_gejala == '') {
				$('#e_kode_gejala').css('background-color', '#DFB5B4');
			} else {
				$('#e_kode_gejala').removeAttr('style');
			}
		if (nama_gejala == '') {
				$('#e_nama_gejala').css('background-color', '#DFB5B4');
			} else {
				$('#e_nama_gejala').removeAttr('style');
			}
				
			$.ajax({
			type: 'POST',
			async: true,
			data: {
					
					id_gejala:id_gejala,
					kode_gejala:kode_gejala,
					nama_gejala:nama_gejala,
					bobot:bobot
										
			},
			dataType: 'json',
			url: '<?php echo base_url(); ?>gejala/update_data_gejala/',
			success: function(json) {
				if (json.length == 0) {            
					alert('edit gagal');
					$('#update_data_gejala').removeAttr('disabled', 'disabled');
					$('#e_overlay_form_input').fadeOut('slow');
					} 
				else {
					alertify.alert('Edit Data Berhasil');
					var halaman = 1;
					load_default(halaman);
					$('#e_div_form_input form').trigger('reset');
					$('#update_data_gejala').removeAttr('disabled', 'disabled');
					$('#e_overlay_form_input').fadeOut('slow');
					$('#e_div_form_input').fadeOut('slow');
					$('#tbl_lampiran_gejala').html('');
					}
			}
		});
	});
});
</script>

<script>
  function load_default(halaman) {
    $('#overlay_data_default').show();
    $('#tbl_utama_gejala').html('');
    var paten = $('#paten').val();
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        paten: 'paten'
      },
      dataType: 'json',
      url: '<?php echo base_url(); ?>gejala/json_all_gejala/?halaman='+halaman+'/',
      success: function(json) {
        var tr = '';
        var start = ((halaman - 1) * <?php echo $per_page; ?>);
        for (var i = 0; i < json.length; i++) {
          var start = start + 1;
					tr += '<tr id_gejala="' + json[i].id_gejala + '" id="' + json[i].id_gejala + '" >';
					tr += '<td valign="top">' + (start) + '</td>';
					tr += '<td valign="top">' + json[i].kode_gejala + '</td>';
					tr += '<td valign="top">' + json[i].nama_gejala + '</td>';
					tr += '<td valign="top">' + json[i].bobot + '</td>';
					tr += '<td valign="top">';
					tr += '<a href="#tab_1" data-toggle="tab" class="update_id" ><i class="fa fa-pencil-square-o"></i></a> ';
					tr += '<a href="#tab_1" data-toggle="tab" id="del_ajax" ><i class="fa fa-cut"></i></a>';
					tr += '</td>';
          tr += '</tr>';
        }
        $('#tbl_utama_gejala').append(tr);
				$('#overlay_data_default').fadeOut('slow');
      }
    });
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('#tbl_utama_gejala, #tbl_search_gejala').on('click', '.update_id', function(e) {
		e.preventDefault();
		$('#e_overlay_form_input').show();
		var id = $(this).closest('tr').attr('id_gejala');
		$.ajax({
			dataType: 'json',
			url: '<?php echo base_url(); ?>gejala/gejala_get_by_id/?id='+id+'',
			success: function(json) {
				if (json.length == 0) {
					alert('Tidak ada data');
				} else {
					for (var i = 0; i < json.length; i++) {
					$('#e_id_gejala').val(json[i].id_gejala);
					$('#e_kode_gejala').val(json[i].kode_gejala);
					$('#e_nama_gejala').val(json[i].nama_gejala);
					$('#e_bobot').val(json[i].bobot);
					}
					$('#div_form_input').fadeOut('slow');
					$('#e_div_form_input').show();
					$('#e_overlay_form_input').fadeOut(2000);
					$('html, body').animate({
						scrollTop: $('#awal').offset().top
					}, 1000);
				}
			}
		});
	});
});
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('#pagination').on('click', '.update_id', function(e) {
		e.preventDefault();
		var id = $(this).closest('li').attr('page');
		var halaman = id;
		load_default(halaman);
	});
});
</script>

<script type="text/javascript">
$(document).ready(function() {
	var halaman = 1;
	load_default(halaman);
});
</script>

<script type="text/javascript">
  // When the document is ready
  $(document).ready(function() {
    $('#tanggal_lahir').datepicker({
      format: 'dd-mm-yyyy',
    }).on('changeDate', function(e) {
      $(this).datepicker('hide');
    });
  });
</script>
