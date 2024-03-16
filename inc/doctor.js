function ativa(a) {
  document.getElementById('saveChangesBtn').href = "/../clinic/inc/deldoc.php?idMedico=" + a;
}

$(document).on("click", ".editBtn", function () {
  var id = $(this).data('id');
  var nome = $(this).data('nome');
  var especialidade = $(this).data('especialidade');


  $("#edit_medico_id").val(id);
  $("#edit_nome").val(nome);
  $("#edit_especialidade option").each(function () {
    if ($(this).text() === especialidade) {
      $(this).prop("selected", true);
    }
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

