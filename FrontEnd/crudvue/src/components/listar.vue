<template>
  <div class="container my-5">
    <div class="card shadow">
      <div 
        class="card-header text-white" 
        style="background: linear-gradient(135deg, #4DA1A9, #39787B);"
      >
  <h4 class="mb-0">Empleados</h4>
</div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover bg-white rounded shadow-sm">
            <thead class="table-light">
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="empleado in empleados" :key="empleado.id">
                <td>{{ empleado.id }}</td>
                <td>{{ empleado.nombre }}</td>
                <td>{{ empleado.correo }}</td>
                <td>
                  <div class="btn-group" role="group">
                    <router-link
                      :to="{ name: 'editar', params: { id: empleado.id } }"
                      class="btn btn-success"
                    >
                      Editar
                    </router-link>
                    <button
                      type="button"
                      @click="borrarEmpleado(empleado.id)"
                      class="btn btn-danger"
                    >
                      Borrar
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ListarEmpleados",
  data() {
    return {
      empleados: [],
    };
  },
  created() {
    this.consultarEmpleados();
  },
  methods: {
    consultarEmpleados() {
      fetch("http://localhost/empleados/")
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);
          this.empleados = [];
          if (typeof datosRespuesta[0].success === "undefined") {
            this.empleados = datosRespuesta;
          }
        })
        .catch(console.log);
    },
    borrarEmpleado(id) {
      fetch("http://localhost/empleados/?borrar=" + id)
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);
          window.location.href = "listar";
        });
    },
  },
};
</script>
