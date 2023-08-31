$(document).ready(function () {
    $(".campoPessoaJuridica, .campoPessoaFisica").hide();
  });

  $("input:radio[name=tipo]").on("change", function () {
    if ($(this).val() == "pessoaFisica") {
      $(".campoPessoaFisica").show();
      $(".campoPessoaJuridica").hide();
    }
    else if ($(this).val() == "pessoaJuridica") {
      $(".campoPessoaFisica").hide();
      $(".campoPessoaJuridica").show();
    }
  });