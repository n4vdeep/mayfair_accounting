//This script adds the array messages to the front end
//If you change the contact form ID then please update this script.
jQuery(function ($) {

    'use strict';
    //Update this ID if you change the form ID
    $('#contactForm').on('submit',function(e){

        e.preventDefault();

        var $action = $(this).prop('action');
        var $data = $(this).serialize();
        var $this = $(this);

        $this.prevAll('.alert').remove();

        $.post( $action, $data, function( data ) {

            if( data.response=='error' ){
                //Alert classes are here for if you want to add styling.
                $this.before( '<div class="alert alert-danger">'+data.message+'</div>' );
            }
            
            if( data.response=='success' ){
                //Alert classes are here for if you want to add styling.
                $this.before( '<div class="alert alert-success">'+data.message+'</div>' );
                $this.find('input, textarea').val('');
                grecaptcha.reset(); //Resets reCaptcha
            }

        }, "json");

    });

});
