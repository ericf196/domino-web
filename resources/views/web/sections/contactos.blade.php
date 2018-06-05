      <div id="contactoFront"><!-- contactoFront -->
        <h3 class="title-front text-center">Contáctanos</h3>
            <div class="divider"></div>

        <div class="container">
          <div class="row contact-details">
            <div class="col-sm-8 text-center text-md-left mb-4">
              <h4>Enivianos tu solicitud</h4>
              <form class="contact-form mt-4">
                <div class="row">
                  <div class="col-md-6">
                    <input type="text" class="form-control mb-4" placeholder="Nombres" value="">
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control mb-4" placeholder="Correo" value="">
                  </div>
                  <br />
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <textarea class="form-control" rows="3">Mensaje</textarea><br />
                    <button type="submit" class="btn btn-primary">Enviar</button>
                  </div> 
                </div>
              </form>
            </div>
            <div class="col-sm-4 text-center text-md-left">
              <h4>Info. de Contactos</h4>
              <h5>Correo</h5>
              <p>{{ $league->email }}</p>
              <h5>Teléfono</h5>
              <p>{{ $league->phone }}</p>
              <h5>Dirección</h5>
              <p>{!! ucwords(strtolower($league->address)) !!}</p>
              <ul class="social mb-4">
                <li><a href="#" title="Facebook" class="fa fa-facebook"></a></li>
                <li><a href="#" title="Twitter" class="fa fa-twitter"></a></li>
                <li><a href="#" title="Google+" class="fa fa-google"></a></li>
                <li><a href="#" title="Instagram" class="fa fa-instagram"></a></li>
                <div class="clear"></div>
              </ul>
            </div>
          </div>
        </div>
      </div><!-- fin contactoFront -->