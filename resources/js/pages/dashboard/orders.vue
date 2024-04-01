<script setup>
import { onMounted, ref, inject } from 'vue'
import PageHeader from "@js/components/dashboard/PageHeader.vue"

const title = 'Список заказов'
const orders = ref(null)

const swal = inject('$swal')

onMounted(() => {
  // window.Echo.private(`App.Models.Orders.${res.data.user.id}`)
  //   .listen('.order.changed', (e) => {
  //       console.log(e);
  //     //store.commit(SET_USER, e.user);
  //   });
  socket()
  getOrders()
});

const socket = () => {
  window.Echo.channel('Payments')
      .listen('.success', (e) => {
          console.log(e);
          let index = orders.value.data.findIndex(x => x.id === e.id)
          if(index >= 0) orders.value.data[index].status = e.status
        //store.commit(SET_USER, e.user);
      });
}

const getOrders = () => {
  axios.get('/api/v1/dashboard/orders')
  .then(res => {
    orders.value = res.data.data
  })
}

const checkPayment = (id) => {
  axios.get(`/api/v1/dashboard/orders/payment/${id}`)
    .then(res => {
      let index = orders.value.data.findIndex(x => x.id === res.data.data.id)
      orders.value.data[index].status = res.data.data.status

      if(res.data.data.status !== '70') {
        swal.fire({
          text: 'Заказ не оплачен',
          position: 'bottom-end',
          toast: true,
          showConfirmButton: false,
          icon: 'error',
          timer: 2000,
        });
      } else {
        swal.fire({
          text: 'Заказ оплачен',
          position: 'bottom-end',
          toast: true,
          showConfirmButton: false,
          icon: 'success',
          timer: 2000,
        });
      }
    });
}

const returnOrder = (id) => {
  swal({
    title: `Подтверждение заказа`,
    text: `Вы действительно хотите вернуть заказ #${id}?`,
    icon: "success",
    showCancelButton: true,
    confirmButtonColor: "00ADB5",
    confirmButtonText: "Вернуть заказ",
    cancelButtonText: "Закрыть",
  }).then((result) => { // <--
      if (result.value) { // <-- if confirmed
        axios.get(`/api/v1/dashboard/orders/return/${id}`)
        .then(res => {
          let index = orders.value.data.findIndex(x => x.id === res.data.data.id)
          orders.value.data[index].status = res.data.data.status

          swal.fire({
            text: 'Заказ возвращен',
            position: 'bottom-end',
            // toast: true,
            showConfirmButton: false,
            icon: 'success',
            timer: 2000,
          })
        });
      } 
  });
}

const sendPaymentLink = (id) => {
  axios.get(`/api/v1/dashboard/orders/send_payment/${id}`)
    .then(res => {
      swal.fire({
        text: 'Ссылка отправлена!',
        position: 'bottom-end',
        toast: true,
        showConfirmButton: false,
        icon: 'success',
        timer: 2000,
      })
    });
}

const checkOrder = (id) => {
  axios.get(`/api/v1/dashboard/orders/check/${id}`)
    .then(res => {
      let index = orders.value.data.findIndex(x => x.id === res.data.data.id)
      if(index >= 0) {
        orders.value.data[index] = res.data.data
      }

      swal.fire({
        text: 'Заказ обновлен!',
        position: 'bottom-end',
        toast: true,
        showConfirmButton: false,
        icon: 'success',
        timer: 2000,
      })
    });
}

const confirmOrder = (id) => {
  swal({
    title: `Подтверждение заказа`,
    text: `Вы действительно хотите подтвердить заказ #${id}?`,
    icon: "success",
    showCancelButton: true,
    confirmButtonColor: "#00ADB5",
    confirmButtonText: "Подтвердить заказ",
    cancelButtonText: "Закрыть",
  }).then((result) => { // <--
      if (result.value) { // <-- if confirmed
        axios.get(`/api/v1/dashboard/orders/confirm/${id}`)
        .then(res => {
          let index = orders.value.data.findIndex(x => x.id === res.data.data.id)
          orders.value.data[index].status = res.data.data.status

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
    icon: "success",
    showCancelButton: true,
    //confirmButtonColor: "#00ADB5",
    confirmButtonText: "Завершить заказ",
    cancelButtonText: "Закрыть",
  }).then((result) => { // <--
      if (result.value) { // <-- if confirmed
        axios.get(`/api/v1/dashboard/orders/complete/${id}`)
        .then(res => {
          let index = orders.value.data.findIndex(x => x.id === res.data.data.id)
          orders.value.data[index].status = res.data.data.status

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
    icon: "error",
    showCancelButton: true,
    confirmButtonColor: "#ff449f",
    confirmButtonText: "Отменить заказ",
    cancelButtonText: "Закрыть",
  }).then((result) => { // <--
      if (result.value) { // <-- if confirmed
        axios.get(`/api/v1/dashboard/orders/cancel/${id}`)
        .then(res => {
          let index = orders.value.data.findIndex(x => x.id === res.data.data.id)
          orders.value.data[index].status = res.data.data.status

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
}

</script>
<template>
<PageHeader :title="title" />
<div class="d-flex align-items-center row mb-3">

</div>

<div class="row">
  <div class="col-12">
    <div class="card" v-if="orders && orders.data.length > 0">
      <div class="table-responsive">
        <table class="table table-sticky table-centered table-bordered mb-0">
          <thead class="thead-light">
            <tr>
                <th>Номер</th>
                <th>Получатель</th>
                <th>Заказ</th>
                <th>Статус</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="order in orders.data"> 
                <td class="table-number" :class="{'success': order.status !== 2, 'danger': order.status === 2}">
                  <p v-html="`${order.orderNumber ?? order.id}`" />
                </td>

                <td>
                  <p>
                    <strong v-html="'Имя: '" />
                    <span v-html="order.name" />
                  </p>

                  <p>
                    <strong v-html="'Email: '" />
                    <a :href="`mailto:${order.user.email}`" v-html="order.user.email" />
                  </p>

                  <p>
                    <strong v-html="'Телефон: '" />
                    <a :href="`tel:${order.phone}`" v-html="order.phone" />
                  </p>

                  <p>
                    <strong v-html="'Доставка: '" />
                    <span v-html="order.recieve" />
                  </p>

                  <p v-if="order.comment">
                    <strong v-html="'Комментарий: '" />
                    <span v-html="order.comment" />
                  </p>
                </td>

                <td>
                  <div v-for="order_item in order.order_items" class="table-items" v-if="order.order_items.length > 0">
                    <div class="d-flex align-items-center" v-if="order_item.item">
                      <img :src="order_item.item.image_url ?? '/svg/vertical_white.svg'" width="30" class="sm" />
                      <p>
                        <a :href="order_item.item.link" target="_blank">
                          <strong>{{order_item.item.title}}</strong>
                        </a> <span>{{order_item.count}} шт. x {{order_item.total.toLocaleString('ru')}} ₽</span>
                      </p>
                    </div>
                  </div>
                  
                  <div class="d-flex align-items-center mb-2">
                    <div class="me-2">
                      <button class="btn btn-sm btn-success" @click="checkOrder(order.id)" v-if="order.status === '21' || order.status === '70'">Синхронизировать товары</button>
                    </div>

                    <div class="d-flex align-items-center" v-if="order.paymentRef && order.status === '21'">
                      <button class="btn btn-sm btn-success me-2" @click="sendPaymentLink(order.id)">Отправить ссылку на оплату</button> <a :href="order.paymentRef" target="_blank">(ссылка)</a>
                    </div>
                  </div>

                  <p><strong>Итого:</strong> <span>{{ order.order_sum.toLocaleString('ru') }} ₽</span></p>
                </td>

                <td class="table-number text-nowrap">
                  <p v-if="order.status === '21'" class="mb-2 text-danger">Не оплачено</p>
                  <p v-if="order.status === '70'" class="mb-2 text-success">Оплачено</p>
                  <p v-if="order.status === '220'" class="mb-2 text-danger">Отменен</p>
                  <p v-if="order.status === '200'" class="mb-2 text-success">Завершен</p>

                  <div class="d-flex flex-column">
                    <button class="btn btn-sm btn-success mb-2" @click="confirmOrder(order.id)" v-if="order.status === '10'">Подтвердить</button>
                    <button class="btn btn-sm btn-success mb-2" @click="checkPayment(order.id)" v-if="order.status === '21'">Проверить оплату</button>
                    <button class="btn btn-sm btn-success mb-2" @click="completeOrder(order.id)" v-if="order.status === '70'">Завершить</button>
                    <button class="btn btn-sm btn-danger mb-2" @click="cancelOrder(order.id)" v-if="order.status !== '200' && order.status !== '220'">Отменить</button>
                    <button class="btn btn-sm btn-success" @click="returnOrder(order.id)" v-if="order.status === '200' || order.status === '220'">Вернуть в работу</button>
                  </div>
                </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div v-if="orders && orders.data.length === 0" >
      <p>Заказов нет</p>
    </div>

    <div v-if="!orders">
      <p>Идет загрузка заказов..</p>
    </div>
  </div>
</div>
</template>