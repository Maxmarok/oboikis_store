<script setup>
import {onMounted, onUnmounted, ref, inject} from 'vue'
import { useRouter } from 'vue-router'
import { useProfileStore } from '@js/stores/profileStore'

const router = useRouter()
const profile = useProfileStore()

const user = ref({
  email: null,
  password: null,
})
const errors = ref({
  email: null,
  password: null,
})
const swal = inject('$swal')
const loginUser = () => {
  axios.post('/api/v1/dashboard/login', user.value)
    .then((res) => {
      profile.setUser(res.data.user)
      profile.setToken(res.data.token)
      router.push({name: 'Dashboard'})
    })
    .catch((err) => {
      if(err.response !== undefined) {
        if(err.response.data.errors !== undefined) errors.value = err.response.data.errors
        if(err.response.data.message !== undefined) {
            swal.fire({
                text: err.response.data.message,
                position: 'bottom-end',
                showConfirmButton: false,
                icon: 'error',
                backdrop: false,
                timer: 2000,
            })
        }
      }
    })
}

onMounted(() => document.body.classList.add("auth-body-bg"))
onUnmounted(() => document.body.classList.remove("auth-body-bg"))

</script>
<template>
<div>
  <div class="home-btn d-none d-sm-block">
    <a href="/">
      <i class="mdi mdi-home-variant h2 text-white"></i>
    </a>
  </div>
  <div class="container-fluid p-0">
    <div class="row no-gutters">
      <div class="col-lg-4">
        <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
          <div class="w-100">
            <div class="row justify-content-center">
              <div class="col-lg-9">
                <div>
                  <div class="text-center">
                    <div>
                      <a href="/" class="logo">
                        <img src="@js/assets/images/logo-admin.svg" height="20" alt="logo" />
                      </a>
                    </div>

                    <h4 class="font-size-18 mt-4">Авторизация</h4>
                  </div>

                  <div class="p-2 mt-5">

                    <form class="form-horizontal" @submit.prevent="loginUser">

                      <div class="form-group auth-form-group-custom mb-4">
                        <i class="ri-mail-line auti-custom-input-icon"></i>
                        <label for="email">Email</label>
                        <input
                          v-model="user.email"
                          type="email"
                          class="form-control"
                          id="email"
                          placeholder="Введите email"
                          :class="{ 'is-invalid': errors.email }"
                        />
                        <div v-if="errors.email" class="invalid-feedback">
                          <span v-for="error in errors.email " v-html="error" />
                        </div>
                      </div>

                      <div class="form-group auth-form-group-custom mb-4">
                        <i class="ri-lock-2-line auti-custom-input-icon"></i>
                        <label for="password">Пароль</label>
                        <input
                          v-model="user.password"
                          type="password"
                          class="form-control"
                          id="password"
                          placeholder="Введите пароль"
                          :class="{ 'is-invalid': errors.password }"
                        />
                        <div v-if="errors.password" class="invalid-feedback">
                          <span v-for="error in errors.password " v-html="error" />
                        </div>
                      </div>

                      <div class="text-center">
                        <button
                          class="btn btn-success w-md waves-effect waves-light"
                          type="submit"
                        >Авторизоваться</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
          <div class="authentication-bg"></div>
      </div>
    </div>
  </div>
</div>
</template>