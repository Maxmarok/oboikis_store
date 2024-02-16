<script setup>
import {onMounted, ref, inject} from 'vue'
import PageHeader from "@js/components/dashboard/PageHeader.vue"
import { useInfoStore } from '@js/stores/infoStore'
import FileUpload from "@js/components/FileUpload.vue"
import InfoModal from '@js/components/modals/InfoModal.vue'

const data = ref({
    phone: null,
    email: null,
    vk: null,
    telegram: null,
    whatsapp: null,
    viber: null,
    instagram: null,
})

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

const updateInfo = (index) => {

    let info = {}

    switch (index) {
        case 0:
            info = {
                phone: data.value.phone,
                email: data.value.email,
            }
            break;
        case 1:
            info = {
                vk: data.value.vk,
                telegram: data.value.telegram,
                whatsapp: data.value.whatsapp,
                viber: data.value.viber,
                instagram: data.value.instagram,
            }
            break;
        default:
            break;
    }

    if(info) {
        axios.post(`/api/v1/dashboard/info/update`, info)
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
}

const uploadFile = (e, type) => {
    console.log(e.target.files[0]);

    const formData = new FormData();
    formData.append('file', e.target.files[0]);
    formData.append('type', type)
    const headers = { 'Content-Type': 'multipart/form-data' };
    axios.post('/api/v1/dashboard/info/upload', formData, { headers })
    .then((res) => {
        data.value[type] = res.data.data[type];

        swal.fire({
            text: 'Файл успешно загружен',
            //position: 'bottom-end',
            // toast: true,
            showConfirmButton: false,
            icon: 'success',
            timer: 2000,
          })
    });
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
<PageHeader :title="'Основная информация'" />


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
                </div>

                <button class="btn btn-sm btn-success" @click="updateInfo(0)">
                    Сохранить изменения
                </button>
            </div>
        </div>
    </div>
</div>


<PageHeader :title="'Соц. сети'" />

<div class="d-flex align-items-center row mb-3">

</div>

<div class="row">
    <div class="col-lg-12">


        <div class="card">
            <div class="card-body">
                

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

                <button class="btn btn-sm btn-success" @click="updateInfo(1)">
                    Сохранить изменения
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mb-4 mb-lg-0">
                            <FileUpload 
                                label="Политика конфиденциальности"
                                :url="url"
                                :data="data.file_1"
                                id="file_1"
                                @onUpload="(e) => uploadFile(e, 'file_1')"
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <FileUpload 
                                label="Публичная оферта"
                                :url="url"
                                :data="data.file_2"
                                id="file_2"
                                @onUpload="(e) => uploadFile(e, 'file_2')"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>