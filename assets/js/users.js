$(function() {

    $("#add-user-profile-photo").on('change', function(){
       
       readURLAddProfileImg(this);
    });

    $('#admin-add-user-form').submit(function(event) {

        event.preventDefault(); 
        
        var base_url = window.location.origin + '/api'

        var form = $(this);
        var formData = new FormData(form[0]); 
       
        var userProfileImg = $('#user-profile-img').val()

        var profileImg = b64toBlob(userProfileImg, 'image/jpeg');

        formData.append('file', profileImg, 'image.jpg');

        $.ajax({
            type: form.attr('method'),
            url: base_url + form.attr('action'),
            data: formData,
            contentType: false,  
            processData: false, 
            success: function(response) {
                if(response.data.error){
                
                    toastr.error(response.data.error_msg);
                }
                else if(response.data.success){
        
                    toastr.success(response.data.success_msg);

                    setTimeout(function () {
                        window.location.href = window.location.origin + '/admin/users/listing';
                    }, 2000);
                }
            },
            error: function(error) {
                toastr.error(error);
            }
        });
    });

    var readURLAddProfileImg = function(input) {
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function (e) {
                
                imageData =  e.target.result
                var base64Image = imageData.split(';base64,').pop();
                $('#user-profile-img').val(base64Image)
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#edit-user-profile-photo').on('change', function(){
        
        readURLEditProfileImg(this);
       
       $('#old-profile-pic').val('');
    })

    var readURLEditProfileImg = function(input) {
        
        if (input.files && input.files[0]) {

            var reader = new FileReader();
    
            reader.onload = function (e) {
    
                imageData =  e.target.result
                var base64Image = imageData.split(';base64,').pop();
                $('#user-edit-profile-img').val(base64Image)
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#admin-edit-user-form').submit(function(event) {

        event.preventDefault(); 
        
        var base_url = window.location.origin + '/api'

        var form = $(this);
        var formData = new FormData(form[0]); 

        var userProfileImg = $('#user-edit-profile-img').val()

        if(userProfileImg) {
        
            var profileImg = b64toBlob(userProfileImg, 'image/jpeg');

            formData.append('file', profileImg, 'image.jpg');
        }
        
        var userId = $('#admin-user-edit-id').val();

        $.ajax({
            type: form.attr('method'),
            url: base_url + form.attr('action'),
            data: formData,
            contentType: false,  
            processData: false, 
            success: function(response) {
                if(response.data.error){
                
                    toastr.error(response.data.error_msg);
                }
                else if(response.data.success){
        
                    toastr.success(response.data.success_msg);

                    setTimeout(function () {
                        window.location.href = window.location.origin + '/admin/users/edit?id='+userId;
                    }, 2000);
                }
            },
            error: function(error) {
                toastr.error(error);
            }
        });
    });

    $("#edit-user-profile-photo-remove").on('click', function(){
        
        $('#old-profile-pic').val('');
    });

    $(document).on('click', '.admin-user-remove-btn', function() {
        var userId = $(this).data('user-id'); // Use .data() instead of .attr()
        alert(userId);
        $('#admin-user-delete-modal-user-id').val(userId);
    });
   
    $('#admin-user-delete-btn').on('click', function() {

        var userId =  $('#admin-user-delete-modal-user-id').val();

        var base_url = window.location.origin;

        var api_path = '/api';

        alert(userId);

        $.ajax({
            type: 'DELETE',
            url: base_url + api_path + '/admin/users/delete',
            data: JSON.stringify({ userId: userId }),
            contentType: false,  
            processData: false, 
            success: function(response) {
                if(response.data.error){
                
                    toastr.error(response.data.error_msg);
                }
                else if(response.data.success){
        
                    toastr.success(response.data.success_msg);

                    setTimeout(function () {
                       window.location.href = window.location.origin + '/admin/users/listing';
                    }, 2000);
                }
            },
            error: function(error) {
                toastr.error(error);
            }
        });
    })
});