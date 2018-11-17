$(document).ready(function (){    
    $("#start_date, #end_date").datepicker({
        orientation: 'auto bottom',
        format: 'yyyy-mm-dd',
        clearBtn: true,
        autoclose: true,
        todayHighlight: true
    });

    $.validator.addMethod("end_date", function(value, element) {
        return $('#start_date').val() != $('#end_date').val()
    },"* Start Date and End Date should not equal.");

    var form = $("#frm_partner");
    var validator = form.validate({
         onkeyup: false,
         errorClass: 'error',
         validClass: 'valid',
         rules: {
             user_name: {
                required: true,
                 remote:
                {
                    type: 'POST',
                    url:  app_url + '/api/prt/user_name_exist',
                    data: {'user_id':$('#user_id').val(), '_token': $('input[name=_token]').val()},
                    async: false
                }
             },
             password: {
                required: true,
                minlength:6,
                maxlength:8
             },
             franchise_id: {
                 required: true
             },
             subscription_id: {
                 required: true
             },
             partner_name: {
                 required: true
             },
             company_name: {
                 required: true
             },
             mobile_number: {
                 minlength:10,
                 maxlength:10,
                 remote:
                    {
                        type: 'POST',
                        url:  app_url + '/api/prt/user_mobile_exist',
                        data: {'partner_id':$('#id').val(), '_token': $('input[name=_token]').val()},
                        async: false
                    }
             },
             phone_number: {
                 minlength:5
             },
             email: {
                 email:true,
                  /* remote:
                    {
                        type: 'POST',
                        url:  app_url + '/api/prt/user_email_exist',
                        data: {'partner_id':$('#id').val(), '_token': $('input[name=_token]').val()},
                        async: false
                    }*/
             },
             state: {
                 required: true
             },
             city: {
                 required: true
             },
             area: {
                 required: true
             },
             deposit_amount: {
                 required: true
             },            
             otp: {
                required: true,
                remote:
                {
                    type: 'POST',
                    url:  app_url + '/api/prt/otp_check',
                    data: {'user_id':$('#user_id').val(), '_token': $('input[name=_token]').val()},
                    async: false
                }
             },
             subscription_id: {
                required: true
             }
         },
         messages: {
             user_name: {
                 required: 'User Name is required',
                 remote : 'User Name already exists.'
             },
             password: {
                 required: 'Password is required'
             },
             franchise_id: {
                 required: 'Franchise Name is required'
             },
             subscription_id: {
                 required: 'Subscription Name is required'
             },
             partner_name: {
                 required: 'Partner Name is required'
             },
             company_name: {
                 required: 'Company Name is required'
             },
             mobile_number: {
                required: 'Mobile number is required',
                remote : ' Mobile already exists.'
             },
             /*email: {
                required: 'Email is required',
                remote : 'Email already exists.'
             },*/
             state: {
                 required: 'State is required'
             },
             city: {
                 required: 'City is required'
             },
             area: {
                 required: 'Area is required'
             },
             deposit_amount: {
                 required: 'Deposit Amount is required'
             },             
             otp: {
                required: 'OTP is required',
                remote: 'OTP is Invalid'
             },
             subscription_id: {
                required: 'Please select your subscription plan'
             }
         },
         highlight: function (element) {
             $(element).closest('div').addClass("f_error");
         },
         unhighlight: function (element) {
             $(element).closest('div').removeClass("f_error");
         },
         errorPlacement: function (error, element) {            
             $(element).closest('div').append(error);
         }
     }); 

    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex)
        {
            if(form.valid() && newIndex==1) {
                fnPartnerStore();
            }
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function (event, currentIndex)
        {             
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
            fnPartnerSubscription();
            //window.frm_partner.submit();
        }
    });

});

window.onload = function () {
//Check File API support
    if (window.File && window.FileList && window.FileReader)
    {
        $('#logo').on("change", function (event) {
            var files = event.target.files; //FileList object
            var output = document.getElementById("result");
            for (var i = 0; i < files.length; i++)
            {
                var file = files[i];
                //Only pics
                // if(!file.type.match('image'))
                if (file.type.match('image.*')) {
                    if (this.files[0].size < 2097152) {
                        // continue;
                        var picReader = new FileReader();
                        picReader.addEventListener("load", function (event) {
                            var picFile = event.target;
                            var div = document.createElement("div");
                            div.innerHTML = "<img class='thumb' src='" + picFile.result + "'" +
                                    "title='preview image' width='100' />";
                            output.insertBefore(div, null);
                        });
                        //Read the image
                        $('#clear, #result').show();
                        picReader.readAsDataURL(file);
                    } else {
                        alert("Image Size is too big. Minimum size is 2MB.");
                        $(this).val("");
                    }
                } else {
                    alert("You can only upload image file.");
                    $(this).val("");
                }
            }
        });


        //Cross Cheque Image Validation(Author:Surya-22Nov)
        $('#cross_cheque').on("change", function (event) {
            var files = event.target.files; //FileList object
            var output = document.getElementById("cheque_result");
            for (var i = 0; i < files.length; i++)
            {
                var file = files[i];
                    if (this.files[0].size < 2097152) {
                        // continue;
                        var picReader = new FileReader();
                        picReader.addEventListener("load", function (event) {
                            var picFile = event.target;
                            var div = document.createElement("div");
                            //div.innerHTML = "<img class='cheque_thumb' src='" + picFile.result + "'" +
                                    "title='preview image' width='100' />";
                            output.insertBefore(div, null);
                        });
                        //Read the image
                        //$('#cheque_clear, #cheque_result').show();
                        picReader.readAsDataURL(file);
                    } else {
                        alert("Image Size is too big. Minimum size is 2MB.");
                        $(this).val("");
                    }
            }
        });

    } else
    {
        console.log("Your browser does not support File API");
    }
}


$('#logo').on("click", function () {
    $('.thumb').parent().remove();
    $('result').hide();
    $(this).val("");
});

$('#clear').on("click", function () {
    $('.thumb').parent().remove();
    $('#result').hide();
    $('#logo').val("");
    $(this).hide();
});


function statetocity(){
    $('#img-loading1').show();
    $("#area_list").show();
    $("#apartment_list").show();
    $("#area").html("");
    $("#apartment").html("");
    var state_id = $("#state").val();
    $.ajax({
        url : app_url + '/api/part/customer/statetocity',
        data : {"state_id":state_id,'_token':$('input[name=_token]').val()},
        success:function(data){
          $('#img-loading1').hide();
          $("#city_list").remove();
          $("#city_data").show();
          $("#city_data").html(data);             
        }
    });
}

function citytoarea(value){
    $('#img-loading2').show();
    $("#apartment").empty();
    $.ajax({
        url : app_url + '/api/part/customer/citytoarea',
        data : {"city_id":value,'_token':$('input[name=_token]').val()},
        success:function(data){
          $('#img-loading2').hide();
          $("#area_list").remove();
          $("#area_data").show();
          $("#area_data").html(data);             
        }
    });
}  

function areatoapartment(value){
    $('#img-loading3').show();
    var values = {
        selected: [],
        unselected:[]
    };
  
    $("#area option").each(function(){
        values[this.selected ? 'selected' : 'unselected'].push(this.value);
    });

    $.ajax({
        url : app_url + '/api/part/customer/areatoapartment',
        data : {"area_id":values.selected,'_token':$('input[name=_token]').val()},
        success:function(data){
          $('#img-loading3').hide();
          $("#apartment_list").remove();
          $("#apartment_data").show();
          $("#apartment_data").html(data);             
        }
    });
}

function fnPartnerStore() {
    var form = $('#frm_partner');
    $.ajax({
        url : app_url + '/api/partner/store',
        type: 'post',
        data : form.serialize(),
        success:function(data){

        }
    });
}

function fnPartnerSubscription() {
    var subscription_id = $('#subscription_id').val();
    var mobile_number = $('#mobile_number').val();
    $.ajax({
        url : app_url + '/api/partner/subscription_store',
        type: 'post',
        data : {"subscription_id":subscription_id, "mobile_number":mobile_number, '_token':$('input[name=_token]').val()},
        success:function(data){
            if(data=='success') {
                alert('Partner has been added successfully.');
                window.location.reload();
            }
        }
    });
}