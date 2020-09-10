



jQuery(document).ready(function($) {



    $('.my-color-field').wpColorPicker();

    

    $('.upload-btn').click(function() {



    var multiple = $(this).attr('data-multiple');

    var lib_type = $(this).attr('data-type');

    var many = multiple == 'true' ? true : false;

    var target = $(this).attr('data-target');

    var images_target = $(this).attr('data-images');

    

    var gallery_window = wp.media({

        title: 'Select',

        library: { type: lib_type },

        multiple: many,

        button: { text: 'SELECT' }

    });





    gallery_window.on('select',function(){



        var user_selection = gallery_window.state().get('selection').toJSON();

        var toappend = '';

        var selected = [];



        var g = $(target).val();

        if (many && g != '') {

            var selected = g.split(',');

        }

        console.log(user_selection);

        for(var i=0;i<user_selection.length;i++){



            if (lib_type == 'image') {

                selected.push(user_selection[i]['id']);

                var thumb_url = user_selection[i]['sizes']['thumbnail']['url'];

                var url = user_selection[i]['sizes']['full']['url'];



                toappend += '<span rel="'+user_selection[i]['id']+'"><a href="'+user_selection[i]['id']+'">X</a><img src="'+thumb_url+'" width="145" height="145"></span>';

            } else if ( lib_type == 'video') {

                var url = user_selection[i]['url'];

            }



        }



        var g_ids = selected.join();

        if (many==false) {

            var data = url;

        } else {

            var data = g_ids;

        }

        console.log(data);

        $(target).val(data);

        $(images_target).append(toappend);

    });





    gallery_window.open();



    });



    function get_sort(target){

        var p_ids = [];

        console.log(target);

        $(target).find('span').each(function(){

                var p_id = $(this).attr('rel');

                var input_target = $(this).parent().attr('input-target');

                p_ids.push(p_id);

                var imgs = p_ids.join();

                console.log(input_target);

                $(input_target).val(imgs);

                //console.log(imgs);

            })

    }

    

    $( ".sortable-images" ).sortable({

        update: function( event, ui ) {

            var target = $(this);

            get_sort(target);

        }

    });

    

    $( ".sortable-images" ).disableSelection();



    $('.sortable-images span a').on('click',function(e){

        e.preventDefault();

        var target = $(this).parent().parent();

        var input_target = target.attr('input-target');

        $(this).parent().remove();

        $(input_target).val('');

        get_sort(target);

    });



});



