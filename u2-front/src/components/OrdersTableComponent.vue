<template>
    <div>
      <div v-if="orders">
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Ident</th>
                <th scope="col">Numero Interno</th>
                <th scope="col">Fecha de Entrega</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="order in orders" :key="order.id" role="button" @click="seeDetails(order.id)">
                <th scope="row">{{order.id}}</th>
                <td>{{order.customer}}</td>
                <td>{{order.passport_number}}</td>
                <td>{{order.internal_id}}</td>
                <td>{{order.delivery_at}}</td>
              </tr>
            </tbody>
          </table>
      </div>
      <div v-else>
        <h4>No hay ordenes para la fecha seleccionada</h4>
      </div>
    </div>
</template>

<script>
    export default {
        props: {
            orders: {
                type: Array,
                default: null,
                required:true
            },
        },
        methods: {
          seeDetails(id) {
            this.$router.push({
                    name: 'OrderDetail',
                    params: {
                        id: id,
                    }});
          }
        },
    }
</script>

<style lang="scss" scoped>

</style>