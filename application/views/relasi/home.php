
<div class="col-md-6"  id="awal">
  <div class="box box-danger box-solid" id="div_form_input">
    <div class="box-header">
      <h3 class="box-title">FORMULIR INPUT</h3>
    </div>
    <div class="box-body">
      <form role="form" id="form_relasi" method="post" action="<?php echo base_url(); ?>attachment/upload/?table_name=relasi" enctype="multipart/form-data">
        <div class="box-body">
          <input id="id_relasi" name="id_relasi" type="hidden">
          <input id="temp" name="temp" type="hidden">
          <div class="form-group">
            <label for="id_diagnosa">Nama Diagnosa</label>
            <select id="id_diagnosa" name="id_diagnosa" class="form-control">
              <option value="">Pilih Diagnosa </option>
              <?php
              $where = array(
              'status' => 1
              );
              $this->db->where($where);
              $query_diagnosa = $this->db->get('diagnosa');
              foreach ($query_diagnosa->result() as $r1)
                {
                  echo '<option value="'.$r1->id_diagnosa.'">'.$r1->nama_diagnosa.'</option>';
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="id_gejala">Nama Gejala</label>
            <select id="id_gejala" name="id_gejala" class="form-control">
              <option value="">Pilih Gejala </option>
              <?php
              $where = array(
              'status' => 1
              );
              $this->db->where($where);
              $query_gejala = $this->db->get('gejala');
              foreach ($query_gejala->result() as $r1)
                {
                  echo '<option value="'.$r1->id_gejala.'">'.$r1->nama_gejala.'</option>';
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input class="form-control" id="keterangan" name="keterangan" value="" placeholder="Keterangan" type="text">
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary" id="simpan_relasi">SIMPAN</button>
        </div>
      </form>
    </div>
    <div class="overlay" id="overlay_form_input" style="display:none;">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
  </div>
</div>
<div class="col-md-6">
  <div class="box box-danger box-solid">
    <div class="box-header">
      <h3 class="box-title">DATA</h3>
    </div>
    <div class="box-body">
      <table class="table table-bordered">
        <tr>
          <th>NO</th>
          <th>Pesyaratan</th>
          <th>Keterangan</th>
          <th>PROSES</th> 
        </tr>
        <tbody id="tbl_utama_relasi">
        </tbody>
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
  </div>
</div>

<script>
  function load_default(id_diagnosa) {
    $('#overlay_data_default').show();
    $('#tbl_utama_relasi').html('');
    $.ajax({
      type: 'POST',
      async: true,
      data: {
        id_diagnosa:id_diagnosa
      },
      dataType: 'json',
      url: '<?php echo base_url(); ?>relasi/json_all_relasi/?halaman=1/',
      success: function(json) {
        var tr = '';
        var start = 0;
        for (var i = 0; i < json.length; i++) {
          var start = start + 1;
					tr += '<tr id_relasi="' + json[i].id_relasi + '" id="' + json[i].id_relasi + '" >';
					tr += '<td valign="top">' + (start) + '</td>';
					tr += '<td valign="top">' + json[i].nama_gejala + '</td>';
					tr += '<td valign="top">' + json[i].keterangan + '</td>';
					tr += '<td valign="top">';
					tr += '<a href="#tab_1" data-toggle="tab" id="del_ajax" ><i class="fa fa-cut"></i></a>';
					tr += '</td>';
          tr += '</tr>';
        }
        $('#tbl_utama_relasi').append(tr);
				$('#overlay_data_default').fadeOut('slow');
      }
    });
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
	var id_diagnosa = 0;
	load_default(id_diagnosa);
});
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#id_diagnosa').on('change', function(e) {
        e.preventDefault();
        var id_diagnosa = $('#id_diagnosa').val();
        load_default(id_diagnosa);
      });
  });
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('#tbl_utama_relasi, #tbl_search_relasi').on('click', '.update_id', function(e) {
		e.preventDefault();
		$('#e_overlay_form_input').show();
		var id = $(this).closest('tr').attr('id_relasi');
		$.ajax({
			dataType: 'json',
			url: '<?php echo base_url(); ?>relasi/relasi_get_by_id/?id='+id+'',
			success: function(json) {
				if (json.length == 0) {
					alert('Tidak ada data');
				} else {
					for (var i = 0; i < json.length; i++) {
					$('#e_id_relasi').val(json[i].id_relasi);
					$('#e_id_gejala').val(json[i].id_gejala);
					$('#e_keterangan').val(json[i].keterangan);
					}
					e_load_lampiran_relasi(id);
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
    $('#simpan_relasi').on('click', function(e) {
      e.preventDefault();
      $('#simpan_relasi').attr('disabled', 'disabled');
      $('#overlay_form_input').show();
			
			var id_gejala = $("#id_gejala").val();
			var id_diagnosa = $("#id_diagnosa").val();
			var keterangan = $("#keterangan").val();
						
			if (id_gejala == '') {
					$('#id_gejala').css('background-color', '#DFB5B4');
				} else {
					$('#id_gejala').removeAttr('style');
				}
						
			$.ajax({
        type: 'POST',
        async: true,
        data: {
					id_gejala:id_gejala,
					id_diagnosa:id_diagnosa,
					keterangan:keterangan
					},
        dataType: 'text',
        url: '<?php echo base_url(); ?>relasi/simpan_relasi/',
        success: function(text) {
          if (text == '0') {
            $('#simpan_relasi').removeAttr('disabled', 'disabled');
            $('#overlay_form_input').fadeOut();
            alert('gagal');
						$('html, body').animate({
							scrollTop: $('#awal').offset().top
						}, 1000);
          } else if (text == 'doble') {
            $('#simpan_relasi').removeAttr('disabled', 'disabled');
            alert('Data Sudah Ada');
            $('#overlay_form_input').fadeOut('slow');
						$('html, body').animate({
							scrollTop: $('#awal').offset().top
						}, 1000);
          } else {
						alertify.alert('Data berhasil disimpan');
						$('#tbl_lampiran_relasi').html('');
						$('#message_progress_upload_lampiran_relasi').html('');
            
            load_default(id_diagnosa);
            var aaa = Math.random();
            $('#temp').val(aaa);
            $('#simpan_relasi').removeAttr('disabled', 'disabled');
            $('#overlay_form_input').fadeOut('slow');
          }
        }
      });
    });
  });
</script>


<script>
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
//===============HAPUS OBAT
$('#tbl_search_relasi, #tbl_utama_relasi').on('click', '#del_ajax', function() {
	reset();
	var id = $(this).closest('tr').attr('id_relasi');
	alertify.confirm('Anda yakin data akan dihapus?', function(e) {
		if (e) {
			$.ajax({
				dataType: 'json',
				url: '<?php echo base_url(); ?>relasi/hapus_relasi/?id='+id+'',
				success: function(response) {
					if (response.errors == 'Yes') {
						alertify.alert('Maaf data tidak bisa dihapus, Anda tidak berhak melakukannya');
					} else {
						$('[id_relasi='+id+']').remove();
						alertify.alert('Data berhasil dihapus');
					}
				}
			});
		} else {
			alertify.alert('Hapus data dibatalkan');
		}
	});
});

</script>