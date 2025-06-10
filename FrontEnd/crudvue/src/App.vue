<template>
  }import BlurText from "./BlurText";

const handleAnimationComplete = () => {
  console.log('Animation completed!');
};

<BlurText
  text="Isn't this so cool?!"
  delay={150}
  animateBy="words"
  direction="top"
  onAnimationComplete={handleAnimationComplete}
  className="text-2xl mb-8"
/>
 <header class="custom-header text-white py-4">
  <div class="container d-flex justify-content-between align-items-center">
    <h1 class="h4 mb-0 fw-bold">Hotel Tolteka Plaza</h1>
   <nav class="nav-links d-flex">
  <router-link class="nav-link me-3" to="/">Inicio</router-link>
  <router-link class="nav-link me-3" to="/Habitaciones">Habitaciones</router-link>
  <router-link class="nav-link" to="/contacto">Contacto</router-link>
</nav>

  </div>
</header>

  <div id="app" class="min-vh-100 d-flex flex-column bg-light">
   


    <main class="container my-5 flex-grow-1 d-flex align-items-center justify-content-center">
      <router-view />
    </main>

   
<footer class="custom-footer text-white text-center py-3 mt-auto">
      <div class="container">
        <p>© 2025 Hotel Tolteka Plaza. Todos los derechos reservados.</p>
        <p>Teléfono: +503 1234 5678 | Email: info@hoteltoltekaplaza.com</p>
      </div>
    </footer>
  </div>
</template>
<style scoped>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
}

.router-link-exact-active.btn {
  font-weight: bold;
  background-color: #ffffff22;
}

.custom-header {
  background: rgba(112, 18, 54, 0.85);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  padding-top: 0.4rem;
  padding-bottom: 0.4rem;
}

.custom-footer {
  background-color: #782b3c; /* Igual que header */
}
</style>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
}

/* Para resaltar el botón activo */
.router-link-exact-active.btn {
  font-weight: bold;
  background-color: #ffffff22;
}.custom-header {
  background: rgba(112, 18, 54, 0.85); /* burdeos con transparencia */
  backdrop-filter: blur(8px);         /* difuminado elegante */
  -webkit-backdrop-filter: blur(8px); /* soporte Safari */
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
 
}

.nav-links .nav-link {
  color: #fff;
  font-weight: 500;
  text-decoration: none;
  transition: color 0.3s ease;
}

.nav-links .nav-link:hover {
  color: #ffc107; /* Amarillo elegante */
}
.custom-footer {
  background: rgba(88, 24, 69, 0.85); /* Igual que el header */
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}
.custom-footer p {
  margin: 0;
  font-size: 0.9rem;
  color: #fff;
}
.custom-footer p:last-child {
  margin-top: 0.5rem;
}
.custom-footer a {
  color: #ffc107; /* Amarillo elegante */
  text-decoration: none;
}
.custom-footer a:hover {
  text-decoration: underline;
}

</style>
