var gamo_survey = new function(){

    this.submit_survey = function(){

        var inputs = Core.get_inputs({
            holder: $('#submit-survey-form')
        });

        $.post('/?a=submit_survey&v=json', inputs, function(data){

            var result = $.parseJSON(data);

            if(result['error_msg'] != null){

                Core.modal({
                    msg: result['error_msg'],
                    alert: 'error'
                });

                return false;

            }
            else{

                Core.modal({
                    msg: "This survey has been submitted!",
                    alert: 'succes' 
                });

                //$('#submit-survey-form').find(':input').val('');

                /*pager.get({
                    holder: "#meeting-list-holder-pager"
                });*/
            }

            //$('survey-list-holder').html(html);

        });

    };

};

$(document).ready(function(){
    /*
    Core.reference['survey_actions_new'] = Core.unique_id();
    
    Core.functions[Core.reference['survey_actions_new']] = function(page, getter_id){

        gamo_survey.get_surveys({

            pager: "#survey-list-holder-page",
            page: page,
            getter_id: getter_id
        });

    };

    Core.functions[Core.reference['survey_actions_new']](1, Core.reference['survey_actions_new']);
    */

    $('#submit-survey').click(function() {
        
        gamo_survey.submit_survey();

    });

});
