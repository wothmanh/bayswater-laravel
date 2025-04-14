var left_side_width = 220; //Sidebar width in pixels
var vrnotesnum = document.getElementById('notesnum');
$(document).on('click','button.btn-danger',function(e){
    if (!confirm(" هل انت متأكد من الحذف ؟")) {
        e.preventDefault();
        return false;
    } 
})

setInterval(function(){
    $.ajax({
        url:base_url+"notes/on_notes",
        async:!1,
        type:"POST",
        data:"notes=all",
        dataType:"json",
        success:function(a){
            if (a.ntsnm) vrnotesnum.innerHTML= '<span class="displaynotifnum">'+a.ntsnm+'</span>';
        },
        error:function(){console.log("error")}
    })
}, 60000);


function loadnotifications(){
    $.ajax({
        url: base_url+"user/getnotifications",
        async: false,
        type: "POST",
        dataType: "json",
        success: function(data) {
            if (data['notis'] === 0) 
            {
                console.log('nothing');
            } else {
                
                
                bootbox.dialog({
                  title: "<i class='fa fa-bell-o'></i> My notification <span class='mynotisdt'> <span><i class='fa fa-calendar'></i> Date : "+data['notification']['date']+"</span> <span> <i class='glyphicon glyphicon-time'></i> Time : "+data['notification']['time']+" </span></span>",
                  message: "<div class='notibody2'><div class='mynotittl'>"+data['notification']['title']+"</div>"+
                            " <div class='mynotibdy'>"+data['notification']['body']+"</div></div>"
                });

            }
        }})
}

function filter_airp2(erthis) {
    ctis_id1 = $('#ctis_id1 option:selected').val();
    cntrie_id3 = $('#cntrie_id3 option:selected').val();
    window.location.href = base_url+"airports/index/"+cntrie_id3+"/"+ctis_id1+"/"+erthis.value;
}
function filter_airp3(erthis) {
    cntrie_id3 = $('#cntrie_id3 option:selected').val();
    window.location.href = base_url+"airports/index/"+cntrie_id3+"/"+erthis.value;
}
function filter_airp4(erthis) {
    window.location.href = base_url+"airports/index/"+erthis.value;
}


function filter_schls2(erthis) {
    ctis_id1 = $('#ctis_id1 option:selected').val();
    cntrie_id3 = $('#cntrie_id3 option:selected').val();
    window.location.href = base_url+"accommodation/index/"+cntrie_id3+"/"+ctis_id1+"/"+erthis.value;
}
function filter_ctrs3(erthis) {
    cntrie_id3 = $('#cntrie_id3 option:selected').val();
    window.location.href = base_url+"accommodation/index/"+cntrie_id3+"/"+erthis.value;
}
function filter_cts4(erthis) {
    window.location.href = base_url+"accommodation/index/"+erthis.value;
}
/* START */
//Courses
function filter_schls1(erthis) {
    ctis_id = $('#ctis_id option:selected').val();
    cntrie_id2 = $('#cntrie_id2 option:selected').val();
    window.location.href = base_url+"courses/index/"+cntrie_id2+"/"+ctis_id+"/"+erthis.value;
}
function filter_ctrs2(erthis) {
    cntrie_id2 = $('#cntrie_id2 option:selected').val();
    window.location.href = base_url+"courses/index/"+cntrie_id2+"/"+erthis.value;
}
function filter_cts3(erthis) {
    window.location.href = base_url+"courses/index/"+erthis.value;
}

//Addons
function filter_crsaddons1(erthis) {
    ctis_id = $('#ctis_id option:selected').val();
    cntrie_id2 = $('#cntrie_id2 option:selected').val();
    window.location.href = base_url+"courses_addons/index/"+cntrie_id2+"/"+ctis_id+"/"+erthis.value;
}
function filter_crsaddons2(erthis) {
    cntrie_id2 = $('#cntrie_id2 option:selected').val();
    window.location.href = base_url+"courses_addons/index/"+cntrie_id2+"/"+erthis.value;
}
function filter_crsaddons3(erthis) {
    window.location.href = base_url+"courses_addons/index/"+erthis.value;
}

//Family Options
function filter_crsfmlyoptn1(erthis) {
    ctis_id = $('#ctis_id option:selected').val();
    cntrie_id2 = $('#cntrie_id2 option:selected').val();
    window.location.href = base_url+"courses_family/index/"+cntrie_id2+"/"+ctis_id+"/"+erthis.value;
}
function filter_crsfmlyoptn2(erthis) {
    cntrie_id2 = $('#cntrie_id2 option:selected').val();
    window.location.href = base_url+"courses_family/index/"+cntrie_id2+"/"+erthis.value;
}
function filter_crsfmlyoptn3(erthis) {
    window.location.href = base_url+"courses_family/index/"+erthis.value;
}

//Exam Preparation
function filter_crsexm1(erthis) {
    ctis_id = $('#ctis_id option:selected').val();
    cntrie_id2 = $('#cntrie_id2 option:selected').val();
    window.location.href = base_url+"courses_exam/index/"+cntrie_id2+"/"+ctis_id+"/"+erthis.value;
}
function filter_crsexm2(erthis) {
    cntrie_id2 = $('#cntrie_id2 option:selected').val();
    window.location.href = base_url+"courses_exam/index/"+cntrie_id2+"/"+erthis.value;
}
function filter_crsexm3(erthis) {
    window.location.href = base_url+"courses_exam/index/"+erthis.value;
}

//Professional
function filter_crsprf1(erthis) {
    ctis_id = $('#ctis_id option:selected').val();
    cntrie_id2 = $('#cntrie_id2 option:selected').val();
    window.location.href = base_url+"courses_professional/index/"+cntrie_id2+"/"+ctis_id+"/"+erthis.value;
}
function filter_crsprf2(erthis) {
    cntrie_id2 = $('#cntrie_id2 option:selected').val();
    window.location.href = base_url+"courses_professional/index/"+cntrie_id2+"/"+erthis.value;
}
function filter_crsprf3(erthis) {
    window.location.href = base_url+"courses_professional/index/"+erthis.value;
}

//Premium
function filter_crsprm1(erthis) {
    ctis_id = $('#ctis_id option:selected').val();
    cntrie_id2 = $('#cntrie_id2 option:selected').val();
    window.location.href = base_url+"courses_premium/index/"+cntrie_id2+"/"+ctis_id+"/"+erthis.value;
}
function filter_crsprm2(erthis) {
    cntrie_id2 = $('#cntrie_id2 option:selected').val();
    window.location.href = base_url+"courses_premium/index/"+cntrie_id2+"/"+erthis.value;
}
function filter_crsprm3(erthis) {
    window.location.href = base_url+"courses_premium/index/"+erthis.value;
}


/* END */
function filter_ctrs1(erthis) {
    cntrie_id = $('#cntrie_id option:selected').val();
    window.location.href = base_url+"schools/index/"+cntrie_id+"/"+erthis.value;
}
function filter_cts2(erthis) {
    window.location.href = base_url+"schools/index/"+erthis.value;
}


function filter_cts(erthis) {
    window.location.href = base_url+"cities/index/"+erthis.value;
}



function filter_clients(erthis) {
    window.location.href = base_url+"clients/type/all/"+erthis.value;
}
function filter_clients_n(erthis) {
    window.location.href = base_url+"clients/type/new/"+erthis.value;
}
function filter_clients_pv(erthis) {
    window.location.href = base_url+"clients/type/paid_adv/"+erthis.value;
}
function filter_clients_p(erthis) {
    window.location.href = base_url+"clients/type/paid/"+erthis.value;
}





$(function() {
    "use strict";





/*    loadnotifications(); 
    setInterval(function(){
        loadnotifications();
    }, 10000);  // sleep 10 seconds make it 10 minutes
*/ 

















/*$(document.body).on('change', '#slc_city' ,function(e){
        e.preventDefault();
        var thiss = $(this);
        $.ajax({
            url: base_url+"fees_calculator/fees_get_centre",
            async: false,
            type: "POST",
            indexValue: thiss,
            data: "city_id="+sel.value,
            dataType: "json",
            success: function(rep) {    

                alert(rep);


            },
            error: function(){
                  alert('error');
            }
        })  
alert('yes');
    });
*/



/*client_name_new
client_name_paid
client_name_all
client_name_adv

client_phone_new
client_phone_paid
client_phone_all
client_phone_adv*/



$('#client_file_num_all').autocomplete({ 
    source: function( request, response ) {
        $.ajax({
            url : base_url+'clients/autocmpt',
            dataType: "json",
            data: {
               file_num: request.term,
               type: 'file_num'
            },
             success: function( data ) {
                 response( $.map( data, function( item ) {
                    return {
                        label: item,
                        value: item
                    }
                }));
            }
        });
    },
    autoFocus: true,
    minLength: 0        
  });



$('#client_name_all').autocomplete({ 
    source: function( request, response ) {
        $.ajax({
            url : base_url+'clients/autocmpt',
            dataType: "json",
            data: {
               last_name: request.term,
               type: 'lastname'
            },
             success: function( data ) {
                 response( $.map( data, function( item ) {
                    return {
                        label: item,
                        value: item
                    }
                }));
            }
        });
    },
    autoFocus: true,
    minLength: 0        
  });

$('#client_phone_all').autocomplete({ 
    source: function( request, response ) {
        $.ajax({
            url : base_url+'clients/autocmpt',
            dataType: "json",
            data: {
               phone: request.term,
               type: 'phone'
            },
             success: function( data ) {
                 response( $.map( data, function( item ) {
                    return {
                        label: item,
                        value: item
                    }
                }));
            }
        });
    },
    autoFocus: true,
    minLength: 0        
  });





$(document.body).on('click', '#clnt_srch_nph' ,function(e){
    e.preventDefault();
    var c_phone = $(this).prev('input').val();
    var c_file_num = $('input.file_num').val();
    var c_lname = $('input.srchbynme').val();
    var tst1 = false;

    if (c_phone != '') {
        tst1 = true;
    };
    if (c_lname != '') {
        tst1 = true;
    };
    if (c_file_num != '') {
        tst1 = true;
    };




    if (tst1) {
        $.ajax({
            url: base_url+"clients/search",
            async: false,
            type: "POST",
            data: "c_file_num="+c_file_num+"&c_phone="+c_phone+'&c_lname='+c_lname,
            dataType: "html",
            success: function(rep) {    

                $('#clients_table').html(rep);


            },
            error: function(){
                  alert('error');
            }
        })
    }; 

});




$(document.body).on('click', '#clnt_srcprnt' ,function(e){
    e.preventDefault();
    var usrsal = $('#usrs_idp').val();
    var tpclnt = $('#usrmdby').val();
    window.location.href = base_url+"clients/print_clients/"+tpclnt+"/"+usrsal;
});



















tinymce.init({
  selector:'textarea.ermce',
  height: 500,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],
  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
});


$('#timepicker1').timepicker({
                minuteStep: 1,
                showMeridian: false
            });


   $('#datepicker-autoclose, #datepicker-autoclose2').datepicker({
            autoclose: true,
            daysOfWeekDisabled: "0,2,3,4,5,6"
        });
   
     $('#nrmdatepicker, #nrmdatepicker2').datepicker({
            autoclose: true
        });
   

















// var doc = new jsPDF();
// var specialElementHandlers = {
//     '#pdfeditor': function (element, renderer) {
//         return true;
//     }
// };


// $("#print_it").on('click', function() {


//  doc.fromHTML($('#printable').html(), 15, 15, {
//         'elementHandlers': specialElementHandlers
//     });
//     doc.save('sample-file.pdf');



// });




$("#submitformclientifn").on('click', function(e) {
    e.preventDefault();
    var errsb = false;
    var first_nm = document.getElementById('first_name').value;
    var last_nm = document.getElementById('last_name').value;  
    var ecst = document.getElementById("slc_couse_weeks");
    var country_study = ecst.options[ecst.selectedIndex].value;

    if(first_nm == "") {
        if(last_nm == "") errsb = "<div class='calculatorErrors'>First name and Last name are required</div>";
        else errsb = "<div class='calculatorErrors'>First name is required</div>";
        //display errors scroll to the top and append them 
        document.getElementById('clinfoerrors').innerHTML = errsb;
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;  
    } 
    if(last_nm == "") {
        errsb = "<div class='calculatorErrors'>Last name is required</div>";
        //display errors scroll to the top and append them 
        document.getElementById('clinfoerrors').innerHTML = errsb;
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;  
    } 
    if (country_study == "") {
        errsb = "<div class='calculatorErrors'>Please complete Course options for this client or add him directly from Clients section</div>";
        //go back display errors scroll to the top and append them 
        document.getElementById('cropterrors').innerHTML = errsb;
        $('#client_input').hide();
        $('#course_input').show();
        $('#second_button1').hide();
        $('#first_button1').show();
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;  
    }
    $('#printable').html2canvas({
        onrendered: function (canvas) {
            //Set hidden field's value to image data (base-64 string)
            $('#pdf_get_valclient').val(canvas.toDataURL("image/png"));
            //Submit the form manually
            document.getElementById("myFormgetmypdfclient").submit();
        }
    });


});



$("#pdf_it").on('click', function() {

        $('#printable').html2canvas({
            onrendered: function (canvas) {
                //Set hidden field's value to image data (base-64 string)            
                $('#pdf_get_val').val(canvas.toDataURL("image/png"));
                //Submit the form manually
                document.getElementById("myFormgetmypdf").submit();
            }
        });

});


$("#print_it").on('click', function() {
    $("#printable").print({
        mediaPrint : true,
        // Use Global styles
        globalStyles : true,
        // Add link with attrbute media=print
        mediaPrint : false,
        //Custom stylesheet
        stylesheet : base_url2+'css/printcss.css',
        //Print in a hidden iframe
        iframe : true,
        // Don't print this
        noPrintSelector : ".avoid-this",
        // Add this at bottom
/*        prepend : wbstlogo,
        // Add this on top
        append : wbstfooter, */
        
        // Manually add form values
        manuallyCopyFormValues: true,
        // resolves after print and restructure the code for better maintainability
     //   deferred: $.Deferred(),
        // timeout
        timeout: 250,
        // Custom title
        title: null,
        // Custom document type
        doctype: '<!doctype html>'
    });
}); 

$("#print_clnt").on('click', function() {
    $("#printclntdv").print({
        mediaPrint : true,
        globalStyles : true,
        mediaPrint : false,
        stylesheet : base_url2+'css/printcss.css',
        iframe : true,
        noPrintSelector : ".printclnt",
        
        manuallyCopyFormValues: true,
        timeout: 250,
        title: null,
        doctype: '<!doctype html>'
    });
});


$("#print_clntall").on('click', function() {
    $("#prntcallby").print({
        mediaPrint : true,
        globalStyles : true,
        mediaPrint : false,
        stylesheet : base_url2+'css/printcss.css',
        iframe : true,
        noPrintSelector : ".printclnt",
        
        manuallyCopyFormValues: true,
        timeout: 250,
        title: null,
        doctype: '<!doctype html>'
    });
});



$(document.body).on('click', '#send_clntall' ,function(e){ 
    e.preventDefault();

    // var branch          = document.forms["erprntfrm"]["branch"].value;                       
    // var usrs              = document.forms["erprntfrm"]["usrs"].value;                   
    // var registered_type  = document.forms["erprntfrm"]["registered_type"].value;                              
    // var active        = document.forms["erprntfrm"]["active"].value;                         
    // var country      = document.forms["erprntfrm"]["country"].value;                           
    // var city         = document.forms["erprntfrm"]["city"].value;                        
    // var school       = document.forms["erprntfrm"]["school"].value;                        
    // var c_start  = document.forms["erprntfrm"]["c_start"].value;
    // var c_ends  = document.forms["erprntfrm"]["c_ends"].value;
    // var toemail  = document.forms["erprntfrm"]["toemail"].value;
    // var subject  = document.forms["erprntfrm"]["subject"].value;
    // var mydata = 'toemail='+toemail+'&subject='+subject+'&branch='+branch+'&usrs='+usrs+'&registered_type='+registered_type+'&active='+active+'&country='+country+'&city='+city+'&school='+school+'&c_start='+c_start+'&c_ends='+c_ends;                                                                                            



    


    var mydata = $('#qsdfezgger').serialize();

        $.ajax({
            url: base_url+"clients/email_clients_list",
            async: false,
            type: "POST",
            data: mydata,
            dataType: "html",
            success: function(rep) {    
               if (rep = 'yes') {
                    $('#send_clntall').hide();
                    $('#msgssldfsd').html('<div class="alert alert-success">Your email has been sent.</div>');
               }  
                else alert('Please try again');
            },
            error: function(){
                  alert('error');
            }
        })

});


$(document.body).on('click', '#send_emailtall' ,function(e){ 
    e.preventDefault();
    var mydata = $('#qsdfezgger').serialize();

        $.ajax({
            url: base_url+"clients/submit_send_emails",
            async: false,
            type: "POST",
            data: mydata,
            dataType: "html",
            success: function(rep) {    
               if (rep = 'yes') {
                    $('#send_emailtall').hide();
                    $('#msgssldfsd').html('<div class="alert alert-success">Your email has been sent.</div>');
               }  
                else alert('Please try again');
            },
            error: function(){
                  alert('error');
            }
        })

});













    //Enable sidebar toggle
    $("[data-toggle='offcanvas']").click(function(e) {
        e.preventDefault();

        //If window is small enough, enable sidebar push menu
        if ($(window).width() <= 992) {
            $('.row-offcanvas').toggleClass('active');
            $('.left-side').removeClass("collapse-left");
            $(".right-side").removeClass("strech");
            $('.row-offcanvas').toggleClass("relative");
        } else {
            //Else, enable content streching
            $('.left-side').toggleClass("collapse-left");
            $(".right-side").toggleClass("strech");
        }
    });

    //Add hover support for touch devices
    $('.btn').bind('touchstart', function() {
        $(this).addClass('hover');
    }).bind('touchend', function() {
        $(this).removeClass('hover');
    });

    //Activate tooltips
    $("[data-toggle='tooltip']").tooltip();



    /*
     * ADD SLIMSCROLL TO THE TOP NAV DROPDOWNS
     * ---------------------------------------
     */
    $(".navbar .menu").slimscroll({
        height: "200px",
        alwaysVisible: false,
        size: "3px"
    }).css("width", "100%");

    /*
     * INITIALIZE BUTTON TOGGLE
     * ------------------------
     */
    $('.btn-group[data-toggle="btn-toggle"]').each(function() {
        var group = $(this);
        $(this).find(".btn").click(function(e) {
            group.find(".btn.active").removeClass("active");
            $(this).addClass("active");
            e.preventDefault();
        });

    });

    $("[data-widget='remove']").click(function() {
        //Find the box parent        
        var box = $(this).parents(".box").first();
        box.slideUp();
    });

    /* Sidebar tree view */
    $(".sidebar .treeview").tree();

    /* 
     * Make sure that the sidebar is streched full height
     * ---------------------------------------------
     * We are gonna assign a min-height value every time the
     * wrapper gets resized and upon page load. We will use
     * Ben Alman's method for detecting the resize event.
     * 
     **/
    function _fix() {
        //Get window height and the wrapper height
        var height = $(window).height() - $("body > .header").height() - ($("body > .footer").outerHeight() || 0);
        $(".wrapper").css("min-height", height + "px");
        var content = $(".wrapper").height();
        //If the wrapper height is greater than the window
        if (content > height)
            //then set sidebar height to the wrapper
            $(".left-side, html, body").css("min-height", content + "px");
        else {
            //Otherwise, set the sidebar to the height of the window
            $(".left-side, html, body").css("min-height", height + "px");
        }
    }
    //Fire upon load
    _fix();
    //Fire when wrapper is resized
    $(".wrapper").resize(function() {
        _fix();
        fix_sidebar();
    });

    //Fix the fixed layout sidebar scroll bug
    fix_sidebar();

    /*
     * We are gonna initialize all checkbox and radio inputs to 
     * iCheck plugin in.
     * You can find the documentation at http://fronteed.com/iCheck/
     */


});
function fix_sidebar() {
    //Make sure the body tag has the .fixed class
    if (!$("body").hasClass("fixed")) {
        return;
    }

    //Add slimscroll
    $(".sidebar").slimscroll({
        height: ($(window).height() - $(".header").height()) + "px",
        color: "rgba(0,0,0,0.2)"
    });
}


/*
 * SIDEBAR MENU
 * ------------
 * This is a custom plugin for the sidebar menu. It provides a tree view.
 * 
 * Usage:
 * $(".sidebar).tree();
 * 
 * Note: This plugin does not accept any options. Instead, it only requires a class
 *       added to the element that contains a sub-menu.
 *       
 * When used with the sidebar, for example, it would look something like this:
 * <ul class='sidebar-menu'>
 *      <li class="treeview active">
 *          <a href="#>Menu</a>
 *          <ul class='treeview-menu'>
 *              <li class='active'><a href=#>Level 1</a></li>
 *          </ul>
 *      </li>
 * </ul>
 * 
 * Add .active class to <li> elements if you want the menu to be open automatically
 * on page load. See above for an example.
 */
(function($) {
    "use strict";

    $.fn.tree = function() {

        return this.each(function() {
            var btn = $(this).children("a").first();
            var menu = $(this).children(".treeview-menu").first();
            var isActive = $(this).hasClass('active');

            //initialize already active menus
            if (isActive) {
                menu.show();
                btn.children(".fa-angle-left").first().removeClass("fa-angle-left").addClass("fa-angle-down");
            }
            //Slide open or close the menu on link click
            btn.click(function(e) {
                e.preventDefault();
                if (isActive) {
                    //Slide up to close menu
                    menu.slideUp();
                    isActive = false;
                    btn.children(".fa-angle-down").first().removeClass("fa-angle-down").addClass("fa-angle-left");
                    btn.parent("li").removeClass("active");
                } else {
                    //Slide down to open menu
                    menu.slideDown();
                    isActive = true;
                    btn.children(".fa-angle-left").first().removeClass("fa-angle-left").addClass("fa-angle-down");
                    btn.parent("li").addClass("active");
                }
            });

            /* Add margins to submenu elements to give it a tree look */
            menu.find("li > a").each(function() {
                var pad = parseInt($(this).css("margin-left")) + 10;

                $(this).css({"margin-left": pad + "px"});
            });

        });

    };


}(jQuery));



/*!
 * SlimScroll https://github.com/rochal/jQuery-slimScroll
 * =======================================================
 * 
 * Copyright (c) 2011 Piotr Rochala (http://rocha.la) Dual licensed under the MIT 
 */
(function(f) {
    jQuery.fn.extend({slimScroll: function(h) {
            var a = f.extend({width: "auto", height: "250px", size: "7px", color: "#000", position: "right", distance: "1px", start: "top", opacity: 0.4, alwaysVisible: !1, disableFadeOut: !1, railVisible: !1, railColor: "#333", railOpacity: 0.2, railDraggable: !0, railClass: "slimScrollRail", barClass: "slimScrollBar", wrapperClass: "slimScrollDiv", allowPageScroll: !1, wheelStep: 20, touchScrollStep: 200, borderRadius: "0px", railBorderRadius: "0px"}, h);
            this.each(function() {
                function r(d) {
                    if (s) {
                        d = d ||
                                window.event;
                        var c = 0;
                        d.wheelDelta && (c = -d.wheelDelta / 120);
                        d.detail && (c = d.detail / 3);
                        f(d.target || d.srcTarget || d.srcElement).closest("." + a.wrapperClass).is(b.parent()) && m(c, !0);
                        d.preventDefault && !k && d.preventDefault();
                        k || (d.returnValue = !1)
                    }
                }
                function m(d, f, h) {
                    k = !1;
                    var e = d, g = b.outerHeight() - c.outerHeight();
                    f && (e = parseInt(c.css("top")) + d * parseInt(a.wheelStep) / 100 * c.outerHeight(), e = Math.min(Math.max(e, 0), g), e = 0 < d ? Math.ceil(e) : Math.floor(e), c.css({top: e + "px"}));
                    l = parseInt(c.css("top")) / (b.outerHeight() - c.outerHeight());
                    e = l * (b[0].scrollHeight - b.outerHeight());
                    h && (e = d, d = e / b[0].scrollHeight * b.outerHeight(), d = Math.min(Math.max(d, 0), g), c.css({top: d + "px"}));
                    b.scrollTop(e);
                    b.trigger("slimscrolling", ~~e);
                    v();
                    p()
                }
                function C() {
                    window.addEventListener ? (this.addEventListener("DOMMouseScroll", r, !1), this.addEventListener("mousewheel", r, !1), this.addEventListener("MozMousePixelScroll", r, !1)) : document.attachEvent("onmousewheel", r)
                }
                function w() {
                    u = Math.max(b.outerHeight() / b[0].scrollHeight * b.outerHeight(), D);
                    c.css({height: u + "px"});
                    var a = u == b.outerHeight() ? "none" : "block";
                    c.css({display: a})
                }
                function v() {
                    w();
                    clearTimeout(A);
                    l == ~~l ? (k = a.allowPageScroll, B != l && b.trigger("slimscroll", 0 == ~~l ? "top" : "bottom")) : k = !1;
                    B = l;
                    u >= b.outerHeight() ? k = !0 : (c.stop(!0, !0).fadeIn("fast"), a.railVisible && g.stop(!0, !0).fadeIn("fast"))
                }
                function p() {
                    a.alwaysVisible || (A = setTimeout(function() {
                        a.disableFadeOut && s || (x || y) || (c.fadeOut("slow"), g.fadeOut("slow"))
                    }, 1E3))
                }
                var s, x, y, A, z, u, l, B, D = 30, k = !1, b = f(this);
                if (b.parent().hasClass(a.wrapperClass)) {
                    var n = b.scrollTop(),
                            c = b.parent().find("." + a.barClass), g = b.parent().find("." + a.railClass);
                    w();
                    if (f.isPlainObject(h)) {
                        if ("height"in h && "auto" == h.height) {
                            b.parent().css("height", "auto");
                            b.css("height", "auto");
                            var q = b.parent().parent().height();
                            b.parent().css("height", q);
                            b.css("height", q)
                        }
                        if ("scrollTo"in h)
                            n = parseInt(a.scrollTo);
                        else if ("scrollBy"in h)
                            n += parseInt(a.scrollBy);
                        else if ("destroy"in h) {
                            c.remove();
                            g.remove();
                            b.unwrap();
                            return
                        }
                        m(n, !1, !0)
                    }
                } else {
                    a.height = "auto" == a.height ? b.parent().height() : a.height;
                    n = f("<div></div>").addClass(a.wrapperClass).css({position: "relative",
                        overflow: "hidden", width: a.width, height: a.height});
                    b.css({overflow: "hidden", width: a.width, height: a.height});
                    var g = f("<div></div>").addClass(a.railClass).css({width: a.size, height: "100%", position: "absolute", top: 0, display: a.alwaysVisible && a.railVisible ? "block" : "none", "border-radius": a.railBorderRadius, background: a.railColor, opacity: a.railOpacity, zIndex: 90}), c = f("<div></div>").addClass(a.barClass).css({background: a.color, width: a.size, position: "absolute", top: 0, opacity: a.opacity, display: a.alwaysVisible ?
                                "block" : "none", "border-radius": a.borderRadius, BorderRadius: a.borderRadius, MozBorderRadius: a.borderRadius, WebkitBorderRadius: a.borderRadius, zIndex: 99}), q = "right" == a.position ? {right: a.distance} : {left: a.distance};
                    g.css(q);
                    c.css(q);
                    b.wrap(n);
                    b.parent().append(c);
                    b.parent().append(g);
                    a.railDraggable && c.bind("mousedown", function(a) {
                        var b = f(document);
                        y = !0;
                        t = parseFloat(c.css("top"));
                        pageY = a.pageY;
                        b.bind("mousemove.slimscroll", function(a) {
                            currTop = t + a.pageY - pageY;
                            c.css("top", currTop);
                            m(0, c.position().top, !1)
                        });
                        b.bind("mouseup.slimscroll", function(a) {
                            y = !1;
                            p();
                            b.unbind(".slimscroll")
                        });
                        return!1
                    }).bind("selectstart.slimscroll", function(a) {
                        a.stopPropagation();
                        a.preventDefault();
                        return!1
                    });
                    g.hover(function() {
                        v()
                    }, function() {
                        p()
                    });
                    c.hover(function() {
                        x = !0
                    }, function() {
                        x = !1
                    });
                    b.hover(function() {
                        s = !0;
                        v();
                        p()
                    }, function() {
                        s = !1;
                        p()
                    });
                    b.bind("touchstart", function(a, b) {
                        a.originalEvent.touches.length && (z = a.originalEvent.touches[0].pageY)
                    });
                    b.bind("touchmove", function(b) {
                        k || b.originalEvent.preventDefault();
                        b.originalEvent.touches.length &&
                                (m((z - b.originalEvent.touches[0].pageY) / a.touchScrollStep, !0), z = b.originalEvent.touches[0].pageY)
                    });
                    w();
                    "bottom" === a.start ? (c.css({top: b.outerHeight() - c.outerHeight()}), m(0, !0)) : "top" !== a.start && (m(f(a.start).position().top, null, !0), a.alwaysVisible || c.hide());
                    C()
                }
            });
            return this
        }});
    jQuery.fn.extend({slimscroll: jQuery.fn.slimScroll})
})(jQuery);

