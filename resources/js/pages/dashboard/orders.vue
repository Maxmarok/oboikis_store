<script setup>
import { onMounted, ref, inject } from 'vue'
import PageHeader from "@js/components/dashboard/PageHeader.vue"

const title = 'Список заказов'
const orders = ref(null)

const swal = inject('$swal')

onMounted(() => {
  getOrders()
});

const getOrders = () => {
  axios.get('/api/v1/dashboard/orders')
  .then(res => {
    orders.value = res.data.data
  })
}

const confirmOrder = (id) => {
  swal({
    title: `Подтверждение заказа`,
    text: `Вы действительно хотите подтвердить заказ #${id}?`,
    type: "success",
    showCancelButton: true,
    //confirmButtonColor: "#3085d6",
    confirmButtonText: "Подтвердить",
    cancelButtonText: "Вернуться",
  }).then((result) => { // <--
      if (result.value) { // <-- if confirmed
        axios.get(`/api/v1/dashboard/orders/confirm/${id}`)
        .then(res => {
          let index = orders.value.findIndex(x => x.id === res.data.data.id)
          orders.value[index].status = res.data.data.status

          swal.fire({
            text: 'Заказ подтвержден',
            //position: 'bottom-end',
            // toast: true,
            showConfirmButton: false,
            icon: 'success',
            timer: 2000,
          })
        });
      } 
  });
}

const completeOrder = (id) => {
  swal({
    title: `Завершение заказа`,
    text: `Вы действительно хотите завершить заказ #${id}?`,
    type: "error",
    showCancelButton: true,
    //confirmButtonColor: "#3085d6",
    confirmButtonText: "Завершить",
    cancelButtonText: "Вернуться",
  }).then((result) => { // <--
      if (result.value) { // <-- if confirmed
        axios.get(`/api/v1/dashboard/orders/complete/${id}`)
        .then(res => {
          let index = orders.value.findIndex(x => x.id === res.data.data.id)
          orders.value[index].status = res.data.data.status

          swal.fire({
            text: 'Заказ завершен',
            //position: 'bottom-end',
            // toast: true,
            showConfirmButton: false,
            icon: 'success',
            timer: 2000,
          })
        });
      } 
  });
}

const cancelOrder = (id) => {
  swal({
    title: `Отмена заказа`,
    text: `Вы действительно хотите отменить заказ #${id}?`,
    type: "error",
    showCancelButton: true,
    //confirmButtonColor: "#3085d6",
    confirmButtonText: "Отменить",
    cancelButtonText: "Вернуться",
  }).then((result) => { // <--
      if (result.value) { // <-- if confirmed
        axios.get(`/api/v1/dashboard/orders/cancel/${id}`)
        .then(res => {
          let index = orders.value.findIndex(x => x.id === res.data.data.id)
          orders.value[index].status = res.data.data.status

          swal.fire({
            text: 'Заказ отменен',
            //position: 'bottom-end',
            // toast: true,
            showConfirmButton: false,
            icon: 'error',
            timer: 2000,
          })
        });
      } 
  });


  axios.post('/api/v1/dashboard/orders/confirmlete', {id: id})
  .then(res => {
    let index = orders.value.findIndex(x => x.id === res.data.data.id)
    orders.value[index].status = res.data.data.status

    swal.fire({
      text: 'Заказ отменен',
      position: 'bottom-end',
      // toast: true,
      showConfirmButton: false,
      icon: 'error',
      timer: 2000,
    })
  })
}

</script>
<template>
<PageHeader :title="title" />
<div class="d-flex align-items-center row mb-3">

</div>

<div class="row">
  <div class="col-12">
    <div class="card" v-if="orders && orders.length > 0">
      <div class="table-responsive">
        <table class="table table-sticky mb-0 text-nowrap">
          <thead class="thead-light">
            <tr>
                <th>Номер заказа</th>
                <th>Получатель</th>
                <th>Заказ</th>
                <th>Статус</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="order in orders"> 
                <td>
                  <p v-html="order.id" />
                </td>

                <td>
                  <p>
                    <strong v-html="'Имя: '" />
                    <span v-html="order.name" />
                  </p>

                  <p>
                    <strong v-html="'Emai: '" />
                    <a :href="`mailto:${order.user.email}`" v-html="order.user.email" />
                  </p>

                  <p>
                    <strong v-html="'Телефон: '" />
                    <a :href="`tel:${order.phone}`" v-html="order.phone" />
                  </p>

                  <p>
                    <strong v-html="'Получение: '" />
                    <span v-html="order.recieve" />
                  </p>

                  <p v-if="order.comment">
                    <strong v-html="'Комментарий: '" />
                    <span v-html="order.comment" />
                  </p>
                </td>

                <td>
                  <p v-for="order_item, i in order.order_items">
                    <span>{{i + 1}}. <a :href="order_item.item.link" target="_blank">{{order_item.item.title}}</a> {{order_item.quantity}} шт. x {{order_item.total.toLocaleString('ru')}} ₽</span>
                  </p>
                  <p>Итого: {{ order.order_sum.toLocaleString('ru') }}₽</p>
                </td>

                <td>
                  <div class="d-flex flex-column" v-if="order.status === 0">
                    <button class="btn btn-success mb-2" @click="confirmOrder(order.id)">Подтвердить заказ</button>
                    <button class="btn btn-danger" @click="cancelOrder(order.id)">Отменить заказ</button>
                  </div>

                  <button v-if="order.status === 1" class="btn btn-success" @click="completeOrder(order.id)">Завершить заказ</button>
                  <p v-if="order.status === 2" class="text-danger">Отменен</p>
                  <p v-if="order.status === 3" class="text-success">Завершен</p>
                </td>
            </tr>
          </tbody>

        </table>
      </div>
    </div>

    <div v-if="orders && orders.length === 0" >
      <p>Заказов нет</p>
    </div>

    <div v-if="!orders">
      <p>Идет загрузка заказов..</p>
    </div>
  </div>
</div>
</template>