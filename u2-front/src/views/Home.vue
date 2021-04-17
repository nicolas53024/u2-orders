<template>
  <div class="container mt-5">
    <div class="row d-flex justify-content-center">
      <div class="card col-lg-5 col-sm-12 shadow-lg" style="width: 18rem">
        <div class="modal-body">
          <div class="form-title text-center">
            <h5>Login</h5>
          </div>
          <div class="d-flex flex-column text-center">
            <form @submit.prevent="submitForm(form)">
              <div class="form-group">
                <input
                  type="email"
                  class="form-control"
                  v-model="form.email"
                  placeholder="Em@il..."
                />
              </div>
              <div class="form-group">
                <input
                  type="password"
                  class="form-control"
                  v-model="form.password"
                  placeholder="Contraseña..."
                />
              </div>
              <div v-if="!showSpinner">
                <button
                  type="button"
                  class="btn btn-danger btn-sm col-4 mr-1"
                  @click="limpiar"
                >
                  <i class="far fa-trash-alt"></i>
                  Limpiar
                </button>
                <input
                  type="submit"
                  class="btn btn-success btn-sm col-4"
                  :disabled="$v.form.$invalid"
                  value="login"
                />
              </div>
              <div v-else>
              <pulse-loader :loading="loading" :color="color" :size="size"></pulse-loader>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
import { required, email } from "vuelidate/lib/validators";
// import axios from 'axios';
import {mapActions} from 'vuex';
export default {
  components: {
    PulseLoader
  },
  data() {
    return {
      showSpinner:false,
      form: {
        email: "admin@test.com",
        password: "inicio01",
      },
    };
  },
  methods: {
    ...mapActions('auth',['login']),
    limpiar() {
      this.form.email = "";
      this.form.password = "";
    },
    async submitForm(){
      this.showSpinner=true
       await this.login(this.form).then(()=>{
           setTimeout(() => {
            this.$router.replace({ name: 'Orders' });
                    }, 3000)
        })
        .catch(() => {
          this.showSpinner=false
          this.$swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Credenciales Invalidas!',
          })
        });
    }
  },
  validations: {
    form: {
      email: {
        required,
        email,
      },
      password: {
        required,
      },
    },
  },
};
</script>
