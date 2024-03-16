Projecto em PHP da "gestão" de consultas numa clinica.

Estrutura base de dados 
##
Tabelas <br/><br/>
consulta - <br/>
&nbsp; &nbsp; * idConsulta (int) <br/>
&nbsp; &nbsp; data (datetime) <br/>
&nbsp; &nbsp; idMedico (int) <br/>
&nbsp; &nbsp; idPaciente (int) <br/>
&nbsp; &nbsp; idEspecialidade (int) <br/>
especialidade - <br/>
&nbsp; &nbsp; * idEspecialidade (int) <br/>
&nbsp; &nbsp; descricao (varchar) <br/>
&nbsp; &nbsp; preco (double) <br/>
medico - <br/>
&nbsp; &nbsp; * idMedico (int) <br/>
&nbsp; &nbsp; nome (varchar) <br/>
&nbsp; &nbsp; idEspecialidade (int) <br/>
paciente - <br/>
&nbsp; &nbsp; * idPaciente (int) <br/>
&nbsp; &nbsp; nome (varchar) <br/>
&nbsp; &nbsp; localidade (varchar) <br/>
&nbsp; &nbsp; contacto (int) <br/>
&nbsp; &nbsp; dataNasc (date) <br/>
