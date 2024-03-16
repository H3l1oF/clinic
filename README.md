Projecto em PHP da "gestão" de consultas numa clinica.

Estrutura base de dados 
##
Tabelas <br/>
consulta - <br/>
    			idConsulta (int) <br/>
          data (datetime) <br/>
          idMedico (int) <br/>
          idPaciente (int) <br/>
          idEspecialidade (int) <br/>
especialidade - <br/>
          * idEspecialidade (int) <br/>
          descricao (varchar) <br/>
          preco (double) <br/>
medico - <br/>
          * idMedico (int) <br/>
          nome (varchar) <br/>
          idEspecialidade (int) <br/>
paciente - <br/>
          * idPaciente (int) <br/>
          nome (varchar) <br/>
          localidade (varchar) <br/>
          contacto (int) <br/>
          dataNasc (date) <br/>
