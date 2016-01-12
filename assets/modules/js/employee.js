$(document).ready(function() {
    $('.select2').select2();

    //Date Pickers
    $('.tgl').datepicker({
        format: 'yyyy-mm-dd', 
        autoclose: true,
        todayHighlight: true
    });
    
    $('#periode').datepicker({
        format: 'M yyyy', 
        minViewMode: 1,
				autoclose: true,
				todayHighlight: true
    });

    //Time pickers
    $('.clockpicker ').clockpicker({
        autoclose: true
    });
    
    //Search Att
    $(".btn-search").click(function(){
			var start = $(".start_att").val();
			var end = $(".end_att").val();
			$("#content").html('<img src="assets/assets/img/loading.gif"> loading...');
			
			$.ajax({
			 type: "POST",
			 url: "attendance/list_attendance/0/"+start+"~"+end,
			 data: 'flag=hitung',
			 cache: false,
			 success: function(data) 
			 {
				$("#content").html(data);
			 }
			});
		});
		
		//Search Edit Att
    $(".btn-submit-emp").click(function(){
    	var act = $("#form_edit_emp").attr("action");
    	var dataz = $("#form_edit_emp").serialize();
			$("#content").html('<img src="assets/assets/img/loading.gif"> loading...');
			$.post(act, dataz,  function(response) {
				//$("#content").html(response);
		  	$("#content").load('employee/main');
		  });
		});
		
		//Back Att
		$(".btn-cancel-emp").click(function(){
			$("#content").html('<img src="assets/assets/img/loading.gif"> loading...').load('employee/main');
		});
		
		//Search Shift
    $(".btn-search-shift").click(function(){
			var period = $("#periode").val();
			$("#content").html('<img src="assets/assets/img/loading.gif"> loading...');
			
			$.ajax({
			 type: "POST",
			 url: "attendance/shift/0/"+period,
			 data: 'flag=hitung',
			 cache: false,
			 success: function(data) 
			 {
				$("#content").html(data);
			 }
			});
		});
		
		//Search Edit Shift
    $(".btn-submit-shift").click(function(){
    	var act = $("#form_edit_shift").attr("action");
    	var dataz = $("#form_edit_shift").serialize();
			$("#content").html('<img src="assets/assets/img/loading.gif"> loading...');
			$.post(act, dataz,  function(response) {
		  	$("#content").load('attendance/shift');
		  });
		});
		
    //Sync
    $(".btn-sync").click(function(){
			var tgl = $(".tgl_absen").val();
			$("#table_att").html('<img src="assets/assets/img/loading.gif"> loading...');
			$.ajax({
			 type: "POST",
			 url: "load/baca_absen_bulan/"+tgl,
			 data: 'flag=hitung',
			 cache: false,
			 success: function(data) 
			 {
				$("#table_att").load('attendance/list_attendance');
			 }
			});
		});
		
		//Search Ovt
    $(".btn-search-ovt").click(function(){
			var start = $(".start_att").val();
			var end = $(".end_att").val();
			$("#content").html('<img src="assets/assets/img/loading.gif"> loading...');
			
			$.ajax({
			 type: "POST",
			 url: "attendance/overtime/0/"+start+"~"+end,
			 data: 'flag=hitung',
			 cache: false,
			 success: function(data) 
			 {
				$("#content").html(data);
			 }
			});
		});
});

function loadEmp()
{
    $("#content").html('<img src="assets/assets/img/loading.gif"> loading...').load('employee/main');
}

function detailEmp(id)
{
	$("#content").html('<img src="assets/assets/img/loading.gif"> loading...').load('employee/detail/'+id);
}

function editAtt(id)
{
  $("#content").html('<img src="assets/assets/img/loading.gif"> loading...').load('attendance/edit/'+id);
}

function backAtt(start, end)
{
	$("#content").html('<img src="assets/assets/img/loading.gif"> loading...').load('attendance/list_attendance/0/'+start+'~'+end);
}

function editShift(id)
{
  $("#content").html('<img src="assets/assets/img/loading.gif"> loading...').load('attendance/shift_detail/'+id);
}

function backShift(periode)
{
	$("#content").html('<img src="assets/assets/img/loading.gif"> loading...').load('attendance/shift/0/'+periode);
}

$('.ot_inc').change(function(){
	var jam = $(this).val();
	var hr = $("#hariraya").is(':checked');
	if(jam > 0) {
		overtime = (jam * 2) - 0.5;
	} else overtime = 0;
	
	$("#acc_ot_incidental").attr("value", overtime);
});
















/*
var save_method; //for save method string
var table;

$(document).ready(function() {


    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "kehadiran/ajax_list/",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [], //last column
            "orderable": false, //set not orderable
        },
        ],

    });

    $('#table_wrapper .dataTables_length select').addClass("select2-wrapper span12");

});



function add_user()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add user'); // Set Title to Bootstrap modal title
}

function edit_user(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "users/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="first_name"]').val(data.first_name);
            $('[name="last_name"]').val(data.last_name);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit user'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "users/ajax_add";
    } else {
        url = "users/ajax_update";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function delete_user(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "users/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}
*/