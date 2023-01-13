document.addEventListener("DOMContentLoaded", function(event) {
    //Everything will be for working with contacts
    var baseUrl = OC.generateUrl('/apps/sciencemesh');
    $('#test_error').hide(); 
    $.ajax({
        url: baseUrl + '/contacts/users',
        type: 'GET',
        contentType: 'application/json',
    }).done(function (response) {
        if(response === '' || response === false) {
            var element = document.getElementById("test_error");
            element.innerHTML= 'No Sciencemesh Connection';
            $('#test_error').show(); 
        } else {
        let token = JSON.parse(response);
        for(tokenData in token) {
            if(token.hasOwnProperty(tokenData)) {
                if(tokenData === 'accepted_users') {
                    let accepted_users = token.accepted_users
                        for(accept in accepted_users) {
                            const displayName = accepted_users[accept].display_name;
                            const username = accepted_users[accept].id.opaque_id;
                            const idp = accepted_users[accept].id.idp;
                            const provider = new URL(idp).host;
                            const result = `
                                    <div href="#" class="app-content-list-item profile-item">
                                        <div class="app-content-list-item-icon profile-item-img" style="">
                                            <img src="https://cdn-icons-png.flaticon.com/512/16/16363.png">
                                        </div>
                                        <div class="app-content-list-item-line-one profile-item-username" id="show_result" >
                                            <p class="displayname">${displayName}</p><p class="username-provider">${username}@${provider}</p>
                                        </div>  
                                    </div>`;                  
                            var element = document.getElementById("test_error");
                            element.innerHTML = result;
                        }

                    $('#test_error').show();
                }else{
                    const result = `
                            <div href="#" class="app-content-list-item profile-item" >
                                <div class="app-content-list-item-icon" style="">
                                </div> 
                                <div class="app-content-list-item-line-one" id="show_result" >
                                    <p class="username-provider">There are no contacts!</p>
                                </div>  
                            </div>`;                  
                    var element = document.getElementById("show_result");
                    element.innerHTML = result;
                    $('#test_error').show();

                }
            } 
            }
        }
    }).fail(function (response, code) {
        console.log(response)
        //alert('The token is invalid')
    });
})