<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbat" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav mr-auto">

        <li class="nav-item">
          <a  class="nav-link @if($current=="inicio") active @endif" href="/">Início</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link @if($current=="produtos") active @endif" href="/produtos">Produtos</a>
        </li>

        <li class="nav-item">
          <a class="nav-link @if($current=="categorias") active @endif " href="/categorias">Categorias</a>
        </li>

      </ul>
     
    </div>
  </nav>