<!DOCTYPE html>
<html lang="es">
<head>
  <link rel="icon" type="image/png" href="logo meraki sushi (1).png">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MERAKI SUSHI</title>
  <link rel="stylesheet" href="Meraki Sushi act pagina 2.8/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&family=Poller+One&display=swap">
</head>
  <style>
    #nombreUsuario {
        position: absolute;
        top: 70px;
        right: 70px;
        color: black;
        background-color: white;
        padding: 10px;
        border-radius: 5px;
    }
  </style>
<body>
<?php
    session_start();
    if (isset($_SESSION['nombres'])) {
        echo "<div id='nombreUsuario'>Bienvenido, " . $_SESSION['nombres'] . "</div>";
    }
    ?>
  <div class="wrap-header-hero">
  <header class="main-header">
      <div class="header-wrap">
        <div 
        class="wrap-logo-header">
        
          <img class="logo" src="logo meraki sushi (1).png" alt="Logo Meraki Sushi">
            Meraki Sushi
          </a>
        </div>                                                                                                
        <div class="wrap-nav-header">
          <nav class="nav-header">
            <input type="checkbox" 
            id="check">
            <label for="check" 
            class="checkbtn">
              <i class="toggle-menu">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbG5zOnN2Z2pzPSJodHRwOi8vc3ZnanMuY29tL3N2Z2pzIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgeD0iMCIgeT0iMCIgdmlld0JveD0iMCAwIDM4NCAzODQiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTIiIHhtbDpzcGFjZT0icHJlc2VydmUiPjxnPjxwYXRoIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgZD0ibTM2OCAxNTQuNjY3OTY5aC0zNTJjLTguODMyMDMxIDAtMTYtNy4xNjc5NjktMTYtMTZzNy4xNjc5NjktMTYgMTYtMTZoMzUyYzguODMyMDMxIDAgMTYgNy4xNjc5NjkgMTYgMTZzLTcuMTY3OTY5IDE2LTE2IDE2em0wIDAiIGZpbGw9IiMwMDAwMDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiPjwvcGF0aD48cGF0aCB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGQ9Im0zNjggMzJoLTM1MmMtOC44MzIwMzEgMC0xNi03LjE2Nzk2OS0xNi0xNnM3LjE2Nzk2OS0xNiAxNi0xNmgzNTJjOC44MzIwMzEgMCAxNiA3LjE2Nzk2OSAxNiAxNnMtNy4xNjc5NjkgMTYtMTYgMTZ6bTAgMCIgZmlsbD0iIzAwMDAwMCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCI+PC9wYXRoPjxwYXRoIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgZD0ibTM2OCAyNzcuMzMyMDMxaC0zNTJjLTguODMyMDMxIDAtMTYtNy4xNjc5NjktMTYtMTZzNy4xNjc5NjktMTYgMTYtMTZoMzUyYzguODMyMDMxIDAgMTYgNy4xNjc5NjkgMTYgMTZzLTcuMTY3OTY5IDE2LTE2IDE2em0wIDAiIGZpbGw9IiMwMDAwMDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiPjwvcGF0aD48L2c+PC9zdmc+" />
              </i>
            </label>
            <ul class="main-menu">
            <li class="menu-item"><a href="Carrito/mostrarCarrito.php">Carrito(<?php
            echo (empty($_SESSION['CARRITO2']))?0:count($_SESSION['CARRITO2'])
            ?>)</a></li>
              <li class="menu-item"><a href="#tarjetas-container">Menu</a></li>
              <li class="menu-item"><a href="#section">Ofertas </a></li>
              <li class="menu-item"><a href="login/index.html">Iniciar Sesion </a></li>
            </ul>
          </nav>
        </div>
  </div>
  </header>
    
      <main class="main-section">
          <section class="hero-home-page">
            <div class="wrap-hero-home-page">
            <h1>Meraki Sushi</h1>
            <p><?php echo ""?></p>
          </div>
          </section>
      </div>
      </main>
    <!-- Cierre de la etiqueta main -->
      <!-- Tarjetas de comida -->
 
      <?php

require 'Carrito/global/config1.php';
require 'Carrito/global/conexion.php';
require 'Carrito/carrito.php';


$sentencia=$pdo->prepare("SELECT * FROM tblmenus");
$sentencia->execute();
$listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

if(count($listaProductos) > 0) {
    echo "<section class='tarjetas-container' id='tarjetas-container'>"; // Contenedor para las tarjetas
    foreach($listaProductos as $producto) {
        $imagen_base64 = base64_encode($producto['imagen']);
        echo "<div class='tarjeta-rest' style='background-image: url(data:image/jpg;base64,".$imagen_base64.");'>";
        echo "<div class='wrap-text_tarjeta-rest'>";
        echo "<h3>".$producto['nombre']."</h3>"; 
        echo "<p>".$producto['descripcion']."</p>";
        echo "<div class='cta-wrap_tarjeta-rest'>";
        echo "<div class='precio_tarjeta-rest'>";
        echo "<span>$".$producto['precio']."</span>";
        echo "</div>";
        echo "<form action='' method='post'>";
        echo "<input type='hidden' name='id' id='id' value='".openssl_encrypt($producto['Id_menu'],COD,KEY)."'>";
        echo "<input type='hidden' name='nombre' id='nombre' value='".openssl_encrypt($producto['nombre'],COD,KEY)."'>";
        echo "<input type='hidden' name='precio' id='precio' value='".openssl_encrypt($producto['precio'],COD,KEY)."'>";
        echo "<input type='hidden' name='cantidad' id='cantidad' value='".openssl_encrypt(1,COD,KEY)."'>";
        if (isset($_SESSION['nombres'])) {
                  echo "<button class='btn btn-primary' name='btnAccion' value='Agregar' type='submit'>Agregar al carrito</button>";
        } else {
                  echo "<button href='/login/index.html' >Agregar al carrito</button>";
                  echo '<script>alert("Por favor inicie sesion.");</script>';
                  
        }
    
        echo "</form>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
    echo "</section>"; // Cierra el contenedor de las tarjetas
} else {
    echo "No se encontraron elementos en el menú.";
}

// No necesitas cerrar la conexión PDO, se cerrará automáticamente al finalizar el script
?>


      <!-- Galería de imágenes -->
      <section>''
        <h2>Galeria de Imagenes</h2>
        <div class="gallery">
            <button class="carousel-btn carousel-btn-prev"><i class="icon fas fa-chevron-left"></i> ❰ </button>
            <div class="gallery-slider">
                <div class="gallery-item">
                    <img src="https://console.listae.com/files/2021/12/kaido_sushi_bar_valencia.jpg" alt="Sushi 1">
                </div>
                <div class="gallery-item">
                    <img src="https://media.traveler.es/photos/624069152b069d36bd24f8b1/master/w_1600%2Cc_limit/LZF%25202020%2520SUN%2520KAIDO%2520063.jpg" alt="Sushi 2">
                </div>
                <div class="gallery-item">
                    <img src="https://media.traveler.es/photos/6240613b06a997a399c7b97f/16:9/w_2560%2Cc_limit/_MG_0061.jpg" alt="Sushi 3">
                </div>
                <div class="gallery-item">
                    <img src="https://www.adimadimistanbul.com/images/turlar/turlar-10-924-17-56-istanbulda-japon-mutfagi-deneyimi.jpg" alt="Sushi 4">
                </div>
              </div>
            <button class="carousel-btn carousel-btn-next"> ❱ <i class="icon fas fa-chevron-right"></i></button>
        </div>
        </section>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" integrity="sha384-tcnfHQvT63lqIhzJQGxu9YsJn7LXyMOFbN5vteH9JxeLe3fu4VrpggWuzK1FTEN2" crossorigin="anonymous"></script>
    <script>
        const gallerySlider = document.querySelector('.gallery-slider');
        const galleryItems = document.querySelectorAll('.gallery-item');
        const carouselBtnPrev = document.querySelector('.carousel-btn-prev');
        const carouselBtnNext = document.querySelector('.carousel-btn-next');
        let currentIndex = 0;
        const maxIndex = galleryItems.length - 1;
        carouselBtnPrev.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
            } else {
                currentIndex = maxIndex;
            }
            updateSlider();
        });
        carouselBtnNext.addEventListener('click', () => {
            if (currentIndex < maxIndex) {
                currentIndex++;
            } else {
                currentIndex = 0;
            }
            updateSlider();
        });

        function updateSlider() {
            const offset = -currentIndex * 100;
            gallerySlider.style.transform = `translateX(${offset}%)`;
        }
    </script>
        
     <!-- Articulos de Blog  -->
  <section class="section" id="section">
    <div class="wrap-title-section">
      <h2>Ofertas</h2>
    </div>
    <div class="card-wrap">
      <article class="card">
        <header class="header-card">
          <img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/sushi-valentine%27s-day-creative-advertising-design-template-237ddef3c78ab2c18e57d62f4293bc1a_screen.jpg?ts=1644339576" alt="">
        </header>
        <footer class="footer-card">
          <div class="categoria-card">
            <span> Oferta Dia Especial </span>
          </div>
          <div class="texto-card">
            <h3>Combo Especial.</h3>
            <p>Combo especial en un dia y para una persona especial</p>
            <div class="cta_tarjeta-rest">
              <a href="PagoDom.html">Pedir ahora</a>
            </div>
          </div>
          <div class="perfil-card">
            <div class="img-perfil-card">
              <img src="img/perfil-1.jpg" alt="">
            </div>
            <div class="text-perfil-card">
            </div>
          </div>
        </footer>
      </article>
      <article class="card">
        <header class="header-card">
          <img src="https://tofuu.getjusto.com/orioneat-local/resized2/EJ5nQCn2wTmqnLA4B-x-400.webp" alt="">
        </header>
        <footer class="footer-card">
          <div class="categoria-card">
            <span>Oferta Miercoles y Jueves</span>
          </div>
          <div class="texto-card">
            <h3>Mitad Precio.</h3>
            <p>Miercoles y Jueves el segundo rollo a mitad de precio</p>
            <div class="cta_tarjeta-rest">
              <a href="PagoDom.html">Pedir ahora</a>
            </div>
          </div>
          <div class="perfil-card">
            <div class="img-perfil-card">
              <img src="img/perfil-2.jpg" alt="">
            </div>
            <div class="text-perfil-card">
            </div>
          </div>
        </footer>
      </article>
      <article class="card">
        <header class="header-card">
          <img src="https://pbs.twimg.com/media/ExrCf5zXABARS1P.jpg" alt="">
        </header>
        <footer class="footer-card">
          <div class="categoria-card">
            <span>Oferta Viernes</span>
          </div>
          <div class="texto-card">
            <h3>2x1 Makis.</h3>
            <p>Compra 10 Makis de Salmon y por nuestra oferta del Viernes   CC, lleva otros 10 makis de salmon totalmente gratis</p>
            <div class="cta_tarjeta-rest">
              <a href="PagoDom.html">Pedir ahora</a>
            </div>
          </div>
          <div class="perfil-card">
            <div class="img-perfil-card">
              <img src="img/perfil-3.jpg" alt="">
            </div>
            <div class="text-perfil-card">
            </div>
          </div>
        </footer>
      </article>
    </div>
  </section>
  <footer class="footer">
    <div class="wrap-footer">
      <div class="text-element-footer element-footer">
        <h3>Restaurante</h3>
        <p>Este restaurante de sushi combina elegancia moderna con la tradición japonesa. Su diseño interior sofisticado crea un ambiente acogedor y animado.</p>
      </div>
      <div class="text-element-footer element-footer">
        <h5>Dirección</h5>
        <ul>
          <li>Calle 45 # 19-36</li>
          <li>Localidad: Teusaquillo </li>
          <li>Movil: (+34) 600 00 00 00</li>
        </ul>
      </div>
      <div class="text-element-footer element-footer">
        <h5>Más información</h5>
        <ul>
          <li><a href="#tarjetas-container">Menu</a></li>
          <li><a href="#section">Ofertas</a></li>
        </ul>
      </div>
      <div class="rrss-element-footer element-footer">
        <h5>Redes Sociales</h5>
        <ul>
          <li><a href="">
            <img src="data:image/svg+xml;base64,PHN2ZyB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJtNTEyIDc1djM2MmMwIDQxLjM5ODQzOC0zMy42MDE1NjIgNzUtNzUgNzVoLTEyMWwtMzAtMzBoLTMwbC0zMCAzMGgtMTUxYy00MS4zOTg0MzggMC03NS0zMy42MDE1NjItNzUtNzV2LTM2MmMwLTQxLjM5ODQzOCAzMy42MDE1NjItNzUgNzUtNzVoMzYyYzQxLjM5ODQzOCAwIDc1IDMzLjYwMTU2MiA3NSA3NXptMCAwIiBmaWxsPSIjNzk4NGViIi8+PHBhdGggZD0ibTUxMiA3NXYzNjJjMCA0MS4zOTg0MzgtMzMuNjAxNTYyIDc1LTc1IDc1aC0xMjFsLTMwLTMwaC0xNXYtNDgyaDE2NmM0MS4zOTg0MzggMCA3NSAzMy42MDE1NjIgNzUgNzV6bTAgMCIgZmlsbD0iIzQ2NjFkMSIvPjxwYXRoIGQ9Im0zMTYgMTgwdjYwaDkwbC0xNSA5MGgtNzV2MTgyaC05MHYtMTgyaC02MHYtOTBoNjB2LTYwYzAtMzMuMzAwNzgxIDE4LjMwMDc4MS02Mi40MDIzNDQgNDUtNzggMTMuMTk5MjE5LTcuNSAyOC44MDA3ODEtMTIgNDUtMTJoOTB2OTB6bTAgMCIgZmlsbD0iI2VjZWNmMSIvPjxwYXRoIGQ9Im0zMTYgMTgwdjYwaDkwbC0xNSA5MGgtNzV2MTgyaC00NXYtNDEwYzEzLjE5OTIxOS03LjUgMjguODAwNzgxLTEyIDQ1LTEyaDkwdjkwem0wIDAiIGZpbGw9IiNlMmUyZTciLz48L3N2Zz4=" alt="icono redes sociales">
          </a></li>
          <li><a href="">
            <img src="data:image/svg+xml;base64,PHN2ZyB2aWV3Qm94PSIwIC0zMSA1MTIgNTEyIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxwYXRoIGQ9Im0yMTEgMjcwLTQwLjkxNzk2OSA0My42NzU3ODEgMTAuOTE3OTY5IDc2LjMyNDIxOSAxMjAtOTB6bTAgMCIgZmlsbD0iIzAwYzBmMSIvPjxwYXRoIGQ9Im0wIDE4MCAxMjEgNjAgOTAgMzAgMjEwIDE4MCA5MS00NTB6bTAgMCIgZmlsbD0iIzc2ZTJmOCIvPjxwYXRoIGQ9Im0xMjEgMjQwIDYwIDE1MCAzMC0xMjAgMjEwLTE4MHptMCAwIiBmaWxsPSIjMjVkOWY4Ii8+PC9zdmc+" alt="icono redes sociales">
          </a></li>
          <li><a href="">
            <img src="data:image/svg+xml;base64,PHN2ZyB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJtMjU2IDBjLTE0MC42OTkyMTkgMC0yNTYgMTE1LjMwMDc4MS0yNTYgMjU2IDAgNDYuNSAxMi41OTc2NTYgOTEuNSAzNi4zMDA3ODEgMTMxLjEwMTU2MmwtMzYuMzAwNzgxIDEyNC44OTg0MzggMTI0Ljg5ODQzOC0zNi4zMDA3ODFjMzkuNjAxNTYyIDIzLjY5OTIxOSA4NC42MDE1NjIgMzYuMzAwNzgxIDEzMS4xMDE1NjIgMzYuMzAwNzgxIDE0MC42OTkyMTkgMCAyNTYtMTE1LjMwMDc4MSAyNTYtMjU2cy0xMTUuMzAwNzgxLTI1Ni0yNTYtMjU2em0wIDAiIGZpbGw9IiMwMGRkN2IiLz48cGF0aCBkPSJtNTEyIDI1NmMwIDE0MC42OTkyMTktMTE1LjMwMDc4MSAyNTYtMjU2IDI1NnYtNTEyYzE0MC42OTkyMTkgMCAyNTYgMTE1LjMwMDc4MSAyNTYgMjU2em0wIDAiIGZpbGw9IiMwMGNjNzEiLz48cGF0aCBkPSJtNDE3LjE5OTIxOSAzNjQuMzAwNzgxLTEyIDExLjY5OTIxOWMtMTYuODAwNzgxIDE2LjgwMDc4MS01NS44MDA3ODEgMTUuNTk3NjU2LTgwLjY5OTIxOSAxMC44MDA3ODEtMjIuMTk5MjE5LTQuMTk5MjE5LTQ2LTE0LjEwMTU2Mi02OC41LTI3LjkwMjM0My02MS4xOTkyMTktMzcuMTk5MjE5LTExNi42OTkyMTktMTAzLjE5OTIxOS0xMzAuMTk5MjE5LTE2Mi41OTc2NTctOS4zMDA3ODEtNDAuMjAzMTI1LTQuMTk5MjE5LTc1IDktODguNWwxMi0xMmM2LjYwMTU2My02LjMwMDc4MSAxNy4wOTc2NTctNi4zMDA3ODEgMjMuNjk5MjE5IDBsNDcuNjk5MjE5IDQ3LjY5OTIxOWMzLjMwMDc4MSAzLjMwMDc4MSA1LjEwMTU2MiA3LjUgNS4xMDE1NjIgMTJzLTEuODAwNzgxIDguNjk5MjE5LTUuMTAxNTYyIDEybC0xMiAxMS42OTkyMTljLTEyLjg5ODQzOCAxMy4xOTkyMTktMTIuODk4NDM4IDM0LjUgMCA0Ny42OTkyMTlsNDkuODAwNzgxIDQ4LjkwMjM0MyAyOS4wOTc2NTYgMjguODAwNzgxYzEzLjIwMzEyNSAxMy4xOTkyMTkgMzUuNTAzOTA2IDEzLjE5OTIxOSA0OC43MDMxMjUgMGwxMS42OTkyMTktMTIuMDAzOTA2YzYuMzAwNzgxLTYgMTcuNjk5MjE5LTYgMjQgMGw0Ny42OTkyMTkgNDcuNzAzMTI1YzYuMzAwNzgxIDYuNTk3NjU3IDYuNjAxNTYyIDE3LjA5NzY1NyAwIDI0em0wIDAiIGZpbGw9IiNlY2VjZjEiLz48cGF0aCBkPSJtNDE3LjE5OTIxOSAzNjQuMzAwNzgxLTEyIDExLjY5OTIxOWMtMTYuODAwNzgxIDE2LjgwMDc4MS01NS44MDA3ODEgMTUuNTk3NjU2LTgwLjY5OTIxOSAxMC44MDA3ODEtMjIuMTk5MjE5LTQuMTk5MjE5LTQ2LTE0LjEwMTU2Mi02OC41LTI3LjkwMjM0M3YtODMuMDk3NjU3bDI5LjA5NzY1NiAyOC44MDA3ODFjMTMuMjAzMTI1IDEzLjE5OTIxOSAzNS41MDM5MDYgMTMuMTk5MjE5IDQ4LjcwMzEyNSAwbDExLjY5OTIxOS0xMi4wMDM5MDZjNi4zMDA3ODEtNiAxNy42OTkyMTktNiAyNCAwbDQ3LjY5OTIxOSA0Ny43MDMxMjVjNi4zMDA3ODEgNi41OTc2NTcgNi42MDE1NjIgMTcuMDk3NjU3IDAgMjR6bTAgMCIgZmlsbD0iI2UyZTJlNyIvPjwvc3ZnPg==" alt="icono redes sociales">
          </a></li>
        </ul>
      </div>
    </div>
    <div class="footer-creds">
      <div class="copy-creds">
        <p> © Meraki Sushi 2024. Todos los derechos reservados.</p>
      </div>
      <div class="legal-creds">
        <ul>
          <li><a href="">Política de Privacidad</a></li>
          <li><a href="">Política de Cookies</a></li>
          <li><a href="">Aviso Legal</a></li>
        </ul>
      </div>
    </div>
    <link rel="stylesheet" href="..\Domicilios/agregar.php">
  </footer>

</body>
</html>