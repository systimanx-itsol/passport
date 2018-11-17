jQuery(document).ready(function(){
	jQuery.ajax({
		url: app_url+'/admin/categories/treeview',
		cache: false,
		success: function(response){
			$('#treeview').treeview({data: response, levels: 1});
		}
	});	
});