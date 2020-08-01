<div class="container">
	<h3>Guest List</h3>
	<div class="alert alert-success" style="display: none;"></div>
	<div class="search-container">
		<input id="inputannya" type="text" placeholder="Search..">
	</div><br>
	<button id="btnAdd" class="btn btn-success">Add New</button>
	<table class="table table-bordered table-responsive" style="margin-top: 20px;">
		<thead>
			<tr>
				<td>No</td>
				<td>ID</td>
				<td>Name</td>
				<td>Address</td>
				<td>Contact Phone</td>
				<td>Action</td>
			</tr>
		</thead>
		<tbody id="showdata">
			
		</tbody>
	</table>
</div>

<div id="myModal" class="modal fade"  tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        	<form id="myForm" action="" method="post" class="form-horizontal">
        		<input type="hidden" name="id" value="0">
        		<div class="form-group">
        			<label for="nama" class="label-control col-md-4">Nama</label>
        			<div class="col-md-8">
        				<input type="text" name="nama" class="form-control">
        			</div>
        		</div>
        		<div class="form-group">
        			<label for="alamat" class="label-control col-md-4">Alamat</label>
        			<div class="col-md-8">
        				<textarea class="form-control" name="alamat"></textarea>
        			</div>
        		</div>
        		<div class="form-group">
        			<label for="no_hp" class="label-control col-md-4">Contact Phone</label>
        			<div class="col-md-8">
        				<input type="text" name="no_hp" maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" class="form-control">
        			</div>
        		</div>
        	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="location.reload();" data-dismiss="modal">Close</button>
        <button type="button" id="btnSave" class="btn btn-primary">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirm Delete</h4>
      </div>
      <div class="modal-body">
        	Do you want to delete this record?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnDelete" class="btn btn-danger">Delete</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	$(function(){
		showAllGuest();

		//Add New
		$('#btnAdd').click(function(){
			$('#myModal').modal('show');
			$('#myModal').find('.modal-title').text('Add New Guest');
			$('#myForm').attr('action', '<?php echo base_url() ?>guest/addGuest');
		});


		$('#btnSave').click(function(){
			var url = $('#myForm').attr('action');
			var data = $('#myForm').serialize();
			//validate form
			var nama = $('input[name=nama]');
			var alamat = $('textarea[name=alamat]');
			var no_hp = $('input[name=no_hp]');
			var result = '';
			if(nama.val()==''){
				alert('namanya isi dong!');
				nama.parent().parent().addClass('has-error');
			}else{
				nama.parent().parent().removeClass('has-error');
				result +='1';
			}
			if(alamat.val()==''){
				alert('alamatnya isi dong!');
				alamat.parent().parent().addClass('has-error');
			}else{
				alamat.parent().parent().removeClass('has-error');
				result +='2';
			}
			if(no_hp.val()==''){
				alert('no. HP nya isi dong!');
				no_hp.parent().parent().addClass('has-error');
			}else{
				no_hp.parent().parent().removeClass('has-error');
				result +='3';
			}
			/*console.log(result);
			return false;*/

			if(result=='123'){
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: url,
					data: data,
					async: false,
					dataType: 'json',
					success: function(response){
						if(response.success){
							$('#myModal').modal('hide');
							$('#myForm')[0].reset();
							if(response.type=='add'){
								var type = 'added'
							}else if(response.type=='update'){
								var type ="updated"
							}
							$('.alert-success').html('Guest '+type+' successfully').fadeIn().delay(4000).fadeOut('slow');
							showAllGuest();
						}else{
							alert('Error');
						}
					},
					error: function(){
						alert('Could not add data');
					}
				});
			}
		});

		//edit
		$('#showdata').on('click', '.item-edit', function(){
			var id = $(this).attr('data');
			$('#myModal').modal('show');
			$('#myModal').find('.modal-title').text('Edit Guest');
			$('#myForm').attr('action', '<?php echo base_url() ?>guest/updateGuest');
			$.ajax({
				type: 'ajax',
				method: 'get',
				url: '<?php echo base_url() ?>guest/editGuest',
				data: {id: id},
				async: false,
				dataType: 'json',
				success: function(data){
					$('input[name=nama]').val(data.nama);
					$('textarea[name=alamat]').val(data.alamat);
					$('input[name=no_hp]').val(data.no_hp);
					$('input[name=id]').val(data.id);
				},
				error: function(){
					alert('Could not Edit Data');
				}
			});
		});

		//delete- 
		$('#showdata').on('click', '.item-delete', function(){
			var id = $(this).attr('data');
			$('#deleteModal').modal('show');
			//prevent previous handler - unbind()
			$('#btnDelete').unbind().click(function(){
				$.ajax({
					type: 'ajax',
					method: 'get',
					async: false,
					url: '<?php echo base_url() ?>guest/deleteGuest',
					data:{id:id},
					dataType: 'json',
					success: function(response){
						if(response.success){
							$('#deleteModal').modal('hide');
							$('.alert-danger').html('Guest Deleted successfully').fadeIn().delay(4000).fadeOut('slow');
							showAllGuest();
						}else{
							alert('Error');
						}
					},
					error: function(){
						alert('Error deleting');
					}
				});
			});
		});


		//function
		function showAllGuest(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url() ?>guest/showAllGuest',
				async: false,
				dataType: 'json',
				success: function(data){
					var html = '';
					var no = 1;
					var i;
					for(i=0; i<data.length; i++){
						html +='<tr>'+
									'<td>'+ no++ +'</td>'+
									'<td>'+data[i].id+'</td>'+
									'<td>'+data[i].nama+'</td>'+
									'<td>'+data[i].alamat+'</td>'+
									'<td>'+data[i].no_hp+'</td>'+
									'<td>'+
										'<a href="javascript:;" class="btn btn-info item-edit" data="'+data[i].id+'">Edit</a>'+
										'<a href="javascript:;" class="btn btn-danger item-delete" data="'+data[i].id+'">Delete</a>'+
									'</td>'+
							    '</tr>';
					}
					$('#showdata').html(html);
				},
				error: function(){
					alert('Could not get Data from Database');
				}
			});
		}
	});

$(document).ready(function(){
  $("#inputannya").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#showdata tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>