<template>
  <div class="container">
    <div class="card shadow">
      <div 
        class="card-header text-white" 
        style="background: linear-gradient(135deg, #2E5077, #1B3552);"
      >
        Editar Empleado
      </div>
      <div class="card-body">
        <form @submit.prevent="actualizarRegistro">
          <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input
              type="text"
              class="form-control"
              required
              name="nombre"
              v-model="empleado.nombre"
              id="nombre"
              placeholder=""
            />
            <small class="form-text text-muted">Escribe el nombre</small>
          </div>
          <div class="form-group">
            <label for="correo">Correo</label>
            <input
              type="email"
              class="form-control"
              required
              name="correo"
              v-model="empleado.correo"
              id="correo"
              placeholder=""
            />
            <small class="form-text text-muted">Escribe el correo del empleado</small>
          </div>
          <div class="btn-group" role="group">
            <button type="submit" class="btn btn-success">Modificar</button>
            <router-link :to="{ name: 'listar' }" class="btn btn-warning">Cancelar</router-link>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "editarComponent",
  data() {
    return {
      empleado: {},
    };
  },
  created() {
    this.obtenerInformacionId();
  },
  methods: {
    obtenerInformacionId() {
      fetch("http://localhost/empleados/?consultar=" + this.$route.params.id)
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);
          this.empleado = datosRespuesta[0];
        })
        .catch(console.log);
    },
    actualizarRegistro() {
      const datosEnviar = {
        id: this.$route.params.id,
        nombre: this.empleado.nombre,
        correo: this.empleado.correo,
      };
      fetch("http://localhost/empleados/?actualizar=" + this.$route.params.id, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(datosEnviar),
      })
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);
          this.$router.push({ name: "listar" });
        })
        .catch(console.log);
    },
  },
};
</script>
