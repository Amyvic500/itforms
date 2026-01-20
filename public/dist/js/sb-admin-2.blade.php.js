/*!
 * Start Bootstrap - SB Admin 2 v3.3.7+1 (http://startbootstrap.com/template-overviews/sb-admin-2)
 * Copyright 2013-2016 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap/blob/gh-pages/LICENSE)
 */
$(function() {
    $('#side-menu').metisMenu();
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size

$(document).ready(function(){
radioval = "";	
name = "";
action = "";
names=[];
var regex = /https?:\/\/[\-A-Za-z0-9+&@#\/%?=~_|$!:,.;]*/g; 
$("#table1").hide();
actions=[];
	 console.log("started");
	 addAuthor = $(".authorClass"); //.hide();
	 addAuthor.prop('checked', false);
	 addAuthor.hide();
	 
$("body").on('change',"#company", function(){
		var compval = $(this).val();
		var locs = $("#location");
		var depart = $("#department");
		if(compval==='EIL'){
			locs.empty();
			var list = ['','ASH-BA', 'DUNKIRK', 'EASTERN-VOLTA', 'GREATER ACCRA', 'HEAD OFFICE', 'KLAGON', 'NORTH', 'WEST-CENTRAL'];
			list.forEach(function(city){
				Opt = new Option(city, city);
				locs.append(Opt);
				//console.log(city);
			});
			deptlist = ['','AUDIT', 'FINANCE', 'GM-HQ', 'HR', 'LOGISTICS', 'SALES'];
			depart.empty();
			deptlist.forEach(function(dept){
				Opts = new Option(dept, dept);
				depart.append(Opts);
				
			});
		}
		else{
			locs.empty();
			var list = ['','APAPA', 'FACTORY', 'HEAD OFFICE'];
			list.forEach(function(city){
				Opt = new Option(city, city);
				locs.append(Opt);
				console.log(city);
			});
			deptlist = ['', 'AUDIT', 'FINANCE', 'HR', 'GA', 'IMPORTATION', 'I.T', 'MARKETING', 'PRODUCTION', 'PURCHASING', 'SALES', 'FINISH GOODS', 'HSE', 'ENGINEERING', 'RAW MATERIAL',];
			depart.empty();
			deptlist.forEach(function(dept){
				Opts = new Option(dept, dept);
				depart.append(Opts);
				
			});			
		}
});	 
$("select[name='req']").change(function(){
		console.log($(this).val())
		if(($("#status").val()=='NEW USER') && ($(this).val()=="Replace existing User")){
			$("#existed").show();
			
			addAuthor.hide();
		}
		else if(($("#status").val()=='UPDATE USER') && ($(this).val()=="Additional Authorization")){
			addAuthor.prop('checked', false);
			addAuthor.show();
		}
		else if(($("#status").val()=='UPDATE USER') && ($(this).val()=="Additional Access")){
			addAuthor.prop('checked', false);
			addAuthor.show();
		}		
		else{
		addAuthor.hide();
		$("#existed").hide();
		}	
		
	 });
$("body").on("click", '#clearSel', function(){
		 apps = ["sir","email","net", "rem","eleave", "sap", "ingress", "spark"];
		 actions = ["delete", "reset", "existing"];
		 actions.forEach(function(i){ 
		 //console.log(i); 
			apps.forEach(function(g){
				$("#"+g+i).val("")
				$("#"+g+i).removeAttr('required');
				$("#"+g+i).hide();
			//	console.log($("#"+g+i));
			//$("#"+g).hide();
			$("#"+g).prop('checked', false);
			});
			addAuthor.prop('checked', false);
			addAuthor.hide();
		 }); 
		 $("input[type='radio']").prop('checked', 'false');
		 $('.submt').prop("disabled", false);
		$(".internet").prop('class', 'internet h5');
		$(".internet").hide();
	 });
	 
$("body").on("click", '#expData', function(){
		//$("#table1").show();
		$.ajax({
					type: 'GET',
					url: "/getrepdata",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"name":$("input[name='name']").val(),
					"tDate":$("input[name='tDate']").val(),
					"fDate":$("input[name='fDate']").val(),
					"company": $("select[name='company']").val(),
					"dept":$("select[name='dept']").val(),
					"status": $("select[name='status']").val(),
					"category":$("select[name='category']").val(),
					"order":$("select[name='order']").val(),
					"application":$("select[name='application']").val(),
					"origin":"export"
					},  
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
					console.log("error on submit"+xhr);
					},
					success: function( data ){ 
			
					}
					
				});			
		 });
	
$("body").on("click", '#repData', function(){
		$("#table1").show();
		$.ajax({
					type: 'GET',
					url: "/getrepdata",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"name":$("input[name='name']").val(),
					"fDate":$("input[name='fDate']").val(),
					"tDate":$("input[name='tDate']").val(),
					"order": $("select[name='order']").val(),
					"company": $("select[name='company']").val(),
					"dept":$("select[name='dept']").val(),
					"status": $("select[name='status']").val(),
					"category":$("select[name='category']").val(),
					"application":$("select[name='application']").val(),
					"origin":"report"
					},  
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
					console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					//console.log("success" + data[0].email);
					//$("#hodemail").val(data.email);
					$("#tbody").empty();
					$.each(data, function(i, list){
					str="";
					stats="";
					apps = ['sir','email','net','hrms','sap','remote','ingress','spark', 'eLeave'];
					apps.forEach(function(elem){
						if(list[elem]!=null){
							if(list[elem+'text']!=null){
							str+='<b>'+elem.toUpperCase()+"</b>:"+list[elem]+' - '+list[elem+'text']+'<br>';
							}else{
							str+='<b>'+elem.toUpperCase()+"</b>:"+list[elem]+'<br>';	
							}
						}
					});
					if(list.apprStatus==8){
					stats = "<b class='text-danger'>DISMISSED BY HOD</b>";	
					}
					else if(list.apprStatus==10){
						stats="<b class='text-primary'>APPROVED BY HOD</b>";						
					}
					else if(list.apprStatus==28){
						stats="<b class='text-danger'>DISMISSED BY IT-HOD</b>";
					}
					else if(list.apprStatus==30){
						stats="<b class='text-primary'>APPRROVED BY IT-HOD</b>";
					}
					else if(list.apprStatus==40){
						stats="<b class='text-success'>COMPLETED</b>"
					}
					else{
						stats= "<b class='text-warning'>AWAITING HOD APPROVAL</b>";						
					}
					$("#tbody").append("<tr><td>"+(i+1)+"</td><td>"+list.id+"</td><td>"+list.eApp3+"</td><td>"+list.created_at+"</td><td>"+list.fName+' '+list.lName+"</td><td>"+list.status+"</td><td>"+ str +"</td><td>"+list.comp+"</td><td>"+list.dept+"</td><td>"+list.eApp1+"</td><td>"+stats+"</td></tr>");
					});
					$("#hodemail").val(hod);
					}
					
				});			
		 });
$("#notes").on('input', function(){
	var textArea = $(this).val().match(regex); // search string
	 netValue = $("input[name='net']:checked").val();
	if(netValue=='New ID'){
		//console.log(netValue);
	if(textArea && textArea.length > 0){
		$('.submt').prop("disabled", false);
		$(".internet").prop('class', 'internet h5');	
	}else{		
		$(".internet").prop('class', 'internet h5 text-danger');	
		$('.submt').prop("disabled", true);
	}
					}
					else{
						$('.submt').prop("disabled", false);
						$(".internet").prop('class', 'internet h5');
						$(".internet").hide();
						
					}
	});
	
$("body").on("click", '.net', function(){
		//console.log($(this).val());
		net = $(this).val();
		if(net=='New ID'){
			$(".internet").show();			
		}
		else{
			$(".internet").hide();
			$('.submt').prop("disabled", false);
			$(".internet").prop('class', 'internet h5');
		}
	});
	 
$("body").on("mouseover focusout click change", '#status,#purpose,#hodemail', function(){
		 var dept = $("select[name='dept']").val();
		 var company = $("select[name='company']").val();
		 var locatn = $("select[name='location']").val();
		 var hod ='';
		 if(dept!="" && company!=""){
			//console.log(dept +' '+company); 
		$.ajax({
					type: 'GET',
					url: "/getapprover",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"comp": company,
					"dept": dept,
					"location": locatn,
					},  
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
					console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					//console.log("success" + data[0].email);
					//$("#hodemail").val(data.email);
					$.each(data, function(i, list){
					hod += list.email+';';
					});
					$("#hodemail").val(hod);
					}
					
				});			
		 }
	 });
$("select[name='status']").change(function(){
		if($(this).val()!='NEW USER'){
		$("#existed").hide();	
		
		}
		if($(this).val()=='REPORT'){
		console.log("Report selected " + $(this).val())
		$(".reports").show();	
		$(".userinput").hide();
		$(".userreport").show();
		$(".appreport").hide();	
		}	
		else if($(this).val()=='APPLICATION'){
			console.log(" Application selected "+ $(this).val())
		$(".appreport").show();	
		$(".reports").hide();
		$(".userreport").hide();
		$(".userinput").hide();		
		//$(".userinput").hide();
	//	$(".userreport").show();
		}		
		else{
		$(".appreport").hide();	
		$(".userinput").show();	
		$(".reports").hide();
		$(".userreport").hide();
		}
		current = $("select[name='req']");
		current.empty();
		if($(this).val()=="NEW USER"){
		current.append(new Option("",""))	
		current.append(new Option("Create new User","Create new User"))			
		current.append(new Option("Replace existing User","Replace existing User"))	
		current.append(new Option("Additional User","Additional User"))		
		}
		else if($(this).val()=="UPDATE USER"){
			current.append(new Option("",""))
		current.append(new Option("Additional Access","Additional Access"))	
		current.append(new Option("Reset Password","Reset Password"))
		current.append(new Option("Update System", "Update System"))
		current.append(new Option("Additional Authorization", "Additional Authorization"))
		}
		else if($(this).val()=="APPLICATION"){
			current.append(new Option("",""))
		current.append(new Option("Request New Application","Request New Application"))	
		current.append(new Option("Modify Existing Application","Modify Existing Application"))		
		}		
		else{
			current.append(new Option("",""))
		current.append(new Option("Create Report","Create Report"))	
		current.append(new Option("Modify Report","Modify Report"))		
		}
		
	}); 
$(function () {
 $('[data-toggle="tooltip"]').tooltip()
})
//loadDept();	 
$("#approve").click(function(){
	if( $('#urlAdd').val()==''){
		
		BootstrapDialog.alert({
            title: 'IT REQUEST',
            message: '<i class="text-center h4"> Please specify internet URL before submit.</i>',
            type: BootstrapDialog.TYPE_DANGER, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
            closable: true, // <-- Default value is false
            draggable: true, // <-- Default value is false
            btnOKLabel: 'CLOSE', // <-- Default value is 'OK',
           //btnOKClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
            callback: function(result) {
                // result will be true if button was click, while it will be false if users close the dialog directly.
                if(result) {
				//window.location = "/";
                }else {
                  
                }
            }
        });
	}
	else{
			$.ajax({
					type: 'GET',
					url: "/approve",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": $("#formid").val(),
					"ky": $("#keyid").val(),
					"cmd":"approve",
					"rem":$("#rem").val(),
					"sites":$("#urlAdd").val(),
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
					console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					console.log("success" + data.message.length)
					var check = data.message.length;
					if(check>50){

			BootstrapDialog.alert({
            title: 'IT REQUEST',
            message: data.message,
            type: BootstrapDialog.TYPE_DANGER, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
            closable: true, // <-- Default value is false
            draggable: true, // <-- Default value is false
            btnOKLabel: 'CLOSE', // <-- Default value is 'OK',
           //btnOKClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
            callback: function(result) {
                // result will be true if button was click, while it will be false if users close the dialog directly.
					if(result) {
					window.location = "/";
					}else {
                  
					}
				}
			});	
					
					
					}//   check if data message
					else{
					
			BootstrapDialog.alert({
            title: 'IT REQUEST',
            message: 'You have successfully Approved this request. Thank You',
            type: BootstrapDialog.TYPE_SUCCESS, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
            closable: true, // <-- Default value is false
            draggable: true, // <-- Default value is false
            btnOKLabel: 'CLOSE', // <-- Default value is 'OK',
           //btnOKClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
            callback: function(result) {
                // result will be true if button was click, while it will be false if users close the dialog directly.
					if(result) {
					window.location = "/";
					}else {
                  
					}
				}
			});				
					
					
					}
					}
				});
				
	}

});
$("#cancel").click(function(){
$("#remarks").show();
$("#neturl").hide();
if($("#rem").val()==""){
console.log("Empty");

		BootstrapDialog.alert({
            title: 'IT REQUEST',
            message: 'Please enter a remark to support request dismissal.',
            type: BootstrapDialog.TYPE_DANGER, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
            closable: true, // <-- Default value is false
            draggable: true, // <-- Default value is false
            btnOKLabel: 'CLOSE', // <-- Default value is 'OK',
           //btnOKClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
            callback: function(result) {
                // result will be true if button was click, while it will be false if users close the dialog directly.

            }
        });	

	
}
else{
console.log("Happy");	
		$.ajax({
					type: 'GET',
					url: "/approve",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": $("#formid").val(),
					"cmd":"cancel",
					"rem":$("#rem").val(),
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
					console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					console.log("success" + data)
					
BootstrapDialog.alert({
            title: 'IT REQUEST',
            message: 'You have successfully updated the request. Thank You',
            type: BootstrapDialog.TYPE_DANGER, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
            closable: true, // <-- Default value is false
            draggable: true, // <-- Default value is false
            btnOKLabel: 'CLOSE', // <-- Default value is 'OK',
           //btnOKClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
            callback: function(result) {
                // result will be true if button was click, while it will be false if users close the dialog directly.
                if(result) {
				window.location = "/";
                }else {
                  
                }
            }
        });

					}
				});
}
});
//$("body").on("submit","#reqstore",function(){ console.log('submitting');});
/*
$( "#reqstore" ).submit(function( event ) {
  event.preventDefault();
});*/
/*
$("body").on("mouseover click",".submt",function(){ 

$( "#reqstore" ).submit(function( event ) {
  event.preventDefault();
});
console.log('submit hover or clicked');

});

*/

$("body").on("change", "input[type='radio']", function(){
	name= $(this).attr('name');
	action=$(this).val().split(' ')[0].toLowerCase();		
	radioval = $(this).next();	
	
		if(($(this).val().split(" ")[0]=='Delete')){
			
			$("#"+name+action).attr('required', 'true');
			$("#"+name+action).attr('placeholder', 'Enter ID to Delete');
			$("#"+name+action).show();			
			$("#"+name+'reset').removeAttr('required');
			$("#"+name+'reset').hide();
			
		}
		else if(($(this).val().split(" ")[0]=='Reset')){
		
			$("#"+name+action).attr('required', 'true');
			$("#"+name+action).attr('placeholder', 'Enter ID to Reset');
			$("#"+name+action).show();			
			$("#"+name+'delete').removeAttr('required');
			$("#"+name+'delete').hide();
			$("#"+name+'existing').removeAttr('required');
			$("#"+name+'existing').hide();			
		
		}
		else if(($(this).val().split(" ")[0]=='Existing')){
		
			$("#"+name+action).attr('required', 'true');
			$("#"+name+action).attr('placeholder', 'Enter Existing ID');
			$("#"+name+action).show();			
			$("#"+name+'delete').removeAttr('required');
			$("#"+name+'delete').hide();
			$("#"+name+'reset').removeAttr('required');
			$("#"+name+'reset').hide();
		
		}		
		else{
			$("#"+name+'existing').removeAttr('required');
			$("#"+name+'existing').hide();
			$("#"+name+'delete').removeAttr('required');
			$("#"+name+'delete').hide();
			$("#"+name+'reset').removeAttr('required');
			$("#"+name+'reset').hide();			
		}
});
/*
$("body").on("change", "input[type='radio']", function(){
	name= $(this).attr('name');
	action=$(this).val().split(' ')[0];		
	radioval = $(this).next();	
	if(($(this).val().split(" ")[0]=='Delete')||($(this).val().split(" ")[0]=='Change')){

	if(names.includes(name)){
		names.pop(name);	
		$("input[name='"+name+"text']").remove();
	    
		radioval.append("<input type='text' placeholder='"+'Enter ID to '+action+"' name='"+name+"text' class='form-control' required>");	
		names.push(name);		
	}
	else{
		names.pop(name);	
		$("input[name='"+name+"text']").remove();
	    names.push(name);
		radioval.append("<input type='text' placeholder='"+'Enter ID to '+action+"' name='"+name+"text' class='form-control' required>");
	}
	
	}else{
	if(names.includes(name)){
		names.pop(name);	
		$("input[name='"+name+"text']").remove();
	}	
		
	}
});	*/
/*
$("body").on("change",".sir, .email, .net, .rem, .hrms, .sap, .ingress, .spark",function(){
if(($(this).val().split(" ")[0]=='Delete')||($(this).val().split(" ")[0]=='Change')){
$("input[name='"+name+"text']").remove();
name= $(this).attr('name');
action=$(this).val().split(' ')[0];
console.log($(this).next())
radioval = $(this).next();
radioval.append("<input type='text' placeholder='"+'Enter ID to '+action+"' name='"+name+"text' class='form-control' required>");
}else{
$("input[name='"+name+"text']").remove();		
}
});
*/
/*
$("input[type='radio']").change(function(){
	if(($(this).val().split(" ")[0]=='Delete')||($(this).val().split(" ")[0]=='Change')){
	$("<input type='text' placeholder='"+'Enter ID to '+action+"' name='"+name+action+"' class='form-control' required>").appendTo($(this))
	return false;
	console.log($(this))
	$(this).find("span").after("<b>Yes it worked</b>");
	}
	
}); */
$("#happrove").click(function(){
	if( $('#urlAdd').val()==''){
		
		BootstrapDialog.alert({
            title: 'IT REQUEST',
            message: 'Please specify internet URL before submit.',
            type: BootstrapDialog.TYPE_DANGER, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
            closable: true, // <-- Default value is false
            draggable: true, // <-- Default value is false
            btnOKLabel: 'CLOSE', // <-- Default value is 'OK',
           //btnOKClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
            callback: function(result) {
                // result will be true if button was click, while it will be false if users close the dialog directly.
                if(result) {
				//window.location = "/";
                }else {
                  
                }
            }
        });
	}
	else{
			$.ajax({
					type: 'GET',
					url: "/happrove",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": $("#formid").val(),
					"cmd":"approve",
					"rem":$("#rem").val(),
					"sites":$("#urlAdd").val(),
					"email":$("#email").val(),
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
					console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					console.log("success" + data.message.length)
					var check = data.message.length;
					if(check>50){

			BootstrapDialog.alert({
            title: 'IT REQUEST',
            message: data.message,
            type: BootstrapDialog.TYPE_DANGER, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
            closable: true, // <-- Default value is false
            draggable: true, // <-- Default value is false
            btnOKLabel: 'CLOSE', // <-- Default value is 'OK',
           //btnOKClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
            callback: function(result) {
                // result will be true if button was click, while it will be false if users close the dialog directly.
					if(result) {
					window.location = "/";
					}else {
                  
					}
				}
			});	
					
					
					}//   check if data message
					else{
					
			BootstrapDialog.alert({
            title: 'IT REQUEST',
            message: 'You have successfully Approved this request. Thank You',
            type: BootstrapDialog.TYPE_SUCCESS, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
            closable: true, // <-- Default value is false
            draggable: true, // <-- Default value is false
            btnOKLabel: 'CLOSE', // <-- Default value is 'OK',
           //btnOKClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
            callback: function(result) {
                // result will be true if button was click, while it will be false if users close the dialog directly.
					if(result) {
					window.location = "/";
					}else {
                  
					}
				}
			});				
					
					
					}
					}
				});
				
	}

});
$("#hcancel").click(function(){
$(".remarks").show();
if($("#rem").val()==""){
console.log("Empty");

		BootstrapDialog.alert({
            title: 'IT REQUEST',
            message: 'Please enter a remark to support request dismissal.',
            type: BootstrapDialog.TYPE_DANGER, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
            closable: true, // <-- Default value is false
            draggable: true, // <-- Default value is false
            btnOKLabel: 'CLOSE', // <-- Default value is 'OK',
           //btnOKClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
            callback: function(result) {
                // result will be true if button was click, while it will be false if users close the dialog directly.

            }
        });	

	
}
else{
console.log("Happy");	
		$.ajax({
					type: 'GET',
					url: "/happrove",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": $("#formid").val(),
					"cmd":"cancel",
					"rem":$("#rem").val(),
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
					console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					console.log("success" + data)
					
BootstrapDialog.alert({
            title: 'IT REQUEST',
            message: 'You have successfully updated the request. Thank You',
            type: BootstrapDialog.TYPE_PRIMARY, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
            closable: true, // <-- Default value is false
            draggable: true, // <-- Default value is false
            btnOKLabel: 'CLOSE', // <-- Default value is 'OK',
           //btnOKClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
            callback: function(result) {
                // result will be true if button was click, while it will be false if users close the dialog directly.
                if(result) {
				window.location = "/";
                }else {
                  
                }
            }
        });

					}
				});
}

});
function zeroPad(num, places) {
  var zero = places - num.toString().length + 1;
  return Array(+(zero > 0 && zero)).join("0") + num;
}
		 var $item_count=0;
		     isEmpty = function(obj) {
      if (obj == null) return true;
      if (obj.constructor.name == "Array" || obj.constructor.name == "String") return obj.length === 0;
      for (var key in obj) if (isEmpty(obj[key])) return true;
      return false;
    }
	var $userid= $("#userid").val();
	var $username = $("#username").val();
	var $location = $("#userlocation").val();
	var $company =  $("#usercompany").val();
	var $userpriv =  $("#userpriv").val();	
	var $lc = $company+" "+$location;
	//console.log("Username " + $username + "  User id: "+ $userid + " company "+ $company +" location: "+ $location);
	var $item_stat = "";
	var $item_err = 0;
	var $doc_id;
	var $ins;
	var $doc;
	var $data;
	var $loc, $wType, $excel;
	var effect = ["flash", "pulse", "rubberBand" , "bounce", "shake", "swing", "wobble", "jello"]; 
	var randonIndex;
	var rec_qty = [];
      var i=1;
	  var comp = ["GSNL", "NPRNL", "ESRNL"];
$("input[type='checkbox']").change(function() {
    if(this.checked) {
       $("#proxyName").show();
	   console.log("checked");
    }else{
		$("#proxyName").hide();
		console.log("unchecked");
	}
});
$("#dept").change(function(){
	console.log($("#dept").val())
});
/*$("#company").change(function(){
	loadDept();
});*/
$("#sentTosel").change(function(){
	
		 $sentTo = $("#sentTosel").val();
		 //$lc = $company+" "+$location;
	 console.log(" $lc "+ $lc + " sent To "+$sentTo);
		 if($sentTo == $lc){
		//	 console.log("same company and location detected");
			 $("#errmsglist").text("choose another location");
			$("#errmsg").prop('hidden', false);
		}else{
			$("#errmsglist").text("");
			$("#errmsg").hide();
		// console.log(" Selected "); 
		 $("#errmsg").hide();
			var $word = $sentTo.split(" ");
			var $company = $word[0];
			var $location = $word[1];
			var options = $("#deliveredTo");
	//		console.log($location);			
				$.ajax({
					type: 'GET',
					url: "/waybill/loadusers",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"company": $company,
					"location": $location
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
//					console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					//console.log(data + " Array Length "+ data.length);
					console.log('Request data for users '+data);
					if ($sentTo=='VENDOR'){
					options.empty();
					options.hide();
					$("#delivTo").show();
					
					}
					else
					{
						options.show();
					options.empty();	
					$("#delivTo").hide();
					$("#delivTo").empty();
					options.show();
					$.each(data, function(i, list){
						options.append(new Option(list.name, this.value))
					});
					}
					}
				});
			
		}
if($(this).find(":selected").val()==='VENDOR'){
		$("#vendiv1").show();	
	}
	else{
		$("#vendiv1").hide();
	}
		
		});
$(".alinks").on("click", function(){
		 id = $(this).attr('href');
		$.ajax({
					type: 'GET',
					url: "/message/"+id,
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": id
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
	//				console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					//data response can contain what we want here...
//					console.log("Item saved "+data+"fully");
					$('.modal-body').empty();
					$('.modal-body').html(data);
					console.log(data);
					}
				});

		 console.log(id);
	 });
$("#printType").change(function(){
		 	$res= $(this).find(":selected").val();
			
		if($res=='No'){
		$("#rec_btn3").append('<span class="glyphicon glyphicon-print"></span>');
		$("#rec_btn3").text("Close");
			}else{
				$("#rec_btn3").append('<span class="glyphicon glyphicon-print"></span>');
		$("#rec_btn3").text("Print");
			}
			
	 });
$(".thumbnail").on("mouseenter", function(){
	randomIndex = Math.floor(Math.random() * effect.length);  
		$(this).addClass("animated "+effect[randomIndex]);
		
		console.log("Added  "+randomIndex);
	  });  
$(".thumbnail").on("mouseleave", function(){
		$(this).removeClass("animated "+effect[randomIndex]);
				console.log("Removed  "+randomIndex);
	  });
$("#deliveredTo").on("focus mouseover", function(){
			$sentTo = $("#sentTosel").val();

		if($sentTo==null){
			
			$("#errmsglist").text("Enter receiving location 'sent To'");
			$("#errmsg").prop('hidden', false);
		}else{$("#errmsg").hide();}	
	  });  
$("body").on("mouseover hover focus click", '#sentBy', function(){
			$userid = $("#userid").val();
			$username = $("#username").val();
			$(this).val($username);
			$(this).prop('readonly', true);
	  });
$("#add_row").click(function(){
      $('#addr'+i).html("<td class='text-center'>"+ (i+1) +"</td><td><input name='items["+i+"][desc]' type='text' placeholder='Item description' class='form-control input-md'  /> </td><td><input  name='items["+i+"][qty]'  type='number' onkeypress='return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57' type='number' min='0' max='10000' placeholder='Quantity'  class='form-control input-md'></td><td><input  name='items["+i+"][serial]' type='text' placeholder='Serial Number'  class='form-control input-md'></td><td><input  name='items["+i+"][status]' type='text' placeholder='Item Status'  class='form-control input-md'></td><td><input  name='items["+i+"][remark]' type='text' placeholder='Remarks'  class='form-control input-md'></td><td><input  name='items["+i+"][sircode]' type='text' placeholder='SIR Number'  class='form-control input-md'></td><td><input  name='items["+i+"][lpo]' type='text' placeholder='LPO Number'  class='form-control input-md'></td>");

	$('#tbody').append('<tr id="addr'+(i+1)+'"></tr>');      i++; 
	$('#row_value').val(i);
	var g = $('#row_value').val();

	console.log(g);
  });
$("#delete_row").click(function(){
    	 if(i>1){
		 $("#addr"+(i-1)).html('');
		 i--;
		 }
	 });
	 $loc = $("#wType").val();
   //  console.log($loc);
$("#search_btn").click(function(){
	console.log($loc);
					var $s = $("#search_input").val();
					if(!$.isNumeric($s) && !isEmpty($s)){				
				//console.log(" it is a string");
				$("#tab_logic tbody > tr > td").remove();
				
				//		console.log("Text input entered");
				i=0
				$("#tbody > tr").empty();
				//$("#tab_logic2 tbody2 > tr > td").remove();	
				$itemCnt=0;				
				$("#thead2").show();
				$("#thead1").hide();
				$.ajax({
					type: 'GET',
					url: "/waybill/searchitem",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": $("#search_input").val(),
					"wType": $loc
					},                                                                           
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
	//				console.log("error on submit"+xhr);
					},
					success: function( data, res ){ 
				//	console.log(data[0][0].item_desc);
					$("#tbody > tr").empty();
						i=0
					$.each(data[0], function(i, item){
					if(data[1][i].receiveStatus === 'OPEN')
						{
					 $('#addr'+i).html("<td class='text-center'>"+'W'+data[1][i].wType.charAt(0)+ zeroPad(data[1][i].id, 5) +"</td><td class='text-center'>"+data[1][i].sentDate+"</td><td class='text-center'>"+item.item_desc+"</td><td class='text-center'>"+data[1][i].sentBy+"</td><td class='text-center'>"+data[1][i].deliveredTo+"</td><td class='text-center'>"+data[1][i].sentFrom+"</td><td class='text-center'>"+data[1][i].sentTo+"</td><td class='text-center'>"+data[1][i].deliveredBy+"</td><td><p data-placement='top' data-toggle='tooltip' title='List items'><button class='btn btn-primary btn-xs btn_items' value='"+data[1][i].id+"'><span class='glyphicon glyphicon-pencil'></span></button></p></td><td class='text-center'>"+data[1][i].receiveStatus+"</td>");

					$('#tbody').append('<tr id="addr'+(i+1)+'"></tr>');    				
					$("#tab_logic").show();  				
					}
					
					});
					$("#tab_logic").show();
	//				console.log('data '+ item);
					//data response can contain what we want here...
			/*		i++; 
					//	item.receivedBy = 'OPEN';
					 $('#addr'+i).html("<td class='text-center'>"+'W'+item.wType.charAt(0)+ zeroPad(item.id, 5) +"</td><td class='text-center'>"+item.sentDate+"</td><td class='text-center'>"+item.sentBy+"</td><td class='text-center'>"+item.sentFrom+"</td><td class='text-center'>"+item.deliveredBy+"</td><td class='text-center'><p data-placement='top' data-toggle='tooltip' title='Print waybill'><a id='printbtn' type='submit' href='printreview?docid="+item.id+"' class='btn btn-primary btn-xs' value='"+item.id+"'><span class='glyphicon glyphicon-print fa-2x'></span></a></p></td>");

					$('#tbody2').append('<tr id="addr'+(i+1)+'"></tr>');    				
					$("#tab_logic2").show(); */

					}
				});					
				
				
		}
		else{
			
				$("#thead1").show();
				$("#thead2").hide();
		$.ajax({
			
					type: 'GET',
					url: "/waybill/load",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"location": $("#loc_input").val(),
					"search": $("#search_input").val(),
					"wType": $("#wType").val(),
					"user_id": $userid
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
					console.log("error on submit"+xhr);
					},
					success: function( data ){ 

					//data response can contain what we want here...
					$("#tab_logic tbody > tr > td").remove();	
					$.each(data, function(i, item){
					//	item.receivedBy = 'OPEN';
					 $('#addr'+i).html("<td>"+'W'+ item.wType.charAt(0)+zeroPad(item.id,5) +"</td><td>"+item.sentDate+"</td><td>"+item.sentBy+"</td><td class='text-center'>"+item.deliveredTo+"</td><td>"+item.sentFrom+"</td><td>"+item.sentTo+"</td><td>"+item.deliveredBy+"</td><td><p data-placement='top' data-toggle='tooltip' title='Edit'><button class='btn btn-primary btn-xs btn_items' value='"+item.id+"'><span class='glyphicon glyphicon-pencil'></span></button></p></td><td>"+item.receiveStatus+"</td>");

					$('#tbody').append('<tr id="addr'+(i+1)+'"></tr>');     
					i++; 
					$('#row_value').val(i);
					}); 
					$("#tab_logic").show();
					$item_count = 0;

			//		console.log("SUCCESS, data="+data);
					}
				});
	}
				
				});
$("body").on("click", '.btn_items1', function(){
		$('#classModal').modal('show');
		$doc_id = $(this).val();
		console.log(" doc id "+$doc_id);
		$.ajax({
					type: 'GET',
					url: "/waybill/loadItems",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": $doc_id
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
					console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					$item_err = 0; 
					$item_count=0;i=0;
					rec_qty = [];
					$rd = "readonly";
					//$("#tbody1 > tr > td").empty();	
					$.each(data, function(i, item){

						//console.log(" items "+ item.item_desc);
						//rec_qty[i] = item.recqty;
					$('#trows'+i).html("<td>"+(i+1)+"</td><td>"+item.item_desc+"</td><td> "+item.serialNo+"</td><td>"+item.qty+"</td><td>"+item.recqty+"</td><td>"+(item.qty-item.recqty)+"</td><td>"+item.status +"</td><td>"+item.remark+"</td><td>"+item.sircode+"</td><td>"+item.lpo+"</td>");
					
					 $('#tbodys').append('<tr id="trows'+(i+1)+'"></tr>');     
					 $item_count++;
					$('#row_value').val(i);
					}); 	

					//$("#rec_err").hide();
					//data response can contain what we want here...
					
	//				console.log(data);
					//console.log("SUCCESS, data="+data);
					}
				});
	});
$("body").on("click", '.btn_items2', function(){

				$("#recRemarks").hide();
				$("#printText").hide();
				$("#printType").hide();
				$("#rec_btn3").hide();
				//$("#recRemText").hide();
//				console.log("Items button clicked");
				$userid = $("#userid").val();
				$doc_id = $(this).val();
				$.ajax({  //load waybill document
					type: 'GET',
					url: "/waybill/loaddoc",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": $doc_id
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
//					console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					$doc = data;
//					console.log($doc.id);
					}
				
				});

				$.ajax({ //load waybill item 
					type: 'GET',
					url: "/waybill/loadItems",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": $doc_id
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
					console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					$item_err = 0; 
					$item_count=0;
					rec_qty = [];
					$("#tbody1 > tr > td").remove();	
					$.each(data, function(i, item){
						if(item.recqty===item.qty){
							$rd = "readonly";
						}else if($doc.ackcnt>9){$rd="readonly"}
						else{$rd = "";}
//						console.log(i);
						rec_qty[i] = item.recqty;
				if($doc.receiveStatus=='CLOSED' || $doc.receiveStatus=='RECEIVED' || $doc.receiveStatus == 'RETURNED')	{
					$rd = 'readonly';
					$("#recheader").text("Received Quantity");
					$ins="<td><input  name='item["+i+"][recqty]' onkeypress='return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57' type='number' min='0' max='1000' placeholder='qty' value='"+item.recqty+"' class='form-control input-md' required "+$rd+"></td>";
				}else{
					$rd="readonly";
					$("#recheader").text("Received Quantity");
					$ins="<td><input  name='item["+i+"][recqty]' onkeypress='return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57' type='number' min='0' max='1000' placeholder='qty' value='"+item.recqty+"' class='form-control input-md' required "+$rd+"></td>";
				}
					 $('#addrs'+i).html("<td>"+ (i+1) +"<input name='item["+i+"][id]' value='"+item.id+"' type='text' placeholder='Item description' hidden/> </td><td><input name='item["+i+"][desc]' value='"+item.item_desc+"' type='text' placeholder='Item description' class='form-control input-md'  readonly/> </td><td><input  name='item["+i+"][serial]' value='"+item.serialNo+"' type='text' placeholder='Quantity'  class='form-control input-md' readonly></td><td><input  name='item["+i+"][qty]'  value='"+item.qty+"'  type='text' placeholder='Serial Number'  class='form-control input-md' readonly></td>"+$ins+"<td><input  name='item["+i+"][recvnqty]'  value='"+(item.qty-item.recqty)+"' type='text' min='0' max='1000' placeholder='Serial Number'  class='form-control input-md' required "+$rd+" readonly></td><td><input  name='item["+i+"][status]'  value='"+item.status+"' type='text' placeholder='Item Status'  class='form-control input-md' readonly></td><td><input  value='"+item.remark+"'  name='item["+i+"][remark]' type='text' placeholder='Remarks'  class='form-control input-md' readonly></td><td><input  value='"+item.sircode+"'  name='item["+i+"][sircode]' type='text' placeholder='SIR Number'  class='form-control input-md' readonly></td><td><input  value='"+item.lpo+"'  name='item["+i+"][lpo]' type='text' placeholder='LPO Number'  class='form-control input-md' readonly></td>");
					 $('#tbody1').append('<tr id="addrs'+(i+1)+'"></tr>');     
					 $item_count++;
					$('#row_value').val(i);
					}); 	
//					console.log("item count "+$item_count);
					//$("#tab_logic1 tbody1").remove();	
					//$("#tab_logic1").show();	
					if($doc.receiveStatus === 'CLOSED'){
					$("#rec_by").text($doc.receivedBy);	
					$("#rec_date").text($doc.receiveDate);	
					console.log($doc.closeremark);
					if($doc.closeremark === null){
					$("#rec_rem0").hide();	
					$("#rec_rem").hide();	
					}else{
					$("#rec_rem").text($doc.closeremark);
					$("#rec_rem0").show();	
					$("#rec_rem").show();	
					}	
					if($doc.wType == 'PROMO'){
					$("#rec_by").text($doc.deliveredTo);	
					$("#rec_date").text($doc.sentDate);							
					}
					$("#disp_rec").show();
					$("#rec_btn").hide();
					$("#rec_btn1").hide();
					$("#rec_suc").text("");
					}else{ $("#rec_btn").show();$("#disp_rec").hide(); $("#rec_btn1").show();}
					$("#edit").modal('show');
					$("#rec_err").text("");
					$("#rec_suc").text("");
					if($doc.wType=='LOAN'){
						
					if($doc.ackcnt>9){
					$("#rec_btn1").hide();
					$("#rec_btn2").show();
					$("#printText").show();
					$("#printType").show();						
					if($username == $doc.sentBy){
						console.log("same person");
					$("#rec_btn1").show();
					$("#rec_btn2").hide();							
					$("#printText").hide();
					$("#printType").hide();							
					}				
						}else{
					$("#rec_btn1").show();
					$("#rec_btn2").hide();							
					$("#printText").hide();
					$("#printType").hide();				
						}
						if($doc.ackcnt>19){
					if($username==$doc.sentBy){
					$("#rec_btn1").hide();  //receive button
					$("#rec_btn2").hide();	// receive button load for loan 						
					$("#printText").hide();
					$("#printType").hide();	
					$("#rec_btn4").show();
							}
							else{	
					$("#rec_btn1").hide();
					$("#rec_btn2").hide();							
					$("#printText").show();
					$("#printType").show();	
					$("#rec_btn3").show();
							}
							
						}
					}
					//$("#rec_err").hide();
					//data response can contain what we want here...
					
	//				console.log(data);
					//console.log("SUCCESS, data="+data);
					}
				});
	});	
	$("body").on("click",'.btn_items', function(){
		$("#recRemarks").hide();
				$("#printText").hide();
				$("#printType").hide();
				$("#rec_btn3").hide();
				//$("#recRemText").hide();
//				console.log("Items button clicked");
				$userid = $("#userid").val();
				$doc_id = $(this).val();
				$.ajax({  //load waybill document
					type: 'GET',
					url: "/waybill/loaddoc",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": $doc_id
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
//					console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					$doc = data;
//					console.log($doc.id);
					}
				
				});

				$.ajax({ //load waybill item 
					type: 'GET',
					url: "/waybill/loadItems",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": $doc_id
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
					console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					$item_err = 0; 
					$item_count=0;
					rec_qty = [];
					$("#tbody1 > tr > td").remove();	
					$.each(data, function(i, item){
						if(item.recqty===item.qty){
							$rd = "readonly";
						}else if($doc.ackcnt>9){$rd="readonly"}
						else{$rd = "";}
//						console.log(i);
						rec_qty[i] = item.recqty;
			if($doc.receiveStatus=='CLOSED' || $doc.receiveStatus=='RECEIVED' || $doc.receiveStatus == 'RETURNED')	{
					$rd = 'readonly';
					$("#recheader").text("Received Quantity");
					$ins="<td><input  name='item["+i+"][recqty]' onkeypress='return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57' type='number' min='0' max='1000' placeholder='qty' value='"+item.recqty+"' class='form-control input-md' required "+$rd+"></td>";
				}else{
					$rd="";
					$("#recheader").text("Receiving Quantity");
					$ins="<td><input  name='item["+i+"][recqty]' onkeypress='return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57' type='number' min='0' max='1000' placeholder='qty' value='0' class='form-control input-md' required "+$rd+"></td>";
				}
					 $('#addrs'+i).html("<td>"+ (i+1) +"<input name='item["+i+"][id]' value='"+item.id+"' type='text' placeholder='Item description' hidden/> </td><td><input name='item["+i+"][desc]' value='"+item.item_desc+"' type='text' placeholder='Item description' class='form-control input-md'  readonly/> </td><td><input  name='item["+i+"][serial]' value='"+item.serialNo+"' type='text' placeholder='Quantity'  class='form-control input-md' readonly></td><td><input  name='item["+i+"][qty]'  value='"+item.qty+"'  type='text' placeholder='Serial Number'  class='form-control input-md' readonly></td>"+$ins+"<td><input  name='item["+i+"][recvnqty]'  value='"+(item.qty-item.recqty)+"' type='text' min='0' max='1000' placeholder='Serial Number'  class='form-control input-md' required "+$rd+" readonly></td><td><input  name='item["+i+"][status]'  value='"+item.status+"' type='text' placeholder='Item Status'  class='form-control input-md' readonly></td><td><input  value='"+item.remark+"'  name='item["+i+"][remark]' type='text' placeholder='Remarks'  class='form-control input-md' readonly></td><td><input  value='"+item.sircode+"'  name='item["+i+"][sircode]' type='text' placeholder='SIR Number'  class='form-control input-md' readonly></td><td><input  value='"+item.lpo+"'  name='item["+i+"][lpo]' type='text' placeholder='LPO Number'  class='form-control input-md' readonly></td>");
					 $('#tbody1').append('<tr id="addrs'+(i+1)+'"></tr>');     
					 $item_count++;
					$('#row_value').val(i);
					}); 	
//					console.log("item count "+$item_count);
					//$("#tab_logic1 tbody1").remove();	
					//$("#tab_logic1").show();	
					if($doc.receiveStatus === 'CLOSED'){
					$("#rec_by").text($doc.receivedBy);	
					$("#rec_date").text($doc.receiveDate);	
					console.log($doc.closeremark);
					if($doc.closeremark === null){
					$("#rec_rem0").hide();	
					$("#rec_rem").hide();	
					}else{
					$("#rec_rem").text($doc.closeremark);
					$("#rec_rem0").show();	
					$("#rec_rem").show();	
					}	
					if($doc.wType == 'PROMO'){
					$("#rec_by").text($doc.deliveredTo);	
					$("#rec_date").text($doc.sentDate);							
					}
					$("#disp_rec").show();
					$("#rec_btn").hide();
					$("#rec_btn1").hide();
					$("#rec_suc").text("");
					}else{ $("#rec_btn").show();$("#disp_rec").hide(); $("#rec_btn1").show();}
					$("#edit").modal('show');
					$("#rec_err").text("");
					$("#rec_suc").text("");
					if($doc.wType=='LOAN'){
						
					if($doc.ackcnt>9){
					$("#rec_btn1").hide();
					$("#rec_btn2").show();
					$("#printText").show();
					$("#printType").show();						
					if($username == $doc.sentBy){
						console.log("same person");
					$("#rec_btn1").show();
					$("#rec_btn2").hide();							
					$("#printText").hide();
					$("#printType").hide();							
					}				
						}else{
					$("#rec_btn1").show();
					$("#rec_btn2").hide();							
					$("#printText").hide();
					$("#printType").hide();				
						}
						if($doc.ackcnt>19){
					if($username==$doc.sentBy){
					$("#rec_btn1").hide();  //receive button
					$("#rec_btn2").hide();	// receive button load for loan 						
					$("#printText").hide();
					$("#printType").hide();	
					$("#rec_btn4").show();
							}
							else{	
					$("#rec_btn1").hide();
					$("#rec_btn2").hide();							
					$("#printText").show();
					$("#printType").show();	
					$("#rec_btn3").show();
							}
							
						}
					}
					//$("#rec_err").hide();
					//data response can contain what we want here...
					
	//				console.log(data);
					//console.log("SUCCESS, data="+data);
					}
				});
				
	});
$("body").on("click",'.btn_itemshow', function(){
				console.log("Items button clicked");
				$doc_id = $(this).val();
								$.ajax({
					type: 'GET',
					url: "/waybill/loaddoc",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": $doc_id
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
					//console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					$doc = data;
				//	console.log($doc.id);
					}
				});
				
				$.ajax({
					type: 'GET',
					url: "/waybill/loadItems",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": $doc_id
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
					//console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					$item_err = 0; 
					$item_count=0;
					rec_qty = [];
					$("#tbody1 > tr > td").remove();	
					$.each(data, function(i, item){
						if(item.recqty===item.qty){
							$rd = "readonly";
						}
						else{$rd = "";}
					//	console.log(i);
						rec_qty[i] = item.recqty;
					 $('#addrs'+i).html("<td>"+ (i+1) +"<input name='item["+i+"][id]' value='"+item.id+"' type='text' placeholder='Item description' hidden/> </td><td><input name='item["+i+"][desc]' value='"+item.item_desc+"' type='text' placeholder='Item description' class='form-control input-md'  readonly/> </td><td><input  name='item["+i+"][serial]' value='"+item.serialNo+"' type='text' placeholder='Quantity'  class='form-control input-md' readonly></td><td><input  name='item["+i+"][qty]'  value='"+item.qty+"'  type='text' placeholder='Serial Number'  class='form-control input-md' readonly></td><td><input  name='item["+item.recqty+"][recqty]' onkeypress='return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57' type='text' min='0' max='1000' placeholder='Serial Number' value='"+item.recqty+"' class='form-control input-md' required readonly></td><td><input  name='item["+i+"][recvnqty]'  value='"+(item.qty-item.recqty)+"' type='text' min='0' max='1000' placeholder='Serial Number'  class='form-control input-md' required "+$rd+" readonly></td><td><input  name='item["+i+"][status]'  value='"+item.status+"' type='text' placeholder='Item Status'  class='form-control input-md' readonly></td><td><input  value='"+item.remark+"'  name='item["+i+"][remark]' type='text' placeholder='Remarks'  class='form-control input-md' readonly></td><td><input  value='"+item.sircode+"'  name='item["+i+"][sircode]' type='text' placeholder='SIR number'  class='form-control input-md' readonly></td><td><input  value='"+item.lpo+"'  name='item["+i+"][lpo]' type='text' placeholder='LPO'  class='form-control input-md' readonly></td>");
					 $('#tbody1').append('<tr id="addrs'+(i+1)+'"></tr>');     
					 $item_count++;
					$('#row_value').val(i);
					}); 	
					//console.log("item count "+$item_count);
					//$("#tab_logic1 tbody1").remove();	
					//$("#tab_logic1").show();	
					$("#rec_btn").hide();
					$("#rec_btn1").hide();
					if($doc.receiveStatus === 'CLOSED'){
					$("#rec_by").text($doc.receivedBy);	
					$("#rec_date").text($doc.receiveDate);	
					//console.log($doc.closeremark);
					if($doc.closeremark === null){
					$("#rec_rem0").hide();	
					$("#rec_rem").hide();	
					}else{
					$("#rec_rem").text($doc.closeremark);
					$("#rec_rem0").show();	
					$("#rec_rem").show();	
					}
					if($doc.wType == 'PROMO'){
					$("#rec_by").text($doc.deliveredTo);	
					$("#rec_date").text($doc.sentDate);							
					}					
					$("#disp_rec2").show();
					$("#rec_suc").text("");
					}else{$("#disp_rec2").hide();}
					$("#edit").modal('show');
					$("#rec_err").text("");
					$("#rec_suc").text("");
					//$("#rec_err").hide();
					//data response can contain what we want here...
					
					//console.log(data);
					//console.log("SUCCESS, data="+data);
					}
				});
	});	
$("body").on("click",'#rec_btn', function(){ 
       console.log("User ID"+ $userid);
		//$("#rec_err").hide();
		$("#recRemarks").hide();
		/*$("#tbody1 > tr").each(function(i, tr){
			console.log(" i "+i+ "  tr "+tr);		
			var val = $("input", tr).val();	
			console.log("VAL "+val);			
						
		});*/
		//console.log($("input[name='item[0][desc]'").val())
				
		loaddoc();
		if($doc.wType == 'TRANSFER'){
		console.log("It is either loan or repair " +$doc.wType );
		recitem();
		}
		else{
		if($doc.user_id == $userid){
			recitem();
		}
		else
		{
			$("#rec_err").text("Not authorized receiver");
			
		}
			
		}
		
		
				});
	
$(".removeBtn").click(function(){
		
$.ajax({
					type: 'GET',
					url: "emailDel",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": $(this).val(),
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
//					console.log("error on submit"+xhr);
					},
					success: function( data ){ 

					//data response can contain what we want here...
					console.log("Item saved "+data+"fully");
					location.reload();
					}
				});
		
	});
$("body").on("click",'#rec_btn1', function(){ 
	
		loaddoc();
		console.log('$lc  = '+$lc);
		console.log(' Waybill SentTo ' +$doc.sentTo);
		if($doc.sentTo == $lc ){    //if waybill sent To location same as receiver location
		//$("#rec_err").hide();
		$("#recRemarks").css('diplay','none');
		$("#rec_err").text("");			
		$item_err = 0; 
		for(var c=0; c<$item_count; c++){
		//	console.log("Received quantity"+ rec_qty[c]);
		var	$h = Number($("input[name='item["+c+"][qty]'").val())
		var	$g = Number($("input[name='item["+c+"][recqty]'").val())
		var	$j = $("input[name='item["+c+"][recvnqty]'").val();
		var	$i = $("input[name='item["+c+"][id]'").val();
		var $k = Number(rec_qty[c]);
			if($g<0){
		   $("#rec_err").text("Received can't be a negative number Item "+(c+1)+" ");
				$item_error=0;
				return true;
			}
		$g=$g+$k;
		//console.log("receive qty" + ($g + $k))
					if($g<0){
		   $("#rec_err").text("Received can't be a negative number Item "+(c+1)+" ");
				return true;
			}
				if($g>$h)	{
					$("#rec_err").text("Received can't be greater than sent on Item "+(c+1)+" ");
					return true;
							}
							else if($g<$h){
								$item_err=$item_err+1;	
							//console.log("Quantity received less"+ $g+" counter "+c +" Item error"+$item_err);	
								}
							else if($g === $h){ 
							$item_err=$item_err-1;
							console.log("Quantity received equal"+ $g+" counter "+c +" Item error"+$item_err);
											}
		                    } 		
		if($item_err>0){
			
			if($('#recRemarks').is(':visible')){
			console.log("did u run this");
			if($("#recRemText").val()==""){
			console.log("Remarks cannot be empty");	
			$("#rec_err").text("Remarks cannot be empty");
			$("#rec_err").show();
			}
			else{
				//$("#rec_err").hide();
				$("#rec_err").text("");
				recLoan();
		}
	}
	else{
		$("#recRemarks").show();}	 
		}
		else if($item_err<0){
			
				recLoan();
		} 
//		console.log("receive button clicked "+$item_err);
//			console.log("receive button 1  clicked ");		
		}
		else if(($doc.wType == 'REPAIR')|| ($userpriv == 1)){ //
	
		//$("#rec_err").hide();
		$("#recRemarks").css('diplay','none');
		$("#rec_err").text("");			
		$item_err = 0; 
		for(var c=0; c<$item_count; c++){
		//	console.log("Received quantity"+ rec_qty[c]);
		var	$h = Number($("input[name='item["+c+"][qty]'").val())
		var	$g = Number($("input[name='item["+c+"][recqty]'").val())
		var	$j = $("input[name='item["+c+"][recvnqty]'").val();
		var	$i = $("input[name='item["+c+"][id]'").val();
		var $k = Number(rec_qty[c]);
			if($g<0){
		   $("#rec_err").text("Received can't be a negative number Item "+(c+1)+" ");
				$item_error=0;
				return true;
			}
		$g=$g+$k;
		//console.log("receive qty" + ($g + $k))
					if($g<0){
		   $("#rec_err").text("Received can't be a negative number Item "+(c+1)+" ");
				return true;
			}
				if($g>$h)	{
					$("#rec_err").text("Received can't be greater than sent on Item "+(c+1)+" ");
					return true;
							}
							else if($g<$h){
								$item_err=$item_err+1;	
							//console.log("Quantity received less"+ $g+" counter "+c +" Item error"+$item_err);	
								}
							else if($g === $h){ 
							$item_err=$item_err-1;
							console.log("Quantity received equal"+ $g+" counter "+c +" Item error"+$item_err);
											}
		                    } 		
		if($item_err>0){
			
			if($('#recRemarks').is(':visible')){
			console.log("did u run this");
			if($("#recRemText").val()==""){
			console.log("Remarks cannot be empty");	
			$("#rec_err").text("Remarks cannot be empty");
			$("#rec_err").show();
			}
			else{
				//$("#rec_err").hide();
				$("#rec_err").text("");
				recLoan();
		}
	}
	else{
		$("#recRemarks").show();}	 
		}
		else if($item_err<0){
			
				recLoan();
		} 
//		console.log("receive button clicked "+$item_err);
//			console.log("receive button 1  clicked ");		
		}		
		else{
			if(($doc.receiveStatus=='RETURNED')||$doc.ackcnt>19){
												//if waybill returned to allow sender close waybill
												// do final receive command
			}else{
		$("#rec_err").text("Not authorized receiver");	
			}
		}
			});

$("body").on("click", ".tableSection .pagination a", function(e){
	 e.preventDefault();
			              //  $('#load a').css('color', '#dfecf6');
              //  $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

                var url = $(this).attr('href');
				console.log(url);
            //    getArticles(url);
			 getWaybill(url);
          //   window.history.pushState("", "", url);
     	
});
		
$("body").on("click", "#rec_btn2", function(){
		console.log("Return Submitted");
		$printType=$("#printType").find(":selected").val();
		console.log("Print type "+$printType);
		
					$.ajax({
					type: 'GET',
					url: "/waybill/return",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"doc_id": $doc_id,
					"printType": $printType
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
	//				console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					$data = data;
					//data response can contain what we want here...
					console.log("Item saved "+data.sentTo+"fully");
					$("#rec_suc").text("Return Successful");
					$("#rec_suc").show();
					}
				});
		$("#rec_suc").text("Return Succesful");
			$('#edit').delay(2000).fadeOut(2000);
			setTimeout(function(){
				$('#edit').modal("hide");
				if($printType=='WAYBILL'){
				//window.location.href = "/home";
				window.location.href = '/waybill/rprint?pType='+$printType+'&doc='+$data.id;
				}else{
					window.location.href = '/home';
				}
				}, 4500);	
		
	});
$("body").on("click", "#rec_btn3", function(){
		$printType=$("#printType").find(":selected").val();
		if($printType=='WAYBILL'){
			console.log("doc id   "+$doc_id);
			window.location.href = '/waybill/rprint?pType='+$printType+'&doc='+$doc_id;
		}else{
			$('.modal').modal('hide');
		}
})
$("body").on("click", "#rec_btn4", function(){
					$printType = 'CLOSED';
					$.ajax({
					type: 'GET',
					url: "/waybill/return",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"doc_id": $doc_id,
					"printType": $printType
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
	//				console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					$data = data;
					//data response can contain what we want here...
					console.log("Item saved "+data.sentTo+"fully");

					}
				});
					$("#rec_suc").text("Loan Transfer Completed");
					$("#rec_suc").show();		
			$('#edit').delay(2000).fadeOut(2000);
			setTimeout(function(){
				$('#edit').modal("hide");
				window.location.href = '/home';
				}, 4500);					
})
$("body").on("click",'#print_btn', function(){ 
	//	console.log("print button clicked "+$item_err);
		window.print();
				});	
$("body").on("click",'#searchi_btn', function(){ 
				var $s = $("#search_input").val();
				if($s===''){
	//				console.log("search button clicked");
					$("#tbody2 > tr > td").remove();	
				}
				else{
					if($.isNumeric($s)){
				i=0
				$("#tbody2 > tr").empty();
				$("#thead1").show();
				$("#thead2").hide();
				//$("#tab_logic2 tbody2 > tr > td").remove();	
				$itemCnt=0;				
				$.ajax({
					type: 'GET',
					url: "/waybill/loaddoc",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": $("#search_input").val()
					},                                                                           
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
	//				console.log("error on submit"+xhr);
					},
					success: function( item ){ 
	//				console.log('data '+ item);
					//data response can contain what we want here...
					//i++; 
					//	item.receivedBy = 'OPEN';
					$doc_id = item.id;
					 $('#addr'+i).html("<td class='text-center'>"+'W'+item.wType.charAt(0)+ zeroPad(item.id, 5) +"</td><td class='text-center'>"+item.sentDate+"</td><td class='text-center'>"+item.sentBy+"</td><td class='text-center'>"+item.sentFrom+"</td><td class='text-center'>"+item.sentTo+"</td><td><p data-placement='top' data-toggle='tooltip' title='List items'><button class='btn btn-primary btn-xs btn_items1' value='"+item.id+"'><span class='glyphicon glyphicon-pencil'></span></button></p></td>");

					$('#tbody2').append('<tr id="addr'+(i+1)+'"></tr>');    				
					$("#tab_logic2").show();

					}
				});
					}
					else
					{
						console.log("Text input entered");
				i=0
				$("#tbody2 > tr").empty();
				//$("#tab_logic2 tbody2 > tr > td").remove();	
				$itemCnt=0;				
				$("#thead2").show();
				$("#thead1").hide();
				$.ajax({
					type: 'GET',
					url: "/waybill/searchitem",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": $("#search_input").val()
					},                                                                           
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
	//				console.log("error on submit"+xhr);
					},
					success: function( data, res ){ 
					console.log(data[0][0].item_desc);
					$("#tbody2 > tr").empty();
						i=0
					$.each(data[0], function(i, item){
					
					 $('#addr'+i).html("<td class='text-center'>"+'W'+data[1][i].wType.charAt(0)+ zeroPad(data[1][i].id, 5) +"</td><td class='text-center'>"+data[1][i].sentDate+"</td><td class='text-center'>"+item.item_desc+"</td><td class='text-center'>"+item.qty+"</td><td class='text-center'>"+data[1][i].deliveredTo+"</td><td class='text-center'>"+data[1][i].sentFrom+"</td><td class='text-center'>"+data[1][i].sentTo+"</td><td><p data-placement='top' data-toggle='tooltip' title='List items'><button class='btn btn-primary btn-xs btn_items1' value='"+data[1][i].id+"'><span class='glyphicon glyphicon-pencil'></span></button></p></td><td class='text-center'>"+data[1][i].receiveStatus+"</td>");

					$('#tbody2').append('<tr id="addr'+(i+1)+'"></tr>');    				
					$("#tab_logic2").show();  				
					
					
					});
					$("#tab_logic2").show();
	//				console.log('data '+ item);
					//data response can contain what we want here...
			/*		i++; 
					//	item.receivedBy = 'OPEN';
					 $('#addr'+i).html("<td class='text-center'>"+'W'+item.wType.charAt(0)+ zeroPad(item.id, 5) +"</td><td class='text-center'>"+item.sentDate+"</td><td class='text-center'>"+item.sentBy+"</td><td class='text-center'>"+item.sentFrom+"</td><td class='text-center'>"+item.deliveredBy+"</td><td class='text-center'><p data-placement='top' data-toggle='tooltip' title='Print waybill'><a id='printbtn' type='submit' href='printreview?docid="+item.id+"' class='btn btn-primary btn-xs' value='"+item.id+"'><span class='glyphicon glyphicon-print fa-2x'></span></a></p></td>");

					$('#tbody2').append('<tr id="addr'+(i+1)+'"></tr>');    				
					$("#tab_logic2").show(); */

					}
				});						
						}
					}	
				});		
$("body").on("click",'#searchp_btn', function(){ 
				var $s = $("#search_input").val();
				if($s===''){
	//				console.log("search button clicked");
					$("#tbody2 > tr > td").remove();	
				}
				else{
			
				i=0
				$("#tab_logic2 tbody2 > tr > td").remove();	
				$itemCnt=0;				
				$.ajax({
					type: 'GET',
					url: "/waybill/loaddoc",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": $("#search_input").val()
					},                                                                           
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
	//				console.log("error on submit"+xhr);
					},
					success: function( item ){ 
	//				console.log('data '+ item);
					//data response can contain what we want here...
					i++; 
					//	item.receivedBy = 'OPEN';
					 $('#addr'+i).html("<td class='text-center'>"+'W'+item.wType.charAt(0)+ zeroPad(item.id, 5) +"</td><td class='text-center'>"+item.sentDate+"</td><td class='text-center'>"+item.sentBy+"</td><td class='text-center'>"+item.sentFrom+"</td><td class='text-center'>"+item.deliveredBy+"</td><td class='text-center'><p data-placement='top' data-toggle='tooltip' title='Print waybill'><a id='printbtn' type='submit' href='printreview?docid="+item.id+"' class='btn btn-primary btn-xs' value='"+item.id+"'><span class='glyphicon glyphicon-print fa-2x'></span></a></p></td>");

					$('#tbody2').append('<tr id="addr'+(i+1)+'"></tr>');    				
					$("#tab_logic2").show();

					}
				});
				
						
					}	
				});		
$("#wTypeSel").on("change", function(){

		if(($(this).find(":selected").val()==='LOAN')|| ($(this).find(":selected").val()==='REPAIR')){
			console.log("LOAN or REPAIR Selected");
		$("#expRetDate").show();
	}
	else{$("#expRetDate").hide();}
	if(($(this).find(":selected").val()==='PROMO'))
	{	
		//$("#deliveredTo").hide();
	//	$("#delivdTo").append("<input type='text' name='deliveredTo' id='delivTo' placeholder='Samuel Besiktas' class='input-md emailinput form-control'/>");
	}else{ //		$("#delivTo").remove();

		//$("#delivTo").hide();	
		//$("#deliveredTo").show();	
			//$("#delivTo").remove();
		//$("#deliveredTo").replaceWith("<select class='input-md emailinput form-control' id='deliveredTo'> </select>");
	}
	});
$("#search_user").click(function(){
		var intext = $("#search_input").val();
		console.log(intext);
		$("#tuserbody > tr > td").remove();

		$.ajax({
					type: 'GET',
					url: "/getuser",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"srch": intext
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
				   console.log("error on submit"+xhr);
					},
					success: function( data, res ){ 
					
					//data response can contain what we want here...
					console.log("Item saved "+data[0].email+"fully");
					$("#tuserbody > tr > td").remove();
					admin = '';
					$.each(data, function(i, item){		
					if(data[i].admin==null || data[i].admin==0 ){admin = 'NO';}
					else{ admin = 'YES'; }
					$("#tuserbody").append("<tr><td class='text-center'>"+data[i].id+"</td><td class='text-center'>"+data[i].name+"</td><td class='text-center'>"+data[i].email+"</td><td class='text-center'>"+data[i].company+"</td><td class='text-center'>"+data[i].location+"</td><td class='text-center'>"+data[i].priv+"</td><td class='text-center'>"+data[i].dept+"</td><td class='text-center'>"+ admin+"</td><td><p><button type='button' class='btn btn-primary btn-xs useredit'  value='"+data[i].id+"'><span class='glyphicon glyphicon-pencil'></span></button></p></td></tr>");
						
					});
					}
				});
				
	
	});
	

$(".close").click(function(){
		$("#myModal").hide();
	});
$("body").on("click", '#btnUpdateUser', function(){
		console.log("Thank You " + $(this).val())
		console.log($("#deptsel").val())

		$.ajax({
					type: 'GET',
					url: "/updateuser",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": $(this).val(),
					"company": $("#compsel").val(),
					"location": $("#locsel").val(),
					"dept": $("#deptsel").val(),					
					"priv": $("#privsel").val(),
					"admin": $("#adminsel").val(),
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
				   console.log("error on submit"+xhr);
					},
					success: function( data, res ){ 
					
					//data response can contain what we want here...
					console.log(" User update "+ data.email +"fully");
					
				setTimeout(function(){
				$('#myModal').hide();
				window.location.href = '/admin/user';
				
				}, 500);
					}
					
		});
		
		});		
$("body").on("click", '.useredit', function(){	
		$(".modal-body >  table > tbody > tr").remove();
		console.log("clicking sound");
		console.log($(this).val())
		
		$.ajax({
					type: 'GET',
					url: "/getuser",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"srch": $(this).val(),
					"keys": "id", 
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
				   console.log("error on submit"+xhr);
					},
					success: function( data, res ){ 
					
					//data response can contain what we want here...
					console.log("Item saved "+ data.email +"fully");
					
			
		$(".modal-body >  table > tbody").append('<tr><td class="h5"><strong>Username: </strong></td><td> </td><td class="h5">'+data.name+'</td></tr><tr><td class="h5"><strong>Email:</strong></td> \
                                 <td> </td> \
                                 <td class="h5">'+data.email+'</td> \
                             </tr> \
                              \
                             <tr> \
                                 <td class="h5"><strong>Company</strong></td> \
                                 <td> </td>\
                                 <td class="h5"><select id="compsel"><option value="ESRNL">ESRNL</option><option value="NPRNL">NPRNL</option><option value="PFNL">PFNL</option><option value="GSNL">GSNL</option></select> </td> \
                             </tr>\
                             \
                             <tr>\
                                 <td class="h5"><strong>Location</strong></td>\
                                 <td> </td>\
                                 <td class="h5"><select id="locsel"><option value="AGBARA">AGBARA</option><option value="APAPA">APAPA</option><option value="IKOYI">IKOYI</option><option value="PARKVIEW">PARKVIEW</option><option value="IKEJA">IKEJA</option></select></td>\
                             </tr>\
                             \
                             <tr>\
                                 <td class="h5"><strong>Department</strong></td>\
                                 <td> </td>\
                                 <td class="h5"><select id="deptsel"><option value="IT">IT</option><option value="ACCOUNTS">ACCOUNTS</option><option value="ADMIN">ADMIN</option><option value="PURCHASING">PURCHASING</option><option value="MARKETING">MARKETING</option><option value="WAREHOUSE">WAREHOUSE</option><option value="RAW MATERIAL">RAW MATERIAL</option><option value="">NULL</option></select></td>\
                             </tr>\
                             \
                             <tr>\
                                 <td class="h5"><strong>Priviledge</strong></td>\
                                 <td> </td>\
                                 <td class="h5"><select id="privsel"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td>\
                             </tr>  \
\
                             <tr>\
                                 <td class="h5"><strong>ADMIN</strong></td>\
                                 <td> </td>\
                                 <td class="h5"><select id="adminsel"><option value="1">YES</option><option value="0">NO</option></select></td>\
                             </tr>                             <tr>\
                                 <td class="h5"><strong></strong></td>\
                                 <td> </td>\
                                 <td class="h5"><button id="btnUpdateUser" value="" class="btn btn-primary btn-sm">SAVE</button></td>\
                             </tr>');
		$("#btnUpdateUser").val(data.id).change();
		$("#adminsel").val(data.admin).change();	
		$("#privsel").val(data.priv).change();	
		$("#deptsel").val(data.dept).change();							 
		$("#locsel").val(data.location).change();
		$("#compsel").val(data.company).change();
		$("#myModal").show();
				}
				});
		
	});

$("#rSearch").click(function(){
	getWaybill("genreport");	
});
function getWaybill(url){
	origin = $("#origin").val();
	destination = $("#destination").val();
	frmDate = $("#frmDate").val();
	toDate = $("#toDate").val();
	sender = $("#sender").val();
	receiver = $("#receiver").val();	
	wType = $("#wType").val();
	statis = $("#status").val();	
	console.log("Origin "+ origin + " Destination "+ destination);
	console.log("To Date "+ toDate + " From Date "+ frmDate);
	console.log("Sender "+ sender + " Receiver "+ receiver);
	console.log("Excel "+$excel);
	$.ajax({
					type: 'GET',
					url: url,
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"frmDate": frmDate,
					"toDate":  toDate,
					"origin":  origin,
					"destination":   destination,
					"sender":  sender,
					"receiver": receiver,
					"status":	statis,
					"wType":	wType,
					"excel":	$excel,
					},                                                                                             
					error: function( xhr, des ){ 
					alert("ERROR ON SUBMIT");
					//console.log("error on submit"+xhr + "des "+ des);
				//	window.location.href = '/report'					
					},
					success: function( data, res){ 
					
					$(".tableSection").html(data);
					console.log("success");
					}				
					
				});
				
}
$("#saveRecipient").click(function(){
	
	
	$.ajax({
					type: 'GET',
					url: "emailSave",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"location": $("#location").val(),
					"company": $("#company").val(),
					"copi": $("#copy").val(),
					"bcopy": $("#bcopy").val(),

					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
					console.log("error on submit"+xhr);
					window.location.href = '/admin'					
					},
					success: function( data ){ 

					//data response can contain what we want here...
					console.log("Item saved "+data+"fully");
					window.location.href = '/admin'
					//location.reload();
					}
				});
	
});
function recitem(){
	
			$item_err = 0; 
		for(var c=0; c<$item_count; c++){
//			console.log("Received quantity"+ rec_qty[c]);
		var	$h = Number($("input[name='item["+c+"][qty]'").val())
		var	$g = Number($("input[name='item["+c+"][recqty]'").val())
		var	$j = $("input[name='item["+c+"][recvnqty]'").val();
		var	$i = $("input[name='item["+c+"][id]'").val();
		var $k = Number(rec_qty[c]);
		if(isNaN($g)){ console.log("Is not a number");};
					if($g<0){
		   $("#rec_err").text("Received can't be a negative number Item "+(c+1)+" ");
				return true;
			}
		$g=$g+$k;
		
		//console.log("receive qty" + ($g + $k))

				if($g>$h)	{
					$("#rec_err").text("Received can't be greater than sent on Item "+(c+1)+" ");
					console.log($doc_id);
					return true;
							}
							else if($g<$h){
								$item_err=$item_err+1;	
//							console.log("Quantity received less"+ $g+" counter "+c +" Item error"+$item_err);	
								}
							else if($g === $h){ 
							$item_err=$item_err-1;
//							console.log("Quantity received equal"+ $g+" counter "+c +" Item error"+$item_err);
												}
				
		} 

		if($item_err>0){
//			console.log("Received Less ");
			$item_stat='OPEN';
//			console.log("Quantity received "+ $g+" counter "+c +" Item error"+$item_err);
			for(var d=0; d<$item_count; d++){
				var	$rec = Number($("input[name='item["+d+"][recqty]'").val())
				var $recqty = $rec + Number(rec_qty[d]);
				var	$id = $("input[name='item["+d+"][id]'").val();
	//			console.log("Quantity received "+ $g+" counter "+d +" Item error"+$item_err);
				console.log("item id "+$id+" Receive quatity "+ $recqty );
//				console.log("Doc id "+$doc_id+" Item Status "+ $item_stat );
				$.ajax({
					type: 'GET',
					url: "/waybill/recitem",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"doc_id": $doc_id,
					"recqty": $recqty,
					"currRec": $rec,					
					"item_id": $id,
					"item_stat": $item_stat,
					"userid": $userid
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
	//				console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					//data response can contain what we want here...
//					console.log("Item saved "+data+"fully");
					}
				});
			}

								$("#rec_suc").text("Items received succesfully");
			$('#edit').delay(2000).fadeOut(2000);
			setTimeout(function(){
				$('#edit').modal("hide");
				window.location.href = '/home';
				}, 4500);	
					
		}
		else if($item_err<0){
			$item_stat='CLOSED';
//			console.log("Item error less than zero"+ $g+" counter "+c +" Item error"+$item_err);
			for(var d=0; d<$item_count; d++){
				var	$rec = Number($("input[name='item["+d+"][recqty]'").val())
				var $recqty = $rec + Number(rec_qty[d]);
				var	$id = $("input[name='item["+d+"][id]'").val();
//				console.log("Quantity received "+ $g+" counter "+d +" Item error"+$item_err);
			console.log("item id "+$id+" Receive quatity "+ $recqty );
//				console.log("Doc id "+$doc_id+" Item Status "+ $item_stat );
			$.ajax({
					type: 'GET',
					url: "/waybill/recitem",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"doc_id": $doc_id,
					"recqty": $recqty,
					"currRec": $rec,
					"item_id": $id,
					"item_stat": $item_stat,
					"userid": $userid
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
//					console.log("error on submit"+xhr);
					},
					success: function( data ){ 

					//data response can contain what we want here...
//					console.log("Item saved "+data+"fully");
					}
				});
			
			}
			$("#rec_suc").text("Items received succesfully");
			$('#edit').delay(2000).fadeOut(2000);
			setTimeout(function(){
				$('#edit').modal("hide");
				window.location.href = '/home';
				}, 4500);
		}
//		console.log("receive button clicked "+$item_err);	
return;
}
function loaddoc(){
	
	$.ajax({
					type: 'GET',
					url: "/waybill/loaddoc",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": $doc_id
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
	//				console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					//data response can contain what we want here...
//					console.log("Item saved "+data+"fully");
					$doc = data;
					}
				});
				return $doc;
				}
function recComplete(){
					$item_stat='CLOSED';
//			console.log("Item error less than zero"+ $g+" counter "+c +" Item error"+$item_err);
			for(var d=0; d<$item_count; d++){
				var	$rec = Number($("input[name='item["+d+"][recqty]'").val())
				var $recqty = $rec + Number(rec_qty[d]);
				var	$id = $("input[name='item["+d+"][id]'").val();
//				console.log("Quantity received "+ $g+" counter "+d +" Item error"+$item_err);
			console.log("item id "+$id+" Receive quatity "+ $recqty );
//				console.log("Doc id "+$doc_id+" Item Status "+ $item_stat );
			$.ajax({
					type: 'GET',
					url: "/waybill/recitem",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"doc_id": $doc_id,
					"recqty": $recqty,
					"currRec": $rec,
					"item_id": $id,
					"item_stat": $item_stat,
					"userid": $userid,
					"remText": $("#recRemText").val()
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
//					console.log("error on submit"+xhr);
					},
					success: function( data ){ 

					//data response can contain what we want here...
//					console.log("Item saved "+data+"fully");
					}
				});
			
			}
			$("#rec_suc").text("Items received succesfully");
			$('#edit').delay(2000).fadeOut(2000);
			setTimeout(function(){
				$('#edit').modal("hide");
				window.location.href = '/home';
				}, 4500);
}
function loadDept() {
	
$("#dept").empty();
$.ajax({
					type: 'GET',
					url: "/loaddepts",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"id": $("#company").val(),
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
					console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					//console.log(data + " Array Length "+ data.length);
					console.log('Request data for users '+ data);
					$.each(data, function(i, list){
						$("#dept").append(new Option(list.name, list.id))
					});
					
					}
				});
	
	
}
function recLoan(){
						
					if(($doc.wType=='LOAN' )&&($doc.ackcnt==0)){
						$item_stat = 'ACK';
					}
					else{
						$item_stat='CLOSED';
					}

//			console.log("Item error less than zero"+ $g+" counter "+c +" Item error"+$item_err);
			for(var d=0; d<$item_count; d++){
				var	$rec = Number($("input[name='item["+d+"][recqty]'").val())
				var $recqty = $rec + Number(rec_qty[d]);
				var	$id = $("input[name='item["+d+"][id]'").val();
//				console.log("Quantity received "+ $g+" counter "+d +" Item error"+$item_err);
			console.log("item id "+$id+" Receive quatity "+ $recqty );
//				console.log("Doc id "+$doc_id+" Item Status "+ $item_stat );
			$.ajax({
					type: 'GET',
					url: "/waybill/recitem",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"doc_id": $doc_id,
					"recqty": $recqty,
					"currRec": $rec,
					"item_id": $id,
					"item_stat": $item_stat,
					"userid": $userid,
					"remText": $("#recRemText").val()
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
//					console.log("error on submit"+xhr);
					},
					success: function( data ){ 

					//data response can contain what we want here...
//					console.log("Item saved "+data+"fully");
					}
				});
			
			}
			$("#rec_suc").text("Items received succesfully");
			$('#edit').delay(2000).fadeOut(2000);
			setTimeout(function(){
				$('#edit').modal("hide");
				window.location.href = '/home';
				}, 4500);
}
				
				
				});




$(function() {
    $(window).bind("load resize", function() {
        var topOffset = 50;
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    // var element = $('ul.nav a').filter(function() {
    //     return this.href == url;
    // }).addClass('active').parent().parent().addClass('in').parent();
    var element = $('ul.nav a').filter(function() {
        return this.href == url;
    }).addClass('active').parent();

    while (true) {
        if (element.is('li')) {
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }
});
