<template>
  <div class="container py-4">
    <h1 class="mb-4">Reserva de Habitaciones</h1>

    <div v-if="mensaje" :class="['alert', mensajeTipo === 'exito' ? 'alert-success' : 'alert-danger']">
      {{ mensaje }}
    </div>

    <div class="row">
      <div v-for="tipo in tiposHabitacion" :key="tipo.nombre" class="col-md-4 mb-4">
        <div class="card" :class="{ 'bg-light': !tipo.disponible }">
          <div class="card-body">
            <h5 class="card-title">{{ tipo.nombre }}</h5>
            <p class="card-text">Capacidad: {{ tipo.capacidad }} personas</p>
            <p class="card-text">Precio: ${{ tipo.precio }}</p>
            <p class="card-text">
              Reservas activas: {{ tipo.reservasActivas }} / {{ tipo.limite }}
            </p>
            <button @click="seleccionarTipoHabitacion(tipo)">Reservar</button>


          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div v-if="modal" class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.5);">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Reservar {{ tipoSeleccionado.nombre }}</h5>
            <button type="button" class="btn-close" @click="cerrarModal"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="confirmarReserva">
              <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input v-model="form.nombre" type="text" class="form-control" required />
              </div>
              <div class="mb-3">
                <label class="form-label">Correo</label>
                <input v-model="form.correo" type="email" class="form-control" required />
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Confirmar</button>
                <button type="button" class="btn btn-secondary" @click="cerrarModal">Cancelar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "ReservasHotel",
  data() {
    return {
      tiposHabitacion: [
        { nombre: "Doble", capacidad: 2, precio: 50, reservasActivas: 0, limite: 5, disponible: true },
        { nombre: "Sencilla", capacidad: 1, precio: 40, reservasActivas: 0, limite: 5, disponible: true },
        { nombre: "Triple", capacidad: 3, precio: 70, reservasActivas: 0, limite: 5, disponible: true }
      ],
      modal: false,
      tipoSeleccionado: null,
      form: {
        nombre: "",
        correo: ""
      },
      mensaje: "",
      mensajeTipo: ""
    };
  },
  mounted() {
    this.actualizarDisponibilidad();
  },
  methods: {
    async actualizarDisponibilidad() {
      try {
        const res = await axios.get("http://localhost/clienteshotel/reservas.php");
        const datos = res.data;

        
        this.tiposHabitacion.forEach(tipo => {
          const dato = datos.find(d => d.tipo_nombre.toLowerCase() === tipo.nombre.toLowerCase());
          tipo.reservasActivas = dato ? parseInt(dato.reservas_activas) : 0;
          tipo.disponible = tipo.reservasActivas < tipo.limite;
        });
      } catch (error) {
        console.error("Error al obtener disponibilidad:", error);
        this.mostrarMensaje("No se pudo cargar disponibilidad.", "error");
      }
    },
    seleccionarTipoHabitacion(tipo) {
      if (!tipo.disponible) {
        this.mostrarMensaje("No hay habitaciones disponibles de este tipo.", "error");
        return;
      }
      this.tipoSeleccionado = tipo;
      this.form.nombre = "";
      this.form.correo = "";
      this.modal = true;
    },
    cerrarModal() {
      this.modal = false;
    },
    async confirmarReserva() {
      if (!this.form.nombre.trim() || !this.form.correo.trim()) {
        this.mostrarMensaje("Todos los campos son obligatorios.", "error");
        return;
      }

      try {
  
        const resHab = await axios.get(
          `http://localhost/clienteshotel/habitacion_libre.php?tipo=${encodeURIComponent(this.tipoSeleccionado.nombre)}`
        );
        const habitacionLibre = resHab.data.habitacion_id;
        if (!habitacionLibre) {
          this.mostrarMensaje("No hay habitaciones disponibles de este tipo.", "error");
          this.modal = false;
          await this.actualizarDisponibilidad();
          return;
        }

        // Insertar reserva con la habitación libre
        await axios.post("http://localhost/clienteshotel/reservas.php", {
 
          habitacion_id: habitacionLibre,
          cliente_nombre: this.form.nombre,
          cliente_correo: this.form.correo
        });

        this.modal = false;
        this.mostrarMensaje("Reserva realizada con éxito. Te contactaremos pronto.", "exito");
        await this.actualizarDisponibilidad();
      } catch (e) {
        const msg = e.response?.data?.mensaje || "No se pudo realizar la reserva.";
        console.error("Error al reservar:", e);
        this.modal = false;
        this.mostrarMensaje(msg, "error");
      }
    },
    mostrarMensaje(texto, tipo) {
      this.mensaje = texto;
      this.mensajeTipo = tipo;
      setTimeout(() => (this.mensaje = ""), 4000);
    }
  }
};
</script>
