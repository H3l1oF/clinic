Projecto em PHP da "gestão" de consultas numa clinica.

Estrutura base de dados
Tabelas
consulta - 
          idConsulta (int)
          data (datetime)
          idMedico (int)
          idPaciente (int)
          idEspecialidade (int)
especialidade -
          idEspecialidade (int)
          descricao (varchar)
          preco (double)
medico -
          idMedico (int)
          nome (varchar)
          idEspecialidade (int)
paciente -
          idPaciente (int)
          nome (varchar)
          localidade (varchar)
          contacto (int)
          dataNasc (date)
