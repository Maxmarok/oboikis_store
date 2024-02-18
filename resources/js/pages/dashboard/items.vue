<script setup>
import { onMounted, ref, inject } from 'vue'
import PageHeader from "@js/components/dashboard/PageHeader.vue"
import helper from '@js/components/helper.js'
import { Bootstrap5Pagination } from 'laravel-vue-pagination'

//import AddItemModal from '@/components/modals/AddItemModal.vue'

const title = 'Список товаров'
const items = ref(null)

const modalTitle = ref()
const modalAccount = ref()
const modalType = ref()
const modalItem = ref()

const swal = inject('$swal')

onMounted(() => {
  getItems()
});

const getItems = (page = 1) => {
  axios.get(`/api/v1/dashboard/items?page=${page}`)
  .then(res => {
    items.value = res.data.data
  })
}

const openCreateModal = (title, type, item) => {
  modalTitle.value = title
  modalType.value = type
  modalItem.value = item
  //modalAccount.value.showModal()
}

const updateItem = (id, name) => {

  swal.fire({
    title: 'Обновление товара',
    text: name,
    showCancelButton: true,

    confirmButtonText: "Обновить",
    cancelButtonText: "Вернуться",
    showLoaderOnConfirm: true,
    
    preConfirm: async () => {
      try {
        await axios.get(`/api/v1/dashboard/items/update/${id}`)
        .then(async res => {
          let index = items.value.data.findIndex(x => x.id === res.data.item.id)
          if(index >= 0) items.value.data[index] = res.data.item
        });
      } catch (error) {
        swal.showValidationMessage(`
          Ошибка: ${error}
        `);
      }
    },
  })
  .then((result) => {
  if (result.isConfirmed) {
    swal.fire({
      text: 'Товар обновлен',
      //position: 'bottom-end',
      // toast: true,
      showConfirmButton: false,
      icon: 'success',
      timer: 2000,
    })
  }
});
      
}

// const confirmOrder = (id) => {
//   swal({
//     title: `Подтверждение заказа`,
//     text: `Вы действительно хотите подтвердить заказ #${id}?`,
//     type: "success",
//     showCancelButton: true,
//     //confirmButtonColor: "#3085d6",
//     confirmButtonText: "Подтвердить",
//     cancelButtonText: "Вернуться",
//   }).then((result) => { // <--
//       if (result.value) { // <-- if confirmed
//         axios.get(`/api/v1/dashboard/orders/confirm/${id}`)
//         .then(res => {
//           let index = orders.value.findIndex(x => x.id === res.data.data.id)
//           orders.value[index].status = res.data.data.status

//           swal.fire({
//             text: 'Заказ подтвержден',
//             //position: 'bottom-end',
//             // toast: true,
//             showConfirmButton: false,
//             icon: 'success',
//             timer: 2000,
//           })
//         });
//       } 
//   });
// }

// const completeOrder = (id) => {
//   swal({
//     title: `Завершение заказа`,
//     text: `Вы действительно хотите завершить заказ #${id}?`,
//     type: "error",
//     showCancelButton: true,
//     //confirmButtonColor: "#3085d6",
//     confirmButtonText: "Завершить",
//     cancelButtonText: "Вернуться",
//   }).then((result) => { // <--
//       if (result.value) { // <-- if confirmed
//         axios.get(`/api/v1/dashboard/orders/complete/${id}`)
//         .then(res => {
//           let index = orders.value.findIndex(x => x.id === res.data.data.id)
//           orders.value[index].status = res.data.data.status

//           swal.fire({
//             text: 'Заказ завершен',
//             //position: 'bottom-end',
//             // toast: true,
//             showConfirmButton: false,
//             icon: 'success',
//             timer: 2000,
//           })
//         });
//       } 
//   });
// }

// const cancelOrder = (id) => {
//   swal({
//     title: `Отмена заказа`,
//     text: `Вы действительно хотите отменить заказ #${id}?`,
//     type: "error",
//     showCancelButton: true,
//     //confirmButtonColor: "#3085d6",
//     confirmButtonText: "Отменить",
//     cancelButtonText: "Вернуться",
//   }).then((result) => { // <--
//       if (result.value) { // <-- if confirmed
//         axios.get(`/api/v1/dashboard/orders/cancel/${id}`)
//         .then(res => {
//           let index = orders.value.findIndex(x => x.id === res.data.data.id)
//           orders.value[index].status = res.data.data.status

//           swal.fire({
//             text: 'Заказ отменен',
//             //position: 'bottom-end',
//             // toast: true,
//             showConfirmButton: false,
//             icon: 'error',
//             timer: 2000,
//           })
//         });
//       } 
//   });


//   axios.post('/api/v1/dashboard/orders/confirmlete', {id: id})
//   .then(res => {
//     let index = orders.value.findIndex(x => x.id === res.data.data.id)
//     orders.value[index].status = res.data.data.status

//     swal.fire({
//       text: 'Заказ отменен',
//       position: 'bottom-end',
//       // toast: true,
//       showConfirmButton: false,
//       icon: 'error',
//       timer: 2000,
//     })
//   })
// }

</script>
<template>
<AddItemModal 
    ref="modalAccount" 
    :title="modalTitle"
    :type="modalType"
    :item="modalItem"
    @action="getItems"
/>

<PageHeader :title="title">
    <template #right>
        <div>
            <button @click="openCreateModal('Синхронизировать со Сбис')" class="btn btn-sm btn-success">
                <i class="mdi mdi-refresh mr-2"></i> Синхронизировать со Сбис
            </button>
        </div>
    </template>
</PageHeader>
<div class="d-flex align-items-center row mb-3">

</div>

<div class="row">
  <div class="col-12">
    <Bootstrap5Pagination
        :data="items"
        @pagination-change-page="getItems"
        :show-disabled="true"
        :limit="5"
        v-if="items && items.data.length > 0"
    />
      
    <div class="card" v-if="items && items.data.length > 0">
     

      <div class="table-responsive">
        <table class="table table-sticky table-centered table-bordered mb-0">
          <thead class="thead-light">
            <tr>
                <th>Товар</th>
                <th>Характеристики</th>
                <th>Наличие и цена</th>
                <th>Действие</th>
            </tr>
          </thead>
          
          <tbody>
            <tr v-for="item in items.data">
                <td class="w-50">
                    <p class="mb-2">
                        <img :src="item.image ?? '/svg/vertical_white.svg'" width="50" class="lg" />
                        <strong v-html="item.title" />
                    </p>
                </td>

                <td>
                    <p>
                        <strong :class="{'text-secondary': !item.id}" v-html="'Артикул: '" />
                        <span :class="{'text-secondary': !item.id}" v-html="item.id ?? 'не указано'" />
                    </p>

                    <p>
                        <strong :class="{'text-secondary': !item.type}" v-html="'Тип товара: '" />
                        <span :class="{'text-secondary': !item.type}" v-html="item.type ?? 'не указано'" />
                    </p>

                    <p>
                        <strong :class="{'text-secondary': !item.producer}" v-html="'Бренд: '" />
                        <span :class="{'text-secondary': !item.producer}" v-html="item.producer ?? 'не указано'" />
                    </p>

                    <p>
                        <strong :class="{'text-secondary': !item.country}" v-html="'Производство: '" />
                        <span :class="{'text-secondary': !item.country}" v-html="item.country ?? 'не указано'" />
                    </p>
                </td>

                <td>
                    <p>
                        <strong v-html="'Цена: '" />
                        <span v-html="helper.getPrice(item.price)" />
                    </p>

                    <p v-if="item.discount > 0">
                        <strong v-html="'Скидка: '" />
                        <span v-html="helper.getPrice(item.discount)" />
                    </p>
                    <p v-if="item.discount > 0">
                        <strong v-html="'Цена со скидкой: '" />
                        <span v-html="helper.getPrice(item.discount_price)" />
                    </p>

                    <p>
                        <strong :class="{'text-secondary': item.stock <= 0}" v-html="'Наличие: '" />
                        <span :class="{'text-secondary': item.stock <= 0}" v-html="item.stock > 0 ? `${item.stock} шт.` : 'нет в наличии'" />
                    </p>
                </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-success" @click="updateItem(item.id, item.name)"><i class="mdi mdi-refresh mr-2"></i> Обновить</button>
                </td>
            </tr>
          </tbody>
        </table>
        
      </div>

      
    </div>

    <Bootstrap5Pagination
      :data="items"
      @pagination-change-page="getItems"
      :show-disabled="true"
      :limit="5"
      v-if="items && items.data.length > 0"
    />

    <div v-if="items && items.data.length === 0" >
      <p>Товаров нет</p>
    </div>

    <div v-if="!items">
      <p>Идет загрузка товаров..</p>
    </div>
  </div>
</div>
</template>