$(document).ready(function() {
  $('#tabelaMain').DataTable({
      "language": {
          "search": "Procurar:",
          "lengthMenu": "Mostrar _MENU_ registos por página",
          "zeroRecords": "Nada encontrado - desculpe",
          "info": "A mostrar página _PAGE_ de _PAGES_",
          "infoEmpty": "Nenhum registo disponível",
          "infoFiltered": "(filtrado de _MAX_ registos no total)",
          "loadingRecords": "A carregar...",
          "processing": "A processar...",
          "emptyTable": "Não há dados disponíveis nesta tabela",
          "paginate": {
              "first": "Primeira",
              "last": "Última",
              "next": "Seguinte",
              "previous": "Anterior"
          },
          "aria": {
              "sortAscending": ": ativar para ordenar a coluna em ordem ascendente",
              "sortDescending": ": ativar para ordenar a coluna em ordem descendente"
          }
      }
  });
});