


<template>
  
  <div class="container mt-5">
    <!-- Hero Section -->
    <section class="hero mb-5 rounded shadow">
      <div class="hero-overlay"></div>
      <div class="hero-content text-white">
        <div class="container py-5">
          <h2 class="display-4 fw-bold">Hotel Tolteka</h2>
          <p class="lead mb-0">Donde el lujo se encuentra con la comodidad.</p>
        </div>
      </div>
    </section>

    <!-- Description Section -->
    <section class="text-section mb-5 text-center">
      <h3 class="section-title">Una experiencia inolvidable</h3>
      <p class="lead">
        Sumérgete en el confort de nuestras instalaciones diseñadas para ofrecer una estancia placentera y relajante.
      </p>
    </section>

    <!-- Image and Text Section -->
    <section class="row align-items-center mb-5">
      <div class="col-md-6 text-center">
        <img :src="habitacionImage" alt="Habitación del hotel" class="section-img" />
      </div>
      <div class="col-md-6">
        <h3 class="section-title">Diseño y Comodidad</h3>
        <p>
          Cada rincón de nuestro hotel ha sido cuidadosamente diseñado para brindarte el máximo confort y estilo.
        </p>
      </div>
    </section>

    <!-- NUEVA SECCIÓN: Información de la cadena hotelera -->
    <section class="row mb-5 align-items-center bg-light p-4 rounded shadow">
      <div class="col-md-8">
        <h5 class="text-uppercase text-muted mb-2">Hoteles El Salvador</h5>
        <h3 class="section-title mb-3">Relájate en nuestra cadena Hotelera</h3>
        <p class="mb-3">
          Grupo Hotesa es una cadena hotelera conformada por 7 hoteles estratégicamente ubicados en distintos departamentos y zonas de nuestro querido El Salvador. Cada uno de nuestros hoteles se distingue por ofrecer una atención al cliente excepcional y habitaciones equipadas con todas las comodidades para que te sientas como en casa.
        </p>
        <p class="mb-3">
          Contamos con hoteles ubicados frente a las hermosas playas de nuestro país, tanto en la Costa del Sol como en La Libertad. Además, disponemos de 5 hoteles en áreas urbanas. Cuatro de ellos ofrecen servicios como restaurante, piscina, salones para eventos, así como habitaciones sencillas, dobles y triples. Entre ellos, destacan el Hotel Capital en San Salvador, el Hotel Tolteka en el departamento de Santa Ana, el Hotel Las Palmeras en el departamento de Sonsonate, el Hotel Sevilla en el departamento de Usulután y el Hotel San José en el distrito de Metapán.
        </p>
        <p>
          En Grupo Hotesa, nos esforzamos por brindar comodidad en el mercado del servicio hotelero y gastronómico para todas aquellas personas que buscan disfrutar de una experiencia única y diferente. Nuestro compromiso con el cliente es primordial, y deseamos que su estadía sea completamente satisfactoria y agradable.
        </p>
      </div>
      <div class="col-md-4 text-center">
        <img :src="habitacionImage" alt="Habitación" class="img-fluid rounded mb-3 shadow" />
        <div class="bg-primary text-white p-4 rounded">
          <i class="fas fa-concierge-bell fa-2x mb-2"></i>
          <h4 class="fw-bold">100+</h4>
          <small>Habitaciones</small>
        </div>
      </div>
    </section>

    <!-- NUEVA SECCIÓN: Línea de pasos y servicios -->
<section class="container py-5">
  <!-- Línea de pasos -->
  <div class="d-flex justify-content-center mb-5">
    <div class="step-line position-relative d-flex justify-content-between w-75">
      <div class="step text-center">
        <div class="step-number">01</div>
        <div class="step-title">Reserva una habitación</div>
      </div>
      <div class="step text-center">
        <div class="step-number">02</div>
        <div class="step-title">Llegar al hotel</div>
      </div>
      <div class="step text-center">
        <div class="step-number">03</div>
        <div class="step-title">Disfruta de la estancia</div>
      </div>

    </div>
  </div>

  <!-- Servicios destacados -->
  <div class="row justify-content-center text-center mb-5">
    <div class="col-md-4 mb-4">
      <div class="card p-3 shadow-sm">
        <img src="@/assets/desayuno.png" class="img-fluid rounded mb-3" alt="Desayuno" />
        <h5 class="fw-bold">Desayunos</h5>
        <p>Disfruta de un delicioso desayuno en tu estadía</p>
        <router-link to="/habitaciones">
          <button class="btn btn-danger">Ver Habitaciones</button>
        </router-link>
      </div>
    </div>

    <div class="col-md-4 text-start">
      <div class="mb-3 d-flex align-items-center">
        <i class="fas fa-key fa-2x me-3 text-primary"></i>
        <div>
          <h6 class="mb-0">Llaves Inteligentes</h6>
          <small>Comodidad y seguridad</small>
        </div>
      </div>
      <div class="mb-3 d-flex align-items-center">
        <i class="fas fa-suitcase-rolling fa-2x me-3 text-primary"></i>
        <div>
          <h6 class="mb-0">Equipaje Seguro</h6>
          <small>Comodidad en sus pertenencias</small>
        </div>
      </div>
      <div class="mb-3 d-flex align-items-center">
        <i class="fas fa-concierge-bell fa-2x me-3 text-primary"></i>
        <div>
          <h6 class="mb-0">Servicio a la Habitación</h6>
          <small>Comodidad y satisfacción</small>
        </div>
      </div>
      <div class="mb-3 d-flex align-items-center">
        <i class="fas fa-broom fa-2x me-3 text-primary"></i>
        <div>
          <h6 class="mb-0">Limpieza e Higiene</h6>
          <small>Comodidad en cada aspecto</small>
        </div>
      </div>
    </div>
  </div>

  <!-- Nuestra Visión -->
  <div class="mb-5">
    <p class="text-uppercase small text-muted">Quiénes somos</p>
    <h3 class="fw-bold">Nuestra Visión</h3>
    <p>
      HOTESA, una empresa con visión de seguir creando hoteles con capital y sudor salvadoreño, en donde usted nos necesite ahí estaremos. Le aseguramos que todos nuestros esfuerzos van enfocados a su comodidad, descanso y satisfacción.
    </p>
  </div>

  <!-- Nuestra Misión -->
  <div class="mb-5">
    <p class="text-uppercase small text-muted">Quiénes somos</p>
    <h3 class="fw-bold">Nuestra Misión</h3>
    <p>
      En HOTESA nuestra misión es que al llegar a cualquiera de nuestros hoteles usted se sienta como “llegar a casa”, es decir que si hay algo en lo que lo podamos ayudar y poderle servir usted se lo merece estamos en la completa disposición de hacerlo.
    </p>
  </div>
</section>


    <!-- Amenities Section -->
    <section class="mb-5 text-center">
      <h3 class="section-title">Comodidades del Hotel</h3>
      <div class="row">
        <div class="col-md-3 mb-4" v-for="(amenity, index) in amenities" :key="index">
          <div class="card h-100 shadow-sm">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
              <i :class="amenity.icon" class="display-6 mb-3"></i>
              <h6 class="card-title">{{ amenity.title }}</h6>
              <p class="card-text text-center">{{ amenity.description }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Booking Call-to-Action -->
    <section class="text-center mb-5">
      <h3 class="section-title">Reserva tu estancia</h3>
      <p class="mb-4">¡No esperes más para disfrutar de una experiencia única!</p>
      <router-link to="/habitaciones">
        <button class="btn btn-success px-4 py-2 me-2">Reservar Ahora</button>
      </router-link>
      <router-link to="/contacto">
        <button class="btn btn-outline-primary px-4 py-2">Ir a Contacto</button>
      </router-link>
    </section>
  </div>
</template>

<script>
import habitacionImage from '@/assets/DSF7617.jpg';

export default {
  data() {
    return {
      habitacionImage,
      amenities: [
        { icon: 'fas fa-wifi', title: 'Wi-Fi Gratis', description: 'Conexión rápida en todo el hotel.' },
        { icon: 'fas fa-swimming-pool', title: 'Piscina', description: 'Disfruta de nuestra piscina al aire libre.' },
        { icon: 'fas fa-dumbbell', title: 'Gimnasio', description: 'Equipado para todas tus rutinas.' },
        { icon: 'fas fa-concierge-bell', title: 'Servicio 24h', description: 'Atención personalizada día y noche.' },
      ],
    };
  },
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

* {
  font-family: 'Poppins', sans-serif;
}

.hero {
  position: relative;
  min-height: 400px;
  background-image: url('@/assets/Principal.jpeg');
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  border-radius: 1rem;
  overflow: hidden;
}

.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 1;
}

.hero-content {
  position: relative;
  z-index: 2;
  padding: 3rem;
}

.section-title {
  font-weight: 600;
  font-size: 2.2rem;
  margin-bottom: 1rem;
  color: #222;
}

.text-section p {
  color: #666;
  font-size: 1rem;
  line-height: 1.8;
}

.section-img {
  width: 100%;
  max-width: 400px;
  object-fit: cover;
  border-radius: 1rem;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
}

.card {
  border: none;
  border-radius: 1rem;
  overflow: hidden;
  transition: transform 0.3s ease;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
}

.card-body {
  padding: 1.5rem;
}

.card-title {
  font-weight: 600;
  font-size: 1.2rem;
  color: #333;
}

.card-text {
  font-size: 0.95rem;
  color: #777;
}

.btn-success {
  background-color: #1f87e0;
  border: none;
  font-weight: 500;
  border-radius: 0.5rem;
}

.btn-success:hover {
  background-color: #155fa0;
}

h3,
h2 {
  color: #1a1a1a;
}

.container {
  max-width: 1100px;
}

.row > .col-md-3 i {
  color: #1f87e0;
}

.row > .col-md-3 h6 {
  font-weight: 500;
  margin-top: 0.5rem;
  color: #333;
}

.step-line {
  position: relative;
  border-top: 1px solid #ddd;
  padding-top: 2rem;
}

.step-number {
  font-size: 2.5rem;
  font-weight: bold;
}

.step-title {
  font-size: 1rem;
  color: #555;
}

.step-line-dot {
  width: 14px;
  height: 14px;
}

</style>
