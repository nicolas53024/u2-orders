<template>
  <div>
    <Nav />
    <div class="container mt-5 shadow-lg rounded-lg">
      <h3>Ordenes</h3>
      <p><small>Haga click para visualizar el cotenido de cada orden</small></p>
      <orders-table-component :orders="orders"/>
    </div>
  </div>
</template>

<script>
import axios from "axios";
axios.defaults.withCredentials = true;
import Nav from "../components/Nav";
import OrdersTableComponent from '../components/OrdersTableComponent.vue';
export default {
  created() {
    axios.get("api/get-orders").then((res) => {
      this.orders = res.data;
    });
  },
  components: {
    Nav,
    OrdersTableComponent,
  },
  data() {
    return {
      orders: null,
    };
  },
};
</script>

<style lang="scss" scoped>
</style>