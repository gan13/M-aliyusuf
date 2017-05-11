<style>
#div_data_cari { overflow:hidden;height:whatever px; }
#div_data_cari:hover { overflow-x:scroll; }
</style>

<div class="col-md-6">
    <div class="box" id="list_data">
      <div class="box-header">
        <h3 class="box-title">Konsultasi</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding" id="div_data_cari">
        <table class="table table-hover">
          <tbody>
            <tr>
              <th>No</th>
              <th>Klik</th>
              <th>Nama Gejala</th>
            </tr>
          </tbody>
          <tbody id="tbl_utama_gejala"></tbody>
        </table>
        <div class="box-footer clearfix">
					<button type="submit" class="btn btn-info pull-right" id="#">Check</button>
        </div>
      </div>
      <div class="overlay" id="overlay_data_default" style="display:none;">
        <i class="fa fa-refresh fa-spin"></i>
      </div>
    </div>
</div>
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
      url: '<?php echo base_url(); ?>konsultasi/json_all_gejala/?halaman='+halaman+'/',
      success: function(json) {
        var tr = '';
        var start = (halaman - 1);
        for (var i = 0; i < json.length; i++) {
          var start = start + 1;
					tr += '<tr id_gejala="' + json[i].id_gejala + '" id="' + json[i].id_gejala + '" >';
					tr += '<td valign="top">' + (start) + '</td>';
					tr += '<td valign="top"><input type="checkbox"></td>';
					tr += '<td valign="top">' + json[i].nama_gejala + '</td>';
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
	var halaman = 1;
	load_default(halaman);
});
</script>


