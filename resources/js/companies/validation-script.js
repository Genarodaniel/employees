$(document).ready(function($){
    $("#zipCode").mask("99999-999");
    $('#phone').mask("(99) 9999-9999?9");
    if($('#zipCode').length && $('#zipCode').val().replace(/[^\d]*/gi,'').length == 8){
        showFields();
    }

    $("#wage").maskMoney({decimal:",", thousands:".",precision: 2});
});

$('#zipCode').on('keyup',function(){
    if($('#zipCode').val().replace(/[^\d]*/gi,'').length == 8){
        $('#zipCode').attr('disabled',true);
        let url = $('#route').val();
        $.ajax({
            url: url,
            data:{'zipCode': $('#zipCode').val().replace(/[^\d]*/gi,'')},
            success: function(json) {
                $('#zipCode').attr('disabled',false);

                if(json.success){
                    setFieldsValue(json.data);
                    showFields();

                }else{
                    if(json.data.message != undefined){
                        showFields();

                    }
                }


            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('#zipCode').attr('disabled',false);
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
});

function showFields(){
    $('#div-street').show();
    $('#div-district').show();
    $('#div-city').show();
    $('#div-state').show();
}

function setFieldsValue(data){
    $('#street').val(data.logradouro);
    $('#district').val(data.bairro);
    $('#city').val(data.localidade);
    $('#state').val(data.uf);
}