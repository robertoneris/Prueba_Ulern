<template >
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
    <div class="bg-white max-w-2xl shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                MiPerfil
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                En esta pagina puedes ver tus datos de usuario, solo preciona el boton
            </p>
            <button type="button" v-on:click="logme"
                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Cargar datos</button>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt id="name" class="text-sm font-medium text-gray-500">
                        Nombre :
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                         {{ name }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Apellido : 
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ lname }} 
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Correo :
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                         {{ email }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Numero de telefono
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ number }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">

                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">

                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>
</template>
<script>
import axios from 'axios';


export default {

    name: 'ProfView',

    data: function () {
    return {
      name: "",
      lname: "",
      email: "",
      number: "",
    }
  },
    methods: {
        async logme() {

            try {
                console.log(localStorage.getItem("token"))
                const response = await axios.get('http://localhost/api/v1/auth/me', { headers: { Authorization: `Bearer ${localStorage.getItem("token")}` } });
                this.name = response.data.name 
                this.lname = response.data.lastname
                this.email = response.data.email
                this.number = response.data.cell_number
                
            } catch (error) {
                if (error.response) {
                    alert("no esta logeado")
                } else {
                    alert(error.message)
                }
            }
        }
    },
}
</script>
<style></style>