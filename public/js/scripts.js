$(document).ready(function(){
    $('#specialtiesList').change(function(){
        id = $(this).val();

        $.ajax({
            url: public_path + '/professionals',
            data: {
                id: id
            },
            success: function(response){
                createCardProfessional(response.professionals);
            }
        });
    });
});

function createCardProfessional(professionals)
{
    $('.titleHidden').show();
    $('#dvDoctors').empty();
    for (i = 0; i < professionals.length; i++) {
        tratamento = professionals[i].tratamento != null ? professionals[i].tratamento : '';
        conselho = professionals[i].conselho != null ? professionals[i].conselho : '';
        documento_conselho = professionals[i].documento_conselho != null ? professionals[i].documento_conselho : '';

        image = professionals[i].foto != "" ? professionals[i].foto : "images/professional.png";

        card = "<div class='card cardProfessional'>"
            + " <div class='row'>"
            + "     <div class='col-md-4 center dvPhoto'>"
            + "         <img src='" + image + "' class='img-fluid imgPhoto'/>"
            + "     </div>"
            + "     <div class='col-md-8'>"
            + "         <div class='row'><div class='col-md-12 center'><b>" + tratamento + ' ' + professionals[i].nome + "</b></div></div>"
            + "         <div class='row'><div class='col-md-12 center'>" + conselho + ' ' + documento_conselho + "</div></div>"
            + "     </div>"
            + " </div>"
            + " <div class='row'><div class='col-md-12 center'>"
            + "     <a href='javascript:void(0)' class='btn btn-success btn-sm btnSchedule' id='" + professionals[i].profissional_id + "'>" + lang_agendar + "</a>"
            + " </div></div>"
            + "</div>";
        
        $('#dvDoctors').append(card);
    }
}