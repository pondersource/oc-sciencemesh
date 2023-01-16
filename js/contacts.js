document.addEventListener("DOMContentLoaded", function(event) {
    //Everything will be for working with contacts
    var baseUrl = OC.generateUrl('/apps/sciencemesh');
    $('#show_result').hide(); 
    $.ajax({
        url: baseUrl + '/contacts/users',
        type: 'GET',
        contentType: 'application/json',
    }).done(function (response) {
        if(response === '' || response === false) {
            var element = document.getElementById("show_result");
            element.innerHTML= 'No Sciencemesh Connection';
            $(element).addClass('text-error');
            $('#show_result').show();
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
                                    <tr class="app-content-list-item">
                                        <td style="border-radius:100%">
                                            <input name="profile[]" type="checkbox" class="input-checkbox-contacts">
                                            <p class="icon-contacts-dark contacts-profile-img"></p>
                                        </td>
                                        <td class="app-content-list-item-line-one contact-item">
                                            <p class="displayname">${displayName}</p>
                                        </td>  
                                        <td>
                                            <p class="username-provider">${username}</p>
                                        </td>
                                    </tr>
                                    `;
                            var element = document.getElementById("show_result");
                            element.innerHTML = result;
                        }

                    $('#show_result').show();
                }else{
                    const result = `
                            <tr colspan="3" href="#" class="app-content-list-item" >
                                <td style="width:40% !important">
                                    <p class="username-provider">There are no contacts!</p>
                                </td>
                            </tr>`;                  
                    var element = document.getElementById("show_result");
                    element.innerHTML = result;
                    $('#show_result').show();

                }
            } 
        }
    }
    }).fail(function (response, code) {
        console.log(response)
        //alert('The token is invalid')
    });
});