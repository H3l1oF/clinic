
function ativa(a) {
    document.getElementById('saveChangesBtn').href = "/../clinic/inc/delpat.php?idPaciente=" + a;
}

$(document).on("click", ".editBtn", function () {
    var id = $(this).data('id');
    var nome = $(this).data('nome');
    var localidade = $(this).data('localidade');
    var contacto = $(this).data('contacto');
    var data = $(this).data('data');

    $("#edit_paciente_id").val(id);
    $("#edit_nome").val(nome);
    $("#edit_localidade").val(localidade);
    $("#edit_contacto").val(contacto);
    flatpickr("#datetimepicker", {
        enableTime: false,
        defaultDate: data,
        dateFormat: "Y-m-d",
        locale: "pt",
        maxDate: "today",
        theme: "material_blue"
    });
});

$(document).ready(function () {
    $('#editForm').submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            success: function (response) {
                console.log('Resposta do servidor:', response);

                $('#editModal').modal('hide');
            },
            error: function (xhr, status, error) {
                console.error('Erro ao enviar dados:', error);
            }
        });
    });
});
