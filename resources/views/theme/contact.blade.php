@extends('theme.master')
@section('content')
  <main id="main">
    <section id="contact" class="contact mt-5">
      <div class="container">

        <div class="section-header">
          <h2>Contate-nos</h2>
          <p>Ea vitae aspernatur deserunt voluptatem impedit deserunt magnam occaecati dssumenda quas ut ad dolores adipisci aliquam.</p>
        </div>

      </div>

      <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3789.8131159517743!2d-8.415626443219686!3d40.19295409427553!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22f9916a32cfd3%3A0xca4589d604c71bc6!2sInstituto%20Superior%20de%20Engenharia%20de%20Coimbra!5e1!3m2!1spt-PT!2spt!4v1698597552091!5m2!1spt-PT!2spt" frameborder="0" allowfullscreen></iframe>
      </div>

      <div class="container">

        <div class="row gy-5 gx-lg-5">

          <div class="col-lg-4">

            <div class="info">
              <h3>Entre em contato</h3>
              <p>Et id eius voluptates atque nihil voluptatem enim in tempore minima sit ad mollitia commodi minus.</p>

              <div class="info-item d-flex">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h4>Localização:</h4>
                  <p>R. Pedro Nunes, 3030-199 Coimbra</p>
                </div>
              </div>

              <div class="info-item d-flex">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h4>Email:</h4>
                  <a href="mailto:secretariado@isec.pt"><p>secretariado@isec.pt</p></a>
                </div>
              </div>

              <div class="info-item d-flex">
                <i class="bi bi-phone flex-shrink-0"></i>
                <div>
                  <h4>Telefone:</h4>
                  <a href="tel:+351239790200"><p>+351 239 790 200</p></a>
                </div>
              </div>

            </div>

          </div>

          <div class="col-lg-8">
            <form action="" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Nome" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Assunto" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" placeholder="Mensagem" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">A carregar..</div>
                <div class="error-message"></div>
                <div class="sent-message">A sua mensagem foi enviada. Obrigado!</div>
              </div>
              <div class="text-center"><button type="submit">Enviar Mensagem</button></div>
            </form>
          </div>

        </div>

      </div>
    </section>
  </main>
@stop