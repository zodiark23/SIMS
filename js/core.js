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
                console.log(x);
                if(x.code == "00"){
                    alert(x.message);
                }else{
                    alert(x.message);
                }
            }
        });
    }
})


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

