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
$(document).ready( function(){
console.log("Javascript Ready");
$("#addRows").bind("hover click blur", function(){
console.log("clicked");
$("#tbody").append("<tr>
                                            <td><div class='col-lg-12'>{!! Form::text('item_desc','', array('class' => 'input-md emailinput form-control')); !!}</div></td>
                                            <td><div class='col-lg-6'>{!! Form::text('Quantity','', array('class' => 'input-md col-lg-2 emailinput form-control')); !!}</div></td>
                                            <td><div class='col-lg-10'>{!! Form::text('serialNo','', array('class' => 'input-md col-lg-2 emailinput form-control')); !!}</div></td>
                                            <td><div class='col-lg-10'>{!! Form::text('status','', array('class' => 'input-md col-lg-2 emailinput form-control')); !!}</div></td>
											<td><div class='col-lg-12'>{!! Form::text('remark','', array('class' => 'input-md col-lg-2 emailinput form-control')); !!}</div></td>			
                                        </tr>");
});


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
