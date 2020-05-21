

$(document).ready(function($) {
  
  $('[data-toggle="tooltip"]').tooltip();

  //SetMasks
  $('.data').mask('99/99/9999');
  $('.hora').mask('99:99');
  $('.datetime').mask('99/99/9999 99:99');
  $('.cep:not(.cepMask)').mask('99999999');
  $('.cepMask').mask('99999-999');
  $('.cpf:not(.cpfMask)').mask('99999999999');
  $('.cpfMask').mask('999.999.999-99');
  $('.cnpj').mask('99999999999999');
  $(".cnpjMask").mask("99.999.999/9999-99");
  $('.money').mask('999999999.99', {reverse: true});
  $('.br_money').mask('R$ 999999.99', {reverse: true});

  var masksTelefone = ['00000-0000', '0000-00009'];
  $('.telefone').mask(masksTelefone[1], {onKeyPress:
     function(val, e, field, options) {
       field.mask(val.length > 10 ? masksTelefone[0] : masksTelefone[1], options) ;
     }
  });

  var masksTelefoneDDD = ['(00) 00000-0000', '(00) 0000-00009'];
  $('.telefone_ddd').mask(masksTelefoneDDD[1], {onKeyPress:
     function(val, e, field, options) {
       field.mask(val.length > 14 ? masksTelefoneDDD[0] : masksTelefoneDDD[1], options) ;
     }
  });

  var cpf_cnpj = ['000.000.000-000', '00.000.000/0000-00'];
  $('.cpf_cnpj').mask(cpf_cnpj[1], {onKeyPress:
     function(val, e, field, options) {
       console.log(val.length);
       field.mask(val.length < 15 ? cpf_cnpj[0] : cpf_cnpj[1], options) ;
     }
  });

  $('.numbersOnly').keyup(function () {
      if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
         this.value = this.value.replace(/[^0-9\.]/g, '');
      }
  });

  $('input[type="text"]').bind('keypress', function(e)
  {
     if(e.keyCode == 13)
     {
        return false;
     }
  });

  $('.cpfMask').change(function(){
    if (this.value.length == 14)
    {
      var cpf = this.value.replace(/[^0-9]/g, '');
      if (! validarCPF(cpf))
      {
        alert('CPF digitado é inválido.');
        this.value = '';
      }
    }
  });

  //Quando o campo cep perde o foco.
  $("#cep").keyup(function() {

      //Nova variável "cep" somente com dígitos.
      var cep = $(this).val().replace(/\D/g, '');

      //Verifica se campo cep possui valor informado.
      if (cep != "" && cep.length ==8) {

          //Expressão regular para validar o CEP.
          var validacep = /^[0-9]{8}$/;

          //Valida o formato do CEP.
          if(validacep.test(cep)) {

              //Preenche os campos com "..." enquanto consulta webservice.
              $("#endereco").val("...");
              $("#bairro").val("...");
              $("#cidade").val("...");
              $("#uf").val("...");

              //Consulta o webservice viacep.com.br/
              $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                  if (!("erro" in dados)) {
                      //Atualiza os campos com os valores da consulta.
                      $("#endereco").val(dados.logradouro);
                      $("#bairro").val(dados.bairro);
                      $("#cidade").val(dados.localidade);
                      $("#uf").val(dados.uf);
                  } //end if.
                  else {
                      //CEP pesquisado não foi encontrado.
                      limpa_formulario_cep();
                      alert("CEP não encontrado.");
                  }
              });
          } //end if.
          else {
              //cep é inválido.
              limpa_formulario_cep();
              alert("Formato de CEP inválido.");
          }
      } //end if.
      else {
          //cep sem valor, limpa formulário.
          limpa_formulario_cep();
      }
  });

});

function validarCPF(cpf) {  
  cpf = cpf.replace(/[^\d]+/g,'');  
  if(cpf == '') return false;  
  // Elimina CPFs invalidos conhecidos  
  if (cpf.length != 11 || 
    cpf == "00000000000" || 
    cpf == "11111111111" || 
    cpf == "22222222222" || 
    cpf == "33333333333" || 
    cpf == "44444444444" || 
    cpf == "55555555555" || 
    cpf == "66666666666" || 
    cpf == "77777777777" || 
    cpf == "88888888888" || 
    cpf == "99999999999")
      return false;    
  // Valida 1o digito  
  add = 0;  
  for (i=0; i < 9; i ++)    
    add += parseInt(cpf.charAt(i)) * (10 - i);  
    rev = 11 - (add % 11);  
    if (rev == 10 || rev == 11)    
      rev = 0;  
    if (rev != parseInt(cpf.charAt(9)))    
      return false;    
  // Valida 2o digito  
  add = 0;  
  for (i = 0; i < 10; i ++)    
    add += parseInt(cpf.charAt(i)) * (11 - i);  
  rev = 11 - (add % 11);  
  if (rev == 10 || rev == 11)  
    rev = 0;  
  if (rev != parseInt(cpf.charAt(10)))
    return false;    
  return true;   
}

function limpa_formulario_cep() {
    // Limpa valores do formulário de cep.
    $("#endereco").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#uf").val("");
}