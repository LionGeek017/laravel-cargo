/* Iframe Map */
function iframeMap(options) {
    return '<iframe id="mod-directions-map-active-iframe" width="100%" height="400px" frameborder="0" style="padding-bottom: 31px" ' +
        'src="https://www.google.com/maps/embed/v1/' + options + '&amp;key="></iframe>';
}
/* Not Iframe Map */
/* Show Contacts */
function showContacts(cardId, cardCode, cardTable) {
    let cardTableUpper = cardTable.charAt(0).toUpperCase() + cardTable.substr(1);
    let url = 'showContacts' + cardTableUpper;

    $.ajax({
        type: 'GET',
        url: '/api/database.'+url,
        data: {
            'id': cardId,
            'code': cardCode
        },
        dataType: 'json',
        success: function(res) {
            if(res.result == 'ok') {
                $('#modal-contacts').modal({
                    show: true
                });
                $('#modal_contact_name').text(res.name);
                if(res.phone != '') {
                    $('#modal_contact_phone').text(res.phone);
                    $('#modal_contact_phone_button').css('display', 'block').attr('href', 'tel:' + res.phone);
                }
                //console.log('ok');
            } else if(res.result == 'subscribe') {
                $('#modal-subscribe').modal({
                    show: true
                });
                //console.log('no');
            }
        },
        error: function() {
            console.log('Что-то пошло не так!');
        }
    });
}
/* Not Show Contacts*/
/* Show Map Directions */
function showMapDirections(origin, destination) {
    let iframe = iframeMap('directions?origin=' + origin + '&amp;destination=' + destination);
    $('#modal-map').find('.iframe-map').html(iframe);
}
/* Not Show Map Directions */
/* Show Map Locations */
function showMapLocations(coordinates) {
    let iframe = iframeMap('place?q=' + coordinates);
    $('#modal-map').find('.iframe-map').html(iframe);
}
/* Not Show Map Directions */

$(document).ready(function() {

    /* Ajax regions and cities */
    $('#select_country_id_from, #select_country_id_to, #select_country_id').change(function() {
        loadRegions(this);
    });

    $('#select_region_id_from, #select_region_id_to, #select_region_id').change(function() {
        loadCities(this);
    });

    function loadRegions(elem) {
        let blockId = $(elem).attr('id');
        let cityIdBlock = blockId.replace('country', 'city');
        let countryId = $(elem).find('option:selected').val();
        let childId = $(elem).attr('data-child');
        let url = 'getRegions?country_id='+countryId;

        oneOption($('#' + cityIdBlock));
        ajaxGet(url, childId);
    }

    function loadCities(elem) {
        let blockId = $(elem).attr('id');
        let countryIdBlock = blockId.replace('region', 'country');
        let countryId = $('#' + countryIdBlock).find('option:selected').val();
        let regionId = $(elem).find('option:selected').val();
        let childId = $(elem).attr('data-child');

        let url = 'getCities?region_id='+regionId+'&country_id='+countryId;
        ajaxGet(url, childId);
    }

    function ajaxGet(url, childId) {
        let select = $('#' + childId);
        oneOption(select, 'Загрузка...');
        select.prop('disabled', true);

        $.ajax({
            type: 'GET',
            url: '/api/database.'+url,
            dataType: 'json',
            success: function(res) {
                oneOption(select);

                for(let i = 0; i < res.length; i++) {
                    //select.append('<option value="'+res[i]['id']+'">'+res[i]['name']+'</option>');
                    select.append(new Option(res[i]['name'], res[i]['id']))
                }
                select.prop('disabled', false);
            },
            error: function() {
                console.log('Что-то пошло не так!');
            }
        });

    }

    function oneOption(select, text = null) {
        select
            .find('option')
            .remove()
            .end()
            .append(new Option(text ?? select.attr('data-title'), 0));
    }
    /* Not ajax regions and cities */

    /* New active country top site */
    $('.list-countries-top a').click(function() {
        event.preventDefault();
        let code = $(this).attr('data-code');
        let name = $(this).find('span').text();

        $('.country-active-a').attr('data-code', code);
        $('.country-active-a .country-active-img').attr('src', '/img/icons/flags/'+code+'.svg');
        $('.country-active-a .country-active-name').text(name);
        $('.country-active-a .country-active-code').text(code.toUpperCase());

        console.log(code);

        $.ajax({
            type: 'GET',
            url: '/new-country',
            data: {
                'code': code
            },
            dataType: 'json',
            success: function(res) {
                console.log(res);
                location.reload();
            },
            error: function() {
                console.log('Что-то пошло не так!');
            }
        });
    });
    /* Not new active country */
});
