$(function(){
  var l = new Login(); //esto se ejecuta automaticamente??
})


class Login {
  constructor() {
    this.submitEvent()
  }

  submitEvent(){
    $('form').submit((event)=>{
      event.preventDefault() // que hace esto ?
      this.sendForm()
    })
  }

  sendForm(){   

    let form_data = new FormData();
    form_data.append('username', $('#user').val())
    form_data.append('password', $('#password').val())
    $.ajax({
      url: '../server/check_login.php',
      dataType: "json",
      cache: false,
      processData: false,
      contentType: false,
      data: form_data,
      type: 'POST',
      success: function(php_response){
        
        if (php_response.msg == "OK") {
            window.location.href = 'main.html';
           //console.log(php_response.datos);            
        }else {
          //setear mensaje a un div con estilos css y que el fondo se vea borroso o opaco
          alert('el mensaje es: ' + php_response.msg);
        }
      },
      error: function(){
        alert(" el error es: error en la comunicación con el servidor");
      }
    })
  }
}
