<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="info">
      <router-link to="/" class="navbar-brand">App</router-link>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <router-link to="/" class="nav-link" :class="{'active':currentPath('/')}" >Home</router-link>
          <router-link to="/orders" class="nav-link" :class="{'active':currentPath('/orders')}">Ordenes</router-link>
        </b-navbar-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <b-nav-item-dropdown right>
            <!-- Using 'button-content' slot -->
            <template #button-content>
              <em>User</em>
            </template>
            <!-- <b-dropdown-item href="#">Profile</b-dropdown-item> -->
            <b-dropdown-item href="#" @click.prevent="salir()" >Salir</b-dropdown-item>
          </b-nav-item-dropdown>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  
  </div>
</template>

<script>
import {mapActions} from 'vuex';
export default {
    methods: {
       ...mapActions('auth',['logout']),
        currentPath(url) {
            return this.$route.fullPath===url
        },
        async salir(){
                await this.logout();
                this.$router.replace({
                    name: 'Home'
                });
        }
    },
    
};
</script>

<style lang="scss" scoped>
</style>