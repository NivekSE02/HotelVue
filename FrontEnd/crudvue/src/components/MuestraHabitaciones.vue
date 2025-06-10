<template>
  <div class="container py-5">

    <div class="text-center mb-5 p-5 bg-light rounded shadow animate-fadeInUp">
      <h3 class="sub-title">HOTEL TOLTEKA PLAZA</h3>
      <h1 class="display-5 fw-bold">Nuestras Habitaciones</h1>
      <p class="lead text-muted">Elige el espacio ideal para tu estadía perfecta</p>
    </div>


    <!-- Habitaciones -->
    <div class="d-flex flex-column gap-5">
      <div
        v-for="habitacion in habitaciones"
        :key="habitacion.tipo"
        class="card shadow-sm mx-auto w-100 habitacion-card"
        style="max-width: 900px"
      >
        <img
  class="card-img-top"
  :src="habitacion.imagen"
  :alt="'Imagen de habitación ' + habitacion.tipo"
  style="height: 350px; object-fit: cover; border-top-left-radius: 1rem; border-top-right-radius: 1rem;"
/>

        <div class="card-body">
          <h5 class="text-primary fw-bold">Desde {{ habitacion.precio }}</h5>
          <h3 class="card-title">Habitación {{ habitacion.tipo }}</h3>
          <p class="text-muted mb-2">
            <i class="fas fa-bed me-2"></i>{{ habitacion.camas }} camas
            <i class="fas fa-expand ms-3 me-2"></i>{{ habitacion.area }} FT²
          </p>
          <p class="text-muted mb-2">
            <i class="fas fa-wifi me-2"></i>
            <i class="fas fa-tv me-2"></i>
            <i class="fas fa-snowflake me-2"></i>
          </p>
          <p class="card-text">{{ habitacion.descripcion }}</p>
          <button
            @click="seleccionarTipoHabitacion(habitacion.tipo)"
            class="btn btn-outline-primary btn-lg w-100 mt-3"
          >
            <i class="fas fa-calendar-check me-2"></i> RESERVAR AHORA
          </button>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div v-if="modal" class="modal-backdrop">
      <div class="modal-content-custom">
        <h3 class="mb-3">Reserva Habitación {{ tipoSeleccionado.nombre }}</h3>
        <input v-model="form.nombre" placeholder="Tu nombre" class="form-control mb-2" />
        <input v-model="form.correo" placeholder="Tu correo" class="form-control mb-2" />
        <button @click="confirmarReserva" class="btn btn-success w-100 mb-2">Confirmar Reserva</button>
        <button @click="cerrarModal" class="btn btn-secondary w-100">Cancelar</button>
      </div>
    </div>

    <!-- Mensaje flotante -->
<div
  v-if="mensaje"
  :class="['alert', mensajeTipo === 'exito' ? 'alert-success' : 'alert-danger']"
  class="mensaje-flotante"
>
  {{ mensaje }}
</div>

  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "MuestraHabitaciones",
  data() {
    return {
      habitaciones: [
        {
          tipo: "Sencilla",
          precio: "$65.00",
          camas: 1,
          area: 100,
          descripcion: "La habitación sencilla es perfecta para viajeros solitarios o personas de negocios que buscan comodidad y funcionalidad. Cuenta con una cama individual, escritorio de trabajo, baño privado, aire acondicionado, Wi-Fi de alta velocidad y televisión por cable. Ideal para estancias breves con todo lo esencial para descansar y trabajar con tranquilidad.",
          imagen: require('@/assets/Sencilla.jpg')
        },
        
        {
          tipo: "Doble",
          precio: "$75.00",
          camas: 2,
          area: 200,
          descripcion: "La habitación doble ofrece un espacio amplio y acogedor, ideal para parejas, amigos o compañeros de viaje. Incluye una cama matrimonial o dos camas individuales, baño privado, televisor de pantalla plana, conexión Wi-Fi, aire acondicionado y minibar. Diseñada para brindar confort y relajación en una atmósfera tranquila.",
           imagen: require('@/assets/doble.jpg')
        },
        {
          tipo: "Triple",
          precio: "$85.00",
          camas: 3,
          area: 200,
          descripcion: "La habitación triple está pensada para grupos pequeños o familias que desean compartir un mismo espacio sin sacrificar comodidad. Dispone de tres camas individuales (o combinaciones según disponibilidad), baño privado, espacio para equipaje, aire acondicionado, Wi-Fi y televisión. Perfecta para una estadía funcional y placentera.",
           imagen: require('@/assets/triple.jpg')
        }
      ],
      tiposHabitacion: [
        { nombre: "Doble", capacidad: 2, precio: 50, reservasActivas: 0, limite: 5, disponible: true },
        { nombre: "Sencilla", capacidad: 1, precio: 40, reservasActivas: 0, limite: 5, disponible: true },
        { nombre: "Triple", capacidad: 3, precio: 70, reservasActivas: 0, limite: 5, disponible: true }
      ],
      modal: false,
      tipoSeleccionado: null,
      form: { nombre: "", correo: "" },
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
        this.mostrarMensaje("Error al cargar disponibilidad", "error");
      }
    },
    seleccionarTipoHabitacion(nombreTipo) {
      const tipo = this.tiposHabitacion.find(t => t.nombre === nombreTipo);
      if (!tipo || !tipo.disponible) {
        this.mostrarMensaje("No hay disponibilidad para esta habitación", "error");
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

        await axios.post("http://localhost/clienteshotel/reservas.php", {
          habitacion_id: habitacionLibre,
          cliente_nombre: this.form.nombre,
          cliente_correo: this.form.correo
        });

        this.modal = false;
        this.mostrarMensaje("Reserva realizada con éxito.", "exito");
        await this.actualizarDisponibilidad();
      } catch (e) {
        const msg = e.response?.data?.mensaje || "No se pudo realizar la reserva.";
        this.mostrarMensaje(msg, "error");
        this.modal = false;
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

<style scoped>
.mensaje-flotante {
  position: fixed;
  top: 20px;
  right: 20px;
  z-index: 9999;
  min-width: 250px;
  padding: 1rem 1.5rem;
  font-weight: bold;
  border-radius: 0.5rem;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  transition: opacity 0.3s ease;
}

.card-title {
  font-size: 1.75rem;
}
.habitacion-card {
  border-radius: 1rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.habitacion-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 24px rgba(0, 0, 0, 0.15);
}
.modal-backdrop {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0,0,0,0.4);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
}
.modal-content-custom {
  background: white;
  padding: 2rem;
  border-radius: 0.75rem;
  width: 100%;
  max-width: 400px;
  box-shadow: 0 5px 20px rgba(0,0,0,0.3);
}
</style>