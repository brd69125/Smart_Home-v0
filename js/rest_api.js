var rest_ip = "";

function deconzConnect(){
    $.ajax({
        type: "GET",
        url: "https://dresden-light.appspot.com/discover",
        success: function (response) {
            console.log("Success! PUT executed!");
            $(document).append(response);            
        },
        error: function(data){
            console.log("Error" + data);
        }
    });
}


