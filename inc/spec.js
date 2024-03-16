
function ativa(a) {
    document.getElementById('saveChangesBtn').href = "/../clinic/inc/delspec.php?idEspecialidade=" + a;
}
$(document).on("click", ".editBtn", function () {
    var id = $(this).data('id');
    var especialidade = $(this).data('especialidade');
    var preco = $(this).data('preco');


    $("#edit_especialidade_id").val(id);
    $("#edit_especialidade").val(especialidade);
    $("#edit_preco").val(preco);
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
