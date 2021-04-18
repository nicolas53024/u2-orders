<template>
  <div>
    <Nav />
    <div class="container mt-5 shadow-lg rounded-lg p-5">
        <p>Si hay productos en stock bajo haga click para ver los detalles</p>
      <div class="card" v-if="order">
        <div class="card-header">Orden # {{ order.internal_id }}</div>
        <div class="card-body">
          <h4 class="card-title">Nombre: {{ order.customer }}</h4>
          <div class="row d-flex justify-content-center">
            <div class="col-6">
              <small><b>Identificación:</b>{{ order.passport_number }}</small>
            </div>
            <div class="col-6">
              <small><b>Fecha de despacho:</b>{{ order.delivery_at }}</small>
            </div>
          </div>
          <h5>Lista de productos</h5>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Ean-13</th>
                <th scope="col">Nombre producto</th>
                <th scope="col">Cantidad a despachar</th>
                <th scope="col">Estado</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="product in order.products" :key="product.id">
                <th scope="row">{{product.id}}</th>
                <td>{{product.barcode}}</td>
                <td>{{product.name}}</td>
                <td>{{product.quantity}}</td>
                <td><span class="badge  px-5" :class="colorBadge(product.stock,product.quantity)" @click="showDetailProduct(product)">{{[product.stock,product.quantity] | estado}}</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div v-else>
        <h2>No existe la orden</h2>
      </div>


     <b-modal id="my-modal">
         <div v-if="productSelected">
         Para el producto {{productSelected.name}} : ean {{productSelected.barcode}}
         <p>Solo puedes despachar <b>{{productSelected.stock}} unidades </b>, para las restantes debes comunicarte con el proveedor
         <b>{{productSelected.provider}}</b>
         </p>
         </div>
     </b-modal>


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
    axios.get(`api/order/${this.$route.params.id}`).then((res) => {
      this.order = res.data;
    });
  },
  components: {
    Nav,
    OrdersTableComponent,
  },
  data() {
    return {
      order: null,
      productSelected:null
    };
  },
  filters: {
      estado: function(value) {
          if(value[1] < value[0]){
              return 'ok';
          }
          return 'stock bajo';
      }
  },
  methods: {
      colorBadge(cant,stock) {
           if(cant < stock){
               return 'badge-danger stock';
          }
              return 'badge-success';
      },
      showDetailProduct(product){
          if(product.quantity > product.stock){
              this.productSelected=product;
              this.$bvModal.show("my-modal")
          }
      }
  },
};
</script>

<style lang="scss" scoped>
 .stock{
     cursor: pointer !important;
 }
</style>