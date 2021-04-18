<template>
  <div>
    <Nav />
    <div class="container mt-5 shadow-lg rounded-lg">
      <h3>Ordenes por fecha</h3>
      <form class="form-inline" @submit.prevent="getOrders">
        <div class="form-group mx-sm-3 mb-2">
          <input
            type="date"
            class="form-control"
            id="date"
            placeholder="Password"
            v-model="date"
          />
        </div>
        <button type="submit" class="btn btn-primary mb-2 btn-sm">
          <i class="fas fa-search"></i>
          Buscar
        </button>
      </form>
      <orders-table-component :orders="orders" />
    </div>
  </div>
</template>

<script>
import axios from "axios";
axios.defaults.withCredentials = true;
import Nav from "../components/Nav";
import OrdersTableComponent from "../components/OrdersTableComponent.vue";
export default {
  created() {
    this.date = new Date().toISOString().slice(0, 10);
    this.getOrders();
  },
  components: {
    Nav,
    OrdersTableComponent,
  },
  data() {
    return {
      orders: null,
      date: null,
    };
  },
  methods: {
    getOrders() {
      axios.get(`api/get-orders-by-date?date=${this.date}`).then((res) => {
        this.orders = res.data;
      }).catch((err) => {
         console.log(err.message);
                    this.$swal.fire({
                        icon: 'error',
                        title: 'La fecha no puede ser inferior a 1 año',
                    })
                });
    },
  },
};
</script>

<style lang="scss" scoped>
</style>