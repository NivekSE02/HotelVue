
<template>
  <div class="container my-5">
    <!-- INFORMACIÓN DE CONTACTO Y HORARIOS -->
    <div class="row gy-4 align-items-stretch mb-4">
      <div class="col-md-4">
        <div class="info-card bg-danger text-white p-4 rounded h-100">
          <h5 class="fw-bold">INFORMACIÓN DE CONTACTO</h5>
          <p>San Salvador, El Salvador</p>
          <p>+503 2526 - 7000</p>
          <p>reservaciones@hoteleselsalvador.com</p>
        </div>
      </div>

      <div class="col-md-4">
        <div :style="{ backgroundImage: 'url(' + eventosImage + ')' }" class="image-card">
          <div class="overlay-text">
            <h3>Eventos</h3>
            <button class="btn btn-light btn-sm mt-2">MÁS INFORMACIÓN</button>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div :style="{ backgroundImage: 'url(' + playaImage + ')' }" class="image-card">
          <div class="overlay-text">
            <h3>Playa</h3>
            <button class="btn btn-light btn-sm mt-2">MÁS INFORMACIÓN</button>
          </div>
        </div>
      </div>
    </div>

    <!-- HORARIOS -->
    <div class="row mb-4">
      <div class="col-md-4">
        <div class="info-card bg-danger text-white p-4 rounded h-100">
          <h5 class="fw-bold">HORARIOS DE RECEPCIÓN</h5>
          <p>LUN ...... 08:00 am - 5:00 pm</p>
          <p>VIE ...... 08:00 am - 5:00 pm</p>
          <p>SAB ...... 08:00 am - 5:00 pm</p>
          <p>DOM ...... 08:00 am - 5:00 pm</p>
        </div>
      </div>
    </div>

    <!-- FORMULARIO DE CONTACTO -->
    <div class="contact-card shadow p-4 rounded bg-white">
      <h2 class="text-center mb-4 text-danger">Contáctanos</h2>
      <form @submit.prevent="submitForm">
        <div class="mb-3">
          <label for="name" class="form-label">Nombre</label>
          <input v-model="form.name" type="text" class="form-control" id="name" required />
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Correo electrónico</label>
          <input v-model="form.email" type="email" class="form-control" id="email" required />
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Mensaje</label>
          <textarea v-model="form.message" class="form-control" id="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Enviar</button>
      </form>
      <div v-if="submitted" class="alert alert-success mt-3" role="alert">
        ¡Mensaje enviado con éxito!
      </div>
    </div>
  </div>
</template>

<script>
import eventosImage from '@/assets/DSF7617.jpg'; // Ajusta si el nombre es diferente
import playaImage from '@/assets/kevin.jpeg'; // Ajusta si el nombre es diferente

export default {
  name: 'ContactoHotel',
  data() {
    return {
      eventosImage,
      playaImage,
      form: {
        name: '',
        email: '',
        message: ''
      },
      submitted: false
    };
  },
  methods: {
    submitForm() {
      console.log('Formulario enviado:', this.form);
      this.submitted = true;
      setTimeout(() => {
        this.submitted = false;
        this.form = { name: '', email: '', message: '' };
      }, 3000);
    }
  }
};
</script>

<style scoped>
.image-card {
  height: 100%;
  min-height: 300px;
  background-size: cover;
  background-position: center;
  position: relative;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.overlay-text {
  position: absolute;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  color: white;
  width: 100%;
  padding: 10px;
  text-align: center;
}

.contact-card {
  background-color: #fff;
  margin-top: 30px;
}

.info-card {
  font-size: 0.95rem;
}
</style>
