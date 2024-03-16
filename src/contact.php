<?php
// barra de navegação
require_once __DIR__ . '/../inc/navbar.php';
?>

<div class="container my-3 my-sm-5">


    <h1 class="mb-sm-4 text-center mb-4">Contacte-nos</h1>
    <hr>
    <div class="row">
        <div class="col-12 col-md-6">
            <h4>Endereço</h4>
            <address>
                <strong>
                    Alcochete City
                </strong>
                <br>
                Rua da escola<br>
                Alcochete,Portugal <br>
                <abbr title="Telefone">T:</abbr> <a href="tel:+351123456789">+351 123456789</a> <br>
                <abbr title="Mail">M: </abbr><a href="mailto:geral@clinica.pt">geral@clinica.pt</a><br>
            </address>
        </div>
        <div class="col-12 col-md-6">


            <h4>Horário</h4>
            <p>
                Segunda-Sexta feira: <span class="float-right">09:00 am - 20:30 pm </span> <br>
            </p>
            <p>
                Sabado: <span class="float-right">10:00 am - 14:00 pm</span> <br>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 mb-3">
            <h4>Contacte-nos</h4>
            <form action="#">
                <div class="row">
                    <div class="col-12 col-md-6">

                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" id="name" class="form-control" placeholder="nome" required>

                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" placeholder="nome@dominio.pt" required>

                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label for="textarea">Mensagem:</label>
                    <textarea class="form-control" placeholder="Escreve aqui a sua mensagem..." name="" id="textarea" cols="30" rows="10" required></textarea>
                </div>
                <button type="submit" class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Enviar</button>
            </form>
        </div>
        <div class="col-12 col-md-6">
            <h4>Onde nos encontrar</h4>
            <div class="embed-responsive embed-responsive-4by3">
                <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d693.0523929953005!2d-8.964057003683674!3d38.747647136269485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd193bb1a8bfb251%3A0xd35e74c6fe0d7dbb!2sEscola%20Secund%C3%A1ria%20de%20Alcochete!5e0!3m2!1spt-PT!2spt!4v1708983308058!5m2!1spt-PT!2spt" width="600" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Escola Secundária de Alcochete 2023/2024</h1>
      </div>
      <div class="modal-body">
        Curso EFA - Programação Informática,<br />
        Quero desde já agradeçer a todos meus colegas que <br /> 
        me aturam e ao prof. Pedro Mesquita que deu a ideia <br />
        e as bases necessárias para criar este projecto.<br />
        Apesar do trabalho deu-me uma enorme satisfação <br />
        dar vida a este site.
        <br />
        <br />
        Aquele abraço, <br />
        Hélio Fernandes
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
