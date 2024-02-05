<script setup>
import {onMounted, ref, inject} from 'vue'
import PageHeader from "@js/components/dashboard/PageHeader.vue"
import { useInfoStore } from '@js/stores/infoStore'
const info = useInfoStore()

import InfoModal from '@js/components/modals/InfoModal.vue'

const title = "Основная информация"

const data = ref({
    name: null,
    tax: null,
})

const id = ref()

const modalApiKey = ref()

const modalTitle = ref()
const modalType = ref()
const modalItem = ref()

const swal = inject('$swal')

const getInfo = () => {
   
    axios.get(`/api/v1/dashboard/info/`)
        .then((res) => {
            data.value = res.data.data
        })
}

const updateInfo = () => {
   
   axios.post(`/api/v1/dashboard/info/update`, {info: data.value})
       .then((res) => {
           swal.fire({
            text: 'Информация обновлена',
            //position: 'bottom-end',
            // toast: true,
            showConfirmButton: false,
            icon: 'success',
            timer: 2000,
          })
       })
}

onMounted(() => {
    getInfo()
})
</script>
<template>
<InfoModal 
    ref="modalInfo"
    :title="modalTitle"
    :type="modalType"
    :item="modalItem"
    @action="getData"
/>
<PageHeader :title="title" />

<div class="d-flex align-items-center row mb-3">

</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mb-4">
                            <label for="phone">Номер телефона</label>
                            <input
                                type="text"
                                class="form-control"
                                id="phone"
                                placeholder="Введите номер телефона"
                                v-model="data.phone"
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group mb-4">
                            <label for="email">Email адрес</label>
                            <input
                                type="text"
                                class="form-control"
                                id="email"
                                placeholder="Введите email адрес"
                                v-model="data.email"
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group mb-4">
                            <label for="logo">Логотип</label>
                            <input
                                type="text"
                                class="form-control"
                                id="logo"
                                placeholder="Введите email адрес"
                                v-model="data.logo"
                            />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mb-4">
                            <label for="vk">Ссылка «Вконтакте»</label>
                            <input
                                type="text"
                                class="form-control"
                                id="vk"
                                placeholder="Введите ссылку для «Вконтакте»"
                                v-model="data.vk"
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group mb-4">
                            <label for="telegram">Ссылка Telegram</label>
                            <input
                                type="text"
                                class="form-control"
                                id="ttelegramax"
                                placeholder="Введите ссылку для telegram"
                                v-model="data.telegram"
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group mb-4">
                            <label for="whatsapp">Ссылка WhatsApp</label>
                            <input
                                type="text"
                                class="form-control"
                                id="whatsapp"
                                placeholder="Введите ссылку для WhatsApp"
                                v-model="data.whatsapp"
                            />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mb-4">
                            <label for="viber">Ссылка Viber</label>
                            <input
                                type="text"
                                class="form-control"
                                id="viber"
                                placeholder="Введите ссылку для viber"
                                v-model="data.viber"
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group mb-4">
                            <label for="instagram">Ссылка Instagram</label>
                            <input
                                type="text"
                                class="form-control"
                                id="instagram"
                                placeholder="Введите ссылку для instagram"
                                v-model="data.instagram"
                            />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mb-4">
                            <label for="file_1">Политика конфиденциальности</label>
                            <input
                                type="text"
                                class="form-control"
                                id="file_1"
                                placeholder="Введите ссылку для viber"
                                v-model="data.file_1"
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group mb-4">
                            <label for="file_2">Публичная оферта</label>
                            <input
                                type="text"
                                class="form-control"
                                id="file_2"
                                placeholder="Введите ссылку для instagram"
                                v-model="data.file_2"
                            />
                        </div>
                    </div>
                </div>

                <button class="btn btn-sm btn-success" @click="updateInfo">
                    Сохранить изменения
                </button>
            </div>
        </div>
    </div>
</div>
</template>