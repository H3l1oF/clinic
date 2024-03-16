
function ativa(a) {
    document.getElementById('saveChangesBtn').href = "/../clinic/inc/delcon.php?idConsulta=" + a;
}

$(document).on("click", ".editBtn", function () {
    var id = $(this).data('id');
    var medico = $(this).data('medico');
    var paciente = $(this).data('paciente');
    var data = $(this).data('data');
    var especialidade = $(this).data('especialidade');
    let med = medico.concat(" - ", especialidade);
    $("#edit_consulta_id").val(id);
    $("#edit_medico option").each(function () {
        if ($(this).text() === med) {
            $(this).prop("selected", true);
        }
    });
    $("#edit_paciente option").each(function () {
        if ($(this).text() === paciente) {
            $(this).prop("selected", true);
        }
    });

    flatpickr("#datetimepicker", {
        defaultDate: data,
        enableTime: true, // Habilita a seleção de hora
        dateFormat: "Y-m-d H:i", // Formato da data e hora
        minDate: "today",
        locale: "pt",
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
