<template>
  <nav>
    <router-link to="/">Home</router-link> |
    <router-link to="/Log">Login</router-link> |
    <router-link to="/reg">Registro</router-link>|
    <router-link to="/prof">Perfil</router-link>
  </nav>
  <router-view/>
</template>
<script>


</script>
<style scoped>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #1d6ebe;

}

nav {
  padding: 40px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
  
}
</style>
