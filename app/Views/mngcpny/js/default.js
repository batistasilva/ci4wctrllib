/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {
    // validate signup form on keyup and submit
    $("form").validate({
        rules: {
            password1: {
                required: true,
                minlength: 5
            },
            password2: {
                required: true,
                minlength: 5,
                equalTo: "#InputPassword1"
            }
        },
        messages: {
            password1: {
                required: "Informe uma Senha",
                minlength: "Sua senha deve conter pelo menos 5 caracteres"
            },
            password2: {
                required: "Informe uma Senha",
                minlength: "Sua Senha deve conter pelos menos 5 caracteres",
                equalTo: "Repita a mesma senha informada acima"
            }
        }
    });
});//]]> 

        