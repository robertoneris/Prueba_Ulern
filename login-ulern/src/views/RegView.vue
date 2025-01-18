vue <template>
  <div class="max-w-4xl max-sm:max-w-lg mx-auto font-[sans-serif] p-6">
    <div class="text-center mb-12 sm:mb-16">
      <a href="javascript:void(0)"><img src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600"
          alt="logo" class='w-48 inline-block' />
      </a>
      <h4 class="text-gray-600 text-base mt-6">Registra tu cuenta</h4>
    </div>

    <form v-on:submit.prevent="register">
      <div class="grid sm:grid-cols-2 gap-6">
        <div>
          <label class="text-gray-600 text-sm mb-2 block">Nombre</label>
          <input id="name" name="name" type="text" v-model="name"
            class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all"
            placeholder="Enter name" />
        </div>
        <div>
          <label class="text-gray-600 text-sm mb-2 block">Apellido</label>
          <input id="lname" name="lname" type="text" v-model="lname"
            class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all"
            placeholder="Enter last name" />
        </div>
        <div>
          <label class="text-gray-600 text-sm mb-2 block">Email</label>
          <input id="email" name="email" type="text" v-model="email"
            class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all"
            placeholder="Enter email" />
        </div>
        <div>
          <label class="text-gray-600 text-sm mb-2 block">Numero de telefono</label>
          <input id="number" name="number" type="number" v-model="number"
            class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all"
            placeholder="Enter mobile number" />
        </div>
        <div>
          <label class="text-gray-600 text-sm mb-2 block">Contraseña</label>
          <input id="password" name="password" type="password" v-model="password"
            class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all"
            placeholder="Enter password" />
        </div>
        <div>
          <label class="text-gray-600 text-sm mb-2 block">Confirmar Contraseña</label>
          <input id="" name="cpassword" type="password"
            class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all"
            placeholder="Enter confirm password" />
        </div>
      </div>

      <div class="mt-8">
        <button type="submit"
          class="mx-auto block py-3 px-6 text-sm tracking-wider rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
          Registrarse
        </button>
      </div>
    </form>
  </div>
</template>
<script>
import axios from 'axios';
export default {
  name: 'RegView',
  data: function () {
    return {
      name: "",
      lname: "",
      email: "",
      number: "",
      password: "",
    }
  },
  methods: {

    async register() {


      let json = {

        "name": this.name,
        "lastname": this.lname,
        "email": this.email,
        "cell_number": JSON.stringify(this.number),
        "password": this.password
      };
      console.log(json)
      try {
         await axios.post("http://localhost/api/v1/auth/register", json);
        window.location.href = "/Log"



        
      } catch (error) {
        if (error.response) {
          alert("error al crear su cuenta, revise sus datos")
        } else {
          alert(error.message)
        }
      }


    }

  }
}
</script>
<style></style>