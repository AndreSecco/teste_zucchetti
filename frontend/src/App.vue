<template>
  <div id="app">
    <nav>
      <nav-bar-component></nav-bar-component>
    </nav>
    <router-view/>
  </div>
</template>

<script>
import NavBarComponent from './components/NavBar/NavBarComponent.vue';

export default {
  name: 'App',
  components: {
    NavBarComponent
  }
}

</script>
<style>
#app {
  font-family: Poppins;
  background: #eee;
}
:root {
  background: #eee;
}
</style>
