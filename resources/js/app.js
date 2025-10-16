import $ from 'jquery';
window.jQuery = window.$ = $;
import 'jquery-mask-plugin';
import 'admin-lte';

$(document).ready(function () {
    console.log('jQuery carregado:', typeof $ !== 'undefined');
    console.log('jquery.mask carregado:', typeof $.fn.mask !== 'undefined');

    // Configurar CSRF para requisições AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Apply masks
    try {
        $('#cnpj').mask('00.000.000/0000-00', { clearIfNotMatch: true });
        $('#cep').mask('00000-000', { clearIfNotMatch: true });
        $('#phone').mask('(00) 0000-0000', { clearIfNotMatch: true });
        $('#mobile').mask('(00) 00000-0000', { clearIfNotMatch: true });
        console.log('Máscaras aplicadas com sucesso em app.js');
    } catch (e) {
        console.error('Erro ao aplicar máscaras em app.js:', e);
    }

    // Consulta ViaCEP
    $('#cep').on('blur', function () {
        var cep = $(this).val().replace(/\D/g, '');
        if (cep.length !== 8 || isNaN(cep)) {
            alert('Por favor, digite um CEP válido com 8 dígitos.');
            return;
        }
        console.log('Consultando CEP:', cep);
        $('#cep').prop('disabled', true);
        $.getJSON('/admin/cep', { cep: cep }, function (data) {
            console.log('Resposta do CEP:', data);
            if (!data.erro) {
                $('#address').val(data.logradouro || '');
                $('#district').val(data.bairro || '');
                $('#city').val(data.localidade || '');
                $('#state').val(data.uf || '');
            } else {
                alert(data.message || 'CEP inválido ou não encontrado.');
            }
        }).fail(function (jqXHR) {
            console.error('Erro ao buscar CEP:', jqXHR.status, jqXHR.responseJSON);
            alert('Erro ao buscar CEP. Verifique sua conexão ou tente novamente.');
        }).always(function () {
            $('#cep').prop('disabled', false);
        });
    });
});