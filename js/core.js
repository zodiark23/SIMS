$(document).ready(function(){


/**************************
 * SCHOOL LEVEL JS
 **************************/

/**
 * Process the submit differently
 *
 * - Get data on school levels and validate it store all values processed on variable `data`
 * - Proceed with submission if there's no errors found
 */
$("#submit-educational").on("click", function(){
    var curr_id = $(this).data('curr-id');

    var data = [];
    var isValid = true;
    var levelsCount = 0; //used to check if levels matchs the duration
    var duration = 0;
    $("#edu_setup input").each(function(){
        var name = $(this).attr('name');
        var value = $(this).val();


        if(name == "description"){
            if(value.length < 4){
                alert("Description must be at least 4 characters");
                $("#description").focus();
                isValid = false;
                return false;
            }
        }else if(name = "duration"){
            if( value.length == 0){
                alert("Duration is required");
                $("#duration").focus();
                isValid = false;
                return false;
            }else if( isNaN(value)){
                alert("Please enter a valid number");
                $("#duration").focus();
                isValid = false;
                return false;
            }else{
                duration = value;
            }
        }

        // push the data to our array

        data.push({"name" : name , "value" : value});
    });


    $("#school-level-form input[type='text']").each(function(){
        var value = $(this).val();
        var name = $(this).attr('name');
        if(value.length < 1){
            //alert only if valid to prevent overriding upper functions
            if(isValid){
                alert("School Level is required.");
                $(this).focus();
                isValid = false;
                return false;
            }
        }else{
            // add it to the array
            data.push({"name":name , "value" : value});
        }

        levelsCount++;

    });


    if(levelsCount != duration && isValid){
            alert("Durational years does not match the levels count");
            isValid = false;
    }

    if(curr_id){
        data.push({"name" : "action", "value" : "save"});
        data.push({"name" : "curr_id", "value" : curr_id});
    }else{
        data.push({"name" : "action", "value" : "create"});
    }

    console.log(curr_id, data);


    if(isValid){

        $.ajax({
            "url" : BASE_URL+"/php/manage_educational.php",
            "type": "post",
            "data" : data,
            "success" : function(data){
                x = JSON.parse(data);
                console.log(x);
                if(x.code == "00"){
                    alert(x.message);
                    window.location = BASE_URL+"/admin/education";
                }else{
                    alert(x.message);
                }
            }
        });
    }
});

$("#add_school_level").on("click", function(){

    var toAppend = "<tr><td><span class='input input--hoshi'><input class='input__field input__field--hoshi' type='text' class='level_item' data-id='' name='level_name[]'><label class='input__label input__label--hoshi input__label--hoshi-color-1' for='level_item'><span class='input__label-content input__label-content--hoshi'>Level Name</span></label></span><button type='button' class='del-school-level util-btn'><img src='"+BASE_URL+"/img/trash_icon.png' /></button></td></tr>";

    $("#school-level-form table").append(toAppend);


    runClassieInput();

});

$("body").on("click",".del-school-level", function(){
    $(this).parents("tr").remove();
});

$("#publish-educational").on("click", function(){
    var curr_id = $(this).data('curr-id');

    var c = confirm("Publishing this will disable any further changes. Do you want to continue?");
    if(c == true){

        $.ajax({
            "url" : BASE_URL+"/php/publish_educational.php",
            "type": "post",
            "data" : "curr_id="+curr_id,
            "success" : function(data){
                x = JSON.parse(data);

                if(x.code == "00"){
                    alert(x.message);
                    location.reload();
                }else{
                    alert(x.message);
                }
            }
        });
    }
});



$("#create-subject-form").on('submit', function(){
    var data = "";
    var hasErrors = 0;

    $(this).find("[name]").each(function(){
        var name = $(this).attr('name');

        var value = $(this).val();

        if(name == "subject_name"){
            if(value.length < 1){
                hasErrors++;
                alert("Please enter a subject name");
                return false;
            }

        }
        if(name == "curr"){
            if(value == null){
                hasErrors++;
                alert("Please select a curriculum");
                return false;
            }else if(value.length <= 0){
                hasErrors++;

            }
        }



    });

    if(hasErrors == 0){
        data = $(this).serialize();
        $.ajax({
            url : BASE_URL+"/php/create_subject.php",
            type : "post",
            data : data,
            success : function(data){
                x = JSON.parse(data);

                if(x.code == "00"){
                    alert(x.message);
                    window.location = BASE_URL+"/admin/subject-list";

                }else{
                    alert(x.message);
                }
            }
        });
    }

    return false;
});

$("#edit-subject-form").on('submit', function(){
    var data = "";
    var hasErrors = 0;
    $(this).find("[name]").each(function(){
        var name = $(this).attr('name');

        var value = $(this).val();

        if(name == "subject_name"){
            if(value.length < 0){
                hasErrors++;
            }

        }
        if(name == "curr"){
            if(value.length <= 0){
                hasErrors++;
            }
        }



    });

    if(hasErrors == 0){
        data = $(this).serialize();
        target = $(this).data('s-id');
        data = data+"&id="+target;

        $.ajax({
            url : BASE_URL+"/php/update_subject.php",
            type : "post",
            data : data,
            success : function(data){
                x = JSON.parse(data);

                if(x.code == "00"){
                    alert(x.message);
                    window.location = BASE_URL+"/admin/subject-list"

                }else{
                    alert(x.message);
                }
            }
        });
    }

    return false;
});

    $("#save-btn").on("click",function () {

       var id = $(this).data('target');

       var dataString = $("#rightsForm").serialize();

       $.ajax({
           type:'POST',
           url: BASE_URL+"/php/update_rights.php",
           data: dataString+"&rid="+id,
           success: function(data) {
               x = JSON.parse(data);

               if(x.code == "01") {
                   alert(x.message);
               }else{
                   alert(x.message);
               }
           }
       });
       return false;
    });


$.validator.addMethod("regex", function(value, element, regexpr) {
    return regexpr.test(value);
  }, "Value doesn't match the required pattern.");


    $("#publish-news-form").validate({
        rules:
            {
                newsTitle: {
                    required: true,
                    regex: /^[a-zA-Z\s]+$/,
                    minlength : 3
                }/*,
                newsContent: {
                    required: true,
                    minlength: 3
                }*/

            },
        messages:
            {
                newsTitle: {
                    required: "Please provide a title.",
                    regex: "Please enter a valid title."
                }/*,
                newsContent: {
                    required: "Please add a content,"
                }*/
            },

        submitHandler: function(){
            $newsContent = tinymce.get('newsContent').getContent();

            $newsTitle = $('#newsTitle').val();

            $.ajax({
                type: 'POST',
                url: BASE_URL+"/php/publish_news.php",
                data: {
                    newsTitle: $newsTitle,
                    newsContent: $newsContent
                },
                success: function (data) {
                    x = JSON.parse(data);

                    if(x.code == "01") {
                        alert(x.message);
                    }else {
                        alert(x.message);
                        window.location = BASE_URL+"/admin/news";
                    }
                }
            });
            return false;
        }
    });


$("#login-form").validate({
        rules:
            {
                userid: {
                    required: true,
                    regex : /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/
                },
                userpass: {
                    required: true
                }
            },
        messages:
            {
                userid: {
                    required : "Please provide an email.",
                    regex : "Please enter a valid email"
                },
                userpass: "Please provide a password."
            },


    submitHandler: function() {

        var data = $("#login-form").serialize();

        $.ajax({
            type: 'POST',
            url: BASE_URL+"/php/login_user.php",
            data: data,
            success: function (data) {
                x = JSON.parse(data);


                if(x.code == "01") {
                   alert(x.message);
                }else {
                    if(x.type == "admin"){
                        window.location = BASE_URL+"/admin/";
                    }else{
                        window.location = BASE_URL+"/account";
                    }
                    
                }
            }
        });
        return false;
    }
});



    $("#create-teacher-form").validate({
        rules: {
                    t_email: {
                        required: true,
                        regex : /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/,
                    },
                    t_pass: {
                        required: true
                    },
                    t_pass_confirm : {
                        required: true,
                        equalTo : '#t_pass'
                    },
                    t_first_name : {
                        required : true,
                        regex : /^[a-zA-Z\s]+$/,
                        minlength : 2,
                    },
                    t_middle_name : {
                        required : true,
                        regex : /^[a-zA-Z\s]+$/
                    },
                    t_last_name : {
                        required : true,
                        regex : /^[a-zA-Z\s]+$/
                    },
                    t_contact : {
                        required : true,
                        regex : /^[0-9]+$/
                    },
                    t_nationality : {
                        required : true,
                        regex : /^[a-zA-Z\s]+$/
                    },
                    t_civil_status : {
                        required : true,
                        regex : /^[a-zA-Z\s]+$/
                    },
                    t_address : {
                        required : true
                    },
                    t_birth_month : {
                        required : true,
                        regex : /^[0-9]+$/
                    },
                    t_birth_day : {
                        required : true,
                        regex : /^[0-9]+$/
                    },
                    t_birth_year : {
                        required : true,
                        regex : /^[0-9]+$/
                    },
                    t_gender : {
                        required : true
                    }
                },
        messages : {
            t_email : {
                regex : 'Please enter a valid email'
            },
            t_pass_confirm : {
                equalTo : "Password doesn't match"
            },
            t_first_name : {
                minlength : "Name must be at least 2 characters",
                regex : "Only letters are allowed",
            },
            t_middle_name : {
                regex : "Only letters are allowed",
            },
            t_last_name : {
                regex : "Only letters are allowed",
            },
            t_contact : {
                regex : "Only numbers allowed"
            },
            t_nationality : {
                regex : "Only letters are allowed"
            },
            t_civil_status : {
                regex : "Only letters are allowed"
            },
            t_birth_day : {
                regex : "Please use number"
            },
            t_birth_month : {
                regex : "Please use number"
            },
            t_birth_year : {
                regex : "Please use number"
            },
            t_gender :{
                required : "Please specify the gender"
            }
        },
        submitHandler : function(){
            var data = $("#create-teacher-form").serialize();

            $.ajax({
                url : BASE_URL+"/php/add_teacher.php",
                type : "post",
                data : data,
                success : function(data){
                    x = JSON.parse(data);

                    if(x.code == "00"){
                        alert(x.message);
                        window.location = BASE_URL+"/admin/overview-teacher";
                    }else{
                        alert(x.message);
                    }
                }
            })
        }
    });


    $("#create-role-form").validate({
        rules:
            {
                r_name: {
                    required: true,
                    regex: /^[a-zA-Z\s]+$/,
                    minlength : 3
                }
            },
        messages:
            {
                r_name: {
                    required: "Please provide a role name.",
                    regex: "Please enter a valid role name."
                }
            },

    submitHandler: function(){
        var role_name = $("#create-role-form").serialize();

        $.ajax({
            type: 'POST',
            url: BASE_URL+"/php/add_role.php",
            data: role_name,
            success: function (data) {
                x = JSON.parse(data);

                if(x.code == "01") {
                    alert(x.message);
                }else {
                    alert(x.message);
                    window.location = BASE_URL+"/admin/roles/";
                }
            }
        });
        return false;
    }
    });






    $("#student-form").validate({
        rules : {
            s_last_name : {
                required : true
            },
            s_middle_name : {
                required : true
            },
            s_first_name : {
                required : true
            },
            s_day: {
                required : true
            },
            s_month: {
                required : true
            },
            s_year: {
                required : true
            },
            s_nationality: {
                required : true
            },
            s_place_of_birth: {
                required : true
            },
            edu_elementary_name: {
                required : true
            },
            edu_elem_year_completed: {
                required : true,
                number : true
            },
            edu_elem_address: {
                required : true
            },
            s_region: {
                required : true
            },
            s_house_street_number: {
                required : true
            },
            s_sub_barangay: {
                required : true
            },
            s_town_city: {
                required : true
            },
            province: {
                required : true
            },
            s_tel_number: {
                required : true,
                number : true
            },
            s_cell_number: {
                required : true,
                number : true
            },
            s_email: {
                required : true,
                regex : /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/
            },

        },
        messages : {
            s_email : {
                regex : "Please use a valid email format"
            }  
        },
        submitHandler : function(e){
            var gender1 = $("#s-male").is(":checked");
            var gender2 = $("#s-female").is(":checked");

            if(gender1 == false && gender2 == false){
                alert("Please selet a gender");
            }

            var data = $(e).serialize();

            $.ajax({
                url : BASE_URL+"/php/create_student.php",
                type : "post",
                data : data,
                success : function (data){
                    

                    x = JSON.parse(data);

                    if(x.code == "00"){
                        alert(x.message);
                        window.location = BASE_URL+"/home";
                    }else{
                        alert(x.message);
                    }
                }
            });
        }

    });


    $("#cur_select").on("change", function(){
        var data = {};

        data['cid'] = $(this).val();
        
        $.ajax({
            url : BASE_URL+"/php/school_level_list.php",
            type : "post",
            data : data,
            beforeSend : function(){
                $("#sched_school_level").html("Loading . . . ");
            },
            success : function(data){
                if(data == "false"){
                    alert("Unable to fetch proper school levels. Contact Support");
                }
                else{
                    $("#sched_school_level").html(data);
                }
            }

        });

    });


    $("#create-schedule-form").validate({
        rules : {
            schedule_name : {
                required : true
            },
            curr : {
                required : true
            },
            level : {
                required : true
            },
            sched_year_start : {
                required : true
            },
            sched_year_end : {
                required : true
            }

        },
        messages: {
            schedule_name : {
                required : "Please do not leave this empty"  
            },
            curr : {

            },
            level : {
                required : "Please choose a level"
            }

        },
        submitHandler : function(e){
            var data = $(e).serialize();
            $.ajax({
                url : BASE_URL+"/php/create_schedule.php",
                type : "post",
                data : data,
                success : function(data){
                    var x = JSON.parse(data);

                    if(x.code == "00"){
                        alert(x.message);
                        window.location = BASE_URL+"/admin/manage-schedule";
                    }else{
                        alert(x.message);
                    }
                }
            })
        }

    });

    $("#sched-builder-form").validate({
        rules : {
            section_id : {
                required : true
            },
            teacher_id : {
                required : true
            },
            subject_id : {
                required : true
            },
            day : {
                required : true
            },
            start_time : {
                required : true
            },
            end_time : {
                required : true
            }
        },
        messages : {

        },
        submitHandler : function(e){
            var formData = $(e).serialize();

            var targ = $(e).data('arg');
            
            $.ajax({
                url : BASE_URL+"/php/add_schedule_item.php",
                type : "post",
                data : formData+"&sched_id="+targ,
                success : function(data){
                    var x = JSON.parse(data);
                    console.log(x, data);
                    if(x.code == "00"){
                        alert(x.message);
                        //do additional stuff if valid
                    }else{
                        alert(x.message);
                    }
                }
            });
        }
    });


    $("#create-section-form").validate({
        rules : {
            section_name : {
                required : true
            },
            curr : {
                required : true
            },
            level : {
                required : true
            },
            teacher_id : {
                required : true
            }

        },
        messages: {
            schedule_name : {
                required : "Please do not leave this empty"  
            },
            curr : {

            },
            level : {
                required : "Please choose a level"
            },
            teacher_id : {
                required : "Please select teacher id"
            }

        },
        submitHandler : function(e){
            var data = $(e).serialize();
            $.ajax({
                url : BASE_URL+"/php/create_section.php",
                type : "post",
                data : data,
                success : function(data){
                    var x = JSON.parse(data);

                    if(x.code == "00"){
                        alert(x.message);
                        window.location = BASE_URL+"/admin/section-list";
                    }else{
                        alert(x.message);
                    }
                }
            })
        }

    });

    
    $("#edit-section-form").validate({
        rules : {
            section_name : {
                required : true
            },
            curr : {
                required : true
            },
            level : {
                required : true
            },
            teacher_id : {
                required : true
            }

        },
        messages: {
            schedule_name : {
                required : "Please do not leave this empty"  
            },
            curr : {

            },
            level : {
                required : "Please choose a level"
            },
            teacher_id : {
                required : "Please select teacher id"
            }

        },
        submitHandler : function(e){
            var data = $(e).serialize();
            
            var targetID = $(e).data('id');
            
            $.ajax({
                url : BASE_URL+"/php/update_section.php",
                type : "post",
                data : data+"&section_id="+targetID,
                success : function(data){
                    var x = JSON.parse(data);

                    if(x.code == "00"){
                        alert(x.message);
                        window.location = BASE_URL+"/admin/section-list";
                    }else{
                        alert(x.message);
                    }
                }
            })
        }

    });




/**
  * End of .ready();
  */
});





/**
 * CLASSE JS EVENT BINDING
 */

 function runClassieInput(){
     // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
    if (!String.prototype.trim) {
        (function() {
            // Make sure we trim BOM and NBSP
            var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
            String.prototype.trim = function() {
                return this.replace(rtrim, '');
            };
        })();
    }

    [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
        // in case the input is already filled..
        if( inputEl.value.trim() !== '' ) {
            classie.add( inputEl.parentNode, 'input--filled' );
        }
        inputEl.removeEventListener( 'focus', onInputFocus);
        inputEl.removeEventListener( 'blur', onInputBlur);
        // events:
        inputEl.addEventListener( 'focus', onInputFocus );
        inputEl.addEventListener( 'blur', onInputBlur );
    } );

    function onInputFocus( ev ) {
        classie.add( ev.target.parentNode, 'input--filled' );
    }

    function onInputBlur( ev ) {
        if( ev.target.value.trim() === '' ) {
            classie.remove( ev.target.parentNode, 'input--filled' );
        }
    }
 }

