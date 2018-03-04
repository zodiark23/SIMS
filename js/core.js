$(document).ready(function(){

/**
 * Process the submit differently
 * 
 * - Get data on school levels and validate it store all values processed on variable `data`
 * - Proceed with submission if there's no errors found
 */
$("#submit-educational").on("click", function(){
    var data = [];
    var isValid = true;
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
            }
            if( isNaN(value)){
                alert("Please enter a valid number");
                $("#duration").focus();
                isValid = false;
                return false;
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
        
    })


    if(isValid){

        $.ajax({
            "url" : BASE_URL+"/php/add_educational.php",
            "type": "post",
            "data" : data,
            "success" : function(data){
                console.log(data);
            }
        });
    }
});


});