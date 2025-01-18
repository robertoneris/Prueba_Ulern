<template>
  <!--
      This example requires updating your template:
  
      ```
      <html class="h-full bg-white">
      <body class="h-full">
      ```
    -->
  <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8 ">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600"
        alt="Your Company" />
      <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">
        Ingresa a tu cuenta
      </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="#" method="POST" v-on:submit.prevent="login">
        <div>
          <label for="email" class="block text-sm/6 font-medium text-gray-900">Correo</label>
          <div class="mt-2">
            <input type="email" name="email" id="email" autocomplete="email" required=""
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
              v-model="mail" placeholder="Su@correo.com" />
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm/6 font-medium text-gray-900">Contraseña</label>

          </div>
          <div class="mt-2">
            <input type="password" name="password" id="password" autocomplete="current-password" required=""
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
              v-model="password" placeholder="Su Contraseña" />
          </div>
        </div>

        <div>
          <button type="submit"
            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Ingresar
          </button>
        </div>
      </form>

      <p class="mt-10 text-center text-sm/6 text-gray-500">
        No tienes cuenta?
        {{ " " }}
        <a href="/reg" class="font-semibold text-indigo-600 hover:text-indigo-500">Registrate ahora</a>
      </p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  name: "LoginView",

  data: function () {
    return {
      mail: "",
      password: "",
      error: false,
      error_msg: "",
    }
  },
  methods: {
    async login() {
      let json = {

        "password": this.password,
        "email": this.mail
      };
      try {
        const response = await axios.post("http://localhost/api/v1/auth/login", json);
        const { access_token, token_type } = response.data;
        localStorage.setItem("token", access_token);
        localStorage.setItem("token_type", token_type);
        
        window.location.href = "/"
      } catch (error) {
        if (error.response) {
          alert(error.response.data.error)
        } else {
          alert(error.message)
        }
      }


    }

  }
}
</script>
<style></style>
