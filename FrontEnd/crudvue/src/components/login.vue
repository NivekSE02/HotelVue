<template>
  <div class="login-container">
    <h2>Hotel Tolteka</h2>
    <form @submit.prevent="handleLogin">
      <div class="mb-3">
        <label>Email:</label>
        <input type="email" v-model="email" required class="form-control" />
      </div>
      <div class="mb-3">
        <label>Contraseña:</label>
        <input type="password" v-model="password" required class="form-control" />
      </div>
      <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    </form>
    <p v-if="errorMessage" class="text-danger mt-2">{{ errorMessage }}</p>
  </div>
</template>

<script>

  

export default {
      name: 'HotelLogin',
  data() {
    return {
      email: '',
      password: '',
      errorMessage: ''
    }
  },
  methods: {
    handleLogin() {
      // Simulación: usuario admin
      const usuarios = [
        { email: 'admin@hotel.com', password: 'admin123', rol: 'admin' },
        { email: 'cliente@hotel.com', password: 'cliente123', rol: 'cliente' }
      ];

      const user = usuarios.find(
        u => u.email === this.email && u.password === this.password
      );

      if (user) {
        // Guardar en localStorage para simular autenticación
        localStorage.setItem('user', JSON.stringify(user));
        if (user.rol === 'admin') {
          this.$router.push({ name: 'adminReservas' });
        } else {
          this.$router.push({ name: 'reservar' });
        }
      } else {
        this.errorMessage = 'Email o contraseña incorrectos.';
      }
    }
  }
}
</script>

<style scoped>
.login-container {
  max-width: 400px;
  margin: auto;
  padding: 2rem;
  background-color: #f8f9fa;
  border-radius: 8px;
}
</style>
