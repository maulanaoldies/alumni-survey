var UIBootbox = function () {

    var handleDemo = function() {

        $('#confirm').click(function(){
            bootbox.confirm("Are you sure?", function(result) {
                alert("Confirm result: "+result);
            });
        });

    }

    return {

        //main function to initiate the module
        init: function () {
            handleDemo();
        }
    };

}();

jQuery(document).ready(function() {    
   UIBootbox.init();
});