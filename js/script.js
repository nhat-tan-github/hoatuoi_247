$(Document).ready(
    function(){
        //validate form Regis
        $("#frmRegForm").validate({
            rules:{
                firstname:{
                    required: true,
                    minlength: 2

                },
                lastname:{
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                },
                repassword: {
                    required: true,
                    equalTo: '#password'
                },
            },
            messagses:{
                firstname:{
                    required: 'Please enter a valid First Name',
                    minlength: 'At least 2 characters long'
                },
                lastname: {
                    required: 'Please enter a valid Last Name',
                    minlength: 'At least 2 characters long' 
                },
                email: {
                    required: 'Please enter a Email',
                    email: 'Please enter a valid Email' 
                },
                password: {
                    required: 'Please enter a password'
                },
                repassword: {
                    required: 'Confirm password is required',
                    equalTo: 'Password not matching'
                },

            }
        })
        //validate form input book
        $("#frmInBook").validate({
            
        })
    }
);