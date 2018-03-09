$(document).ready(function(){

    showForm();
    searchBirds();
    searchObservations();
    getLocation();
    datetimeObs();

    function showForm() {
        $button = $('.bouton-color-ajout');
        $remove = $('.btn-remove');
        $form = $('.form-observation');
        $form.hide();
        $remove.hide();

        $button.click(function(){
            $form.show();
            $remove.show();

        });

        $remove.click(function(){
            $form.hide();
            $remove.hide();
        });
    }


    function searchBirds()
    {

        $("#search").autocomplete({
            minLength: 3,
            source: function(request, response){
                $.ajax({
                    url: Routing.generate('search-bird'),
                    type: 'get',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        if (!data.length) {
                            var result = [
                                {
                                    label: 'Pas de resultat',
                                    value: response.term
                                }
                            ];
                            response(result);

                        }
                        else {
                            response($.map(data, function(item){
                                return {
                                    label: item.nomVern + ', ' + item.nomComplet,
                                    value: item.id,
                                }
                            }));
                        }
                        }

                });
            },
            select: function(event, ui) {
                event.preventDefault();
                console.log(ui.item);
                $("#search").val(ui.item.label);
                $(".data-observation").val(ui.item.value);
            },
            focus: function(event, ui) {
                event.preventDefault();
                $("#search").val(ui.item.label);
            }

        });
    }

    /**
     * Cherche en BDD un oiseau
     */
    function searchObservations()
    {

        $('#form-submit').submit(function(e){

            e.preventDefault();
            var searchVal = $('.data-holder').val();
            $.ajax({
                url: Routing.generate('search-observation', { id: searchVal, query: "true" }),
                success: function (result) {
                    $('.ajax-observation').html(result);
                }
            });
        });

        $(".searchTerm").autocomplete({
            minLength: 3,
            source: function(request, response){
                $.ajax({
                    url: Routing.generate('search-observation'),
                    type: 'get',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response($.map(data, function(item){
                            return {
                                label: item.nomVern + ', ' + item.nomValide,
                                value: item.id,
                            }
                        }));
                    }
                });
            },
            select: function(event, ui) {
                event.preventDefault();
                console.log(ui.item);
                $(".searchTerm").val(ui.item.label);
                $(".data-holder").val(ui.item.value);
            },
            focus: function(event, ui) {
                event.preventDefault();
                $(".searchTerm").val(ui.item.label);
            }

        });
    }

    var $latitude = $('.latitude');
    var $longitude = $('.longitude');

    function getLocation() {

        console.log($latitude);
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert('Pas de geolocalisation disponible');
        }
    }
    function showPosition(position) {
        $latitude.val(position.coords.latitude);
        $longitude.val(position.coords.longitude);
    }

    function datetimeObs()
    {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();

        if(dd<10) {
            dd = '0'+dd
        }

        if(mm<10) {
            mm = '0'+mm
        }

        today = yyyy + '-' + mm + '-' + dd;
        $(".datepicker").flatpickr({
            "locale": {
                "firstDayOfWeek": 1 // start week on Monday
            },
            "defaultDate": today
        });
    }

});